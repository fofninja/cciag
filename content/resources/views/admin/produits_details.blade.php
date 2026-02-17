@extends('layouts.layout')
@section('content')

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    Détails de l'Article
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
                                                          
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Désignation :</label>
                                            <input type="text" class="form-control inputup" readonly value="{{$produit[0]->nom_prod}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Catégorie :</label>
                                            <input type="text" class="form-control inputup" readonly value="{{$produit[0]->nom_categ}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Prix de vente :</label>
                                            <input type="text" class="form-control inputup" readonly value="{{ number_format($produit[0]->prix_prod,0,'',' ',) }} GNF">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Conditionnement :</label>
                                            <input type="text" class="form-control inputup" readonly value="{{$produit[0]->conditionnement}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Quantité Par Groupe :</label>
                                            <input type="number" class="form-control inputup" readonly value="{{$produit[0]->qt_par_group}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>

 <div class="row">

    <div class="col-lg-6 grid-margin stretch-card">
        @if($message = Session::get('success'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif
        <div class="card">
            <div class="card-body">
              <h4 class="card-title" style="font-size:11px">Situation Par Magasin</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th style="font-size:10px;">N°</th>
                          <th style="font-size:10px;">Magasin</th>
                          <th style="font-size:10px;">Quantité</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($produit_magasin as $pr => $prod_mag)
                        <tr>
                            <td style="font-size:10px;">{{ $pr+1 }}</td>
                            <td style="font-size:10px;"><strong>{{ $prod_mag->nom_mag }}</strong></td>
                            <td style="font-size:10px;"><strong>{{ $prod_mag->qt_prod }}</strong></td>
                        </tr>
                        @endforeach                   
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        @if($message = Session::get('success'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif
        <div class="card">
            <div class="card-body">
              <h4 class="card-title" style="font-size:11px">Historique des Approvisionnements</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Date</th>
                          <th>Quantité</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($productions as $i => $prod)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($prod->date_prd)->format('d-M-Y')  }}</td>
                            <td><strong>{{ $prod->qt_prd }}</strong></td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#modal_edit{{$i}}"  style="font-size:8px;" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                            </td>
                        </tr>

                        @if(\Carbon\Carbon::parse($prod->date_prd)->isToday())
                        <div id="modal_edit{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content card-body" style="background-color: white;">
                                    <div class="modal-header">
                                        <div class="card-title mslabel mstitle">Modification</div>
                                    </div>
                                    <form method="POST" action="{{route('production.edit',[$prod->id_prd])}}">
                                        @csrf
                                        <input type="hidden" name="qt_actuel" value="{{ $prod->qt_prd }}">
                                        <input type="hidden" name="id_prod" value="{{ $id}}">

                                        <div class="modal-body">
                                            <div class="row col-lg-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="input-1" class="mslabel">Date :</label>
                                                        <input type="text" class="msinput form-control" value="{{ \Carbon\Carbon::parse($prod->date_prd)->format('d-M-Y')  }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="input-1" class="mslabel">Quantité Produite :</label>
                                                        <input type="number" class="msinput form-control"  name="qt_prd" value="{{ $prod->qt_prd }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                            <button type="submit" class="btn labo-btn-primary"><i class="icon-bag"></i> Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            <div id="modal_edit{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content card-body" style="background-color: white;">
                                    <div class="modal-header">
                                        <div class="card-title mslabel mstitle text-danger">Impossible de Modifier la production d'une date passée</div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                        </div>
                                </div>
                            </div>
                        </div>

                        @endif

                        @endforeach                   
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>


  </div>
@endsection