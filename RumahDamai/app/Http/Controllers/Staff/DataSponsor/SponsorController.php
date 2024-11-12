<?php

namespace App\Http\Controllers\Staff\DataSponsor;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function index(Request $request)
{
    $currentYear = now()->year;
    $selectedYear = $request->input('tanggal_sponsor') ?: $currentYear;

    $sponsorList = Sponsor::when($selectedYear, function ($query, $selectedYear) {
            return $query->whereYear('tanggal_sponsor', $selectedYear);
        })
        ->orderBy('created_at', 'desc')  // Mengurutkan dari yang paling baru
        ->paginate(7)
        ->appends(['tanggal_sponsor' => $selectedYear]); // Menjaga filter saat pagination

    // Mengambil tahun yang unik saja dari kolom 'tanggal_sponsor'
    $tanggalSponsorList = Sponsor::selectRaw('YEAR(tanggal_sponsor) as tahun')
        ->groupBy('tahun')
        ->orderBy('tahun', 'desc')  // Mengurutkan dari yang paling baru
        ->get();

    return view('staff.DataSponsor.index', compact('sponsorList', 'tanggalSponsorList', 'selectedYear'));
}





    public function create()
    {
        $sponsorship = Sponsorship::all();
        $loggedInUserId = Auth::id();
        return view('staff.DataSponsor.create', compact('sponsorship', 'loggedInUserId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sponsor' => 'required|string',
            'email_sponsor' => 'required|string|email',
            'tanggal_sponsor' => 'required|date',
            'no_telepon_sponsor' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'jumlah_sponsor' => 'nullable|numeric',
            'foto_sponsor' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'lainnya' => 'nullable|string|max:255',
        ]);

        $sponsor_ids = $request->input('sponsorship_id', []);

        foreach ($sponsor_ids as $sponsor_id) {
            if ($sponsor_id !== 'lainnya' && !Sponsorship::find($sponsor_id)) {
                return redirect()->back()->withErrors(['sponsorship_id' => 'The selected sponsorship_id is invalid.']);
            }
        }

        // Assign logged in user ID
        $validatedData['user_id'] = Auth::id();
        $validatedData['jumlah_sponsor'] = $validatedData['jumlah_sponsor'] ?? 0;

        // Proses upload foto_sponsor
        if ($request->hasFile('foto_sponsor')) {
            $gambar = $request->file('foto_sponsor');
            $slug = Str::slug(pathinfo($gambar->getClientOriginalName(), PATHINFO_FILENAME));
            $new_gambar = time() . '_' . $slug . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/sponsor/'), $new_gambar);
            $validatedData['foto_sponsor'] = 'uploads/sponsor/' . $new_gambar;
        }

        if (!empty($validatedData['lainnya'])) {
            $validatedData['lainnya'] = $request->input('lainnya');
        }

        $sponsor = Sponsor::create($validatedData);
        $sponsor->sponsorship()->attach(array_filter($sponsor_ids, fn ($id) => $id !== 'lainnya'));

        return redirect()->route('dataSponsor.index')->with('success', 'Data Sponsor berhasil ditambahkan.');
    }


    public function show($id)
    {
        $sponsor = Sponsor::with('sponsorship')->find($id);
        return view('staff.DataSponsor.show', compact('sponsor'));
    }

    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsorship = Sponsorship::all();
        $selectedSponsorshipIds = $sponsor->sponsorship->pluck('id')->toArray();
        if ($sponsor->lainnya) {
            $selectedSponsorshipIds[] = 'lainnya';
        }
        return view('staff.DataSponsor.edit', compact('sponsor', 'sponsorship', 'selectedSponsorshipIds'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_sponsor' => 'nullable|string',
            'email_sponsor' => 'nullable|string|email',
            'tanggal_sponsor' => 'nullable|date',
            'no_telepon_sponsor' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'jumlah_sponsor' => 'nullable|numeric',
            'foto_sponsor' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'lainnya' => 'nullable|string|max:255',
            'sponsorship_id' => 'nullable|array',
        ]);

        $sponsor = Sponsor::findOrFail($id);

        // Handle photo update
        if ($request->hasFile('foto_sponsor')) {
            // Delete the old photo if it exists
            if ($sponsor->foto_sponsor && file_exists(public_path($sponsor->foto_sponsor))) {
                unlink(public_path($sponsor->foto_sponsor));
            }

            $file = $request->file('foto_sponsor');
            $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $newFileName = time() . '_' . $slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sponsor'), $newFileName);
            $validatedData['foto_sponsor'] = 'uploads/sponsor/' . $newFileName;
        }

        // Handle 'lainnya' option separately
        $sponsorshipIds = $request->input('sponsorship_id', []);
        $lainnyaIndex = array_search('lainnya', $sponsorshipIds);
        if ($lainnyaIndex !== false) {
            // Remove 'lainnya' from the array
            unset($sponsorshipIds[$lainnyaIndex]);
            // Handle 'lainnya' data
            $validatedData['lainnya'] = $request->input('lainnya');
        } else {
            $validatedData['lainnya'] = null; // Clear the 'lainnya' field if 'lainnya' is not selected
        }

        $sponsor->fill($validatedData);
        $sponsor->save();

        // Update the pivot table for sponsorship_id
        $sponsor->sponsorship()->sync($sponsorshipIds);

        return redirect()->route('dataSponsor.index')->with('success', 'Data Sponsor berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        if ($sponsor->foto_sponsor && file_exists(public_path($sponsor->foto_sponsor))) {
            unlink(public_path($sponsor->foto_sponsor));
        }

        // Menghapus relasi sponsor
        $sponsor->sponsorship()->detach();

        // Menghapus data sponsor
        $sponsor->delete();

        return redirect()->route('dataSponsor.index')->with('success', 'Data Sponsor berhasil dihapus.');
    }
}
