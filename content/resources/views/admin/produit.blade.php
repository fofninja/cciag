@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var limit=25;
        $("#liste").load("{{ route('produit.liste','') }}/"+limit);
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
                    $("#liste").load("{{ route('produit.search','') }}/" + word, function() {
                        $('#loading-popup').hide(); // Masquer le popup une fois le chargement terminé
                    });
                } else {
                    $("#liste").load("{{ route('produit.liste','') }}/" + limit, function() {
                        $('#loading-popup').hide(); // Masquer le popup une fois le chargement terminé
                    });
                }
            }, 500);
        });


        $("#showmore").click(function(){
            limit+=10;
            $('#loading-popup').show();
            $("#liste").load("{{ route('produit.liste','') }}/" + limit, function() {
                $('#loading-popup').hide();
            });
        });
    });
</script>
<style>
        #loading-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .loading-content p {
        font-size: 14px;
        color: #333;
        margin: 0;
    }

    .inputup{
        font-size: 11px;
    }

    .labelup{
        margin-bottom:-10px;
        font-size:11px;
    }
</style>

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

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Catégorie :</label>
                                            <select class="form-control labo-search inputup" autocomplete="off" name="id_categ" required>
                                              <option></option>
                                              @foreach($categories as $c => $categ)
                                                <option value="{{ $categ->id_categ  }}">{{ $categ->nom_categ }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Prix de vente :</label>
                                            <input type="number" class="form-control inputup" name="prix_prod" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Conditionnement :</label>
                                            <select class="form-control labo-search inputup" autocomplete="off" required name="conditionnement">
                                              <option></option>
                                              @foreach($conditionnement as $cd => $cond)
                                                <option value="{{$cond->nom_cd}}">{{ $cond->nom_cd}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Quantité Par Groupe :</label>
                                            <input type="number" class="form-control inputup" required autocomplete="off" name="qt_par_group">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Seuil d'alerte :</label>
                                            <input type="number" class="form-control inputup" required autocomplete="off" name="seuil">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Code:</label>
                                            <input type="text" class="form-control inputup" readonly required autocomplete="off" name="code_prod" value="{{ date('ymdhis').Str::random(5) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                   
                                <div class="form-group">
                                    <button type="submit" class="btn btn-light px-5" style="font-size:10px;padding: 6px 3px 6px 4px ">Enregister</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
 


 <div class="row">
    <div class="col-lg-12">
        @if($message = Session::get('success'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif

        @if($message = Session::get('warning'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-warning">{{ $message }}</div> 
        @endif
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="font-size:11px">
                Liste des Produits
                <div class="pull-right">
                    <input type="text" id="search" placeholder="rechercher" autocomplete="off" class=" labo-search">
                </div>
              </h5>
                  
                <div id="liste"></div>
                <button id="showmore" data-page="2">Afficher plus</button>
            </div>
        </div>

         <!--
        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Affichage en cours...</p>
            </div>
        </div>-->
    </div>

  </div>


@endsection