<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VMCS</title>
  <link rel="stylesheet" href="{{ asset('vaccin/vendors/typicons.font/font/typicons.css')}}">
  <link rel="stylesheet" href="{{ asset('vaccin/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('vaccin/css/vertical-layout-light/style.css')}}">
  <link rel="shortcut icon" href="{{ asset('vaccin/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
              	<center>
                <img src="{{ asset('vaccin/images/logo.png')}}" style="width:110px;text-align: center;" alt="logo">
                </center>
              </div>
              <h4>Authentification</h4>
              <form class="pt-3" method="POST" action="{{ route('login') }}">
              	@csrf  
                <div class="form-group">
                  <input type="email" name="email" id="email" :value="old('email')" placeholder="Nom d'utilisateur" class="form-control form-control-lg">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de Passe">
                </div>

                @error('password')
					<p class="text-danger">{{ $message }}</p>
				@enderror
				@error('email')
					<p class="text-danger">{{ $message }}</p>
				@enderror

                <div class="mt-3">
                  <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">Connexion</button>
                </div>
                <!--<div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('vaccin/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{ asset('vaccin/js/off-canvas.js')}}"></script>
  <script src="{{ asset('vaccin/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('vaccin/js/template.js')}}"></script>
  <script src="{{ asset('vaccin/js/settings.js')}}"></script>
  <script src="{{ asset('vaccin/js/todolist.js')}}"></script>
</body>

</html>
