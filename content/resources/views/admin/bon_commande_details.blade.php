@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
   $(document).ready(function () {
    var limit=25;
    var numBon = "{{ $bon[0]->num_bon_cmd }}"; // Récupérer la variable PHP
    $("#liste").load("{{ route('bon_commande.article_liste',['','']) }}/" + limit + "/" + numBon);
    
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
    })();

    $("#search").keyup(function() {
        delay(function() {
            var word = $("#search").val();
            word = word.replace(/ /g, "_");
            $('#loading-popup').show();
            if (word !== "") {
                $("#liste").load("{{ route('bon_commande.article_search',['','']) }}/" + word + "/" + numBon, function() {
                    $('#loading-popup').hide();
                });
            } else {
                $("#liste").load("{{ route('bon_commande.article_liste',['','']) }}/" + limit + "/" + numBon, function() {
                    $('#loading-popup').hide();
                });
            }
        }, 500);
    });

    $("#showmore").click(function(){
        limit += 10;
        $('#loading-popup').show();
        $("#liste").load("{{ route('bon_commande.article_liste',['','']) }}/" + limit + "/" + numBon, function() {
            $('#loading-popup').hide();
        });
    });

    // ✅ LOGIQUE UNIFIÉE : Formatage + Calcul du reste
    $(document).on('input', '#montant_paye', function () {
        let input = $(this);
        let modal = input.closest('.modal');
        
        // 1. Extraire uniquement les chiffres
        let value = input.val().replace(/\D/g, '');
        
        // 2. Stocker la valeur numérique dans le champ caché
        $('#montant_paye_hidden').val(value);
        
        // 3. Formater l'affichage avec séparateurs
        if (value) {
            let formattedValue = parseInt(value).toLocaleString('fr-FR');
            input.val(formattedValue);
        } else {
            input.val('');
        }
        
        // 4. Calculer le reste à payer
        let montantPaye = parseFloat(value) || 0;
        let somme = parseFloat($('#somme').val()) || 0;
        let reste = somme - montantPaye;
        let restePositif = reste > 0 ? reste : 0;
        
        // 5. Stocker la valeur numérique du reste dans le champ caché
        modal.find('#reste_hidden').val(restePositif);
        
        // 6. Formater et afficher le reste
        if (restePositif > 0) {
            modal.find('#reste_display').val(restePositif.toLocaleString('fr-FR') + ' GNF');
        } else {
            modal.find('#reste_display').val('0 GNF');
        }
        
        // 7. Validation
        if (montantPaye > somme) {
            modal.find('#alertepay').text('Le montant payé est supérieur au montant total');
            modal.find('#btnsubmit').prop('disabled', true);
        } else {
            modal.find('#alertepay').text('');
            modal.find('#btnsubmit').prop('disabled', false);
        }
    });

    // ✅ Au focus : retirer le formatage pour faciliter la saisie
    $(document).on('focus', '#montant_paye', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });

    // ✅ Au blur : reformater automatiquement
    $(document).on('blur', '#montant_paye', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value) {
            $(this).val(parseInt(value).toLocaleString('fr-FR') + ' GNF');
        }
    });


    // ✅ CALCUL AUTOMATIQUE DU MONTANT (Quantité × Prix)
    $(document).on('input', '.qt-input, .prix-input', function() {
        let index = $(this).data('index');
        let modal = $(this).closest('.modal');
        
        // Récupérer la quantité
        let qt = parseFloat(modal.find('.qt-input').val()) || 0;
        
        // Récupérer le prix (nettoyer le formatage)
        let prixDisplay = modal.find('.prix-input').val();
        let prix = parseFloat(prixDisplay.replace(/\D/g, '')) || 0;
        
        // Calculer le montant
        let montant = qt * prix;
        
        // Mettre à jour l'affichage
        modal.find('.montant-display').val(montant.toLocaleString('fr-FR') + ' GNF');
        modal.find('.montant-hidden').val(montant);
    });

    // ✅ FORMATAGE DU PRIX D'ACHAT
    $(document).on('input', '.prix-input', function() {
        let input = $(this);
        let modal = input.closest('.modal');
        
        // Extraire uniquement les chiffres
        let value = input.val().replace(/\D/g, '');
        
        // Stocker la valeur numérique
        modal.find('.prix-hidden').val(value);
        
        // Formater l'affichage
        if (value) {
            input.val(parseInt(value).toLocaleString('fr-FR'));
        } else {
            input.val('');
        }
    });

    // ✅ Au focus du prix : retirer le formatage
    $(document).on('focus', '.prix-input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });

    // ✅ Au blur du prix : reformater
    $(document).on('blur', '.prix-input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value) {
            $(this).val(parseInt(value).toLocaleString('fr-FR'));
        }
    });

    // ✅ LOGIQUE POUR LE MODAL DE RÈGLEMENT
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

 <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row col-lg-12">
                                                          
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">N° Bon de Commande :</label>
                                            <input type="text" class="form-control inputup" value="{{ $bon[0]->num_bon_cmd }}" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Date :</label>
                                            <input type="text" class="form-control inputup" value="{{ \Carbon\Carbon::parse($bon[0]->date_bon_cmd)->format('d/m/Y') }}" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Fournisseur :</label>
                                            <input type="text" class="form-control inputup" value="{{ $bon[0]->nom_fournisseur }}" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Montant Total :</label>
                                            <input type="text" class="form-control inputup" value="{{ number_format($bon[0]->montant_bon_cmd, 0, '', ' ') }} GNF" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Payé :</label>
                                            <input type="text" class="form-control inputup" style="background-color:#2A9666" value="{{ number_format($bon[0]->montant_paye, 0, '', ' ') }} GNF" readonly autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="input-1" class="labelup">Reste à payé :</label>
                                            <input type="text" class="form-control inputup" value="{{ number_format($bon[0]->montant_bon_cmd-$bon[0]->montant_paye, 0, '', ' ') }} GNF" readonly style="background-color:#E62F0E" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
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

        @if($message = Session::get('success_vente'))
            <div class="row">
                <div class="col-lg-5">
                    <div class="alert labo-label-alert-success labo-alert-success"><h style="color:black">Vente Effectuée</h></div> 
                </div>

                <div class="col-lg-2">
                    <a target="_blank" href="{{route('recu_vente',[$message])}}"  style="font-size:10px; padding-left:5px; margin-right:5px;height:35px;" class="btn btn-rounded btn-sm btn-info">
                    <i class="fa fa-print"></i> &nbsp;Reçu
                    </a>
                </div>
            </div>
        @endif
    </div>


    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="font-size:14px">
                Ajout d'articles
                <div class="pull-right">
                    <input type="text" id="search" placeholder="rechercher" autocomplete="off" class=" labo-search">
                    &nbsp;&nbsp;&nbsp;  
                </div>
              </h5>
                  
                <div id="liste"></div>
                <button id="showmore" data-page="2">Afficher plus</button>
            </div>
        </div>

        <div id="loading-popup" style="display: none;">
            <div class="loading-content">
                <p>Affichage en cours...</p>
            </div>
        </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="font-size:14px">
                Articles du Bon de Commande
              </h5>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr style="background-color:white;color:black">
                          <th>Article</th>
                          <th>Qt</th>
                          <th>P.Achat</th>
                          <th>Magasin</th>
                          <th>Montant</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $somme=0; @endphp
                        @forelse($liste_article as $i => $list)
                        @php $somme+=$list->montant_cmd; @endphp
                            <tr>
                                <td style="font-size:11px;">{{ $list->nom_prod }}</td>
                                <td style="font-size:11px;">{{ $list->qt_cmd }}</td>
                                <td style="font-size:11px;"><strong>{{ number_format($list->prix_achat, 0, '', ' ') }} GNF</strong></td>
                                <td style="font-size:11px;"><strong>{{ $list->nom_mag }}</strong></td>
                                <td style="font-size:11px;"><strong>{{ number_format($list->montant_cmd, 0, '', ' ') }} GNF</strong></td>
                                <td style="font-size:11px;">
                                    <a href="" data-toggle="modal" data-target="#modal_edit{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-info">
                                       <i class="fa fa-pencil"></i>
                                    </a>  
                                    &nbsp;
                                    <form method="POST" action="{{ route('bon_commande.edit_delete', [$list->id_bon_cmd_line]) }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" value="{{ $list->num_bon_cmd }}" name="num_bon_cmd">
                                        <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </form>
                                </td> 
                            </tr>


                            <!-- Modal édition Article -->
                            <div id="modal_edit{{$i}}" class="modal fade" role="dialog" style="padding-top:50px">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-body" style="background-color: white;">
                                        <div class="modal-header" style="background-color:#007bff;">
                                            <div class="card-title mslabel mstitle" style="color:white;">Modifier l'Article</div>
                                        </div>
                                        <form method="POST" action="{{route('bon_commande.edit_article',[$list->id_bon_cmd_line])}}" id="editform{{$i}}">
                                            @csrf
                                            <input type="hidden" name="num_bon_cmd" value="{{ $list->num_bon_cmd }}">
                                            <div class="modal-body">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Article :</label>
                                                            <input type="text" class="msinput form-control" readonly value="{{ $list->nom_prod }}">
                                                            <input type="hidden" name="code_prod" value="{{ $list->code_prod }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Quantité Commandée :</label>
                                                            <input type="number" class="msinput form-control qt-input" 
                                                                   name="qt_cmd" 
                                                                   data-index="{{$i}}"
                                                                   required 
                                                                   min="1"
                                                                   value="{{ $list->qt_cmd }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Prix d'Achat Unitaire :</label>
                                                            <input type="text" class="msinput form-control prix-input" 
                                                                   name="prix_achat_display" 
                                                                   data-index="{{$i}}"
                                                                   required 
                                                                   value="{{ number_format($list->prix_achat, 0, '', ' ') }}">
                                                            <input type="hidden" name="prix_achat" class="prix-hidden" value="{{ $list->prix_achat }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Magasin :</label>
                                                            <select class="msinput form-control" name="id_mag" required>
                                                                <option value="{{ $list->id_mag }}">{{ $list->nom_mag }} (Actuel)</option>
                                                                @foreach(DB::select('SELECT id_mag, nom_mag FROM magasin') as $mag)
                                                                    @if($mag->id_mag != $list->id_mag)
                                                                        <option value="{{ $mag->id_mag }}">{{ $mag->nom_mag }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Montant Total :</label>
                                                            <input type="text" class="msinput form-control montant-display" 
                                                                   id="montant_display{{$i}}"
                                                                   readonly 
                                                                   style="font-weight:bold;"
                                                                   value="{{ number_format($list->montant_cmd, 0, '', ' ') }} GNF">
                                                            <input type="hidden" name="montant_cmd" class="montant-hidden" id="montant_hidden{{$i}}" value="{{ $list->montant_cmd }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                                <button type="submit" class="btn labo-btn-primary">
                                                    <i class="fa fa-save"></i> Enregistrer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <th scope="row"></th>
                            <td><strong class="text-warning">Vide</strong></td>
                        @endforelse
                            <tr style="background-color:white;color:black">
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th><strong>TOTAL</strong></th>
                                  <th><strong>{{ number_format($somme, 0, '', ' ') }} GNF</strong></th>
                                  <th></th>
                              </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

<!-- ✅ HISTORIQUE DES RÈGLEMENTS -->
<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px">
                    <i class="fa fa-history"></i> Historique des Règlements
                    
                    @php
                        $reste = $bon[0]->montant_bon_cmd - $bon[0]->montant_paye;
                    @endphp
                    
                    @if($reste > 0)
                        <div class="pull-right">
                            <a href="" data-toggle="modal" data-target="#modal_nouveau_reglement" 
                               style="font-size:10px;" 
                               class="btn btn-rounded btn-sm btn-success">
                                <i class="fa fa-plus"></i> Nouveau Règlement
                            </a>
                        </div>
                    @endif
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color:white; color:black;">
                                <th style="font-size:11px;">Date</th>
                                <th style="font-size:11px;">Montant Payé</th>
                                <th style="font-size:11px;">Mode de Paiement</th>
                                <th style="font-size:11px;">Enregistré par</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $total_reglements = 0;
                            @endphp
                            
                            @forelse($historique_reglements as $reglement)
                                @php 
                                    $total_reglements += $reglement->montant_paye;
                                @endphp
                                <tr>
                                    <td style="font-size:11px;">
                                        <strong>{{ \Carbon\Carbon::parse($reglement->date_reglement)->format('d/m/Y') }}</strong>
                                    </td>
                                    <td style="font-size:11px;">
                                        <strong style="color:#2A9666;">
                                            {{ number_format($reglement->montant_paye, 0, '', ' ') }} GNF
                                        </strong>
                                    </td>
                                    <td style="font-size:11px;">
                                        <span class="badge 
                                            @if($reglement->mode_pay == 'Espèces') badge-success
                                            @elseif($reglement->mode_pay == 'Chèque') badge-info
                                            @elseif($reglement->mode_pay == 'Virement') badge-primary
                                            @else badge-secondary
                                            @endif">
                                            {{ $reglement->mode_pay }}
                                        </span>
                                    </td>
                                    <td style="font-size:11px;">
                                        {{ $reglement->nom_user ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <em class="text-muted">Aucun règlement enregistré</em>
                                    </td>
                                </tr>
                            @endforelse
                            
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouveau Règlement -->
<!-- [Le modal ci-dessus] -->

<!-- Modal Nouveau Règlement -->
<div id="modal_nouveau_reglement" class="modal fade" role="dialog" style="padding-top:50px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-body" style="background-color: white;">
            <div class="modal-header" style="background-color:green;">
                <div class="card-title mslabel mstitle" style="color:white; font-size:16px">
                    Enregistrer un Règlement
                </div>
            </div>
            <form method="POST" action="{{route('bon_commande.reglement', [$bon[0]->num_bon_cmd])}}">
                @csrf
                @php
                    $reste = $bon[0]->montant_bon_cmd - $bon[0]->montant_paye;
                @endphp
                <input type="hidden" class="reste-a-payer-value" value="{{ $reste }}">
                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                
                <div class="modal-body">
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input-1" class="mslabel">N° Bon:</label>
                                <input type="text" class="msinput form-control" readonly value="{{ $bon[0]->num_bon_cmd }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1" class="mslabel">Date Règlement :</label>
                                <input type="date" class="msinput form-control" value="{{date('Y-m-d')}}" name="date_reglement" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1" class="mslabel">Montant Total du Bon:</label>
                                <input type="text" class="msinput form-control" value="{{ number_format($bon[0]->montant_bon_cmd, 0, '', ' ') }} GNF" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1" class="mslabel">Déjà Payé:</label>
                                <input type="text" class="msinput form-control" style="background-color:#2A9666; color:white; font-weight:bold;" value="{{ number_format($bon[0]->montant_paye, 0, '', ' ') }} GNF" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-1" class="mslabel">Reste à Payer:</label>
                                <input type="text" class="msinput form-control" style="background-color:#E62F0E; color:white; font-weight:bold;" value="{{ number_format($reste, 0, '', ' ') }} GNF" readonly>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input-1" class="mslabel"><strong>*Montant à Régler:</strong></label>
                                <input type="text" class="msinput form-control montant-reglement" 
                                       style="font-size:1.2rem; font-weight:bold;" 
                                       placeholder="0 GNF" 
                                       required>
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
  </div>



 
@endsection