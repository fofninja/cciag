@extends('layouts.layout')
@section('content')
<style type="text/css">
  td, th {
  font-size:11px;
}
</style>
  <script src="{{ asset('assets/js/jquery.min.js ') }}"></script>
    <script>
         $(document).ready(function () {
            $("#month").change(function(){
                var month= $("#month").val();
                window.location=month;
            });
          });
    </script>

<div class="card-title col-lg-12 mstitle">
    <i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Statistique du Mois de <h style="color:#eeb741;">{{ date('M Y',strtotime($mois)) }} </h>
    <select class="labo-search" id="month" autocomplete="off">
        <option>Choisir le mois</option>
        @foreach($liste_mois as $i => $list_m)
              <option value="{{route('magasin.rapport_mois',[$list_m->mois])}}">{{ $list_m->mois_texte }}</option>
            @endforeach
    </select>
</div>

  <div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Encaissement du Mois  <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 small-font" style="color:#0ebd0e">{{ number_format((($ventes[0]->total_vente)+($recouvrement[0]->total_rb)),0,'',' ',) }} GNF</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Ventes <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format($ventes[0]->total_vente,0,'',' ',) }} GNF </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Remboursement <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format($recouvrement[0]->total_rb,0,'',' ',) }} GNF </p>
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
                  <h5 class="text-white mb-0" style="font-size:12px">SOLDE DU MOIS  <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format((($ventes[0]->total_vente)+($recouvrement[0]->total_rb))-$total_depense[0]->total_depense,0,'',' ',) }} GNF</p>
                </div>
            </div>
            
        </div>
    </div>
 </div>


<div class="row">


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Situation Par Boutique</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:#F5D695;color:black">
                          <th>Boutique</th>
                          <th>Total Encaissement</th>
                          <th>Depenses</th>
                          <th>Solde</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php 
                            $t_encaissement_boutique=0;
                            $t_depense_boutique=0;
                            $t_solde_boutique=0;
                        @endphp
                        @foreach($magasins as $i => $mag)
                            @php 
                                $ventes_boutique = DB::select("SELECT SUM(montant_paye) as total_vente FROM vente_groupe  WHERE date_vente BETWEEN ? AND ? and id_mag=?", [$debut_mois, $fin_mois,$mag->id_mag]);
                                $depense_boutique = DB::select("SELECT SUM(montant) as total_depense  FROM depenses  WHERE date_depense BETWEEN ? AND ? and id_mag=?", [$debut_mois, $fin_mois,$mag->id_mag]);
                                $recouvrement_boutique = DB::select("SELECT SUM(montant_paye) as total_rb FROM paiement_credits WHERE date_paiement BETWEEN ? AND ? and id_mag=?", [$debut_mois, $fin_mois,$mag->id_mag]);

                                $encaissement_boutique=$ventes_boutique[0]->total_vente+$recouvrement_boutique[0]->total_rb;
                                $solde_boutique=$encaissement_boutique-$depense_boutique[0]->total_depense;

                                $t_encaissement_boutique+=$encaissement_boutique;
                                $t_depense_boutique+=$depense_boutique[0]->total_depense;
                                $t_solde_boutique+=$solde_boutique;
                            @endphp
                            <tr>
                                <td>{{ $mag->nom_mag}}</td>
                                <td><strong>{{ number_format($encaissement_boutique,0,'',' ',) }} GNF</strong></td>
                                <td><strong>{{ number_format($depense_boutique[0]->total_depense,0,'',' ',) }} GNF</strong></td>
                                <td><strong class="text-success">{{ number_format($solde_boutique,0,'',' ',) }} GNF</strong></td>
                                <td><a href="{{route('magasin.rapport_mois_boutique',[$mois,$mag->id_mag]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"><i class="fa fa-user"></i> Détails</a></td>
                            </tr>
                        @endforeach
                            <tr style="background-color:#F5D695;color:black">
                                <td>TOTAL</td>
                                <td><strong>{{ number_format($t_encaissement_boutique,0,'',' ',) }} GNF</strong></td>
                                <td><strong>{{ number_format($t_depense_boutique,0,'',' ',) }} GNF</strong></td>
                                <td><span class="badge badge-success" style="font-size:14px;"><strong>{{ number_format($t_solde_boutique,0,'',' ',) }} GNF</strong> </span></td> 
                                <td>-</td>
                            </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Journal des Ventes du Mois</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Date</th>
                          <th>Total Encaissement</th>
                          <th>Depenses</th>
                          <th>Solde</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                     <tbody>
                        @php 
                            $t_encaissement=0; 
                            $t_depense=0; 
                            $t_encaissement=0; 
                            $t_solde=0;
                        @endphp
                        @foreach($journal_vente as $i => $vente)
                            @php 
                                $rb=DB::select("SELECT sum(montant_paye) as total_rb from paiement_credits where date_paiement=?",[$vente->date_vente]);
                                $dep = DB::select("SELECT SUM(montant) as total_depense FROM depenses WHERE date_depense=?", [$vente->date_vente]);
                                $encaissement=$vente->total_vente+$rb[0]->total_rb;
                                $solde=$encaissement-$dep[0]->total_depense;
                                $t_encaissement+=$encaissement;
                                $t_depense+=$dep[0]->total_depense;
                                $t_solde+= $solde;
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d-M-Y') }}</td>
                                <td><strong>{{ number_format($encaissement,0,'',' ',) }} GNF</strong></td>
                                <td><strong>{{ number_format($dep[0]->total_depense,0,'',' ',) }} GNF</strong></td>
                                <td><strong class="text-success">{{ number_format($encaissement-$dep[0]->total_depense,0,'',' ',) }} GNF</strong></td>
                                <td><a href="{{route('magasin.rapport_jour',[$vente->date_vente]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"><i class="fa fa-user"></i> Détails</a></td>
                            </tr>
                        @endforeach
                            <tr style="background-color:white;color:black">
                                <td>TOTAL</td>
                                <td><strong>{{ number_format($t_encaissement,0,'',' ',) }} GNF</strong></td>
                                <td><strong>{{ number_format($t_depense,0,'',' ',) }} GNF</strong></td>
                                <td><span class="badge badge-success" style="font-size:14px;"><strong>{{ number_format($t_solde,0,'',' ',) }} GNF</strong> </span></td> 
                                <td>-</td>
                            </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>




    

    
</div>
@endsection