@extends('layouts.layout')
@section('content')

    {{-- ============ HERO BANNER ============ --}}
    <section>
        <div class="breadcrumb-area section-divide">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text text-center">
                            <h1>Nos Services</h1>
                            <p class="breadcrumb-subtitle">Accompagner, promouvoir et développer le secteur privé guinéen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ INTRODUCTION ============ --}}
    <section class="services-intro-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="services-intro-text about-cop">
                        <span class="propos-section-label">NOS SERVICES</span>
                        <h2>Ce que nous offrons</h2>
                        <p>La CCIAG est le point de contact privilégié pour les entrepreneurs souhaitant bénéficier de services complets en matière de formation, d’information, de conseil et d’orientation. Elle accompagne les entreprises dans leurs démarches administratives et stratégiques, facilite leur mise en relation avec des partenaires institutionnels et économiques, et les informe sur les réglementations en vigueur, les dispositifs d’aides financières ainsi que les opportunités de partenariat. Composée de professionnels expérimentés, la CCIAG assure un accompagnement structuré et adapté aux besoins des acteurs du secteur privé.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="services-intro-text about-cop">
                        <p>La CCIAG assure la représentativité des intérêts communs des opérateurs économiques de Guinée dans les domaines du Commerce, de l'Industrie, des métiers, des Bâtiments et Travaux Publics, des Services et de l'Artisanat dans le but d'instaurer le dialogue et la concertation entre ses membres, et de développer et d'améliorer la coopération économique et commerciale entre les opérateurs économiques établis en Guinée et leurs homologues établis à l'étranger.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 4 SERVICES EN GRILLE ============ --}}
    <section class="services-grid-section">
        <div class="container">

            {{-- SERVICE 1 --}}
            <div class="service-card about-cop" id="promotion">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-12">
                        <div class="service-card-icon-wrapper">
                            <div class="service-card-icon">
                                <i class="fi flaticon-businessman"></i>
                            </div>
                            <span class="service-card-number">01</span>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12">
                        <div class="service-card-body">
                            <h3>Promotion du secteur privé</h3>
                            <p>La Chambre de Commerce d'Industrie et d'Artisanat de Guinée œuvre activement à la promotion et au renforcement du secteur privé guinéen. Elle accompagne les entreprises à chaque étape de leur développement en favorisant un environnement économique dynamique, compétitif et attractif.</p>
                            <div class="service-card-tags">
                                <span class="service-tag"><i class="fa fa-check"></i> Sensibilisation</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Rencontres d'affaires</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Missions économiques</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Renforcement des capacités</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Manifestations Commerciales</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERVICE 2 --}}
            <div class="service-card about-cop" id="etude">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-12">
                        <div class="service-card-icon-wrapper">
                            <div class="service-card-icon">
                                <i class="fi flaticon-salary"></i>
                            </div>
                            <span class="service-card-number">02</span>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12">
                        <div class="service-card-body">
                            <h3>Études Économiques</h3>
                            <p>La Chambre réalise et met à disposition des études économiques stratégiques afin d'éclairer les décisions des opérateurs économiques et des pouvoirs publics. Nos travaux portent notamment sur l'analyse des secteurs porteurs, les tendances du marché national et international, l'environnement des affaires et les données statistiques économiques.</p>
                            <div class="service-card-tags">
                                <span class="service-tag"><i class="fa fa-check"></i> Analyse sectorielle</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Tendances du marché</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Données statistiques</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Annuaire des Entreprises</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Aide à la décision</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERVICE 3 --}}
            <div class="service-card about-cop" id="carte">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-12">
                        <div class="service-card-icon-wrapper">
                            <div class="service-card-icon">
                                <i class="fi flaticon-up-arrow"></i>
                            </div>
                            <span class="service-card-number">03</span>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12">
                        <div class="service-card-body">
                            <h3>Délivrance des cartes d'Adhésion</h3>
                            <p>La Chambre assure la délivrance des cartes d'adhésion aux entreprises, commerçants, industriels et artisans régulièrement établis en Guinée. La carte d'adhésion constitue un gage de reconnaissance et renforce la crédibilité de l'entreprise auprès des partenaires et institutions.</p>
                            <div class="service-card-tags">
                                <span class="service-tag"><i class="fa fa-check"></i> Réseau institutionnel</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Accompagnement</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Informations privilégiées</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Crédibilité renforcée</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERVICE 4 --}}
            <div class="service-card about-cop" id="dialogue">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-12">
                        <div class="service-card-icon-wrapper">
                            <div class="service-card-icon">
                                <i class="fi flaticon-up-arrow"></i>
                            </div>
                            <span class="service-card-number">04</span>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12">
                        <div class="service-card-body">
                            <h3>Favoriser le dialogue Public-Privé</h3>
                            <p>La Chambre joue un rôle central dans la facilitation du dialogue entre les acteurs du secteur privé et les autorités publiques. Elle agit comme interface institutionnelle afin de recueillir et porter les préoccupations des entreprises, contribuer à l'amélioration du climat des affaires et participer à l'élaboration des politiques économiques.</p>
                            <div class="service-card-tags">
                                <span class="service-tag"><i class="fa fa-check"></i> Interface institutionnelle</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Climat des affaires</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Politiques économiques</span>
                                <span class="service-tag"><i class="fa fa-check"></i> Cadre réglementaire</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ============ CALL TO ACTION ============ --}}
    <section class="services-cta-section">
        <div class="container">
            <div class="services-cta-box about-cop">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-7">
                        <h3>Besoin d'accompagnement ?</h3>
                        <p>Contactez-nous pour bénéficier de nos services et rejoindre le réseau des opérateurs économiques de Guinée.</p>
                    </div>
                    <div class="col-lg-4 col-md-5 text-md-right text-center">
                        <a href="{{ route('index') }}#contact" class="cta-btn">
                            <i class="fa fa-envelope"></i> Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
