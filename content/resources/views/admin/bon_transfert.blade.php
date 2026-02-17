@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    var limit = 25;
    var numTransfert = "0";
    var idMagSource = "0";  // ✅ Magasin source sélectionné
    
    // ✅ Fonction pour charger la liste avec routes Laravel
    function chargerListe() {
        var url = "{{ route('bon_transfert.article_liste', ['limit' => ':limit', 'num' => ':num', 'id_mag_source' => ':id_mag_source']) }}";
        url = url.replace(':limit', limit).replace(':num', numTransfert).replace(':id_mag_source', idMagSource);
        $("#liste").load(url);
    }
    
    // ✅ Sélection du magasin source
    $("#magasin_source").change(function() {
        idMagSource = $(this).val();
        if (idMagSource == "0" || idMagSource == "") {
            $("#liste").html('<p class="text-warning">Veuillez sélectionner un magasin source</p>');
        } else {
            chargerListe();
        }
    });
    
    // ✅ Recherche avec délai
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
    
    $("#search").keyup(function() {
        if (idMagSource == "0" || idMagSource == "") {
            alert("Veuillez d'abord sélectionner un magasin source");
            return;
        }
        
        delay(function() {
            var word = $("#search").val();
            word = word.replace(/ /g, "_");
            $('#loading-popup').show();
            
            if (word !== "") {
                // ✅ Route de recherche avec paramètres dynamiques
                var url = "{{ route('bon_transfert.article_search', ['name' => ':name', 'num' => ':num', 'id_mag_source' => ':id_mag_source']) }}";
                url = url.replace(':name', word).replace(':num', numTransfert).replace(':id_mag_source', idMagSource);
                
                $("#liste").load(url, function() {
                    $('#loading-popup').hide();
                });
            } else {
                chargerListe();
                $('#loading-popup').hide();
            }
        }, 500);
    });
    
    $("#showmore").click(function(){
        limit += 10;
        $('#loading-popup').show();
        chargerListe();
        setTimeout(function() {
            $('#loading-popup').hide();
        }, 500);
    });
});
</script><script>
$(document).ready(function () {
    var limit = 25;
    var numTransfert = "0";
    var idMagSource = "0";  // ✅ Magasin source sélectionné
    
    // ✅ Fonction pour charger la liste avec routes Laravel
    function chargerListe() {
        var url = "{{ route('bon_transfert.article_liste', ['limit' => ':limit', 'num' => ':num', 'id_mag_source' => ':id_mag_source']) }}";
        url = url.replace(':limit', limit).replace(':num', numTransfert).replace(':id_mag_source', idMagSource);
        $("#liste").load(url);
    }
    
    // ✅ Sélection du magasin source
    $("#magasin_source").change(function() {
        idMagSource = $(this).val();
        if (idMagSource == "0" || idMagSource == "") {
            $("#liste").html('<p class="text-warning">Veuillez sélectionner un magasin source</p>');
        } else {
            chargerListe();
        }
    });
    
    // ✅ Recherche avec délai
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
    
    $("#search").keyup(function() {
        if (idMagSource == "0" || idMagSource == "") {
            alert("Veuillez d'abord sélectionner un magasin source");
            return;
        }
        
        delay(function() {
            var word = $("#search").val();
            word = word.replace(/ /g, "_");
            $('#loading-popup').show();
            
            if (word !== "") {
                // ✅ Route de recherche avec paramètres dynamiques
                var url = "{{ route('bon_transfert.article_search', ['name' => ':name', 'num' => ':num', 'id_mag_source' => ':id_mag_source']) }}";
                url = url.replace(':name', word).replace(':num', numTransfert).replace(':id_mag_source', idMagSource);
                
                $("#liste").load(url, function() {
                    $('#loading-popup').hide();
                });
            } else {
                chargerListe();
                $('#loading-popup').hide();
            }
        }, 500);
    });
    
    $("#showmore").click(function(){
        limit += 10;
        $('#loading-popup').show();
        chargerListe();
        setTimeout(function() {
            $('#loading-popup').hide();
        }, 500);
    });
});
</script>

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    <i class="fa fa-exchange"></i> BON DE TRANSFERT
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Messages -->
<div class="row">
    <div class="col-lg-12">
        @if($message = Session::get('success'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div>
        @endif
        
        @if($message = Session::get('warning'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-warning">{{ $message }}</div>
        @endif
        
        @if($message = Session::get('error'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-danger">{{ $message }}</div>
        @endif
    </div>
    
    <!-- Sélection magasin source -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    <i class="fa fa-building"></i> Magasin Source
                </h5>
                <div class="form-group">
                    <label class="mslabel" style="color:white">Transférer depuis :</label>
                    <select class="form-control msinput" id="magasin_source">
                        <option value="0">Sélectionnez un magasin</option>
                        @foreach($magasins as $mag)
                            <option value="{{ $mag->id_mag }}">{{ $mag->nom_mag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Liste articles -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    Articles Disponibles
                    <div class="pull-right">
                        <input type="text" id="search" placeholder="Rechercher" autocomplete="off" class="labo-search">
                    </div>
                </h5>
                
                <div id="liste">
                    <p class="text-muted">Sélectionnez d'abord un magasin source</p>
                </div>
                <button id="showmore" data-page="2">Afficher plus</button>
            </div>
        </div>
        
        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Chargement...</p>
            </div>
        </div>
    </div>
    
    <!-- Brouillon transfert -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    Articles du Transfert
                    <div class="pull-right">
                        <form method="POST" action="{{ route('bon_transfert.cancel', ['0']) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" 
                                    onclick="return confirm('Annuler le brouillon ?');">
                                Annuler
                            </button>
                        </form>
                        <a href="" data-toggle="modal" data-target="#modal_valider" style="font-size:8px;" 
                           class="btn btn-rounded btn-sm btn-success">
                            <i class="fa fa-check"></i> Valider
                        </a>
                    </div>
                </h5>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="background-color:white; color:black;">
                                <th>Article</th>
                                <th>Qt</th>
                                <th>Prix</th>
                                <th>Source</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse($liste_transfert as $i => $item)
                                @php $total += $item->montant; @endphp
                                <tr>
                                    <td style="font-size:11px;">{{ $item->nom_prod }}</td>
                                    <td style="font-size:11px;">{{ $item->qt_transfert }}</td>
                                    <td style="font-size:11px;">{{ number_format($item->prix_unitaire, 0, '', ' ') }}</td>
                                    <td style="font-size:11px;">{{ $item->mag_source_nom }}</td>
                                    <td style="font-size:11px;">
                                        <form method="POST" action="{{ route('bon_transfert.delete', [$item->id_bon_transfert_line]) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" 
                                                    onclick="return confirm('Supprimer ?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><strong class="text-warning">Vide</strong></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Validation -->
<div id="modal_valider" class="modal fade" role="dialog" style="padding-top:50px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-body" style="background-color: white;">
            <div class="modal-header" style="background-color:green;">
                <div class="card-title mslabel mstitle">Valider le Transfert</div>
            </div>
            <form method="POST" action="{{ route('bon_transfert.valide') }}">
                @csrf
                <input type="hidden" value="BT{{ date('ymdhis').Str::random(5) }}" name="num_bon_transfert">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="display:none">
                            <div class="form-group">
                                <label class="mslabel">Montant Total :</label>
                                <input type="text" class="msinput form-control" 
                                       value="{{ number_format($total, 0, '', ' ') }} GNF" readonly>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mslabel">Date Transfert :</label>
                                <input type="date" class="msinput form-control" 
                                       value="{{ date('Y-m-d') }}" name="date_transfert" required>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mslabel">Remarque (optionnel) :</label>
                                <textarea class="msinput form-control" name="remarque" rows="3" 
                                          placeholder="Notes sur ce transfert..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn labo-btn-red" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn labo-btn-primary"><i class="fa fa-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection