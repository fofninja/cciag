<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black">
                <th>N° Transfert</th>
                <th>Date</th>
                <th>De → Vers</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($liste_transferts as $i => $transfert)
                <tr>
                    <td style="font-size:11px;"><strong>{{ $transfert->num_bon_transfert }}</strong></td>
                    <td style="font-size:11px;">{{ date('d/m/Y', strtotime($transfert->date_transfert)) }}</td>
                    <td style="font-size:11px;">
                        <span class="badge badge-info">{{ $transfert->mag_source }}</span>
                        <i class="fa fa-arrow-right"></i>
                        <span class="badge badge-success">{{ $transfert->mag_destination }}</span>
                    </td>
                    <td style="font-size:11px;"><strong>{{ number_format($transfert->montant_total, 0, '', ' ') }} GNF</strong></td>
                    <td style="font-size:11px;">
                        @if($transfert->statut == 'validé')
                            <span class="badge badge-success">Validé</span>
                        @elseif($transfert->statut == 'en_cours')
                            <span class="badge badge-warning">En cours</span>
                        @else
                            <span class="badge badge-danger">Annulé</span>
                        @endif
                    </td>
                    <td style="font-size:11px;">
                        <a href="{{ route('bon_transfert.details', [$transfert->num_bon_transfert]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-info">
                            <i class="fa fa-eye"></i> Détails
                        </a>
                        
                        @if($transfert->statut == 'validé')
                            <a href="" data-toggle="modal" data-target="#modal_annuler{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-danger">
                                <i class="fa fa-times"></i> Annuler
                            </a>
                        @endif
                    </td>
                </tr>

                <!-- Modal Annulation -->
                @if($transfert->statut == 'validé')
                <div id="modal_annuler{{$i}}" class="modal fade" role="dialog" style="padding-top:50px;">
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
                                            <li>Remettre le stock dans le magasin source</li>
                                            <li>Retirer le stock du magasin destination</li>
                                            <li>Marquer le transfert comme annulé</li>
                                        </ul>
                                    </div>
                                    
                                    <p><strong>N° Transfert :</strong> {{ $transfert->num_bon_transfert }}</p>
                                    <p><strong>Montant :</strong> {{ number_format($transfert->montant_total, 0, '', ' ') }} GNF</p>
                                    <p><strong>De :</strong> {{ $transfert->mag_source }}</p>
                                    <p><strong>Vers :</strong> {{ $transfert->mag_destination }}</p>
                                    
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
            @empty
                <tr>
                    <td colspan="6"><strong class="text-warning">Aucun transfert trouvé</strong></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>