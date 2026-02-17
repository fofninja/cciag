<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead style="background-color:#f8f9fa; color:black;">
            <tr>
                <th style="font-size:11px;">Photo</th>
                <th style="font-size:11px;">Nom</th>
                <th style="font-size:11px;">Email</th>
                <th style="font-size:11px;">Privilège</th>
                <th style="font-size:11px;">Magasin</th>
                <th style="font-size:11px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($utilisateurs as $i => $user)
                <tr>
                    <td style="font-size:11px;">
                            <img src="{{ asset('assets/images/vide.png') }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    </td>
                    <td style="font-size:11px;"><strong>{{ $user->nom_usr }}</strong></td>
                    <td style="font-size:11px;">{{ $user->email }}</td>
                    <td style="font-size:11px;">
                        @if($user->privilege_usr == 'vente')
                            <span class="badge badge-success">Vente</span>
                        @elseif($user->privilege_usr == 'admin')
                            <span class="badge badge-primary">Admin</span>
                        @else
                            <span class="badge badge-danger">Directeur</span>
                        @endif
                    </td>
                    <td style="font-size:11px;">{{ $user->nom_mag }}</td>
                    <td style="font-size:11px;">
                        <!-- Modifier -->
                        <a href="#" data-toggle="modal" data-target="#modal_edit{{ $i }}" class="btn btn-rounded btn-sm btn-primary" style="font-size:8px;">
                            <i class="fa fa-pencil"></i> Modifier
                        </a>
                        
                        <!-- Réinitialiser Password -->
                        <a href="#" data-toggle="modal" data-target="#modal_reset{{ $i }}" class="btn btn-rounded btn-sm btn-warning" style="font-size:8px;">
                            <i class="fa fa-key"></i> Mot de passe
                        </a>
                        
                        <!-- Supprimer -->
                        @if($user->id != Auth::user()->id)
                            <form method="POST" action="{{ route('utilisateurs.delete', [$user->id]) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-rounded btn-sm btn-danger" style="font-size:8px;" onclick="return confirm('Supprimer cet utilisateur ?');">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                
                <!-- Modal Modifier -->
                <div id="modal_edit{{ $i }}" class="modal fade" role="dialog" style="padding-top:50px;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content card-body" style="background-color: white;">
                            <div class="modal-header" style="background-color:#007bff;">
                                <div class="card-title mslabel mstitle" style="color:white;">
                                    <i class="fa fa-pencil"></i> Modifier Utilisateur
                                </div>
                            </div>
                            <form method="POST" action="{{ route('utilisateurs.update', [$user->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Nom Complet <span class="text-danger">*</span></label>
                                                <input type="text" class="msinput form-control" name="nom_usr" value="{{ $user->nom_usr }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="msinput form-control" name="email" value="{{ $user->email }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Privilège <span class="text-danger">*</span></label>
                                                <select class="msinput form-control" name="privilege_usr" required>
                                                    <option value="vente" {{ $user->privilege_usr == 'vente' ? 'selected' : '' }}>Vente</option>
                                                    <option value="admin" {{ $user->privilege_usr == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="directeur" {{ $user->privilege_usr == 'directeur' ? 'selected' : '' }}>Directeur</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Magasin <span class="text-danger">*</span></label>
                                                <select class="msinput form-control" name="id_mag" required>
                                                    @php
                                                        $magasins = DB::select("SELECT * FROM magasin ORDER BY nom_mag");
                                                    @endphp
                                                    @foreach($magasins as $mag)
                                                        <option value="{{ $mag->id_mag }}" {{ $user->id_mag == $mag->id_mag ? 'selected' : '' }}>
                                                            {{ $mag->nom_mag }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Photo Actuelle</label><br>
                                                @if($user->img_usr && file_exists(public_path('uploads/users/' . $user->img_usr)))
                                                    <img src="{{ asset('uploads/users/' . $user->img_usr) }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('uploads/users/default.png') }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mslabel">Nouvelle Photo (optionnel)</label>
                                                <input type="file" class="form-control" name="img_usr" accept="image/*">
                                                <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn labo-btn-red" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn labo-btn-primary">
                                        <i class="fa fa-check"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Réinitialiser Password -->
                <div id="modal_reset{{ $i }}" class="modal fade" role="dialog" style="padding-top:50px;">
                    <div class="modal-dialog">
                        <div class="modal-content card-body" style="background-color: white;">
                            <div class="modal-header" style="background-color:#ffc107;">
                                <div class="card-title mslabel mstitle" style="color:white;">
                                    <i class="fa fa-key"></i> Réinitialiser Mot de Passe
                                </div>
                            </div>
                            <form method="POST" action="{{ route('utilisateurs.reset-password', [$user->id]) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="alert alert-warning" style="font-size:12px;">
                                        <strong>Utilisateur :</strong> {{ $user->nom_usr }}<br>
                                        <strong>Email :</strong> {{ $user->email }}
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="mslabel">Nouveau Mot de Passe <span class="text-danger">*</span></label>
                                        <input type="password" class="msinput form-control" name="new_password" required autocomplete="off" placeholder="Minimum 6 caractères">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn labo-btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn labo-btn-warning">
                                        <i class="fa fa-key"></i> Réinitialiser
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="6" class="text-center"><strong class="text-warning">Aucun utilisateur</strong></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>