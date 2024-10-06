<table class="table table-striped table-hover">
    <thead class="bg-primary text-white">
        <tr>
            <th>Nama Lengkap Anak</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $filteredAnak = $anak->filter(function ($data) {
                return $data->tipe_anak === 'disabilitas';
            });
        @endphp

        @foreach ($filteredAnak as $key => $data)
            <tr>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->status }}</td>
                <td><a href="{{ route('ppiA.show', $data->id) }}" class="btn btn-info">Detail</a></td>
            </tr>
        @endforeach

        @if ($filteredAnak->isEmpty())
            <tr>
                <td colspan="5" class="text-center">Tidak ada Data Anak Disabilitas.</td>
            </tr>
        @endif
    </tbody>
</table>
