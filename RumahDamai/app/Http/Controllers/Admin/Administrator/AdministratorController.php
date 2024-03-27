<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    // Menampilkan semua akun
    public function admin()
    {
        $users = User::all();
        return view('admin.administrator.admin', compact('users'));
    }

    public function guru()
    {
        $users = User::all();
        return view('admin.administrator.guru', compact('users'));
    }

    public function staff()
    {
        $users = User::all();
        return view('admin.administrator.staff', compact('users'));
    }

    // Menampilkan form untuk menambahkan akun
    public function create()
    {
        return view('admin.administrator.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Mengambil pengguna berdasarkan ID
        
        // Periksa peran pengguna dan sesuaikan tautan kembali
        switch ($user->role) {
            case 0:
                $redirectRoute = 'admin.administrator.admin';
                break;
            case 1:
                $redirectRoute = 'admin.administrator.guru'; // Ganti 'guru.index' dengan nama rute untuk halaman guru
                break;
            case 2:
                $redirectRoute = 'admin.administrator.staff'; // Ganti 'staff.index' dengan nama rute untuk halaman staff
                break;
            default:
                $redirectRoute = 'dashboard'; // Ganti 'home' dengan rute default jika tidak sesuai peran yang diharapkan
                break;
        }
    
        return view('admin.administrator.show', compact('user', 'redirectRoute'));
    }
    
    


    // Menyimpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.administrator.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit akun
    public function edit(User $user)
    {
        return view('admin.administrator.edit', compact('user'));
    }

    // Menyimpan perubahan pada akun yang diedit
    public function update(Request $request, User $user)
{
    $request->validate([
        'nama_lengkap' => 'required|string',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'role' => 'required|string|in:admin,guru,staff', // Memastikan input hanya admin, guru, atau staff
        'nip' => 'nullable|string',
        'golongan_darah_id' => 'nullable|string',
        'jenis_kelamin_id' => 'nullable|string',
        'agama_id' => 'nullable|string',
        'pendidikan_id' => 'nullable|string',
        'alamat' => 'nullable|string',
        'tanggal_masuk' => 'nullable|date',
        'tanggal_keluar' => 'nullable|date',
        'tempat_lahir' => 'nullable|string',
        'tanggal_lahir' => 'nullable|date',
        'lokasi_penugasan_id' => 'nullable|string',
        'foto' => 'nullable|string',
    ]);

    // Inisialisasi nilai role berdasarkan tipe pengguna
    $role = match ($request->role) {
        'admin' => 0,
        'guru' => 1,
        'staff' => 2,
        default => 0, // Nilai default jika input tidak cocok
    };

    // Update atribut user dan role
    $user->update(array_merge($request->all(), ['role' => $role]));

    return redirect()->route('admin.administrator.index')->with('success', 'Akun berhasil diperbarui.');
}



    // Menghapus akun
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.administrator.index')->with('success', 'Akun berhasil dihapus.');
    }
}
