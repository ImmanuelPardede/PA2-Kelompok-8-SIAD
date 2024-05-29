<!-- partial:partials/_sidebar.html -->
<style>
    .sidebar hr {
        border-top: 1px solid #ddd;
        /* Warna dan gaya garis */
        margin: 10px 0;
        /* Jarak di atas dan di bawah garis */
    }

    .sidebar .menu-title {
        margin-left: 10px;
    }
</style>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('JadwalPembelajaranYayasan.index') }}" class="nav-link">
                <i class="mdi mdi-calendar menu-icon"></i>
                <span class="menu-title">Jadwal Pembelajaran</span>
            </a>
        </li>
        @auth
            @if (auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Kepegawaian</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.administrator.admin') }}">Admin</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.administrator.guru') }}">Guru</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.administrator.staff') }}">Staff</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.administrator.direktur') }}">Direktur</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.administrator.all') }}">All</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                        aria-controls="form-elements">
                        <i class="mdi mdi-human-child menu-icon"></i>
                        <span class="menu-title">Data Anak</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.anak.index') }}">Anak</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.latarBelakang.index') }}">Latar
                                    Belakang</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.orangTuaWali.index') }}">Orangtua/Wali</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.riwayatMedis.index') }}">Riwayat
                                    Medis</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                        <i class="mdi mdi-school menu-icon"></i>
                        <span class="menu-title">Pendidikan</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="error">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.kelas.index') }}">Kelas</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.tahunKurikulum.index') }}">Tahun
                                    Kurikulum</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.tahunAjaran.index') }}">Tahun
                                    Ajaran</a>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.semesterTahunAjaran.index') }}">Semester Ajaran</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mingguPembelajaran.index') }}">
                                    Pembelajaran</a>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.formatLaporan.index') }}">Format
                                    Laporan</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="mdi mdi-database menu-icon"></i>
                        <span class="menu-title">Master Data</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.agama.index') }}">Agama</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.disabilitas.index') }}">Jenis
                                    Disabilitas</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.donasi.index') }}">Jenis
                                    Donasi</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.golonganDarah.index') }}">Golongan
                                    Darah</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.jenisKelamin.index') }}">Jenis
                                    Kelamin</a>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.kebutuhanDisabilitas.index') }}">Jenis Kebutuhan</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.lokasiTugas.index') }}">Lokasi
                                    Penugasan</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pekerjaan.index') }}">Jenis
                                    Pekerjaan</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.pendidikan.index') }}">Jenis
                                    Pendidikan</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.penyakit.index') }}">Jenis
                                    Penyakit</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.sponsorship.index') }}">Jenis
                                    Sponsorship</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.kategoriBerita.index') }}">Kategori Berita</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.kodeLaporan.index') }}">Kode
                                    Laporan</a></li>
                        </ul>
                    </div>
                </li>

                <hr>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#succes" aria-expanded="false"
                        aria-controls="succes">
                        <i class="mdi mdi-home"></i>
                        <span class="menu-title">Home</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="succes">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.carousel.index') }}">
                                    Carousel
                                </a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.history.index') }}"> History
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#about" aria-expanded="false"
                        aria-controls="about">
                        <i class="mdi mdi-information"></i>
                        <span class="menu-title">About</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="about">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.about.index') }}">Content</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#program" aria-expanded="false"
                        aria-controls="program">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span class="menu-title">Program</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="program">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.program.index') }}">Content</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#berita" aria-expanded="false"
                        aria-controls="berita">
                        <i class="mdi mdi-newspaper"></i>
                        <span class="menu-title">Berita</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="berita">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.berita.index') }}">Content</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#fasilitas" aria-expanded="false"
                        aria-controls="fasilitas">
                        <i class="mdi mdi-factory"></i>
                        <span class="menu-title">Fasilitas</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="fasilitas">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.fasilitas.index') }}">Content</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#galeri" aria-expanded="false"
                        aria-controls="galeri">
                        <i class="mdi mdi-image menu-icon"></i>
                        <span class="menu-title">Galeri</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="galeri">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.galeri.index') }}">Content</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        @endauth



        @auth
            @if (auth()->user()->role === 'guru')
                <li class="nav-item">
                    <a href="{{ route('jadwalPembelajaran.index') }}" class="nav-link">
                        <i class="mdi mdi-calendar-clock menu-icon"></i>
                        <span class="menu-title">Atur Jadwal Belajar</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                        aria-controls="error">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Data Induk Pegawai</span>
                    </a>
                    <div class="collapse" id="error">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('guru.DataDiri.show', ['user' => auth()->user()->id]) }}"> Data Diri
                                </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guru.anak.index') }}">
                        <i class="mdi mdi-human-child menu-icon"></i>
                        <span class="menu-title">Data Anak</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('raport.index') }}">
                        <i class="mdi mdi-file-document menu-icon"></i>
                        <span class="menu-title">Raport Anak</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                        aria-controls="icons">
                        <i class="mdi mdi-file menu-icon"></i>
                        <span class="menu-title">PPI</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="icons">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('ppiA.index') }}">PPI A</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('ppiB.index') }}">PPI B</a></li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                        aria-controls="tables">
                        <i class="mdi mdi-book menu-icon"></i>
                        <span class="menu-title">Materi</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('modulMateri.index') }}">Modul
                                    Materi</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('silabus.index') }}">Silabus</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        @endauth

        @auth
            @if (auth()->user()->role === 'staff')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                        aria-controls="error">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Data Induk Pegawai</span>
                    </a>
                    <div class="collapse" id="error">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('staff.DataDiri.show', ['user' => auth()->user()->id]) }}"> Data Diri
                                </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                        aria-controls="tables">
                        <i class="mdi mdi-gift menu-icon"></i>
                        <span class="menu-title">Pendukung</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('dataDonatur.index') }}">Donatur</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('dataSponsor.index') }}">Sponsor</a></li>
                        </ul>
                    </div>
                </li>
            @endif
        @endauth



        @auth
            @if (auth()->user()->role === 'direktur')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                        aria-controls="error">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Data Induk</span>
                    </a>
                    <div class="collapse" id="error">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('direktur.DataDiri.show', ['user' => auth()->user()->id]) }}"> Data
                                    Diri
                                </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                        aria-controls="form-elements">
                        <i class="mdi mdi-human-child menu-icon"></i>
                        <span class="menu-title">Data Anak</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('direktur.anak.index') }}">Anak</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('direktur.latarBelakang.index') }}">Latar
                                    Belakang</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('direktur.orangTuaWali.index') }}">Orangtua/Wali</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('direktur.riwayatMedis.index') }}">Riwayat
                                    Medis</a></li>
                        </ul>
                    </div>
                </li>
            @endif
        @endauth


        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Raport</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
            </div>
        </li> --}}


        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li> --}}
    </ul>



</nav>



<script>
    $(document).ready(function() {
        $('.sidebar .nav-item').on('mouseleave', function() {
            $(this).find('.collapse').collapse('hide');
        });
    });
</script>
