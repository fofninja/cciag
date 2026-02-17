@extends('layouts.layout')
@section('content')

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    <i class="fa fa-history"></i> HISTORIQUE DES TRANSFERTS
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
    </div>
    
    <div class="col-lg-12 mb-3">
        <div class="btn-group" role="group">
            <a href="{{ route('bon_transfert.liste') }}" class="btn btn-rounded btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i> Retour
            </a>
            <a href="{{ route('bon_transfert') }}" class="btn btn-rounded btn-sm btn-success">
                <i class="fa fa-plus"></i> Nouveau Transfert
            </a>
        </div>
    </div>
    
    <!-- Transferts Envoyés -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px; color:white; padding:10px;">
                    <i class="fa fa-upload"></i> TRANSFERTS ENVOYÉS ({{ count($transferts_envoyes) }})
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="background-color:white;">
                            <tr>
                                <th style="font-size:11px;color:black;">N° Transfert</th>
                                <th style="font-size:11px;color:black;">Date</th>
                                <th style="font-size:11px;color:black;">Vers</th>
                                <th style="font-size:11px;color:black;">Montant</th>
                                <th style="font-size:11px;color:black;">Statut</th>
                                <th style="font-size:11px;color:black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transferts_envoyes as $transfert)
                                <tr>
                                    <td style="font-size:11px;"><strong>{{ $transfert->num_bon_transfert }}</strong></td>
                                    <td style="font-size:11px;">{{ date('d/m/Y', strtotime($transfert->date_transfert)) }}</td>
                                    <td style="font-size:11px;">
                                        <i class="fa fa-arrow-right text-warning"></i>
                                        <span class="badge badge-success">{{ $transfert->mag_destination }}</span>
                                    </td>
                                    <td style="font-size:11px;"><strong>{{ number_format($transfert->montant_total, 0, '', ' ') }}</strong></td>
                                    <td style="font-size:11px;">
                                        @if($transfert->statut == 'validé')
                                            <span class="badge badge-success" style="font-size:10px;">✓ Validé</span>
                                        @elseif($transfert->statut == 'en_cours')
                                            <span class="badge badge-warning" style="font-size:10px;">⏳ En cours</span>
                                        @else
                                            <span class="badge badge-danger" style="font-size:10px;">✗ Annulé</span>
                                        @endif
                                    </td>
                                    <td style="font-size:11px;">
                                        <a href="{{ route('bon_transfert.details', [$transfert->num_bon_transfert]) }}" 
                                           class="btn btn-rounded btn-sm btn-info" style="font-size:8px;">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <span class="text-muted">Aucun transfert envoyé</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if(count($transferts_envoyes) > 0)
                        <tfoot style="background-color:#fff3cd; font-weight:bold;">
                            <tr>
                                <td colspan="3" class="text-right" style="font-size:11px;">TOTAL ENVOYÉ :</td>
                                <td style="font-size:11px;">
                                    {{ number_format(array_sum(array_column($transferts_envoyes, 'montant_total')), 0, '', ' ') }} GNF
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Transferts Reçus -->
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px; background-color:#28a745; color:white; padding:10px;">
                    <i class="fa fa-download"></i> TRANSFERTS REÇUS ({{ count($transferts_recus) }})
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead style="background-color:#d4edda;">
                            <tr>
                                <th style="font-size:11px;color:black;">N° Transfert</th>
                                <th style="font-size:11px;color:black;">Date</th>
                                <th style="font-size:11px;color:black;">De</th>
                                <th style="font-size:11px;color:black;">Montant</th>
                                <th style="font-size:11px;color:black;">Statut</th>
                                <th style="font-size:11px;color:black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transferts_recus as $transfert)
                                <tr>
                                    <td style="font-size:11px;"><strong>{{ $transfert->num_bon_transfert }}</strong></td>
                                    <td style="font-size:11px;">{{ date('d/m/Y', strtotime($transfert->date_transfert)) }}</td>
                                    <td style="font-size:11px;">
                                        <span class="badge badge-warning">{{ $transfert->mag_source }}</span>
                                        <i class="fa fa-arrow-right text-success"></i>
                                    </td>
                                    <td style="font-size:11px;"><strong>{{ number_format($transfert->montant_total, 0, '', ' ') }}</strong></td>
                                    <td style="font-size:11px;">
                                        @if($transfert->statut == 'validé')
                                            <span class="badge badge-success" style="font-size:10px;">✓ Validé</span>
                                        @elseif($transfert->statut == 'en_cours')
                                            <span class="badge badge-warning" style="font-size:10px;">⏳ En cours</span>
                                        @else
                                            <span class="badge badge-danger" style="font-size:10px;">✗ Annulé</span>
                                        @endif
                                    </td>
                                    <td style="font-size:11px;">
                                        <a href="{{ route('bon_transfert.details', [$transfert->num_bon_transfert]) }}" 
                                           class="btn btn-rounded btn-sm btn-info" style="font-size:8px;">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <span class="text-muted">Aucun transfert reçu</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if(count($transferts_recus) > 0)
                        <tfoot style="background-color:#d4edda; font-weight:bold;">
                            <tr>
                                <td colspan="3" class="text-right" style="font-size:11px;">TOTAL REÇU :</td>
                                <td style="font-size:11px;">
                                    {{ number_format(array_sum(array_column($transferts_recus, 'montant_total')), 0, '', ' ') }} GNF
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Résumé -->
    @if(count($transferts_envoyes) > 0 || count($transferts_recus) > 0)
    <div class="col-lg-12" style="display:none">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    <i class="fa fa-bar-chart"></i> RÉSUMÉ
                </h5>
                
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="labelup">Total Envoyé :</label>
                            <input type="text" class="form-control inputup" 
                                   value="{{ number_format(array_sum(array_column($transferts_envoyes, 'montant_total')), 0, '', ' ') }} GNF" 
                                   readonly style="background-color:#ffc107; color:white; font-weight:bold;">
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="labelup">Total Reçu :</label>
                            <input type="text" class="form-control inputup" 
                                   value="{{ number_format(array_sum(array_column($transferts_recus, 'montant_total')), 0, '', ' ') }} GNF" 
                                   readonly style="background-color:#28a745; color:white; font-weight:bold;">
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="labelup">Nb Transferts Envoyés :</label>
                            <input type="text" class="form-control inputup" 
                                   value="{{ count($transferts_envoyes) }}" 
                                   readonly style="background-color:#007bff; color:white; font-weight:bold;">
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="labelup">Nb Transferts Reçus :</label>
                            <input type="text" class="form-control inputup" 
                                   value="{{ count($transferts_recus) }}" 
                                   readonly style="background-color:#17a2b8; color:white; font-weight:bold;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

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