<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Msanté</title>
  <link rel="icon" href="{{ asset('assets/images/ref.png') }}" type="image/x-icon">
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/css/labo.css') }}" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme7">

<!-- Start wrapper-->
 <div id="wrapper">

	<div class="card card-authentication1 mx-auto" style="background-color:black;opacity: 80%;margin-top: 150px;">
      		<div class="card-body">
            		 <div class="card-content p-2">

            		      <div class="text-center py-3">Modifier le Mot de Passe h</div>
              		    <form method="POST" action="{{ route('mot_de_passe_reset') }}">
              		    	 @csrf
                  			  <div class="form-group">
                      			  <label for="exampleInputUsername" class="sr-only">ty</label>
                      			   <div class="position-relative has-icon-right">
                          				  <input type="password" class="form-control input-shadow" required placeholder="Mot de Passe actuel" name="old_pwd" autocomplete="off">
                          				  <div class="form-control-position">
                          					  <i class="icon-nfc"></i>
                          				  </div>
                      			   </div>
                  			  </div>

                  			  <div class="form-group">
                      			  <label for="exampleInputUsername" class="sr-only">ty</label>
                      			   <div class="position-relative has-icon-right">
                          				  <input type="password" class="form-control input-shadow" required placeholder="Nouveau Mot de Passe" name="new_pwd" autocomplete="off">
                          				  <div class="form-control-position">
                          					  <i class="icon-nfc"></i>
                          				  </div>
                      			   </div>
                  			  </div>

                  			  <div class="form-group">
                      			  <label for="exampleInputUsername" class="sr-only">ty</label>
                      			   <div class="position-relative has-icon-right">
                          				  <input type="password" class="form-control input-shadow" required placeholder="Confirmer le Nouveau Mot de Passe" name="confirme_pwd" autocomplete="off">
                          				  <div class="form-control-position">
                          					  <i class="icon-nfc"></i>
                          				  </div>
                      			   </div>
                  			  </div>
                  			  <div class="form-row">
                          			<div class="form-group col-12 text-center">
                                  @if($message = Session::get('error'))
                                    <p style="font-size: 14px;" class="text-warning"><strong>{{ $message }}</strong></p>
                                  @endif
                                </div>
                      			</div>


              			     <input type="submit" value="Valider" class="btn btn-light btn-block">
                  			 
              			 </form>

            		   </div>
      		  </div>
		  <div class="card-footer text-left py-3">
		    <a onclick="history.back()" class="btn btn-rounded btn-sm labo-btn-red">Retour</a>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->

	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	
  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>  
  
</body>
</html>
