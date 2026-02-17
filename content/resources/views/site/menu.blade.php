<section>   
      <div class="hearder_area">
        <div id="header_sticky_2" class="demo-header mainmenu_area_2">
          <div class="container">
            <div class="row">
              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-10">
                <div class="logo">
                  <a href="">
                    <img src="{{ asset('assets/img/logo/logocciag.png')}}" style="width:90px" alt="" />
                  </a>
                </div>
              </div>
              <div class="col-xl-10 col-lg-7 col-md-2 col-sm-2 text-right">
                <div class="mainmenu_2">
                  <ul id="nav">
                    <li><a href="{{route('index')}}">Accueil</a></li>

                    <li><a href="{{route('propos')}}">La CCIAG </a></li>


                    <li><a href="{{route('services')}}">Nos Service <i class="fa fa-angle-down" style="color: white;"></i></a>
                      <ul class="sub-menu text-left">
                        <li><a href="{{route('services')}}#promotion">Promotion du Secteur Privé</a></li>
                        <li><a href="{{route('services')}}#carte">Délivrance des Cartes d'Adhésion</a></li>
                        <li><a href="{{route('services')}}#etude">Etudes Economique</a></li>
                        <li><a href="{{route('services')}}#dialogue">Dialogue Public-Privé</a></li>
                      </ul>
                    </li>

                    <li><a href="service.html">Contact & Démarches<i class="fa fa-angle-down" style="color: white;"></i></i></a>
                      <ul class="sub-menu text-left">
                        <li><a href="{{route('membre')}}">Devenir Membre</a></li>
                        <li><a href="{{route('contact')}}">Nous contacter</a></li>
                      </ul>
                    </li>

                    <li><a href="{{route('actualites')}}">Actualités</a></li> 
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>