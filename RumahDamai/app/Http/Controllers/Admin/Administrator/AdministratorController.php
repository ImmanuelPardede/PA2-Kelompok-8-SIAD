<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /* ================================== - Adamin - ===================================================== */
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

    public function create()
    {
        $users = User::all();

        return view('admin.administrator.create',compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id); 
        
      
        switch ($user->role) {
            case 0:
                $redirectRoute = 'admin.administrator.admin';
                break;
            case 1:
                $redirectRoute = 'admin.administrator.guru'; 
                break;
            case 2:
                $redirectRoute = 'admin.administrator.staff'; 
                break;
            default:
                $redirectRoute = 'dashboard'; 
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
            'role' => 'required|string|in:admin,guru,staff', 
        ]);
    
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->role = match ($request->role) {
            'admin' => 0,
            'guru' => 1,
            'staff' => 2,
            default => 0, 
        };
        $user->save();
    
        switch ($user->role) { 
            case 'admin':
                $redirectRoute = 'admin.administrator.admin';
                break;
            case 'guru':
                $redirectRoute = 'admin.administrator.guru';
                break;
            case 'staff':
                $redirectRoute = 'admin.administrator.staff';
                break;
            default:
                $redirectRoute = 'dashboard'; 
                break;
        }
    
        return redirect()->route($redirectRoute)->with('success', 'Akun berhasil ditambahkan.');
    }
    


    public function edit(User $user)
    {
        return view('admin.administrator.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'nama_lengkap' => 'required|string',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'role' => 'required|string|in:admin,guru,staff', 
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

    $role = match ($request->role) {
        'admin' => 0,
        'guru' => 1,
        'staff' => 2,
        default => 0, 
    };

    $user->update(array_merge($request->all(), ['role' => $role]));

    switch ($user->role) { 
        case 'admin':
            $redirectRoute = 'admin.administrator.admin';
            break;
        case 'guru':
            $redirectRoute = 'admin.administrator.guru';
            break;
        case 'staff':
            $redirectRoute = 'admin.administrator.staff';
            break;
        default:
            $redirectRoute = 'dashboard'; 
            break;
    }

    return redirect()->route($redirectRoute)->with('success', 'Akun berhasil ditambahkan.');
}



    // Menghapus akun
    public function destroy(User $user)
    {
        $user->delete();
        
        // Tentukan rute redirect berdasarkan peran pengguna yang dihapus
        switch ($user->role) {
            case 'admin': 
                $redirectRoute = 'admin.administrator.admin';
                break;
            case 'guru': 
                $redirectRoute = 'admin.administrator.guru';
                break;
            case 'staff': 
                $redirectRoute = 'admin.administrator.staff';
                break;
            default: 
                $redirectRoute = 'dashboard';
                break;
        }
    
        return redirect()->route($redirectRoute)->with('success', 'Akun berhasil diperbarui.');
    }


    /* ======================================== - GURU - ===================================================== */
    public function editGuruProfile(User $user)
{
    // Pastikan hanya pengguna yang sedang login yang dapat mengedit profil guru mereka sendiri
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.profile.edit', compact('user'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
    }
}

public function updateGuruProfile(Request $request, User $user)
{
    // Validasi data yang dikirimkan untuk update profil guru
    $request->validate([
        'nama_lengkap' => 'required|string',
        'email' => 'required|email|unique:users,email,'.$user->id,
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

    // Pastikan hanya pengguna yang sedang login yang dapat mengedit profil guru mereka sendiri
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        $user->update($request->all());

        return redirect()->route('guru.profile.show', ['user' => $user])->with('success', 'Profil guru berhasil diperbarui.');
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
    }
}


public function showGuruProfile(User $user)
{
    // Pastikan hanya pengguna yang sedang login yang dapat melihat profil guru mereka sendiri
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.profile.show', compact('user'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan melihat profil guru lain.');
    }
}

    
    /* ======================================== - STAFF - ===================================================== */

    public function editStaffProfile(User $user)
    {
        // Pastikan hanya pengguna yang sedang login yang dapat mengedit profil staff mereka sendiri
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.profile.edit', compact('user'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil staff lain.');
        }
    }
    
    public function updateStaffProfile(Request $request, User $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
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
    
        // Pastikan hanya pengguna yang sedang login yang dapat mengedit profil guru mereka sendiri
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            $user->update($request->all());
    
            return redirect()->route('staff.profile.show', ['user' => $user])->with('success', 'Profil guru berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
        }
    }
    
    public function showStaffProfile(User $user)
    {
        // Pastikan hanya pengguna yang sedang login yang dapat melihat profil staff mereka sendiri
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.profile.show', compact('user'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan melihat profil staff lain.');
        }
    }
        
}
