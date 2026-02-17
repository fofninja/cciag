
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black;">
                <th style="font-size:10px;">N°</th>
                <th style="font-size:10px;">Article</th>
                <th style="font-size:10px;">Prix Unitaire</th>
                <th style="font-size:10px;">Action</th>
            </tr>
        </thead>
        
        <tbody >
            @forelse($produits as $i => $list)
                <tr>
                    <td style="font-size:10px;">{{$i+1}}</td>
                    <td style="font-size:10px;">{{ $list->nom_prod }}</td>
                    <td style="font-size:10px;"><strong>{{ number_format($list->prix_prod, 0, '', ' ') }} GNF</strong></td>
                    <td style="font-size:10px;">
                        <a href="{{ route('magasin.produits.details', [$list->id_prod]) }}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-light"><i class="fa fa-user"></i> Détails</a>
                        &nbsp;
                        <a href="" data-toggle="modal" data-target="#modal_edit{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-info">
                           <i class="fa fa-pencil"></i>
                        </a>  
                        &nbsp;
                        <form method="POST" action="{{ route('produit.delete', [$list->code_prod]) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                <i class="fa fa-trash"></i> 
                            </button>
                        </form>
                        &nbsp;
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
<!-- Modal édition -->
<div id="modal_edit{{$i}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-body" style="background-color: white;">
            <div class="modal-header">
                <div class="card-title mslabel mstitle">Modifier le Produit</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{route('produit.edit',[$list->id_prod])}}" id="editformart{{$i}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Nom du Produit -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Nom du Produit *</label>
                                <input type="text" class="msinput form-control" name="nom_prod" required value="{{ $list->nom_prod }}">
                            </div>
                        </div>

                        <!-- Code Produit -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Code Produit *</label>
                                @if(Auth::user()->id=='2')
                                    <input type="text" class="msinput form-control" name="code_prod" required value="{{ $list->code_prod }}">
                                @else
                                    <input type="text" class="msinput form-control" name="code_prod" required readonly value="{{ $list->code_prod }}">
                                @endif
                            </div>
                        </div>

                        <!-- Prix Unitaire -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Prix Unitaire (GNF) *</label>
                                @if(Auth::user()->id=='2')
                                    <input type="text" class="msinput form-control montant-format" id="prix_edit{{$i}}" data-target="prix_edit_hidden{{$i}}" required value="{{ number_format($list->prix_prod, 0, '', ' ') }}">
                                    <input type="hidden" name="prix_prod" id="prix_edit_hidden{{$i}}" value="{{ $list->prix_prod }}">
                                @else
                                    <input type="text" class="msinput form-control" value="{{ number_format($list->prix_prod, 0, '', ' ') }}">
                                    <input type="hidden" name="prix_prod" value="{{ $list->prix_prod }}">
                                @endif
                            </div>
                        </div>

                        <!-- Catégorie -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Catégorie *</label>
                                <select class="msinput form-control" name="id_categ" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id_categ }}" {{ $list->id_categ == $cat->id_categ ? 'selected' : '' }}>
                                            {{ $cat->nom_categ }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Conditionnement -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Conditionnement *</label>
                                <input type="text" class="msinput form-control" name="conditionnement" required value="{{ $list->conditionnement }}" placeholder="Ex: Carton, Boîte, Unité...">
                            </div>
                        </div>

                        <!-- Quantité par Groupe -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Quantité par Groupe *</label>
                                <input type="number" class="msinput form-control" name="qt_par_group" required value="{{ $list->qt_par_group }}" min="1">
                                <small class="text-muted">Nombre d'unités par conditionnement</small>
                            </div>
                        </div>

                        <!-- Seuil d'Alerte -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Seuil d'Alerte *</label>
                                <input type="number" class="msinput form-control" name="seuil" required value="{{ $list->seuil }}" min="0">
                                <small class="text-muted">Stock minimum avant alerte</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn labo-btn-red" data-dismiss="modal" style="border-color: black;">
                        <i class="fa fa-times"></i> Fermer
                    </button>
                    <button type="submit" class="btn labo-btn-primary">
                        <i class="fa fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach