<table class="table table-striped table-hover">
    <thead class="bg-primary text-white">
        <tr>
            <th>Foto</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($anakList->isNotEmpty())
            @foreach ($anakList as $anak)
                <tr>
                    <td><img src="{{ asset($anak->foto_profil) }}" alt="{{ $anak->nama_lengkap }}" style="width: 50px; height: 50px;"></td>
                    <td>{{ $anak->nama_lengkap }}</td>
                    <td>{{ $anak->jenisKelamin->jenis_kelamin }}</td>
                    <td>{{ $anak->status }}</td>
                    <td>
                        <a href="{{ route('guru.anak.show', $anak->id) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">Tidak ada Data Anak tersedia.</td>
            </tr>
        @endif
    </tbody>
</table>
