@extends('layouts.layout')
@section('content')

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    <i class="fa fa-exchange"></i> DÉTAILS DU TRANSFERT
                </div>
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
        
        @if($message = Session::get('error'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-danger">{{ $message }}</div>
        @endif
    </div>
    
    <!-- Informations du Transfert -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    Informations
                    <div class="pull-right">
                        <a href="{{ route('bon_transfert.liste') }}" class="btn btn-rounded btn-sm btn-secondary" style="font-size:8px;">
                            <i class="fa fa-arrow-left"></i> Retour
                        </a>
                        
                        @if($transfert->statut == 'validé')
                            <a href="" data-toggle="modal" data-target="#modal_annuler" style="font-size:8px;" class="btn btn-rounded btn-sm btn-danger">
                                <i class="fa fa-times"></i> Annuler le Transfert
                            </a>
                        @endif
                    </div>
                </h5>
                
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">N° Transfert :</label>
                                <input type="text" class="form-control inputup" value="{{ $transfert->num_bon_transfert }}" readonly autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Date :</label>
                                <input type="text" class="form-control inputup" value="{{ date('d/m/Y', strtotime($transfert->date_transfert)) }}" readonly autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Magasin Source :</label>
                                <input type="text" class="form-control inputup" value="{{ $transfert->mag_source }}" readonly autocomplete="off" style="background-color:#ffc107; color:white;">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Magasin Destination :</label>
                                <input type="text" class="form-control inputup" value="{{ $transfert->mag_destination }}" readonly autocomplete="off" style="background-color:#28a745; color:white;">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Montant Total :</label>
                                <input type="text" class="form-control inputup" value="{{ number_format($transfert->montant_total, 0, '', ' ') }} GNF" readonly autocomplete="off" style="background-color:#007bff; color:white; font-weight:bold;">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Statut :</label>
                                <input type="text" class="form-control inputup" 
                                       value="{{ $transfert->statut == 'validé' ? 'VALIDÉ' : ($transfert->statut == 'en_cours' ? 'EN COURS' : 'ANNULÉ') }}" 
                                       readonly autocomplete="off" 
                                       style="background-color:{{ $transfert->statut == 'validé' ? '#28a745' : ($transfert->statut == 'en_cours' ? '#ffc107' : '#dc3545') }}; color:white; font-weight:bold;">
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="labelup">Créé par :</label>
                                <input type="text" class="form-control inputup" value="{{ $transfert->createur }}" readonly autocomplete="off">
                            </div>
                        </div>
                        
                        @if($transfert->remarque)
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="labelup">Remarque :</label>
                                <textarea class="form-control inputup" readonly rows="2">{{ $transfert->remarque }}</textarea>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Articles Transférés -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px">
                    Articles Transférés ({{ count($articles) }})
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="background-color:#f8f9fa;color: black;">
                            <tr>
                                <th style="font-size:11px;">Article</th>
                                <th style="font-size:11px;">Quantité</th>
                                <th style="font-size:11px;">Prix Unit.</th>
                                <th style="font-size:11px;">Montant</th>
                                <th style="font-size:11px;">Magasin Source</th>
                                <th style="font-size:11px;">Magasin Destination</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $art)
                                <tr>
                                    <td style="font-size:11px;"><strong>{{ $art->nom_prod }}</strong></td>
                                    <td style="font-size:11px;">{{ $art->qt_transfert }}</td>
                                    <td style="font-size:11px;">{{ number_format($art->prix_unitaire, 0, '', ' ') }}</td>
                                    <td style="font-size:11px;"><strong>{{ number_format($art->montant, 0, '', ' ') }} GNF</strong></td>
                                    <td style="font-size:11px;">{{ $art->mag_source  }}</td>
                                    <td style="font-size:11px;">{{ $art->mag_destination }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"><strong class="text-warning">Aucun article</strong></td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot style="background-color:#B3B3B3; font-weight:bold;">
                            <tr>
                                <td colspan="3" class="text-right" style="font-size:12px;color:black">TOTAL :</td>
                                <td style="font-size:12px;color:black" class="text-success">{{ number_format($transfert->montant_total, 0, '', ' ') }} GNF</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Annulation -->
@if($transfert->statut == 'validé')
<div id="modal_annuler" class="modal fade" role="dialog" style="padding-top:50px;">
    <div class="modal-dialog">
        <div class="modal-content card-body" style="background-color: white;">
            <div class="modal-header" style="background-color:#dc3545;">
                <div class="card-title mslabel mstitle" style="color:white;">
                    Annuler le Transfert
                </div>
            </div>
            <form method="POST" action="{{ route('bon_transfert.annuler', [$transfert->num_bon_transfert]) }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>Attention !</strong> Cette action va :
                        <ul>
                            <li>Remettre le stock dans <strong>{{ $transfert->mag_source }}</strong></li>
                            <li>Retirer le stock de <strong>{{ $transfert->mag_destination }}</strong></li>
                            <li>Marquer le transfert comme annulé</li>
                        </ul>
                    </div>
                    
                    <p><strong>N° Transfert :</strong> {{ $transfert->num_bon_transfert }}</p>
                    <p><strong>Montant :</strong> {{ number_format($transfert->montant_total, 0, '', ' ') }} GNF</p>
                    <p><strong>Articles :</strong> {{ count($articles) }}</p>
                    
                    <p class="text-danger"><strong>Êtes-vous sûr de vouloir annuler ce transfert ?</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn labo-btn-red" data-dismiss="modal">Non, Fermer</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times"></i> Oui, Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

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

@endsection