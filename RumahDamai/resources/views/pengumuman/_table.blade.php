<table class="table table-striped table-hover">
    <thead class="bg-primary text-white">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tanggal & Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($pengumumans->isNotEmpty())
            @foreach ($pengumumans as $pengumuman)
                <tr>
                    <td>{{ \Illuminate\Support\Str::limit($pengumuman->judul, 20, '...') }}</td>
                    <td>{{ $pengumuman->kategori }}</td>
                    <td>{{ $pengumuman->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="dropdown d-inline">
                            <button class="btn btn-sm btn-primary dropdown-toggle"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i> Aksi
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                    href="{{ route('pengumuman.show', ['id' => $pengumuman->id]) }}">
                                    <i class="fas fa-eye"></i> Tampilkan
                                </a>
                                @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item"
                                        href="{{ route('admin.pengumuman.edit', ['id' => $pengumuman->id]) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form
                                        action="{{ route('admin.pengumuman.destroy', ['id' => $pengumuman->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @elseif (Auth::user()->role == 'direktur')
                                    <a class="dropdown-item"
                                        href="{{ route('direktur.pengumuman.edit', ['id' => $pengumuman->id]) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form
                                        action="{{ route('direktur.pengumuman.destroy', ['id' => $pengumuman->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Tidak ada pengumuman yang tersedia.</td>
            </tr>
        @endif
    </tbody>
</table>
