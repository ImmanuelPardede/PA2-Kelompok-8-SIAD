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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        $pendidikan = Pendidikan::all();
    $agama = Agama::all();
    $jeniskelamin = JenisKelamin::all();
    $golongandarah = GolonganDarah::all();
    $lokasi = LokasiTugas::all();    

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
    
        return view('admin.administrator.show', compact('user', 'redirectRoute','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    }
    
    


    // Menyimpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'lokasi_penugasan_id' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
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
        
        // Generate NIP
        $lokasi_penugasan_id = str_pad($request->lokasi_penugasan_id ?? 0, 1, '0', STR_PAD_LEFT); // Ambil lokasi_penugasan_id atau isi 0 jika null
        $tahun_masuk = date('y');
        $tahun_lahir = substr(date('Y', strtotime($user->tanggal_lahir)), -2);
        
        $latest_user = User::latest()->first(); // Ambil user terakhir untuk mendapatkan nomor urut terakhir
        $nomor_urut = $latest_user ? ((int) substr($latest_user->nip, -3)) + 1 : 1; // Jika tidak ada user sebelumnya, nomor urut dimulai dari 1
        
        $user->nip = $lokasi_penugasan_id . $tahun_masuk . $tahun_lahir . str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
    
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
            'newPassword' => 'nullable|string', // Ganti validasi password
        ]);
    
        // Perbarui atribut yang dapat diisi dari request
        $user->fill($request->except('foto', 'newPassword'));
    
        // Perbarui password jika disertakan dalam permintaan
        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->newPassword);
        }
    
        // Proses penyimpanan foto Data Diri jika ada
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
    public function editGuruDataDiri(User $user)
{
    $pendidikan = Pendidikan::all();
    $agama = Agama::all();
    $jeniskelamin = JenisKelamin::all();
    $golongandarah = GolonganDarah::all();
    $lokasi = LokasiTugas::all();
    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.DataDiri.edit', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit Data Diri guru lain.');
    }
}

public function updateGuruDataDiri(Request $request, User $user)
{
    $request->validate([
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
    
        // Proses penyimpanan foto Data Diri jika ada
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

        return redirect()->route('guru.DataDiri.show', ['user' => $user])->with('success', 'Data Diri guru berhasil diperbarui.');
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit Data Diri guru lain.');
    }
}



public function showGuruDataDiri(User $user)
{
    $pendidikan = Pendidikan::all();
    $agama = Agama::all();
    $jeniskelamin = JenisKelamin::all();
    $golongandarah = GolonganDarah::all();
    $lokasi = LokasiTugas::all();    

    if(auth()->user()->id === $user->id && $user->role === 'guru') {
        return view('guru.DataDiri.show', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
    } else {
        return redirect()->back()->with('error', 'Anda tidak diizinkan melihat Data Diri guru lain.');
    }
}

    
    /* ======================================== - STAFF - ===================================================== */

    public function editStaffDataDiri(User $user)
    {
        $pendidikan = Pendidikan::all();
        $agama = Agama::all();
        $jeniskelamin = JenisKelamin::all();
        $golongandarah = GolonganDarah::all();
        $lokasi = LokasiTugas::all();
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.DataDiri.edit', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit Data Diri staff lain.');
        }
    }
    
    public function updateStaffDataDiri(Request $request, User $user)
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
        
            // Proses penyimpanan foto Data Diri jika ada
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
    
    
            return redirect()->route('staff.DataDiri.show', ['user' => $user])->with('success', 'Data Diri anda berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit Data Diri anda lain.');
        }
    }
    
    
    public function showStaffDataDiri(User $user)
    {
        $pendidikan = Pendidikan::all();
        $agama = Agama::all();
        $jeniskelamin = JenisKelamin::all();
        $golongandarah = GolonganDarah::all();
        $lokasi = LokasiTugas::all();
        if(auth()->user()->id === $user->id && $user->role === 'staff') {
            return view('staff.DataDiri.show', compact('user','pendidikan','agama','jeniskelamin','golongandarah','lokasi'));
        } else {
            return redirect()->back()->with('error', 'Anda tidak diizinkan melihat Data Diri staff lain.');
        }
    }


    public function showResetPasswordGuru(User $user)
    {
        return view('guru.DataDiri.password', compact('user'));
    }

    public function resetPasswordGuru(Request $request, User $user)
{
    $request->validate([
        'tanggal_lahir' => 'required|date',
        'new_password' => 'required|string|min:8',
        'confirm_password' => 'required|string|same:new_password',
    ]);

    // Validasi tanggal lahir
    if ($request->tanggal_lahir == $user->tanggal_lahir) {
        // Reset password
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('guru.DataDiri.show', ['user' => $user])->with('success', 'Password berhasil direset.');
    } else {
        return redirect()->back()->with('error', 'Tanggal lahir tidak cocok. Password tidak direset.');
    }
}

public function showResetPasswordStaff(User $user)
    {
        return view('staff.DataDiri.password', compact('user'));
    }
    
    public function resetPasswordStaff(Request $request, User $user)
{
    $request->validate([
        'tanggal_lahir' => 'required|date',
        'new_password' => 'required|string|min:8',
        'confirm_password' => 'required|string|same:new_password',
    ]);

    // Validasi tanggal lahir
    if ($request->tanggal_lahir == $user->tanggal_lahir) {
        // Reset password
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('staff.DataDiri.show', ['user' => $user])->with('success', 'Password berhasil direset.');
    } else {
        return redirect()->back()->with('error', 'Tanggal lahir tidak cocok. Password tidak direset.');
    }
}


    
    


    
        
}
