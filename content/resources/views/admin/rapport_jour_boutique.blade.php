@extends('layouts.layout')
@section('content')
<style type="text/css">
  td, th {
  font-size:11px;
}
</style>

@php
    $total_encaissement=$ventes[0]->total_vente+$recouvrement[0]->total_rb;
    $total_ca=$all_ventes_jour[0]->total_vente+$recouvrement[0]->total_rb;
    $depense=$total_depense[0]->total_depense;
    $solde_jour=$total_ca- $depense;
@endphp
<div class="card-title col-lg-12 mstitle">
    <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}
</div>
  <div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">BOUTIQUE  <span class="float-right"><i class="fa fa-home"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 small-font"><span class="badge badge-info" style="font-size:14px"><strong>{{$magasins[0]->nom_mag}}</strong></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Chiffre d'Affaire<span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 small-font">{{ number_format((($all_ventes_jour[0]->total_vente+$recouvrement[0]->total_rb)),0,'',' ',) }} GNF</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Encaissement (Espèce)  <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 small-font" style="color:#0ebd0e">{{ number_format((($total_encaissement)),0,'',' ',) }} GNF</p>
                </div>
            </div>
            
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Dépense <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <a  href=""  style="color:#ff8484">{{ number_format($total_depense[0]->total_depense,0,'',' ',) }} GNF</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light" style="background-color:green;">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">SOLDE DU JOUR  <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format($solde_jour,0,'',' ',) }} GNF</p>
                </div>
            </div>
            
        </div>
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

 <div class="row">

         <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px; margin-bottom:15px;">
                    <i class="fa fa-building"></i> SITUATION
                </h5>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style="font-size:12px;">
                        <thead>
                            <tr style="background-color:#343a40; color:white;">
                                <th style="text-align:right; background-color:#56ab2f; color:white;">Espèce</th>
                                <th style="text-align:right; background-color:#F4A018; color:white;">O.Money</th>
                                <th style="text-align:right; background-color:#677CE7; color:white;">Banque</th>
                                <th style="text-align:right; background-color:#f12711; color:white;">Sorties</th>
                                <th style="text-align:right; background-color:#7256B2; color:white;">Solde du jour</th>
                                <th style="text-align:right; background-color:#17a2b8; color:white;">Solde Caisse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $t_encaissement_boutique=0;
                                $t_om_boutique=0;
                                $t_banque_boutique=0;

                                $t_depense_boutique=0;
                                $t_solde_boutique=0;
                                $t_caisse=0;
                                $t_credit=0;
                            @endphp
                            @foreach($magasins as $mag)
                                @php 
                                    $ventes_boutique = DB::select("SELECT SUM(montant_paye_fixe) as total_vente FROM vente_groupe  WHERE date_vente=? and id_mag=? AND mode_paye=?", [$date,$mag->id_mag,'Espèce']);
                                    $ventes_boutique_om = DB::select("SELECT SUM(montant_paye_fixe) as total_vente FROM vente_groupe  WHERE date_vente=? and id_mag=? AND mode_paye=?", [$date,$mag->id_mag,'Orange Money']);
                                    $ventes_boutique_banque = DB::select("SELECT SUM(montant_paye_fixe) as total_vente FROM vente_groupe  WHERE date_vente=? and id_mag=? AND mode_paye=?", [$date,$mag->id_mag,'UBA SG & Family GNF']);

                                    $depense_boutique = DB::select("SELECT SUM(montant) as total_depense  FROM depenses  WHERE date_depense=? and id_mag=? AND statut = 'validée'", [$date,$mag->id_mag]);

                                    $recouvrement_boutique = DB::select("SELECT SUM(montant_paye) as total_rb FROM paiement_credits WHERE date_paiement=? and id_mag=? and mode_paiement=?", [$date,$mag->id_mag,'Espèce']);
                                    $recouvrement_boutique_om = DB::select("SELECT SUM(montant_paye) as total_rb FROM paiement_credits WHERE date_paiement=? and id_mag=? and mode_paiement=?", [$date,$mag->id_mag,'Orange Money']);
                                    $recouvrement_boutique_banque = DB::select("SELECT SUM(montant_paye) as total_rb FROM paiement_credits WHERE date_paiement=? and id_mag=? and mode_paiement=?", [$date,$mag->id_mag,'UBA SG & Family GNF']);

                                    $caisse = DB::select("SELECT * FROM caisse WHERE id_mag = ?",[$mag->id_mag]);
                                    $credit = DB::select("SELECT SUM(montant_to_pay) as total_credit FROM vente_groupe  WHERE id_mag=? and montant_to_pay>montant_paye", [$mag->id_mag]);

                                    $encaissement_boutique=$ventes_boutique[0]->total_vente+$recouvrement_boutique[0]->total_rb;
                                    $om_boutique=$ventes_boutique_om[0]->total_vente+$recouvrement_boutique_om[0]->total_rb;
                                    $banque_boutique=$ventes_boutique_banque[0]->total_vente+$recouvrement_boutique_banque[0]->total_rb;

                                    $solde_boutique=$encaissement_boutique-$depense_boutique[0]->total_depense;

                                    $t_encaissement_boutique+=$encaissement_boutique;
                                    $t_om_boutique+=$om_boutique;
                                    $t_banque_boutique+=$banque_boutique;

                                    $t_depense_boutique+=$depense_boutique[0]->total_depense;
                                    $t_solde_boutique+=$solde_boutique;
                                    $t_caisse+=$caisse[0]->solde_general;
                                    $t_credit+=$credit[0]->total_credit;
                                @endphp
                                <tr>
                                    <td style="text-align:right; color:#56ab2f; font-weight:bold;">{{ number_format($encaissement_boutique, 0, '', ' ') }}</td>
                                    <td style="text-align:right; color:#F4A018; font-weight:bold;">{{ number_format($om_boutique, 0, '', ' ') }}</td>
                                    <td style="text-align:right; color:#677CE7; font-weight:bold;">{{ number_format($banque_boutique, 0, '', ' ') }}</td>
                                    <td style="text-align:right; color:#f12711; font-weight:bold;">{{ number_format($depense_boutique[0]->total_depense, 0, '', ' ') }}</td>
                                    <td style="text-align:right; background-color:#7256B2; font-weight:bold;">{{ number_format($solde_boutique, 0, '', ' ') }}</td>
                                    <td style="text-align:right; font-weight:bold;">{{ number_format($caisse[0]->solde_general ?? 0, 0, '', ' ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<input type="hidden" id="date_vente" value="{{$date}}">
<input type="hidden"  id="id_mag" value="{{$id_mag}}">

     <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    <i class="fa fa-shopping-cart"></i> Ventes du jour par article
                </h5>
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-striped">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th style="font-size: 11px;color: black;">Désignation</th>
                                <th style="font-size: 11px;color: black; text-align: center;">Qté</th>
                                <th style="font-size: 11px;color: black; text-align: right;">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ventes_articles as $article)
                                <tr>
                                    <td style="font-size: 11px;">{{ $article->designation }}</td>
                                    <td style="font-size: 11px; text-align: center;">
                                        <strong>{{ number_format($article->quantite, 0, '', ' ') }}</strong>
                                    </td>
                                    <td style="font-size: 11px; text-align: right;">
                                        {{ number_format($article->montant, 0, '', ' ') }} GNF
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center" style="font-size: 11px;">
                                        Aucune vente aujourd'hui
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
            date_vente: $('#date_vente').val(),
            id_mag: $('#id_mag').val(),
        };
        
        $.ajax({
            url: "{{ route('vente.liste_load_boutique') }}",
            method: 'GET',
            data: params,
            success: function(response) {
                $('#liste').html(response.html);
            },
            error: function() {
                alert('Erreur lors du chargement de la liste');
            },
            complete: function() {
                $('#loading-popup').hide();
            }
        });
    }
});
</script>



    


  </div>
@endsection