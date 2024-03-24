<p>Periode Bulan : {{$raport->periode_bulan }}</p>
<p>Nama : {{$raport->anak->nama_lengkap }}</p>
<p>Kelas kronologis :</p>
<p> PPI No : 1<p>

<table border="1">
    <tbody>
        <tr>
            <td rowspan="2">No</td>
            <td rowspan="2">Area</td>
            <td rowspan="2">Kemampuan yang dipelajari</td>
            <td colspan="2">Hasil Yang Dicapai</td>
        </tr>
        <tr>
            <td>Kelas kemampuan</td>
            <td>Naratif</td>
        </tr>
        @foreach($detailraport as $index => $detail)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $detail->area }}</td>
            <td>{{ $detail->kemampuan }}</td>
            <td>{{ $detail->kelas_kemampuan }}</td>
            <td>{{ $detail->naratif }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
