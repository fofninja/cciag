@php $privilege=auth()->user()->privilege_usr;$mag=auth()->user()->id_mag @endphp
<ul style="display: flex; flex-wrap: nowrap; margin: 0; padding: 0; list-style: none;">
    <li>
        <a href="{{route('magasin.dashboard')}}">
            <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>


    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-shopping-cart"></i> <span>Ventes</span>
            <i class="fa fa-caret-down dropdown-indicator"></i>
        </a>
        <ul class="dropdown-submenu">
            <li>
                <a href="{{route('magasin.ventes',[$mag])}}">Nouvelle Vente</a>
            </li>
            <li>
                <a href="{{route('magasin.vente_liste')}}">Liste des ventes</a>
            </li>
        </ul>
    </li>


    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-list"></i> <span>Gestion des Article</span>
            <i class="fa fa-caret-down dropdown-indicator"></i>
        </a>
        <ul class="dropdown-submenu">
            @if(in_array($privilege, ['directeur', 'admin']))
            <li>
                <a href="{{route('stock.global')}}">Stock Global</a>
            </li>
            @endif
            <li>
                <a href="{{route('stock.mon_stock')}}">Mon Stock</a>
            </li>
            <li>
                <a href="{{route('magasin.produits')}}">Configuration des Articles</a>
            </li>
            @if(in_array($privilege, ['directeur', 'admin']))
                <li>
                    <a href="{{route('bon_commande')}}">Nouveau Bon de Commande</a>
                </li>
                <li>
                    <a href="{{route('bon_commande.liste')}}">Liste Bon de Commande</a>
                </li>
            @endif
            <li>
                <a href="{{route('bon_transfert')}}">Transfert de Stock</a>
            </li>
            <li>
                <a href="{{route('bon_transfert.liste')}}">Liste des Transfert</a>
            </li>
            <li>
                <a href="{{route('inventaire.create')}}">Nouvel Inventaire</a>
            </li>
            <li>
                <a href="{{route('inventaire.liste')}}">Liste des Inventaires</a>
            </li>
            <li>
                <a href="{{route('eclatement.create')}}">Eclatement</a>
            </li>
        </ul>
    </li>


    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-cog"></i> <span>Configuration</span>
            <i class="fa fa-caret-down dropdown-indicator"></i>
        </a>
        <ul class="dropdown-submenu">
            <li>
                <a href="{{route('config.magasins')}}">Magasin</a>
            </li>
            <li>
                <a href="{{route('config.categories')}}">Catégorie d'article</a>
            </li>
            <li>
                <a href="{{route('magasin.type_depense')}}">Type de Dépenses</a>
            </li>
            <li>
                <a href="{{route('config.fournisseurs')}}">Fournisseurs</a>
            </li>
            <li>
                <a href="{{route('clients.index')}}">Clients</a>
            </li>
            <li>
                <a href="{{route('magasin.transitaire')}}">Transitaire</a>
            </li>
            <li>
                <a href="{{route('utilisateurs.index')}}">Utilisateurs</a>
            </li>
        </ul>
    </li>
    

    @if(in_array($privilege, ['directeur', 'admin']))
        <li>
            <a href="javascript:void(0);">
                <i class="fa fa-money"></i> <span>Depenses</span>
                <i class="fa fa-caret-down dropdown-indicator"></i>
            </a>
            <ul class="dropdown-submenu">
                <li>
                    <a href="{{route('depenses.validation.liste')}}">Dépenses Standard</a>
                </li>
                <li>
                    <a href="{{route('magasin.depense_tr')}}">Dépenses Transitaires</a>
                </li>
                <li>
                    <a href="{{route('depenses.rapport_par_type')}}">Rapport Dépense</a>
                </li>
            </ul>
        </li>
    @else
    <li>
        <a href="{{route('depenses.index')}}">
            <i class="fa fa-money"></i> <span>Depenses</span>
        </a>
    </li>
    @endif


    <li>
        <a href="{{route('cloture.index',[date('Y-m-d'),$mag])}}">
            <i class="fa fa-users"></i> <span>Cloture</span>
        </a>
    </li>

    @if(in_array($privilege, ['directeur', 'admin']))
        <li>
            <a href="javascript:void(0);">
                <i class="fa fa-cog"></i> <span>Transfert de Fond</span>
                <i class="fa fa-caret-down dropdown-indicator"></i>
            </a>
            <ul class="dropdown-submenu">
                <li>
                    <a href="{{route('transferts.index')}}">Nouveau Transfert</a>
                </li>
                <li>
                    <a href="{{route('transferts.validation.liste')}}">Transfert En Attente</a>
                </li>
            </ul>
        </li>
    @else
    <li>
        <a href="{{route('transferts.index')}}">
            <i class="fa fa-users"></i> <span>Transfert de Fond</span>
        </a>
    </li>
    @endif

    
    @if(in_array($privilege, ['directeur', 'admin']))
    <li>
        <a href="{{route('comptes.dashboard')}}">
            <i class="fa fa-dollar"></i> <span>Finances</span>
        </a>
    </li>
    @endif


    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-bar-chart"></i> <span>Rapport</span>
            <i class="fa fa-caret-down dropdown-indicator"></i>
        </a>
        <ul class="dropdown-submenu">
            <li>
                <a href="{{route('magasin.rapport_jour',[date('Y-m-d')])}}">Journalier</a>
            </li>
            <li>
                <a href="{{route('magasin.rapport_mois',[date('Y-m')])}}">Mensuelle</a>
            </li>
            <li>
                <a href="{{route('magasin.rapport_year',[date('Y')])}}">Annuelle</a>
            </li>
        </ul>
    </li>      
</ul>