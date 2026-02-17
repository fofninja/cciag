@extends('layouts.layout')
@section('content')

@php
    $articles = [
        'message-nouvel-an-president' => [
            'title' => 'Message de Nouvel An du Président de la CCIAG',
            'tag' => 'Institutionnel',
            'date' => '20 Janvier 2026',
            'day' => '20',
            'month' => 'Jan 2026',
            'location' => 'Conakry, Guinée',
            'image' => 'art1.jpg',
            'images' => ['art1.jpg', 'art2.jpg', 'art3.jpg'],
            'content' => [
                "À l'occasion de la nouvelle année 2026, j'ai l'honneur de vous adresser, au nom de l'ensemble des élus consulaires et du personnel de la Chambre de Commerce, d'Industrie et d'Artisanat de Guinée, mes vœux les plus chaleureux de santé, de prospérité et de réussite.",
                "L'année écoulée a été marquée par des avancées significatives dans le renforcement du secteur privé guinéen. Ensemble, nous avons mené des actions concrètes en faveur de la promotion de l'entrepreneuriat, du dialogue public-privé et de l'amélioration du climat des affaires.",
                "Nous avons organisé plusieurs missions économiques à l'international, renforcé nos partenariats avec les chambres consulaires de la sous-région et au-delà, et accompagné des centaines d'entreprises dans leurs démarches de formalisation et de développement.",
                "En 2026, nous comptons intensifier nos efforts pour faire de la CCIAG un véritable levier de croissance économique. Nos priorités porteront sur le renforcement des capacités des PME, la digitalisation de nos services, la promotion de l'investissement et le soutien aux jeunes entrepreneurs.",
                "Je reste convaincu que c'est ensemble, dans l'unité et la solidarité, que nous construirons une économie guinéenne forte, compétitive et inclusive. Bonne et heureuse année 2026 à toutes et à tous."
            ]
        ],
        'assemblee-generale-mixte-2025' => [
            'title' => 'Clôture de l\'Assemblée Générale Mixte 2025',
            'tag' => 'Événement',
            'date' => '20 Février 2025',
            'day' => '20',
            'month' => 'Fév 2025',
            'location' => 'Conakry, Guinée',
            'image' => 'art2.jpg',
            'images' => ['art2.jpg', 'art1.jpg', 'art3.jpg'],
            'content' => [
                "La cérémonie de clôture de l'Assemblée Générale Mixte 2025 de la Chambre de Commerce, d'Industrie et d'Artisanat de Guinée a marqué un tournant important dans la vie institutionnelle de la CCIAG.",
                "Cette rencontre a réuni l'ensemble des élus consulaires, les représentants des secteurs économiques et les partenaires institutionnels autour des enjeux majeurs du développement du secteur privé guinéen. Les discussions ont porté sur le bilan des activités de l'exercice écoulé, l'adoption du budget prévisionnel et la définition des orientations stratégiques pour les années à venir.",
                "Parmi les points saillants de cette assemblée, on note l'approbation du rapport financier, la validation du plan d'actions stratégique et l'élection de nouveaux membres au sein des commissions techniques. Les participants ont également débattu des moyens de renforcer la compétitivité des entreprises guinéennes sur les marchés nationaux et internationaux.",
                "Le Président de la CCIAG a salué l'engagement des élus consulaires et a réaffirmé la volonté de la Chambre de poursuivre ses efforts en faveur d'un environnement des affaires plus attractif et plus transparent. Il a également appelé à une mobilisation accrue de l'ensemble des acteurs économiques pour relever les défis du développement.",
                "L'Assemblée Générale s'est achevée dans une ambiance de cohésion et de détermination collective, avec un engagement renouvelé pour le rayonnement de la CCIAG et la promotion du secteur privé guinéen."
            ]
        ],
        'ateliers-cpccaf-marseille' => [
            'title' => 'La CCIAG prend part aux Ateliers de la CPCCAF à Marseille',
            'tag' => 'International',
            'date' => '28 Octobre 2025',
            'day' => '28',
            'month' => 'Oct 2025',
            'location' => 'Marseille, France',
            'image' => 'art3.jpg',
            'images' => ['art3.jpg', 'art1.jpg', 'art2.jpg'],
            'content' => [
                "Les Ateliers de la Coopération Consulaire de la CPCCAF (Conférence Permanente des Chambres Consulaires Africaines et Francophones) se sont déroulés du 20 au 22 octobre 2025 au Palais de la Bourse de Marseille.",
                "La délégation de la CCIAG, conduite par son Président, a participé activement aux différentes sessions de travail portant sur le renforcement de la coopération économique entre les chambres consulaires africaines et francophones. Les échanges ont porté sur la digitalisation des services consulaires, le développement du commerce intra-africain et les opportunités offertes par la Zone de Libre-Échange Continentale Africaine (ZLECAf).",
                "Au cours de ces ateliers, la CCIAG a présenté les réformes engagées en Guinée pour améliorer l'environnement des affaires et faciliter l'accès des entreprises guinéennes aux marchés internationaux. Cette présentation a suscité un vif intérêt de la part des participants et a ouvert des perspectives de partenariats prometteurs.",
                "Plusieurs accords de coopération bilatérale ont été signés en marge des ateliers, renforçant ainsi le réseau de la CCIAG à l'échelle internationale. Ces partenariats permettront de faciliter les échanges commerciaux, de promouvoir les investissements croisés et de soutenir la mobilité des entrepreneurs.",
                "La participation de la CCIAG à ces ateliers confirme son engagement en faveur de l'intégration économique régionale et du rayonnement international du secteur privé guinéen."
            ]
        ],
        'renforcement-capacites-pme' => [
            'title' => 'Programme de renforcement des capacités des PME guinéennes',
            'tag' => 'Formation',
            'date' => '15 Septembre 2025',
            'day' => '15',
            'month' => 'Sep 2025',
            'location' => 'Conakry, Guinée',
            'image' => '1.jpg',
            'images' => ['1.jpg', '2.jpg', '3.jpg'],
            'content' => [
                "La CCIAG lance un nouveau programme de formation destiné aux petites et moyennes entreprises pour renforcer leurs compétences en gestion et en développement commercial. Ce programme ambitieux vise à accompagner plus de 200 PME sur une période de 12 mois.",
                "Les modules de formation couvrent des thématiques essentielles telles que la gestion financière, le marketing digital, la gestion des ressources humaines, la conformité réglementaire et l'accès aux financements. Chaque entreprise bénéficiera d'un accompagnement personnalisé avec un mentor dédié.",
                "Ce programme est réalisé en partenariat avec des institutions internationales de renom et bénéficie du soutien technique et financier de partenaires au développement. Il s'inscrit dans la stratégie globale de la CCIAG visant à renforcer la compétitivité du tissu économique guinéen.",
                "Les inscriptions sont ouvertes et les entreprises intéressées sont invitées à se rapprocher du siège de la CCIAG à Conakry ou de l'Assemblée Consulaire Régionale de leur zone pour déposer leur dossier de candidature.",
                "La CCIAG est convaincue que le renforcement des capacités des PME constitue un levier fondamental pour la création d'emplois, la croissance économique et le développement durable en Guinée."
            ]
        ],
        'accord-cooperation-cote-ivoire' => [
            'title' => 'Signature d\'un accord de coopération avec la CCI de Côte d\'Ivoire',
            'tag' => 'Partenariat',
            'date' => '02 Août 2025',
            'day' => '02',
            'month' => 'Aoû 2025',
            'location' => 'Abidjan, Côte d\'Ivoire',
            'image' => '2.jpg',
            'images' => ['2.jpg', '3.jpg', '1.jpg'],
            'content' => [
                "Dans le cadre du renforcement de la coopération sous-régionale, la Chambre de Commerce, d'Industrie et d'Artisanat de Guinée et la Chambre de Commerce et d'Industrie de Côte d'Ivoire ont signé un protocole d'accord visant à faciliter les échanges commerciaux entre les deux pays.",
                "Cet accord prévoit la mise en place de mécanismes de facilitation du commerce bilatéral, l'organisation conjointe de missions commerciales et de forums d'affaires, le partage d'informations économiques et commerciales, ainsi que l'accompagnement des entreprises dans leurs démarches d'implantation dans les deux pays.",
                "La cérémonie de signature s'est déroulée à Abidjan en présence des présidents des deux chambres consulaires, de représentants des milieux d'affaires et de hauts responsables gouvernementaux des deux pays. Elle témoigne de la volonté commune de renforcer les liens économiques entre la Guinée et la Côte d'Ivoire.",
                "Ce partenariat s'inscrit dans une dynamique plus large d'intégration économique ouest-africaine et contribuera à accroître les opportunités commerciales pour les opérateurs économiques des deux pays.",
                "La CCIAG entend multiplier ce type d'accords avec d'autres chambres consulaires de la sous-région afin de créer un réseau solide au service du développement économique de la Guinée."
            ]
        ],
        'forum-economique-conakry' => [
            'title' => 'Forum économique de Conakry : bilan et perspectives',
            'tag' => 'Événement',
            'date' => '18 Juin 2025',
            'day' => '18',
            'month' => 'Jui 2025',
            'location' => 'Conakry, Guinée',
            'image' => '3.jpg',
            'images' => ['3.jpg', '1.jpg', '2.jpg'],
            'content' => [
                "Le Forum économique de Conakry, organisé par la CCIAG, a réuni plus de 300 opérateurs économiques, investisseurs et partenaires institutionnels autour des défis et opportunités du marché guinéen. Cet événement majeur s'est tenu sur deux jours au Centre de Conférences de Conakry.",
                "Les panels de discussion ont abordé des thématiques variées : les opportunités d'investissement dans les secteurs minier, agricole et des services, les réformes du climat des affaires, la transformation digitale des entreprises et le financement des PME. Des témoignages d'entrepreneurs à succès ont ponctué les débats.",
                "En marge du forum, un espace B2B a permis aux participants de nouer des contacts d'affaires et d'explorer des opportunités de partenariat. Plus de 150 rencontres d'affaires ont été organisées, aboutissant à la signature de plusieurs protocoles d'accord et de lettres d'intention.",
                "Le forum a également été l'occasion de présenter le nouveau plan stratégique de la CCIAG pour la période 2025-2030, axé sur la modernisation des services, le renforcement du plaidoyer en faveur du secteur privé et l'accompagnement de la transition numérique des entreprises.",
                "Les participants ont salué la qualité de l'organisation et la pertinence des thématiques abordées, et ont exprimé leur souhait de voir ce forum devenir un rendez-vous annuel incontournable du monde des affaires en Guinée."
            ]
        ],
        'renouvellement-cartes-adhesion' => [
            'title' => 'Renouvellement des cartes d\'adhésion : campagne 2025',
            'tag' => 'Institutionnel',
            'date' => '05 Mai 2025',
            'day' => '05',
            'month' => 'Mai 2025',
            'location' => 'Conakry, Guinée',
            'image' => 'img-1.jpg',
            'images' => ['img-1.jpg', 'img-2.jpg', 'img-3.jpg'],
            'content' => [
                "La CCIAG invite l'ensemble de ses membres à procéder au renouvellement de leur carte d'adhésion pour l'exercice 2025. Cette campagne de renouvellement est une étape importante pour maintenir votre statut de membre actif et continuer à bénéficier de l'ensemble des services offerts par la Chambre.",
                "Les démarches ont été simplifiées cette année afin de faciliter le processus pour nos membres. Le renouvellement peut être effectué directement au siège de la CCIAG à Conakry ou auprès des Assemblées Consulaires Régionales sur l'ensemble du territoire national.",
                "Pour renouveler votre carte, il vous suffit de présenter votre ancienne carte d'adhésion, une pièce d'identité en cours de validité, la patente de l'exercice en cours et le règlement de la cotisation annuelle. Le traitement de votre demande est effectué dans un délai de 48 heures ouvrables.",
                "La carte d'adhésion à la CCIAG offre de nombreux avantages : accès aux services d'accompagnement et de conseil, participation aux événements et formations, accès aux études économiques, représentation de vos intérêts auprès des pouvoirs publics et intégration au réseau des opérateurs économiques de Guinée.",
                "Nous vous encourageons vivement à procéder à votre renouvellement dans les meilleurs délais afin de continuer à bénéficier pleinement de votre appartenance au premier réseau économique de Guinée."
            ]
        ]
    ];

    $article = $articles[$slug] ?? null;

    if (!$article) {
        abort(404);
    }

    // Articles récents (exclure l'article actuel, prendre 3)
    $recents = collect($articles)->except($slug)->take(3);
@endphp

    {{-- ============ HERO BANNER ============ --}}
    <section>
        <div class="breadcrumb-area_actu section-divide">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text text-center">
                            <h1>{{ $article['tag'] }}</h1>
                            <p class="breadcrumb-subtitle">{{ $article['date'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CONTENU ARTICLE ============ --}}
    <section class="article-detail-section">
        <div class="container">
            <div class="row">

                {{-- Colonne principale --}}
                <div class="col-lg-8 col-md-12">
                    <div class="article-detail-wrapper about-cop">

                        {{-- Image principale --}}
                        <div class="article-hero-img">
                            <img src="{{ asset('assets/img/blog/' . $article['image']) }}" alt="{{ $article['title'] }}">
                            <div class="actu-featured-date">
                                <span class="day">{{ $article['day'] }}</span>
                                <span class="month">{{ $article['month'] }}</span>
                            </div>
                        </div>

                        {{-- Meta --}}
                        <div class="article-meta">
                            <div class="actu-tag">{{ $article['tag'] }}</div>
                            <span><i class="fa fa-calendar"></i> {{ $article['date'] }}</span>
                            <span><i class="fa fa-map-marker"></i> {{ $article['location'] }}</span>
                            <span><i class="fa fa-user"></i> CCIAG</span>
                        </div>

                        {{-- Titre --}}
                        <h1 class="article-title">{{ $article['title'] }}</h1>

                        {{-- Contenu --}}
                        <div class="article-content">
                            @foreach($article['content'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        {{-- Galerie 3 images --}}
                        <div class="article-gallery">
                            <h3><i class="fa fa-image"></i> Galerie photos</h3>
                            <div class="row">
                                @foreach($article['images'] as $img)
                                    <div class="col-md-4 col-sm-4 col-6">
                                        <div class="gallery-item">
                                            <img src="{{ asset('assets/img/blog/' . $img) }}" alt="">
                                            <div class="gallery-overlay">
                                                <i class="fa fa-search-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Partage --}}
                        <div class="article-share">
                            <h4>Partager cet article</h4>
                            <div class="article-share-links">
                                <a href="#" class="share-btn facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="share-btn linkedin"><i class="fa fa-linkedin"></i></a>
                                <a href="#" class="share-btn twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="share-btn whatsapp"><i class="fa fa-whatsapp"></i></a>
                            </div>
                        </div>

                    </div>

                    {{-- Navigation article --}}
                    <div class="article-back-link about-cop">
                        <a href="{{ route('actualites') }}"><i class="fa fa-arrow-left"></i> Retour aux actualités</a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 col-md-12">
                    <div class="article-sidebar about-cop">

                        {{-- Articles récents --}}
                        <div class="sidebar-recent">
                            <h4><i class="fa fa-clock-o"></i> Articles récents</h4>
                            @foreach($recents as $recentSlug => $recent)
                                <a href="{{ route('article', $recentSlug) }}" class="sidebar-recent-item">
                                    <div class="recent-img">
                                        <img src="{{ asset('assets/img/blog/' . $recent['image']) }}" alt="">
                                    </div>
                                    <div class="recent-info">
                                        <span class="recent-date">{{ $recent['date'] }}</span>
                                        <h5>{{ $recent['title'] }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Catégories --}}
                        <div class="sidebar-categories">
                            <h4><i class="fa fa-folder-o"></i> Catégories</h4>
                            <ul>
                                <li><a href="#">Institutionnel <span>2</span></a></li>
                                <li><a href="#">Événement <span>2</span></a></li>
                                <li><a href="#">International <span>1</span></a></li>
                                <li><a href="#">Formation <span>1</span></a></li>
                                <li><a href="#">Partenariat <span>1</span></a></li>
                            </ul>
                        </div>

                        {{-- CTA Membre --}}
                        <div class="contact-sidebar-cta">
                            <h4>Devenir membre ?</h4>
                            <p>Rejoignez le réseau des opérateurs économiques de Guinée.</p>
                            <a href="{{ route('membre') }}" class="sidebar-cta-btn">
                                <i class="fa fa-arrow-right"></i> En savoir plus
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
