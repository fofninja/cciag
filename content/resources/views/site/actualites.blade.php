@extends('layouts.layout')
@section('content')

    {{-- ============ HERO BANNER ============ --}}
    <section>
        <div class="breadcrumb-area_actu section-divide">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text text-center">
                            <h1>Actualités</h1>
                            <p class="breadcrumb-subtitle">Suivez les dernières nouvelles de la CCIAG</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ ARTICLE À LA UNE ============ --}}
    <section class="actu-featured-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="propos-section-label">À LA UNE</span>
                </div>
            </div>
            <div class="actu-featured-card about-cop">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="actu-featured-img">
                            <img src="{{ asset('assets/img/blog/art2.jpg') }}" alt="Assemblée Générale Mixte 2025">
                            <div class="actu-featured-date">
                                <span class="day">20</span>
                                <span class="month">Fév 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="actu-featured-body">
                            <div class="actu-tag">Événement</div>
                            <a href="{{ route('article', 'assemblee-generale-mixte-2025') }}" style="text-decoration:none;color:inherit;"><h2>Clôture de l'Assemblée Générale Mixte 2025</h2></a>
                            <p>La cérémonie de clôture de l'Assemblée Générale Mixte 2025 de la Chambre de Commerce, d'Industrie et d'Artisanat de Guinée a marqué un tournant important dans la vie institutionnelle de la CCIAG. Cette rencontre a réuni l'ensemble des élus consulaires, les représentants des secteurs économiques et les partenaires institutionnels autour des enjeux majeurs du développement du secteur privé guinéen.</p>
                            <div class="actu-featured-meta">
                                <span><i class="fa fa-calendar"></i> 20 Février 2025</span>
                                <span><i class="fa fa-map-marker"></i> Conakry, Guinée</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ GRILLE D'ARTICLES ============ --}}
    <section class="actu-grid-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="propos-section-label" style="padding-left:0;">
                        <span style="display:none;">.</span>DERNIÈRES NOUVELLES
                    </span>
                    <h2 class="membre-section-title">Toutes nos actualités</h2>
                    <p class="membre-section-subtitle">Restez informé des activités, événements et initiatives de la CCIAG.</p>
                </div>
            </div>
            <div class="row">

                {{-- Article 1 --}}
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="actu-card about-cop">
                        <div class="actu-card-img">
                            <img src="{{ asset('assets/img/blog/art1.jpg') }}" alt="">
                            <div class="actu-card-date">
                                <span class="day">20</span>
                                <span class="month">Jan</span>
                            </div>
                            <div class="actu-card-tag">Institutionnel</div>
                        </div>
                        <div class="actu-card-body">
                            <h4>Message de Nouvel An du Président de la CCIAG</h4>
                            <p>À l'occasion de la nouvelle année 2026, j'ai l'honneur de vous adresser, au nom de l'ensemble des élus consulaires, mes vœux les plus chaleureux.</p>
                            <div class="actu-card-footer">
                                <span class="actu-author"><i class="fa fa-user"></i> CCIAG</span>
                                <a href="{{ route('article', 'message-nouvel-an-president') }}" class="actu-read-more">Lire plus <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Article 2 --}}
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="actu-card about-cop">
                        <div class="actu-card-img">
                            <img src="{{ asset('assets/img/blog/art3.jpg') }}" alt="">
                            <div class="actu-card-date">
                                <span class="day">28</span>
                                <span class="month">Oct</span>
                            </div>
                            <div class="actu-card-tag">International</div>
                        </div>
                        <div class="actu-card-body">
                            <h4>La CCIAG prend part aux Ateliers de la CPCCAF à Marseille</h4>
                            <p>Les Ateliers de la Coopération Consulaire de la CPCCAF se sont déroulés du 20 au 22 octobre 2025 au Palais de la Bourse de Marseille.</p>
                            <div class="actu-card-footer">
                                <span class="actu-author"><i class="fa fa-user"></i> CCIAG</span>
                                <a href="{{ route('article', 'ateliers-cpccaf-marseille') }}" class="actu-read-more">Lire plus <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

              

            </div>
        </div>
    </section>

    {{-- ============ NEWSLETTER CTA ============ --}}
    <section class="actu-newsletter-section">
        <div class="container">
            <div class="actu-newsletter-box about-cop">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="newsletter-text">
                            <h3><i class="fa fa-newspaper-o"></i> Restez informé</h3>
                            <p>Ne manquez aucune actualité de la CCIAG. Suivez-nous sur nos réseaux sociaux.</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="newsletter-social">
                            <a href="#" class="newsletter-social-btn facebook"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="#" class="newsletter-social-btn linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            <a href="#" class="newsletter-social-btn twitter"><i class="fa fa-twitter"></i> Twitter</a>
                            <a href="#" class="newsletter-social-btn youtube"><i class="fa fa-youtube-play"></i> YouTube</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
