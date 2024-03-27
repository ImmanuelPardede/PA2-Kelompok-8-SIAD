<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @auth
            @if (auth()->user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                aria-controls="charts">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kepegawaian</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.administrator.admin') }}">Admin</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.administrator.guru') }}">Guru</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.administrator.staff') }}">Staff</a></li>
                </ul>
            </div>
        </li>


                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                        aria-controls="form-elements">
                        <i class="icon-columns menu-icon"></i>
                        <span class="menu-title">Data Anak</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('anak.index') }}">Anak</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('orangTuaWali.index') }}">Orangtua/Wali</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('riwayatMedis.index') }}">Riwayat
                                    Medis</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="icon-layout menu-icon"></i>
                        <span class="menu-title">Master Data</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('agama.index') }}">Agama</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('disabilitas.index') }}">Jenis Disabilitas</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('donasi.index') }}">Jenis Donasi</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('golonganDarah.index') }}">Golongan Darah</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('jenisKelamin.index') }}">Jenis Kelamin</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('kebutuhanDisabilitas.index') }}">Jenis Kebutuhan</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('lokasiTugas.index') }}">Lokasi Penugasan</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('pekerjaan.index') }}">Jenis Pekerjaan</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('pendidikan.index') }}">Jenis Pendidikan</a>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('penyakit.index') }}">Jenis Penyakit</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('sponsorship.index') }}">Jenis Sponsorship</a>
                        </ul>
                    </div>
                </li>
                
            @endif
        @endauth

        @auth
            @if (auth()->user()->role === 'guru')
            <li class="nav-item">
                <a href="{{ route('guru.profile.show', ['user' => auth()->user()->id]) }}" class="nav-link">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Profile</span>
                </a>
            </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('raport.index') }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">Raport Anak</span>
                    </a>
                </li>
            @endif
        @endauth

    @auth
    @if(auth()->user()->role === 'staff')

    <li class="nav-item">
        <a href="{{ route('staff.profile.show', ['user' => auth()->user()->id]) }}" class="nav-link">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Profile</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Pendukung</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('dataDonatur.index') }}">Donatur</a></li>
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
