@extends('layouts.header')

</head>
<body>
    <body>
      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                  <div class="brand-logo">
                    <img src="{{ asset('skydash/images/logo.png') }}" alt="logo">
                  </div>
                  <h4>Yayasan Pendidikan Anak Rumah Damai</h4>
                  <h6 class="font-weight-light">Sistem Informasi Administrasi</h6>                  
                  @if ($errors->any())
                  <div style="color: red;">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                  <form method="POST" class="pt-3" action="{{ url('/login') }}">
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
                      <button type="submit" class="btn btn-primary btn-sm font-weight-medium auth-form-btn">Sign In</button>
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
        document.getElementById('forgotPassword').addEventListener('click', function (event) {
            event.preventDefault();
            alert('Silahkan hubungi admin :)');
        });
    </script>
</body>
</html>







