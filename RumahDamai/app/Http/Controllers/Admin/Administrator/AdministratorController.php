<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\LokasiTugas;
use App\Models\User;
use App\Models\Pendidikan;
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
        $lokasi = LokasiTugas::all();
        $users = User::all();

        return view('admin.administrator.create',compact('users','lokasi'));
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
        'lokasi_penugasan_id' => 'nullable|string',
        'role' => 'required|string|in:admin,guru,staff',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto harus berupa gambar dengan maksimum 2MB
    ]);

    // Jika pengguna mengunggah foto, simpan foto yang diunggah, jika tidak, gunakan 'bodat.jpg'

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
        $pendidikan = Pendidikan::all();
        $agama = Agama::all();
        $jeniskelamin = JenisKelamin::all();
        $golongandarah = GolonganDarah::all();
        $lokasi = LokasiTugas::all();
        return view('admin.administrator.edit', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    }


public function update(Request $request, User $user)
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
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Perbarui atribut yang dapat diisi dari request
    $user->fill($request->except('foto', 'password'));

    // Perbarui password jika disertakan dalam permintaan
    if ($request->has('password')) {
        $user->password = Hash::make($request->password);
    }

    // Proses penyimpanan foto profil jika ada
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
        $lokasi_simpan = public_path('uploads/pegawai'); // Lokasi penyimpanan diubah sesuai kebutuhan
        $foto->move($lokasi_simpan, $nama_foto);

        // Hapus foto lama jika ada
        if ($user->foto) {
            $foto_lama = public_path('uploads/pegawai/'.$user->foto);
            if (file_exists($foto_lama)) {
                unlink($foto_lama);
            }
        }

        // Set foto baru
        $user->foto = $nama_foto;
    }

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

    return redirect()->route($redirectRoute)->with('success', 'Akun berhasil diperbarui.');
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
    $pendidikan = Pendidikan::all();
    $agama = Agama::all();
    $jeniskelamin = JenisKelamin::all();
    $golongandarah = GolonganDarah::all();
    $lokasi = LokasiTugas::all();
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.profile.edit', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
    }
}

public function updateGuruProfile(Request $request, User $user)
{
    $request->validate([
        'nama_lengkap' => 'required|string',
        'golongan_darah_id' => 'nullable|string',
        'jenis_kelamin_id' => 'nullable|string',
        'agama_id' => 'nullable|string',
        'pendidikan_id' => 'nullable|string',
        'alamat' => 'nullable|string',
        'tanggal_masuk' => 'nullable|date',
        'tanggal_keluar' => 'nullable|date',
        'tempat_lahir' => 'nullable|string',
        'tanggal_lahir' => 'nullable|date',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);


        $user->fill($request->except('password'));

        // Perbarui password jika disertakan dalam permintaan
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Proses penyimpanan foto profil jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $lokasi_simpan = public_path('uploads/pegawai'); // Lokasi penyimpanan diubah sesuai kebutuhan
            $foto->move($lokasi_simpan, $nama_foto);
    
            // Hapus foto lama jika ada
            if ($user->foto) {
                $foto_lama = public_path('uploads/pegawai/'.$user->foto);
                if (file_exists($foto_lama)) {
                    unlink($foto_lama);
                }
            }
    
            // Set foto baru
            $user->foto = $nama_foto;

        // Simpan perubahan pada model pengguna
        $user->save();

        return redirect()->route('guru.profile.show', ['user' => $user])->with('success', 'Profil guru berhasil diperbarui.');
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
    }
}



public function showGuruProfile(User $user)
{
    $pendidikan = Pendidikan::all();
    $agama = Agama::all();
    $jeniskelamin = JenisKelamin::all();
    $golongandarah = GolonganDarah::all();
    $lokasi = LokasiTugas::all();    
    
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.profile.show', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan melihat profil guru lain.');
    }
}

    
    /* ======================================== - STAFF - ===================================================== */

    public function editStaffProfile(User $user)
    {
        $pendidikan = Pendidikan::all();
        $agama = Agama::all();
        $jeniskelamin = JenisKelamin::all();
        $golongandarah = GolonganDarah::all();
        $lokasi = LokasiTugas::all();
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.profile.edit', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil staff lain.');
        }
    }
    
    public function updateStaffProfile(Request $request, User $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'golongan_darah_id' => 'nullable|string',
            'jenis_kelamin_id' => 'nullable|string',
            'agama_id' => 'nullable|string',
            'pendidikan_id' => 'nullable|string',
            'alamat' => 'nullable|string',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_keluar' => 'nullable|date',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
    
            $user->fill($request->except('password'));
    
            // Perbarui password jika disertakan dalam permintaan
            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }
        
            // Proses penyimpanan foto profil jika ada
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
                $lokasi_simpan = public_path('uploads/pegawai'); // Lokasi penyimpanan diubah sesuai kebutuhan
                $foto->move($lokasi_simpan, $nama_foto);
        
                // Hapus foto lama jika ada
                if ($user->foto) {
                    $foto_lama = public_path('uploads/pegawai/'.$user->foto);
                    if (file_exists($foto_lama)) {
                        unlink($foto_lama);
                    }
                }
        
                // Set foto baru
                $user->foto = $nama_foto;
            }
    
            // Simpan perubahan pada model pengguna
            $user->save();
    
    
            return redirect()->route('staff.profile.show', ['user' => $user])->with('success', 'Profil guru berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit profil guru lain.');
        }
    }
    
    public function showStaffProfile(User $user)
    {
        $pendidikan = Pendidikan::all();
        $agama = Agama::all();
        $jeniskelamin = JenisKelamin::all();
        $golongandarah = GolonganDarah::all();
        $lokasi = LokasiTugas::all();
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.profile.show', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan melihat profil staff lain.');
        }
    }
        
}
