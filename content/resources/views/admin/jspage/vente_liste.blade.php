<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black">
                <th>Facture</th>
                <th>Montant</th>
                <th>Client</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody >
            @forelse($produits as $i => $list)
                <tr>
                    <td>{{ $list->nom_prod }}</td>
                    <td><strong>{{ number_format($list->prix_prod, 0, '', ' ') }} GNF</strong></td>
                    <td><strong>{{ $list->qt_prod }}</strong></td>
                    <td><strong>{{ $list->qt_prod }}</strong></td>
                    <td>
                        <a href="{{ route('magasin.produits.details', [$list->id_prod]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-eye"></i> Afficher</a>
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
                            <!-- Modal de production -->
                            <div id="modal_prod{{$i}}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-body" style="background-color: white;">
                                        <div class="modal-header">
                                            <div class="card-title mslabel mstitle">APPROVISIONNEMENT</div>
                                        </div>
                                        <form method="POST" id="apro{{$i}}" action="{{route('production.store',[$list->id_prod])}}">
                                            @csrf
                                            <input type="hidden" value="{{ $list->id_prod }}" name="id_prod">
                                            <div class="modal-body">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Date :</label>
                                                            <input type="date" class="msinput form-control"  name="date_prd" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Quantité Actuelle :</label>
                                                            <input type="number" class="msinput form-control" readonly required value="{{ $list->qt_prod }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Quantité à Ajouter :</label>
                                                            <input type="number" class="msinput form-control"  name="qt_prd" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">Fermer</button>
                                                <button type="submit" onclick='document.getElementById("apro{{$i}}").submit();' class="btn labo-btn-primary"><i class="icon-bag"></i> Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal édition -->
                            <div id="modal_edit{{$i}}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content card-body" style="background-color: white;">
                                        <div class="modal-header">
                                            <div class="card-title mslabel mstitle">Modifier</div>
                                        </div>
                                        <form method="POST" action="{{route('produit.edit',[$list->id_prod])}}" id="editformart{{$i}}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row col-lg-12">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Nom du Produit :</label>
                                                            <input type="text" class="msinput form-control" name="nom_prod" required value="{{ $list->nom_prod }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Quantité Actuelle :</label>
                                                            <input type="number" class="msinput form-control" name="qt_prod" readonly value="{{ $list->qt_prod }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="input-1" class="mslabel">Prix Unitaire :</label>
                                                            @if(Auth::user()->id=='2')
                                                                <input type="number" class="msinput form-control" name="prix_prod" required value="{{ $list->prix_prod }}">
                                                            @else
                                                                <input type="number" class="msinput form-control" name="prix_prod" required readonly value="{{ $list->prix_prod }}">
                                                            @endif
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
@endforeach