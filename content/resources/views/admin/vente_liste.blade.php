@extends('layouts.layout')
@section('content')

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

    .filter-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .stat-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 15px;
    }

    .stat-box h4 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .stat-box p {
        margin: 5px 0 0 0;
        font-size: 12px;
        opacity: 0.9;
    }
</style>

<!-- Titre -->
<div class="card-title col-lg-12 mstitle mb-4">
    <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Liste des ventes
</div>

<!-- Filtres -->
<div class="row">
    <div class="col-lg-12">
        <div class="card filter-card">
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Du :</label>
                        <input type="date" class="form-control msinput" id="date_debut" value="{{ date('Y-m-01') }}">
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Au :</label>
                        <input type="date" class="form-control msinput" id="date_fin" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">N° Facture :</label>
                        <input type="text" class="form-control msinput" id="code_vente" placeholder="VT...">
                    </div>
                </div>
            @php $privilege=auth()->user()->privilege_usr; @endphp
                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Boutique :</label>
                        <select class="form-control msinput" id="id_mag">
                            <option value="">Tous</option>
                            @foreach($magasins as $mag)
                                <option value="{{ $mag->id_mag }}" {{ !in_array($privilege, ['directeur', 'admin']) && Auth::user()->id_mag == $mag->id_mag ? 'selected' : '' }}>
                                    {{ $mag->nom_mag }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Statut :</label>
                        <select class="form-control msinput" id="statut">
                            <option value="">Tous</option>
                            <option value="complete">Payé complet</option>
                            <option value="partiel">Payé partiel</option>
                            <option value="credit">À crédit (0 payé)</option>
                            <option value="solde">Payé par solde</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Livraison :</label>
                        <select class="form-control msinput" id="statut_livraison">
                            <option value="">Tous</option>
                            <option value="livre">Livré</option>
                            <option value="partiel">Partiel</option>
                            <option value="non_livre">Non livré</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="form-group">
                        <label class="mslabel">Client :</label>
                        <select class="form-control msinput" id="code_cl">
                            <option value="">Tous</option>
                            @foreach($clients as $cl)
                                <option value="{{ $cl->code_cl }}">{{ $cl->nom_cl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_filtrer">
                        <i class="fa fa-filter"></i> Filtrer
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" id="btn_reset">
                        <i class="fa fa-refresh"></i> Réinitialiser
                    </button>
                    <button type="button" class="btn btn-success btn-sm" id="btn_exporter">
                        <i class="fa fa-file-excel-o"></i> Exporter Excel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stat-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h4 id="total_montant">0 GNF</h4>
            <p>Montant Total</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-box" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h4 id="total_paye">0 GNF</h4>
            <p>Total Payé</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-box" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <h4 id="total_reste">0 GNF</h4>
            <p>Total Reste</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-box" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h4 id="nb_ventes">0</h4>
            <p>Nombre de Ventes</p>
        </div>
    </div>
</div>

<!-- Messages -->
<div class="row">
    <div class="col-lg-12">
        @if($message = Session::get('success'))
            <div class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif

        @if($message = Session::get('warning'))
            <div class="alert labo-label-alert-success labo-alert-warning">{{ $message }}</div> 
        @endif
    </div>
</div>
@php $mag=auth()->user()->id_mag @endphp
<!-- Liste des ventes -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    Ventes
                    <div class="pull-right">
                        <a href="{{route('magasin.ventes',[$mag])}}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Nouvelle Vente
                        </a>
                    </div>
                </h5>
                  
                <div id="liste"></div>
                <button id="showmore" class="btn btn-primary btn-sm mt-3" style="display:none;">
                    Afficher plus
                </button>
            </div>
        </div>

        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Chargement en cours...</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    var limit = 25;
    
    // ✅ Charger la liste au démarrage
    chargerListe();
    
    // ✅ FONCTION DE CHARGEMENT
    function chargerListe() {
        $('#loading-popup').show();
        
        var params = {
            limit: limit,
            date_debut: $('#date_debut').val(),
            date_fin: $('#date_fin').val(),
            code_vente: $('#code_vente').val(),
            id_mag: $('#id_mag').val(),
            statut: $('#statut').val(),
            statut_livraison: $('#statut_livraison').val(),
            code_cl: $('#code_cl').val()
        };
        
        $.ajax({
            url: "{{ route('vente.liste_load') }}",
            method: 'GET',
            data: params,
            success: function(response) {
                $('#liste').html(response.html);
                
                // Mettre à jour les statistiques
                $('#total_montant').text(response.stats.total_montant.toLocaleString('fr-FR') + ' GNF');
                $('#total_paye').text(response.stats.total_paye.toLocaleString('fr-FR') + ' GNF');
                $('#total_reste').text(response.stats.total_reste.toLocaleString('fr-FR') + ' GNF');
                $('#nb_ventes').text(response.stats.nb_ventes);
                
                // Afficher/cacher le bouton "Afficher plus"
                if (response.has_more) {
                    $('#showmore').show();
                } else {
                    $('#showmore').hide();
                }
            },
            error: function() {
                alert('Erreur lors du chargement de la liste');
            },
            complete: function() {
                $('#loading-popup').hide();
            }
        });
    }
    
    // ✅ BOUTON FILTRER
    $('#btn_filtrer').click(function() {
        limit = 25;
        chargerListe();
    });
    
    // ✅ BOUTON RÉINITIALISER
    $('#btn_reset').click(function() {
        $('#date_debut').val('{{ date("Y-m-01") }}');
        $('#date_fin').val('{{ date("Y-m-d") }}');
        $('#code_vente').val('');
        $('#id_mag').val('{{ in_array($privilege, ["directeur", "admin"]) ? "" : Auth::user()->id_mag }}');
        $('#statut').val('');
        $('#statut_livraison').val('');
        $('#code_cl').val('');
        limit = 25;
        chargerListe();
    });
    
    // ✅ AFFICHER PLUS
    $('#showmore').click(function() {
        limit += 10;
        chargerListe();
    });
    
    // ✅ FILTRER EN TEMPS RÉEL SUR LES DATES
    $('#date_debut, #date_fin').change(function() {
        limit = 25;
        chargerListe();
    });
    
    // ✅ EXPORTER EXCEL
    $('#btn_exporter').click(function() {
        var params = $.param({
            date_debut: $('#date_debut').val(),
            date_fin: $('#date_fin').val(),
            code_vente: $('#code_vente').val(),
            id_mag: $('#id_mag').val(),
            statut: $('#statut').val(),
            statut_livraison: $('#statut_livraison').val(),
            code_cl: $('#code_cl').val()
        });
        
        window.location.href = "{{ route('vente.export') }}?" + params;
    });
});
</script>

@endsection