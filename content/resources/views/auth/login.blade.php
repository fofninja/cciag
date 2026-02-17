<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>CCIAG </title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="manifest" href="site.webmanifest">
      <link rel="shortcut icon" type="x-icon" href="favicon.ico">
      
      <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.css')}}">     
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/normalize.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/bisness-style.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/bisness-responsive.css')}}">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700,800&amp;display=swap" rel="stylesheet">
</head>
<body>

    <section>
            <div class="login-area section-divide mb-30">
                <div class="container">
                    <div class="sign-in-form">
                        <div class="sign-in-title">
                            <h3>Authentification</h3>
                        </div>
                            
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"name="email" required value="{{ old('email') }}" autocomplete="off" placeholder="Nom d'utilisateur">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" placeholder="Mot de Passe">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-check">
                                        @error('password')
                                            <label class="form-check-label text-danger" for="checkme">{{ $message }}</label>
                                        @enderror

                                         @error('email')
                                            <label class="form-check-label text-danger" for="checkme">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="send-btn">
                                        <button type="submit" class="default-btn">
                                            {{ __('Se Connecter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>      
        </section>  


      


        <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>         
        <script src="js/jquery.counterup.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{ asset('assets/js/scrollreveal.min.js')}}"></script>          
        <script src="{{ asset('assets/js/waypoints.min.js')}}"></script>              
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>       
        <script src="{{ asset('assets/js/jquery.slicknav.min.js')}}"></script>
        <script src="{{ asset('assets/js/fancyBox v2.1.5.js')}}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>          
        <script src="{{ asset('assets/js/bisness-main.js')}}"></script>
        <script src="{{ asset('assets/js/isotope.pkgd.min.js')}}"></script>
        <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins.js')}}"></script>
  
  
</body>
</html>
