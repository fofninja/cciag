@extends('layouts.layout')
@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
   $(document).ready(function () {
    var limit=25;
    var numBon = "0";
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
        limit+=10;
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
});
</script>
</script>
<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    BON DE COMMANDE
                </div>
            </div>
        </div>
    </div>
 </div>

 



<!-- Cadeau -->
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
                <div class="pull-right">

                     <form method="POST" action="{{ route('bon_commande.cancel', ['0']) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-rounded btn-sm btn-danger pull-right" style="font-size:8px;" onclick="return confirm('Êtes-vous sûr de vouloir Annuler cette Commande ?');">
                                            Annuler
                                        </button>
                                    </form>
                    <a href="" data-toggle="modal" data-target="#modal_cadeau" style="font-size:8px; padding-left:10px; margin-right:5px;" class="btn btn-rounded btn-sm btn-success pull-right">
                        <i class="fa fa-check"></i> Valider
                    </a> 
                </div>
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
                        @forelse($liste_bon as $i => $list)
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
                                    <form method="POST" action="{{ route('bon_commande.delete', [$list->id_bon_cmd_line]) }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" value="{{ $list->num_bon_cmd }}" name="num_bon_cmd">
                                        <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </form>
                                </td> 
                            </tr>
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


    <div id="modal_cadeau" class="modal fade" role="dialog" style="padding-top:50px">>
                          <div class="modal-dialog modal-lg">
                                  <div class="modal-content card-body" style="background-color: white;">
                                      <div class="modal-header" style="background-color:green;">
                                          <div class="card-title mslabel mstitle">Valider la Commande</div>
                                      </div>
                                      <form method="POST" action="{{route('bon_commande.valide')}}">
                                        @csrf
                                        <input type="hidden" value="BC{{ date('ymdhis').Str::random(5) }}" name="num_bon_cmd">
                                        <input type="hidden" value="{{$somme}}" id="somme" name="montant_bon_cmd">
                                      <div class="modal-body">
                                          <div class="row">
                                              <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Montant Commande :</label>
                                                              <input type="text" class="msinput form-control" value="{{ number_format($somme, 0, '', ' ') }} GNF">
                                                         </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Fournisseur :</label>
                                                            <select class="msinput form-control" autocomplete="off" required name="id_fournisseur">
                                                              <option></option>
                                                              @foreach($fournisseurs as $fr => $fourni)
                                                                <option value="{{$fourni->id_fournisseur }}">{{ $fourni->nom_fournisseur}} ({{ $fourni->type_fournisseur}})</option>
                                                              @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Montant payé:</label>
                                                            <input type="text" class="msinput form-control" 
                                                                   style="background-color:#2A9666" 
                                                                   name="montant_paye_display" 
                                                                   id="montant_paye" 
                                                                   placeholder="0 GNF" 
                                                                   required>
                                                            <input type="hidden" name="montant_paye" id="montant_paye_hidden">
                                                            <p class="text-danger" id="alertepay"></p>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Reste à Payer:</label>
                                                            <input type="text" class="msinput form-control" 
                                                                   id="reste_display" 
                                                                   style="background-color:#E62F0E" 
                                                                   readonly 
                                                                   value="0 GNF">
                                                            <input type="hidden" name="reste" id="reste_hidden" value="0">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Mode de Paiement :</label>
                                                            <select class="msinput form-control" autocomplete="off" required name="mode_paye">
                                                              <option></option>
                                                              <option value="Espèces">Espèces</option>
                                                              <option value="Chèque">Chèque</option>
                                                              <option value="Virement">Virement</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Date Commande :</label>
                                                              <input type="date" class="msinput form-control" value="{{date('Y-m-d')}}" name="date_bon_cmd" required>
                                                         </div>
                                                    </div>
                                                    <div class="col-lg-12">&nbps;</div>

                                              </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                          <button type="submit" class="btn labo-btn-primary" id="btnsubmit"><i class="icon-bag"></i> Enregistrer</button>
                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>


        
    

  </div>



 
@endsection