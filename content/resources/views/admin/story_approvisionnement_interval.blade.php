@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js ') }}"></script>

<div class="card-title col-lg-12 mstitle">
    Approvisionnements Du <h style="color:#eeb741;">{{ \Carbon\Carbon::parse($debut)->format('d-M-Y')  }}</h> au <h style="color:#eeb741;">{{ \Carbon\Carbon::parse($fin)->format('d-M-Y')  }}</h>
</div>


 <div class="row">
  <div class="col-lg-12" style="padding-bottom:10px">
    <p class="btn btn-rounded btn-light" style="background-color:#003853;font-size:9px;">
            <a type="button" data-toggle="modal" data-target="#mois" target="_blank">
                Historique Mensuelles
            </a>
    </p>
    
    <p class="btn btn-rounded btn-light" style="background-color:#003853;font-size:9px;">
            <a type="button" data-toggle="modal" data-target="#interval" target="_blank">
                Par Intervalle
            </a>
    </p>
    
    <p class="btn btn-rounded btn-light" style="background-color:#003853;font-size:9px;">
            <a type="button" data-toggle="modal" data-target="#jour" target="_blank">
                Par Jour
            </a>
    </p>
  </div>
</div>

 <div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        @if($message = Session::get('success'))
                <div id="success-alert" class="alert labo-label-alert-success labo-alert-success">{{ $message }}</div> 
        @endif
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Historique des Approvisionnements</h4>
                  
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Date</th>
                          <th>Produits</th>
                          <th>Quantité</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($productions as $i => $prod)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($prod->date_prd)->format('d-M-Y')  }}</td>
                            <td><strong>{{ $prod->nom_prod }}</strong></td>
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
                                        <input type="hidden" name="id_prod" value="{{$prod->id_prod}}">

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
                                                        <label for="input-1" class="mslabel">Quantité :</label>
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
                                        <div class="card-title mslabel mstitle text-danger">Impossible de Modifier l'Approvisionnements d'une date passée</div>
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
    
    
      <div id="interval" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content card-body" style="background-color: white;">
                    <div class="modal-header">
                        <div class="card-title mslabel mstitle">Veuillez définir l'interval <h class="text-warning"></h></div>
                    </div>
                    <form action="{{route('magasin.story_apr_interval')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                               <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-1" class="mslabel">Date Depart:</label>
                                        <input type="date" class="msinput form-control"  name="depart" required>
                                    </div>
                                </div>
    
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-1" class="mslabel">Date arrivée:</label>
                                        <input type="date" class="msinput form-control"  name="arrivee" required>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="modal-footer">
                             <button type="submit" class="btn labo-btn-primary"><i class="icon-bag"></i> Trier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="jour" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content card-body" style="background-color: white;">
                    <div class="modal-header">
                        <div class="card-title mslabel mstitle">Veuillez définir le Jour <h class="text-warning"></h></div>
                    </div>
                    <form action="{{route('magasin.story_apr_jour')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                               <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-1" class="mslabel">Date Depart:</label>
                                        <input type="date" class="msinput form-control"  name="jour" required>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="modal-footer">
                             <button type="submit" class="btn labo-btn-primary"><i class="icon-bag"></i> Trier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="mois" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content card-body" style="background-color: white;">
                    <div class="modal-header">
                        <div class="card-title mslabel mstitle">Veuillez Choisir le Mois <h class="text-warning"></h></div>
                    </div>
                    <form action="{{route('magasin.story_apr_mois')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                               <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="input-1" class="mslabel">Mois :</label>
                                        <select class="form-control msinput"  autocomplete="off" name="mois">
                                            <option>Choisir le mois</option>
                                            @foreach($liste_mois as $key => $lmois) 
                                            <option value="{{$lmois->mois}}">{{$lmois->mois_texte}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                               
                            </div>
                        </div>
                        <div class="modal-footer">
                             <button type="submit" class="btn labo-btn-primary"><i class="icon-bag"></i> Trier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

</div>


  </div>
@endsection