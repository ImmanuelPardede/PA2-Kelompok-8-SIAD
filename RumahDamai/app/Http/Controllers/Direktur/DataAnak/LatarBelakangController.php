<?php

namespace App\Http\Controllers\Direktur\DataAnak;

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
use Dompdf\Options;
use Dompdf\Dompdf;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LatarBelakangController extends Controller
{
    public function index()
    {
        $latarBelakangList = LatarBelakang::orderBy('created_at', 'desc')->paginate(7);
        return view('direktur.DataAnak.latarBelakang.index', compact('latarBelakangList'));
    }

    public function create()
    {
        $anak = Anak::all();
        $loggedInUserId = Auth::id();
        $users = User::where('role', 'admin')->where('id', $loggedInUserId)->get();
        return view('direktur.DataAnak.latarBelakang.create', compact('anak'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anak_id' => 'required|exists:anak,id',
            'usia' => 'required|numeric',
            'kelas' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d',
            'gambar_latar_belakang.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Create the LatarBelakang record
            $latarBelakang = LatarBelakang::create([
                'anak_id' => $request->anak_id,
                'usia' => $request->usia,
                'kelas' => $request->kelas,
                'tanggal' => $request->tanggal,
                'user_id' => Auth::id(), // Assign logged in user ID
            ]);

            // Save each description as a separate record in the deskripsi_latar_belakang table
            foreach ($request->deskripsi as $desc) {
                DeskripsiLatarBelakang::create([
                    'latar_belakang_id' => $latarBelakang->id,
                    'deskripsi' => $desc,
                ]);
            }

            // Handle Gambar Upload
            if ($request->hasFile('gambar_latar_belakang')) {
                foreach ($request->file('gambar_latar_belakang') as $image) {
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $path = public_path('uploads/gambar_latar_belakang/');
                    $image->move($path, $filename);

                    GambarLatarBelakang::create([
                        'nama' => $filename,
                        'latar_belakang_id' => $latarBelakang->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('direktur.latarBelakang.index')->with('success', 'Latar belakang berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $latarBelakang = LatarBelakang::with('deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);
        $anak = Anak::all();
        return view('direktur.DataAnak.latarBelakang.edit', compact('latarBelakang', 'anak'));
    }

    public function show($id)
    {
        $latarBelakang = LatarBelakang::with('deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);
        return view('direktur.DataAnak.latarBelakang.show', compact('latarBelakang'));
    }

    public function update(Request $request, $id)
    {
        $latarBelakang = LatarBelakang::findOrFail($id);

        $request->validate([
            'anak_id' => 'required|integer|exists:anak,id',
            'usia' => 'required|integer',
            'kelas' => 'required|string',
            'tanggal' => 'required|date',
            'gambar_latar_belakang.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi.*' => 'required|string'
        ]);

        DB::transaction(function () use ($request, $latarBelakang) {
            // Update the main record
            $latarBelakang->update(array_merge(
                $request->only(['anak_id', 'usia', 'kelas', 'tanggal']),
                ['user_id' => Auth::id()]
            ));

            // Handle image deletions
            if ($request->has('deleted_images')) {
                foreach ($request->deleted_images as $imageId) {
                    $image = GambarLatarBelakang::find($imageId);
                    if ($image) {
                        $path = public_path('uploads/gambar_latar_belakang/' . $image->nama);
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
                        $file->move(public_path('uploads/gambar_latar_belakang'), $filename);

                        if ($request->has('existing_image_ids') && isset($request->existing_image_ids[$key])) {
                            $existingImageId = $request->existing_image_ids[$key];
                            $existingImage = GambarLatarBelakang::find($existingImageId);

                            if ($existingImage) {
                                $existingImagePath = public_path('uploads/gambar_latar_belakang/' . $existingImage->nama);
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
        });

        return redirect()->route('direktur.latarBelakang.index')->with('success', 'Latar belakang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = LatarBelakang::findOrFail($id);
        $item->delete();

        return redirect()->route('direktur.latarBelakang.index')
            ->with('success', 'Latar belakang berhasil dihapus.');
    }

    public function generatePDF($id)
    {
        ini_set('max_execution_time', 300); 

        $latarBelakang = LatarBelakang::with('anak', 'deskripsiLatarBelakang', 'gambarLatarBelakang')->findOrFail($id);

        $pdfView = view('direktur.DataAnak.latarBelakang.pdf', compact('latarBelakang'))->render();

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
