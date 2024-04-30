@extends('layouts.management.header')

</head>
<body>
    <body>
      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                <div id="loadingWrapper">
                  <div id="loadingIndicator" class="loading-spinner">
                    <!-- SVG Loader -->
                    <svg viewBox="0 0 240 240" height="240" width="240" class="pl">
                      <circle stroke-linecap="round" stroke-dashoffset="-330" stroke-dasharray="0 660" stroke-width="20" stroke="#000" fill="none" r="105" cy="120" cx="120" class="pl__ring pl__ring--a"></circle>
                      <circle stroke-linecap="round" stroke-dashoffset="-110" stroke-dasharray="0 220" stroke-width="20" stroke="#000" fill="none" r="35" cy="120" cx="120" class="pl__ring pl__ring--b"></circle>
                      <circle stroke-linecap="round" stroke-dasharray="0 440" stroke-width="20" stroke="#000" fill="none" r="70" cy="120" cx="85" class="pl__ring pl__ring--c"></circle>
                      <circle stroke-linecap="round" stroke-dasharray="0 440" stroke-width="20" stroke="#000" fill="none" r="70" cy="120" cx="155" class="pl__ring pl__ring--d"></circle>
                    </svg>
                  </div>
                </div>
                <div class="auth-form-light text-center py-5 px-4 px-sm-5" style="display: none;">
                  <div class="brand-logo" style="display: none;">
                    <img src="{{ asset('skydash/images/logo.png') }}" alt="logo">
                  </div>
                  <h4 style="display: none;">Yayasan Pendidikan Anak Rumah Damai</h4>
                  <h6 class="font-weight-light" style="display: none;">Sistem Informasi Administrasi</h6>                  
                  @if ($errors->any())
                  <div style="color: red;">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                  <form id="loginForm" method="POST" class="pt-3" action="{{ url('/login') }}" style="display: none;">
            @csrf
            <div class="form-group">
              <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" value="{{ old('email') }}" required placeholder="Email">
          </div>
          <div class="form-group">
              <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" required placeholder="Password">
          </div>
          
                    <div class="mt-3">
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <a href="#" class="auth-link text-black" id="forgotPassword">Forgot password?</a>
                      </div>
                      <button type="submit" class="btn btn-primary btn-sm font-weight-medium auth-form-btn" id="loginButton">Sign In</button>
                  </div>
                  
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>

      <script>
        // Menampilkan indikator loading
        document.getElementById('loadingIndicator').style.display = 'block';

        // Mendeteksi ketika semua elemen halaman telah dimuat
        window.addEventListener('load', function() {
          // Menyembunyikan indikator loading
          document.getElementById('loadingIndicator').style.display = 'none';
          // Menampilkan elemen halaman
          document.querySelector('.auth-form-light').style.display = 'block';
          document.querySelector('.brand-logo').style.display = 'block';
          document.querySelector('h4').style.display = 'block';
          document.querySelector('.font-weight-light').style.display = 'block';
          document.querySelector('form#loginForm').style.display = 'block';
          // Menyembunyikan wrapper loading
          document.getElementById('loadingWrapper').style.display = 'none';
        });

        document.getElementById('forgotPassword').addEventListener('click', function (event) {
            event.preventDefault();
            alert('Silahkan hubungi admin :)');
        });

        document.getElementById('loginForm').addEventListener('submit', function () {
            document.getElementById('loadingIndicator').style.display = 'block';
        });
    </script>
</body>
</html>
