<?php

namespace App\Http\Controllers\Admin\Todolist;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use App\Models\LokasiTugas;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Anak;
use App\Models\Donatur;
use App\Models\ModulMateri;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('created_at', 'desc')->take(5)->get();
        $totalPegawai = User::count();
        $totalanak = Anak::count();
        $todolist = TodoList::where('user_id', Auth::id())->get(); // Hanya menampilkan tugas milik user yang login
        $totalmateri = ModulMateri::count();
        $totoldonatur = Donatur::count();

        return view('dashboard', compact('totalPegawai', 'pengumumans', 'totalanak', 'todolist', 'totalmateri', 'totoldonatur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas' => 'required|string|max:255',
        ]);

        TodoList::create([
            'tugas' => $request->tugas,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Task added successfully.');
    }

    public function edit(Request $request, $id)
    {
        $todo = TodoList::findOrFail($id);

        // Periksa apakah pengguna yang sedang masuk memiliki izin untuk mengedit tugas
        if ($todo->user_id !== Auth::id()) {
            return Redirect::back()->withErrors(['msg', 'You are not authorized to edit this task.']);
        }

        // Periksa status yang dikirim dari request
        $newStatus = $request->input('status');
        if (in_array($newStatus, ['menunggu', 'selesai'])) {
            $todo->status = $newStatus; // Perbarui status berdasarkan inputan
            $todo->save();
        }

        return response()->json(['message' => 'Task status updated successfully.']);
    }


    public function destroy($id)
    {
        $todo = TodoList::findOrFail($id);

        // Periksa apakah pengguna memiliki hak untuk menghapus
        if ($todo->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['msg', 'You are not authorized to delete this task.']);
        }

        $todo->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }
}
