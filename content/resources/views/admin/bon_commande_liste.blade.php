@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
   $(document).ready(function () {
    var limit=25;
    $("#liste").load("{{ route('bon_commande.load','') }}/"+limit);
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
    })();

    $("#search").keyup(function() {
        delay(function() {
            var word = $("#search").val();
            word = word.replace(/ /g, "_");
            $('#loading-popup').show();
            if (word !== "") {
                $("#liste").load("{{ route('bon_commande.search','') }}/" + word, function() {
                    $('#loading-popup').hide();
                });
            } else {
                $("#liste").load("{{ route('bon_commande.load','') }}/" + limit, function() {
                    $('#loading-popup').hide();
                });
            }
        }, 500);
    });

    $("#showmore").click(function(){
        limit+=10;
        $('#loading-popup').show();
        $("#liste").load("{{ route('bon_commande.load','') }}/" + limit, function() {
            $('#loading-popup').hide();
        });
    });

});
</script>
</script>
<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    LISTE DES COMMANDES
                </div>
            </div>
        </div>
    </div>
 </div>

  <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('produit.store')}}">
                                @csrf
                                <div class="row col-lg-12">
                                                          
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Désignation :</label>
                                            <input type="text" class="form-control inputup" name="nom_prod" required autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">&nbsp;</label>
                                            <button type="submit" class="px-5 form-control btn btn-info" style="font-size:10px;padding: 6px 3px 6px 4px ">ok</button>
                                        </div>
                                    </div>

                                    
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>



<!-- Cadeau -->
 <div class="row">
    <div class="col-lg-12">
        @if($message = Session::get('success'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif

        @if($message = Session::get('warning'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-warning">{{ $message }}</div> 
        @endif

        @if($message = Session::get('success_vente'))
            <div class="row">
                <div class="col-lg-5">
                    <div class="alert labo-label-alert-success labo-alert-success"><h style="color:black">Vente Effectuée</h></div> 
                </div>

                <div class="col-lg-2">
                    <a target="_blank" href="{{route('recu_vente',[$message])}}"  style="font-size:10px; padding-left:5px; margin-right:5px;height:35px;" class="btn btn-rounded btn-sm btn-info">
                    <i class="fa fa-print"></i> &nbsp;Reçu
                    </a>
                </div>
            </div>
        @endif
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title text-warning" style="font-size:14px">
                Factures Non reglées
                <div class="pull-right">
                    <input type="text" id="search" placeholder="rechercher" autocomplete="off" class=" labo-search">
                    &nbsp;&nbsp;&nbsp;  
                </div>
              </h5>
                  
                <div id="liste"></div>
                <button id="showmore" data-page="2">Afficher plus</button>
            </div>
        </div>

        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Affichage en cours...</p>
            </div>
        </div>
    </div>

   

    

  </div>



 
@endsection