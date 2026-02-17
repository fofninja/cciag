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
    <i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Statistique (<h style="color:#eeb741;">{{ $an }})
    <select class="labo-search" id="month" autocomplete="off">
        <option>Choisir l'Année</option>
        @foreach($liste_mois as $i => $list_m)
              <option value="{{route('admin.rapport_year',[$list_m->an])}}">{{ $list_m->an }}</option>
            @endforeach
    </select>
</div>

  <div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">{{ $an }} <span class="float-right"><i class="fa fa-calendar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Années </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light" style="background-color:green;">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">CA  <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format($ventes[0]->total_vente+$recouvrement[0]->total_rb,0,'',' ',) }} GNF</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Vente <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">
                            {{ number_format($ventes[0]->total_vente, 0, '', ' ') }} GNF
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Recouvrement <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">{{ number_format($recouvrement[0]->total_rb,0,'',' ',) }} GNF</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-2 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0" style="font-size:12px">Dépense <span class="float-right"><i class="fa fa-dollar"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:100%"></div>
                    </div>
                  <a  href="{{route('depense.rapport_year',[$an]) }}"  style="color:#ff8484">{{ number_format($total_depense[0]->total_depense,0,'',' ',) }} GNF</a>
                </div>
            </div>
        </div>
    </div>
 </div>


<div class="row">
  <div class="col-lg-12">
    <a href="h" class="pull-right" style="font-size:12px;padding-bottom:6px;margin-top:-14px;"><i class="fa fa-print"></i> imprimer le rapport</a>
  </div>
</div>

<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Production de l'années</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>#</th>
                          <th>Article</th>
                          <th class="text-center">Quantité Produite</th>
                          <th class="text-center">Quantité Actuelle</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($production as $i => $prod)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$prod->nom_prod }}</td>
                                <td class="text-center"><strong><u>{{$prod->total_prod }}</u></strong></td>
                                <td class="text-center"><strong><u>{{$prod->qt_prod }}</u></strong></td>
                            </tr> 
                        @endforeach   
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Journal des Ventes de l'années</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Mois</th>
                          <th>Total Ventes</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($journal_vente as $i => $vente)
                        @php $rb = DB::select("SELECT sum(montant_rb) as total_rb from remboursement where date_format(date_rb,'%Y-%m')=?",[$vente->mois_v]); @endphp
                            <tr>
                                <td>{{ $vente->mois }}</td>
                                <td><strong>{{ number_format($vente->total_vente+$rb[0]->total_rb,0,'',' ',) }} GNF</strong></td>
                                <td><a href="{{route('admin.rapport_mois',[$vente->mois_v]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"><i class="fa fa-user"></i> Détails</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Journal des Livraisons</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Mois</th>
                          <th>Total Ventes</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($journal_livraison as $i => $liv)
                            <tr>
                                <td>{{$liv->mois }}</td>
                                <td><strong>{{ number_format($liv->total_vente,0,'',' ',) }} GNF</strong></td>
                                <td><a href="{{route('admin.rapport_mois',[$liv->mois_v]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"><i class="fa fa-user"></i> Détails</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection