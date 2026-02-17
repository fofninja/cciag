@extends('layouts.layout')
@section('content')

<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                    <i class="fa fa-users"></i> GESTION UTILISATEURS
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
        
        @if($message = Session::get('error'))
            <div id="success-alert" class="alert labo-label-alert-success labo-alert-danger">{{ $message }}</div>
        @endif
    </div>
    
    <!-- Statistiques
    <div class="col-lg-3 grid-margin">
        <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="card-body">
                <h6 style="color: white; font-size: 12px;">TOTAL UTILISATEURS</h6>
                <h2 style="color: white; font-weight: bold;">{{ $stats->total }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 grid-margin">
        <div class="card" style="background-color: #28a745; color: white;">
            <div class="card-body">
                <h6 style="color: white; font-size: 12px;">VENTE</h6>
                <h2 style="color: white; font-weight: bold;">{{ $stats->nb_vente }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 grid-margin">
        <div class="card" style="background-color: #007bff; color: white;">
            <div class="card-body">
                <h6 style="color: white; font-size: 12px;">ADMIN</h6>
                <h2 style="color: white; font-weight: bold;">{{ $stats->nb_admin }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 grid-margin">
        <div class="card" style="background-color: #dc3545; color: white;">
            <div class="card-body">
                <h6 style="color: white; font-size: 12px;">DIRECTEUR</h6>
                <h2 style="color: white; font-weight: bold;">{{ $stats->nb_directeur }}</h2>
            </div>
        </div>
    </div>  -->
    
    <!-- Répartition par Magasin 
    @if(count($stats_magasins) > 0)
        <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size: 12px; font-weight: bold;">
                        <i class="fa fa-building"></i> RÉPARTITION PAR MAGASIN
                    </h6>
                    <div class="row">
                        @foreach($stats_magasins as $stat)
                            <div class="col-lg-2 col-md-3 col-sm-4 mb-2">
                                <div class="card" style="background-color: #f8f9fa;">
                                    <div class="card-body" style="padding: 10px; text-align: center;">
                                        <strong style="font-size: 11px;">{{ $stat->nom_mag }}</strong><br>
                                        <span style="font-size: 18px; font-weight: bold; color: #007bff;">{{ $stat->nb_users }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif -->
    
    <!-- Filtres -->
    <div class="col-lg-12 mb-3" style="display:none">
        <div class="card">
            <div class="card-body">
                <h6 style="font-size: 12px; font-weight: bold;">
                    <i class="fa fa-filter"></i> FILTRES
                </h6>
                
                <div class="row">
                    <div class="col-lg-3">
                        <label class="mslabel">Privilège</label>
                        <select id="filtre_privilege" class="msinput form-control">
                            <option value="">Tous</option>
                            <option value="vente">Vente</option>
                            <option value="admin">Admin</option>
                            <option value="directeur">Directeur</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-3">
                        <label class="mslabel">Magasin</label>
                        <select id="filtre_magasin" class="msinput form-control">
                            <option value="">Tous</option>
                            @foreach($magasins as $mag)
                                <option value="{{ $mag->id_mag }}">{{ $mag->nom_mag }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-2" style="padding-top: 25px;">
                        <button id="btn_filtrer" class="btn btn-primary">
                            <i class="fa fa-search"></i> Filtrer
                        </button>
                        <button id="btn_reset" class="btn btn-secondary">
                            <i class="fa fa-undo"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bouton Nouveau -->
    <div class="col-lg-12 mb-3">
        <a href="#" data-toggle="modal" data-target="#modal_nouveau" class="btn btn-primary">
            <i class="fa fa-user-plus"></i> Nouvel Utilisateur
        </a>
    </div>
    
    <!-- Liste -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-size:14px;">
                    <i class="fa fa-list"></i> Liste des Utilisateurs
                </h5>
                
                <div id="liste"></div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Nouveau -->
<div id="modal_nouveau" class="modal fade" role="dialog" style="padding-top:50px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-body" style="background-color: white;">
            <div class="modal-header" style="background-color:#007bff;">
                <div class="card-title mslabel mstitle" style="color:white;">
                    <i class="fa fa-user-plus"></i> Nouvel Utilisateur
                </div>
            </div>
            <form method="POST" action="{{ route('utilisateurs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Nom Complet <span class="text-danger">*</span></label>
                                <input type="text" class="msinput form-control" name="nom_usr" required autocomplete="off" placeholder="Ex: Jean Dupont">
                                @error('nom_usr')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Email <span class="text-danger">*</span></label>
                                <input type="email" class="msinput form-control" name="email" required autocomplete="off" placeholder="Ex: jean@example.com">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Mot de Passe <span class="text-danger">*</span></label>
                                <input type="password" class="msinput form-control" name="password" required autocomplete="off" placeholder="Minimum 6 caractères">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Privilège <span class="text-danger">*</span></label>
                                <select class="msinput form-control" name="privilege_usr" required>
                                    <option value="">-- Choisir --</option>
                                    <option value="vente">Vente</option>
                                    <option value="admin">Admin</option>
                                    <option value="directeur">Directeur</option>
                                </select>
                                @error('privilege_usr')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Magasin <span class="text-danger">*</span></label>
                                <select class="msinput form-control" name="id_mag" required>
                                    <option value="">-- Choisir --</option>
                                    @foreach($magasins as $mag)
                                        <option value="{{ $mag->id_mag }}">{{ $mag->nom_mag }}</option>
                                    @endforeach
                                </select>
                                @error('id_mag')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mslabel">Photo (optionnel)</label>
                                <input type="file" class="form-control" name="img_usr" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                                @error('img_usr')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn labo-btn-red" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn labo-btn-primary">
                        <i class="fa fa-check"></i> Créer l'Utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
    var limit = 25;
    var baseUrl = "{{ url('/') }}";
    
    // Charger la liste
    function chargerListe() {
        var url = baseUrl + "/utilisateurs_load/" + limit;
        
        // Ajouter filtres
        var privilege = $("#filtre_privilege").val();
        var id_mag = $("#filtre_magasin").val();
        
        if (privilege !== '' || id_mag !== '') {
            url += "?";
            
            if (privilege !== '') {
                url += "privilege=" + privilege;
            }
            
            if (id_mag !== '') {
                if (privilege !== '') {
                    url += "&";
                }
                url += "id_mag=" + id_mag;
            }
        }
        
        $("#liste").load(url);
    }
    
    // Chargement initial
    chargerListe();
    
    // Bouton Filtrer
    $("#btn_filtrer").click(function() {
        chargerListe();
    });
    
    // Bouton Reset
    $("#btn_reset").click(function() {
        $("#filtre_privilege").val('');
        $("#filtre_magasin").val('');
        chargerListe();
    });
    
    // Bouton Afficher Plus
    $("#showmore").click(function() {
        limit += 10;
        chargerListe();
    });
});
</script>

@endsection