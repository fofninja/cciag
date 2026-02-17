
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black;">
                <th style="font-size:10px;">N° BC</th>
                <th style="font-size:10px;">Statut</th>
                <th style="font-size:10px;">Fournisseur</th>
                <th style="font-size:10px;">Action</th>
            </tr>
        </thead>
        
        <tbody >
            @forelse($liste_bon as $i => $list)
                @php $reste=$list->montant_bon_cmd-$list->montant_paye; @endphp
                <tr>
                    <td style="font-size:10px;"><strong>{{ $list->num_bon_cmd }}</strong><br>{{ \Carbon\Carbon::parse($list->date_bon_cmd)->format('d/m/Y') }}</td>
                    @if($reste>0)
                        <td style="font-size:10px;"><strong class="text-danger">Non réglé</strong><br>({{ number_format($list->montant_bon_cmd-$list->montant_paye , 0, '', ' ') }} GNF restant)</td>
                    @else
                        <td style="font-size:10px;"><strong class="text-success">Réglé</strong></td>
                    @endif
                    <td style="font-size:10px;">{{ $list->nom_fournisseur }}</td>
                    <td style="font-size:10px;">
                        <a href="{{ route('bon_commande.details', [$list->num_bon_cmd]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"> Détails</a>
                        &nbsp;
                        <a href="" data-toggle="modal" data-target="#regle{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-success">
                           réglé
                        </a>
                        &nbsp;
                        <a href="" data-toggle="modal" data-target="#modal_edit{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-info">
                           <i class="fa fa-pencil"></i>
                        </a>  
                        @if(Auth::user()->id=='2')
                        &nbsp;
                        <form method="POST" action="{{ route('bon_commande.drop', [$list->num_bon_cmd]) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                <i class="fa fa-trash"></i> 
                            </button>
                        </form>
                        &nbsp;
                        @endif 
                    </td> 
                </tr>
            @empty
                <th scope="row"></th>
                <td><strong class="text-danger">Aucun Résultat</strong></td>
            @endforelse
        </tbody>
    </table>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    // ✅ LOGIQUE POUR CHAQUE MODAL DE RÈGLEMENT
    $(document).on('input', '.montant-reglement', function () {
        let input = $(this);
        let modal = input.closest('.modal');
        
        // 1. Extraire uniquement les chiffres
        let value = input.val().replace(/\D/g, '');
        
        // 2. Récupérer le reste à payer pour ce bon de commande
        let resteAPayer = parseFloat(modal.find('.reste-a-payer-value').val()) || 0;
        
        // 3. Stocker la valeur numérique dans le champ caché
        modal.find('.montant-reglement-hidden').val(value);
        
        // 4. Formater l'affichage avec séparateurs
        if (value) {
            let formattedValue = parseInt(value).toLocaleString('fr-FR');
            input.val(formattedValue);
        } else {
            input.val('');
        }
        
        // 5. Validation : le montant saisi ne doit pas dépasser le reste à payer
        let montantSaisi = parseFloat(value) || 0;
        
        if (montantSaisi > resteAPayer) {
            modal.find('.alerte-paiement').text('Le montant saisi dépasse le reste à payer (' + resteAPayer.toLocaleString('fr-FR') + ' GNF)');
            modal.find('.btn-submit-reglement').prop('disabled', true);
        } else if (montantSaisi === 0) {
            modal.find('.alerte-paiement').text('Veuillez saisir un montant');
            modal.find('.btn-submit-reglement').prop('disabled', true);
        } else {
            modal.find('.alerte-paiement').text('');
            modal.find('.btn-submit-reglement').prop('disabled', false);
        }
    });

    // ✅ Au focus : retirer le formatage pour faciliter la saisie
    $(document).on('focus', '.montant-reglement', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });

    // ✅ Au blur : reformater automatiquement
    $(document).on('blur', '.montant-reglement', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value) {
            $(this).val(parseInt(value).toLocaleString('fr-FR') + ' GNF');
        }
    });
});
</script>

@foreach($liste_bon as $i => $list)
@php $reste=$list->montant_bon_cmd-$list->montant_paye; @endphp
                            <!-- Modal édition -->
                            <div id="modal_edit{{$i}}" class="modal fade" role="dialog" style="padding-top:50px">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-body" style="background-color: white;">
                                        <div class="modal-header">
                                            <div class="card-title mslabel mstitle">Modifier</div>
                                        </div>
                                        <form method="POST" action="{{route('bon_commande.edit',[$list->num_bon_cmd])}}" id="editformart{{$i}}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">N° Bon:</label>
                                                            <input type="text" class="msinput form-control" name="num_bon_cmd" readonly value="{{ $list->num_bon_cmd }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Fournisseur :</label>
                                                            <select class="msinput form-control" autocomplete="off" required name="id_fournisseur">
                                                              <option value="{{ $list->id_fournisseur }}">{{ $list->nom_fournisseur }}</option>
                                                              @foreach($fournisseurs as $fr => $fourni)
                                                                <option value="{{$fourni->id_fournisseur }}">{{ $fourni->nom_fournisseur}} ({{ $fourni->type_fournisseur}})</option>
                                                              @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Date Commande :</label>
                                                              <input type="date" class="msinput form-control" value="{{date('Y-m-d')}}" name="date_bon_cmd" required>
                                                         </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                                <button type="submit" onclick='document.getElementById("editformart{{$i}}").submit();' class="btn labo-btn-primary"><i class="icon-bag"></i> Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Règlement -->
    <div id="regle{{$i}}" class="modal fade" role="dialog" style="padding-top:50px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content card-body" style="background-color: white;">
                <div class="modal-header" style="background-color:green;">
                    <div class="card-title mslabel mstitle" style="font-size:16px">Régler le Bon de Commande</div>
                </div>
                <form method="POST" action="{{route('bon_commande.reglement',[$list->num_bon_cmd])}}">
                    @csrf
                    <input type="hidden" class="reste-a-payer-value" value="{{ $reste }}">
                     <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    
                    <div class="modal-body">
                        <div class="row col-lg-12">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">N° Bon:</label>
                                    <input type="text" class="msinput form-control" name="num_bon_cmd" readonly value="{{ $list->num_bon_cmd }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">Date Règlement :</label>
                                    <input type="date" class="msinput form-control" value="{{date('Y-m-d')}}" name="date_reglement" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">Montant Total du Bon:</label>
                                    <input type="text" class="msinput form-control" value="{{ number_format($list->montant_bon_cmd, 0, '', ' ') }} GNF" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">Déjà Payé:</label>
                                    <input type="text" class="msinput form-control" style="background-color:#2A9666" value="{{ number_format($list->montant_paye, 0, '', ' ') }} GNF" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">Reste à Payer:</label>
                                    <input type="text" class="msinput form-control" style="background-color:#E62F0E" value="{{ number_format($reste, 0, '', ' ') }} GNF" readonly>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel"><strong>*Montant à Régler:</strong></label>
                                    <input type="text" class="msinput form-control montant-reglement" 
                                           style="font-size:1.2rem;" placeholder="0 GNF" required>
                                    <input type="hidden" name="montant_paye" class="montant-reglement-hidden">
                                    <p class="text-danger alerte-paiement" style="font-weight:bold;"></p>
                                    <small class="text-muted">Maximum: {{ number_format($reste, 0, '', ' ') }} GNF</small>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1" class="mslabel">Mode de Paiement :</label>
                                    <select class="msinput form-control" autocomplete="off" required name="mode_pay">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Espèces">Espèces</option>
                                        <option value="Chèque">Chèque</option>
                                        <option value="Virement">Virement</option>
                                        <option value="Mobile Money">Mobile Money</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                        <button type="submit" class="btn labo-btn-primary btn-submit-reglement" disabled>
                            <i class="fa fa-check"></i> Enregistrer le Règlement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
