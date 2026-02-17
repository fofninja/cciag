@extends('layouts.layout')
@section('content')

    {{-- ============ HERO BANNER ============ --}}
    <section>
        <div class="breadcrumb-area_propos section-divide">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text text-center">
                            <h1>LA CCIAG</h1>
                            <p class="breadcrumb-subtitle">Chambre de Commerce, d'Industrie et d'Artisanat de Guinée</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ À PROPOS - MISSION ============ --}}
    <section class="propos-mission-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="propos-mission-badge about-cop">
                        <div class="mission-icon-wrapper">
                            <i class="fi flaticon-businessman"></i>
                        </div>
                        <h3>Notre Mission</h3>
                        <p>Promouvoir les échanges, la production industrielle et artisanale au service du développement économique de la Guinée.</p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="propos-mission-text about-cop">
                        <span class="propos-section-label">À PROPOS</span>
                        <h2>Qui sommes-nous ?</h2>
                        <p>La Chambre de Commerce, d'Industrie et d'Artisanat de Guinée est un Établissement public à caractère Professionnel doté de la personnalité morale de l'autonomie financière et de gestion. Elle est placée sous la Tutelle du Ministère en charge du Commerce, de l'Industrie et des Petites et Moyennes Entreprises.</p>
                        <p>Son siège est à Conakry et sa compétence s'exerce sur toute l'étendue du territoire national.</p>
                        <p>La CCIAG a pour mission de faire la promotion des échanges, de la production industrielle et artisanale, des services ainsi que l'amélioration des relations de coopération avec les autres acteurs. Elle assure la liaison et la concertation entre les milieux économiques guinéens et les pouvoirs publics auprès desquels elle doit jouer le rôle de conseil et d'auxiliaire du développement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CHIFFRES CLÉS ============ --}}
    <section class="propos-stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="propos-stat-card about-cop">
                        <div class="stat-number">19</div>
                        <div class="stat-label">Commissions Techniques</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="propos-stat-card about-cop">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Régions Consulaires</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="propos-stat-card about-cop">
                        <div class="stat-number">19</div>
                        <div class="stat-label">Membres du Bureau</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="propos-stat-card about-cop">
                        <div class="stat-number">4</div>
                        <div class="stat-label">Organes Principaux</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ TITRE SECTION ORGANES ============ --}}
    <section class="propos-organes-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="propos-section-label">ORGANISATION</span>
                    <h2 class="propos-organes-title">Les Organes de la CCIAG</h2>
                    <p class="propos-organes-subtitle">La CCIAG est structurée en quatre organes complémentaires assurant son bon fonctionnement.</p>
                </div>
            </div>

            {{-- ============ ORGANE 1 : ASSEMBLÉE GÉNÉRALE ============ --}}
            <div class="propos-organe-card about-cop" id="promotion">
                <div class="row align-items-start">
                    <div class="col-lg-4 col-md-12">
                        <div class="organe-header">
                            <div class="organe-icon">
                                <i class="fi flaticon-businessman"></i>
                            </div>
                            <div class="organe-number">01</div>
                            <h3>L'Assemblée Générale</h3>
                            <p class="organe-role">Instance suprême et délibérante</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="organe-content">
                            <p>L'Assemblée Générale est l'instance suprême et délibérante de la CCIAG. À ce titre, elle est chargée :</p>
                            <ul>
                                <li><i class="fa fa-check-circle"></i> De statuer sur toutes les questions qui relèvent des attributions de la CCIAG</li>
                                <li><i class="fa fa-check-circle"></i> D'élire le Président de la Chambre et les autres membres du Bureau Consulaire National ainsi que les membres des Commissions Techniques</li>
                                <li><i class="fa fa-check-circle"></i> D'approuver le programme général de la CCIAG, d'adopter le plan d'actions proposé par le Président et de donner les directives du Bureau Consulaire National</li>
                                <li><i class="fa fa-check-circle"></i> De voter le budget soumis par le Bureau Consulaire National</li>
                                <li><i class="fa fa-check-circle"></i> De statuer sur l'augmentation et l'utilisation des fonds de réserves</li>
                                <li><i class="fa fa-check-circle"></i> De statuer sur les propositions de modification des statuts de la CCIAG</li>
                                <li><i class="fa fa-check-circle"></i> De nommer et de révoquer les Commissaires aux comptes</li>
                                <li><i class="fa fa-check-circle"></i> De créer des fonds spéciaux de réserves, de décider des prélèvements à y effectuer et de l'affectation des ressources nettes de l'exercice</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ ORGANE 2 : BUREAU CONSULAIRE ============ --}}
            <div class="propos-organe-card about-cop" id="etude">
                <div class="row align-items-start">
                    <div class="col-lg-4 col-md-12">
                        <div class="organe-header">
                            <div class="organe-icon">
                                <i class="fi flaticon-salary"></i>
                            </div>
                            <div class="organe-number">02</div>
                            <h3>Le Bureau Consulaire National</h3>
                            <p class="organe-role">Organe exécutif de la CCIAG</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="organe-content">
                            <p>Le Bureau Consulaire National est l'organe exécutif de la Chambre de Commerce d'Industrie et d'Artisanat de Guinée. Il est composé de dix-neuf (19) membres :</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i> Un Président</li>
                                        <li><i class="fa fa-check-circle"></i> Un Premier Vice-Président</li>
                                        <li><i class="fa fa-check-circle"></i> Un 2<sup>e</sup> Vice-Président chargé du commerce</li>
                                        <li><i class="fa fa-check-circle"></i> Un 3<sup>e</sup> Vice-Président chargé de l'industrie</li>
                                        <li><i class="fa fa-check-circle"></i> Un 4<sup>e</sup> Vice-Président chargé de l'artisanat, du tourisme et de l'hôtellerie</li>
                                        <li><i class="fa fa-check-circle"></i> Un 5<sup>e</sup> Vice-Président chargé des services</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i> Un 6<sup>e</sup> Vice-Président chargé des BTP</li>
                                        <li><i class="fa fa-check-circle"></i> Huit Présidents des Assemblées Consulaires Régionales</li>
                                        <li><i class="fa fa-check-circle"></i> Un Trésorier Principal</li>
                                        <li><i class="fa fa-check-circle"></i> Un Trésorier Adjoint</li>
                                        <li><i class="fa fa-check-circle"></i> Deux Secrétaires</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ ORGANE 3 : COMMISSIONS TECHNIQUES ============ --}}
            <div class="propos-organe-card about-cop" id="carte">
                <div class="row align-items-start">
                    <div class="col-lg-4 col-md-12">
                        <div class="organe-header">
                            <div class="organe-icon">
                                <i class="fi flaticon-up-arrow"></i>
                            </div>
                            <div class="organe-number">03</div>
                            <h3>Les Commissions Techniques</h3>
                            <p class="organe-role">19 commissions spécialisées</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="organe-content">
                            <p>La CCIAG compte au total 19 commissions techniques couvrant l'ensemble des secteurs économiques :</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i> Commission Finances et Budget</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Relations Internationales et Partenariats</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Consultative des Marchés</li>
                                        <li><i class="fa fa-check-circle"></i> Commission des Services</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Artisanat et Tourisme</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Financement, Promotion, Investissement et Compétitivité</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Commerce</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Fiscalité</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Enseignement, Formation et Perfectionnement</li>
                                        <li><i class="fa fa-check-circle"></i> Commission NTIC</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i> Commission HSE et Développement Durable</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Promotion du Genre et de l'Entrepreneuriat Féminin</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Transformation du Secteur Informel et Modernisation des Marchés</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Audit, Éthique et Gouvernance</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Intégration Régionale</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Industrie</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Énergie</li>
                                        <li><i class="fa fa-check-circle"></i> Commission BTP et Promotion Immobilière</li>
                                        <li><i class="fa fa-check-circle"></i> Commission Transport et Logistique</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ ORGANE 4 : SECRÉTARIAT GÉNÉRAL ============ --}}
            <div class="propos-organe-card about-cop" id="dialogue">
                <div class="row align-items-start">
                    <div class="col-lg-4 col-md-12">
                        <div class="organe-header">
                            <div class="organe-icon">
                                <i class="fi flaticon-up-arrow"></i>
                            </div>
                            <div class="organe-number">04</div>
                            <h3>Le Secrétariat Général</h3>
                            <p class="organe-role">Organe administratif</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="organe-content">
                            <p>Le Secrétariat Général est l'organe administratif de la Chambre de Commerce d'Industrie et d'Artisanat de Guinée. Il est composé d'un personnel placé sous l'autorité d'un Secrétaire Général.</p>
                            <p>Le Secrétariat Général coordonne, anime et dirige les divers travaux administratifs et techniques de la CCIAG. Il exécute les décisions du Bureau Consulaire National et de l'Assemblée Générale sur les directives et orientations du Président de la Chambre.</p>
                            <p>Il assure le Secrétariat des réunions du Bureau Consulaire National et des sessions de l'Assemblée Générale.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
