
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black">
                <th>Article</th>
                <th>Prix de Vente</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody >
            @forelse($produits as $i => $list)
                <tr>
                    <td style="font-size:11px;">{{ $list->nom_prod }}</td>
                    <td style="font-size:11px;"><strong>{{ number_format($list->prix_prod, 0, '', ' ') }} GNF</strong></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modal_vente{{$i}}"  style="font-size:8px;" class="btn btn-rounded btn-sm btn-success"><i class="fa fa-plus"></i> </a>  
                    </td>
                </tr>
            @empty
                <th scope="row"></th>
                <td><strong class="text-danger">Aucun Résultat</strong></td>
            @endforelse
        </tbody>
    </table>
</div>

@foreach($produits as $i => $list)
        <div id="modal_vente{{$i}}" class="modal fade" role="dialog" style="padding-top:50px">
                          <div class="modal-dialog modal-lg">
                                  <div class="modal-content card-body" style="background-color: white;">
                                      <div class="modal-header">
                                          <div class="card-title mslabel mstitle">Ajouter au Bon de Commande</div>
                                      </div>
                                      <form method="POST" action="{{route('bon_commande.store')}}">
                                            @csrf
                                      <div class="modal-body">
                                        <div class="row">
                                              <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Article :</label>
                                                              <input type="text" class="msinput form-control" readonly autocomplete="off" value="{{ $list->nom_prod }}" name="nom_prod">
                                                              <input type="hidden" value="{{ $list->code_prod }}" name="code_prod">
                                                              <input type="hidden" value="{{$num}}" name="num_bon_cmd">
                                                         </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Prix de Vente :</label>
                                                              <input type="number" class="msinput form-control prixUnitaire"  name="pu_vente" required autocomplete="off" placeholder="valeur" value="{{ $list->prix_prod }}">
                                                         </div>
                                                    </div>


                                                    <div class="col-lg-6">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Prix d'Achat :</label>
                                                              <input type="number" class="msinput form-control prixUnitaire"  name="prix_achat" required autocomplete="off" placeholder="valeur">
                                                         </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                         <div class="form-group">
                                                              <label for="input-1" class="mslabel">Quantité à Approvisionner :</label>
                                                              <input type="number" class="msinput form-control prixUnitaire"  name="qt_cmd" required autocomplete="off">
                                                         </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Magasin :</label>
                                                            <select class="msinput form-control" autocomplete="off" required name="id_mag">
                                                              <option></option>
                                                              @foreach($magasins as $mg => $mag)
                                                                <option value="{{$mag->id_mag}}">{{ $mag->nom_mag}}</option>
                                                              @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                
                                       
                                              </div>

                                      </div>
                                  </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                          <button type="submit" class="btn labo-btn-primary btnsubmit"><i class="icon-bag"></i> Enregistrer</button>
                                      </div>
                                      </form>
                                  </div>
                          </div>
                        </div>
@endforeach

