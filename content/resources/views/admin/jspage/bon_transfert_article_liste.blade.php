<div class="table-responsive">
    <table class="table">
        <thead>
            <tr style="background-color:white;color:black">
                <th>Article</th>
                <th>Stock Disponible</th>
                <th>Prix</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $i => $prod)
                <tr>
                    <td style="font-size:11px;">{{ $prod->nom_prod }}</td>
                    <td style="font-size:11px;"><strong class="text-success">{{ $prod->qt_prod }} unités</strong></td>
                    <td style="font-size:11px;">{{ number_format($prod->prix_prod, 0, '', ' ') }} GNF</td>
                    <td style="font-size:11px;">
                        <a href="" data-toggle="modal" data-target="#modal_add{{$i}}" style="font-size:8px;" class="btn btn-rounded btn-sm btn-success">
                            <i class="fa fa-plus"></i> Ajouter
                        </a>
                    </td>
                </tr>

                
            @empty
                <tr>
                    <td colspan="4"><strong class="text-warning">Aucun article disponible dans ce magasin</strong></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@foreach($produits as $i => $prod)
<!-- Modal Ajout Article -->
                <div id="modal_add{{$i}}" class="modal fade" role="dialog" style="padding-top:50px;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content card-body" style="background-color: white;">
                            <div class="modal-header" style="background-color:#28a745;">
                                <div class="card-title mslabel mstitle" style="color:white;">
                                    Ajouter au Transfert
                                </div>
                            </div>
                            <form method="POST" action="{{route('bon_transfert.store')}}">
                                @csrf
                                <input type="hidden" value="{{$num}}" name="num_bon_transfert">
                                <input type="hidden" value="{{$prod->code_prod}}" name="code_prod">
                                <input type="hidden" value="{{$id_mag_source}}" name="id_mag_source">
                                <!-- ✅ PRIX EN HIDDEN (pas required) -->
                                <input type="hidden" name="prix_unitaire" value="{{ $prod->prix_prod }}">
                                
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mslabel">Article :</label>
                                                <input type="text" class="msinput form-control" value="{{ $prod->nom_prod }}" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mslabel">Stock Disponible :</label>
                                                <input type="text" class="msinput form-control" value="{{ $prod->qt_prod }} unités" readonly style="background-color:#006119;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mslabel">Quantité à Transférer <span class="text-danger">*</span></label>
                                                <input type="number" class="msinput form-control" name="qt_transfert" min="1" max="{{ $prod->qt_prod }}" required autocomplete="off">
                                                <small class="text-muted">Max : {{ $prod->qt_prod }} unités</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div style="padding: 8px 0;">
                                                <label class="mslabel">Magasin de destination</label>
                                                <select class="form-control msinput" name="id_mag_destination" style="font-size: 12px;">
                                                    <option></option>
                                                    @foreach($magasins as $mag)
                                                        <option value="{{ $mag->id_mag }}">{{ $mag->nom_mag }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn labo-btn-red" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn labo-btn-primary">
                                        <i class="fa fa-check"></i> Ajouter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endforeach