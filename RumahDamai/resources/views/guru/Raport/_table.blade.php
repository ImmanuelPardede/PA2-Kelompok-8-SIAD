<table class="table table-striped table-hover">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Nama Lengkap Anak</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anak as $key => $data)
            <tr>
                <td>{{ $anak->firstItem() + $key }}</td> <!-- Use firstItem for paginated result -->
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->status }}</td>
                <td>
                    <a href="{{ route('raport.show', $data->id) }}" class="btn btn-info">Detail</a>
                </td>
            </tr>
        @endforeach

        @if ($anak->isEmpty())
            <tr>
                <td colspan="5" class="text-center">Tidak ada Data Anak.</td>
            </tr>
        @endif
    </tbody>
</table>
