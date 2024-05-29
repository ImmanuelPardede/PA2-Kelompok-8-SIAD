<?php

namespace App\Http\Controllers\Admin\DataAnak;

use App\Models\Anak;
use App\Models\DeskripsiLatarBelakang;
use App\Models\GambarLatarBelakang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LatarBelakang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LatarBelakangController extends Controller
{
    public function index()
    {
        $latarBelakangList = LatarBelakang::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.DataAnak.latarBelakang.index', compact('latarBelakangList'));
    }

    public function create()
    {
        $anak = Anak::all();
        $loggedInUserId = Auth::id();
        $users = User::where('role', 'admin')->where('id', $loggedInUserId)->get();

        return view('admin.DataAnak.latarBelakang.create', compact('anak', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anak_id' => 'required|exists:anak,id',
            'usia' => 'required|numeric',
            'kelas' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'gambar_latar_belakang.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $latarBelakang = LatarBelakang::create([
                'anak_id' => $request->anak_id,
                'usia' => $request->usia,
                'kelas' => $request->kelas,
                'tanggal' => $request->tanggal,
                'user_id' => Auth::id(), // Assign logged in user ID
            ]);

            foreach ($request->deskripsi as $desc) {
                DeskripsiLatarBelakang::create([
                    'latar_belakang_id' => $latarBelakang->id,
                    'deskripsi' => $desc,
                ]);
            }

            if ($request->hasFile('gambar_latar_belakang')) {
                foreach ($request->file('gambar_latar_belakang') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('uploads/gambar_latar_belakang', $filename, 'public');

                    GambarLatarBelakang::create([
                        'nama' => $filename,
                        'latar_belakang_id' => $latarBelakang->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.latarBelakang.index')->with('success', 'Latar belakang berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $latarBelakang = LatarBelakang::with('deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);
        $anak = Anak::all();
        return view('admin.DataAnak.latarBelakang.edit', compact('latarBelakang', 'anak'));
    }

    public function show($id)
    {
        $latarBelakang = LatarBelakang::with('deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);
        return view('admin.DataAnak.latarBelakang.show', compact('latarBelakang'));
    }

    public function update(Request $request, $id)
    {
        $latarBelakang = LatarBelakang::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'anak_id' => 'required|exists:anak,id',
            'usia' => 'required|numeric',
            'kelas' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'gambar_latar_belakang.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Update the main record and assign user_id to the logged-in user
            $latarBelakang->update(array_merge(
                $request->only(['anak_id', 'usia', 'kelas', 'tanggal']),
                ['user_id' => Auth::id()]
            ));

            // Handle image deletions
            if ($request->has('deleted_images')) {
                foreach ($request->deleted_images as $imageId) {
                    $image = GambarLatarBelakang::find($imageId);
                    if ($image) {
                        $path = storage_path('app/public/uploads/gambar_latar_belakang/' . $image->nama);
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $image->delete();
                    }
                }
            }

            // Handle new file uploads and replace existing images if necessary
            if ($request->hasFile('gambar_latar_belakang')) {
                foreach ($request->file('gambar_latar_belakang') as $key => $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('uploads/gambar_latar_belakang', $filename, 'public');

                        if (isset($request->existing_image_ids[$key])) {
                            $existingImageId = $request->existing_image_ids[$key];
                            $existingImage = GambarLatarBelakang::find($existingImageId);

                            if ($existingImage) {
                                $existingImagePath = storage_path('app/public/uploads/gambar_latar_belakang/' . $existingImage->nama);
                                if (File::exists($existingImagePath)) {
                                    File::delete($existingImagePath);
                                }
                                $existingImage->nama = $filename;
                                $existingImage->save();
                            }
                        } else {
                            GambarLatarBelakang::create([
                                'latar_belakang_id' => $latarBelakang->id,
                                'nama' => $filename,
                            ]);
                        }
                    }
                }
            }

            // Update descriptions
            DeskripsiLatarBelakang::where('latar_belakang_id', $latarBelakang->id)->delete();
            foreach ($request->deskripsi as $desc) {
                DeskripsiLatarBelakang::create([
                    'latar_belakang_id' => $latarBelakang->id,
                    'deskripsi' => $desc,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.latarBelakang.index')->with('success', 'Latar belakang berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $item = LatarBelakang::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.latarBelakang.index')->with('success', 'Latar belakang berhasil dihapus.');
    }

    public function generatePDF($id)
    {
        ini_set('max_execution_time', 300);

        $latarBelakang = LatarBelakang::with('anak', 'deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);

        $pdfView = view('admin.DataAnak.latarBelakang.pdf', compact('latarBelakang'))->render();

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($pdfView);
        $dompdf->setPaper('A4', 'portrait');

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);
        $dompdf->setHttpContext($context);

        $dompdf->render();

        $filename = 'anak_profile_' . str_replace(' ', '_', $latarBelakang->anak->nama_lengkap) . '.pdf';

        return $dompdf->stream($filename);
    }
}
