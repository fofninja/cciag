<!doctype html>
 <html class="no-js" lang="">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CCIAG - V1 </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="x-icon" href="logocciag.png">
    <!-- Place favicon.ico in the root directory -->
    
    
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
      <style>
            section {
          scroll-margin-top: 150px; /* adapte selon la hauteur de ton header */
        }
  </style>
    
  </head>

  <body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <div class="page-wrapper">
      <div class="preloader">
        <div class="inner">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>

    @include('site.menu')




    @yield('content')


    <section>     
      <footer>
        <div class="footer-top-area section-divide">
          <div class="container">
            <div class="row">
                                          
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="footer-wrapper">
                  <h4 class="footer-text">Liens Utiles</h4>
                  <ul class="footers">
                    <li>
                      <div class="footer-info">
                        <h4><a href="#">Ministère du Commerce et de l'Industrie</a></h4>
                      </div>
                    </li>
                    <li>
                      <div class="footer-info">
                        <h4><a href="#">Douane</a></h4>
                      </div>
                    </li>
                  </ul>                 
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-wrapper">
                  <h4 class="footer-text">Accès Rapide</h4>
                  <ul class="footer-menu">
                    <li><a href="#"><i class="fa fa-caret-right"></i>La CCIAG</a></li>
                    <li><a href="#"><i class="fa fa-caret-right"></i>Services</a></li>
                    <li><a href="#"><i class="fa fa-caret-right"></i>Actualités</a></li>
                    <li><a href="#"><i class="fa fa-caret-right"></i>Contacts</a></li>
                  </ul>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <div class="footer-bootom-area pt-40 mt-40">
          <div class="container">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="copyright">
                  <p>Copyright @2026 <a href="#">CCIAG</a></p>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="footer-icon">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer> 
    </section>
    

    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>         
    <script src="{{ asset('assets/js/jquery.counterup.min.js')}}"></script>
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
      <script>
$(document).ready(function() {
    // Animation au scroll
    $(window).on('scroll', function() {
        $('.about-cop').each(function(index) {
            var elementTop = $(this).offset().top;
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            
            if (scrollTop + windowHeight > elementTop + 100) {
                setTimeout(() => {
                    $(this).addClass('fade-in');
                }, index * 80); // Délai rapide entre chaque élément
            }
        });
    });
    
    // Déclenche aussi au chargement
    $(window).trigger('scroll');
});
</script>
  </body>

</html>
