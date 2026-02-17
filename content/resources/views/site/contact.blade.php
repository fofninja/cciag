@extends('layouts.layout')
@section('content')

    {{-- ============ HERO BANNER ============ --}}
    <section>
        <div class="breadcrumb-area_contact section-divide">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-text text-center">
                            <h1>Nous Contacter</h1>
                            <p class="breadcrumb-subtitle">Restons en contact pour construire ensemble</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ COORDONNÉES ============ --}}
    <section class="contact-info-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card about-cop">
                        <div class="contact-info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <h4>Adresse</h4>
                        <p>Siège de la CCIAG<br>Conakry, République de Guinée</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card about-cop">
                        <div class="contact-info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <h4>Téléphone</h4>
                        <p>+224 XXX XXX XXX<br>+224 XXX XXX XXX</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="contact-info-card about-cop">
                        <div class="contact-info-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <h4>Email</h4>
                        <p>contact@cciag.org.gn<br>info@cciag.org.gn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ FORMULAIRE + INFOS ============ --}}
    <section class="contact-form-section">
        <div class="container">
            <div class="row">

                {{-- Colonne formulaire --}}
                <div class="col-lg-8 col-md-12">
                    <div class="contact-form-wrapper about-cop">
                        <span class="propos-section-label">MESSAGE</span>
                        <h2>Envoyez-nous un message</h2>
                        <p class="contact-form-desc">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>

                        <form class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="name"><i class="fa fa-user"></i> Nom et Prénom <span>*</span></label>
                                        <input type="text" name="name" id="name" class="form-control-custom" placeholder="Votre nom complet">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="email"><i class="fa fa-envelope"></i> Email <span>*</span></label>
                                        <input type="email" name="email" id="email" class="form-control-custom" placeholder="votre@email.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="phone"><i class="fa fa-phone"></i> Téléphone</label>
                                        <input type="text" name="phone" id="phone" class="form-control-custom" placeholder="+224 XXX XXX XXX">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label for="subject"><i class="fa fa-tag"></i> Objet <span>*</span></label>
                                        <select name="subject" id="subject" class="form-control-custom">
                                            <option value="" disabled selected>-- Sélectionnez un objet --</option>
                                            <option value="Demande d'information">Demande d'information</option>
                                            <option value="Adhésion à la CCIAG">Adhésion à la CCIAG</option>
                                            <option value="Carte de membre">Carte de membre</option>
                                            <option value="Partenariat">Partenariat</option>
                                            <option value="Réclamation">Réclamation</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <label for="message"><i class="fa fa-pencil"></i> Message <span>*</span></label>
                                        <textarea name="message" id="message" class="form-control-custom" rows="6" placeholder="Écrivez votre message ici..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="contact-submit-btn">
                                        <i class="fa fa-paper-plane"></i> Envoyer le message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Colonne infos latérales --}}
                <div class="col-lg-4 col-md-12">
                    <div class="contact-sidebar about-cop">

                        <div class="contact-sidebar-card">
                            <div class="sidebar-card-icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <h4>Horaires d'ouverture</h4>
                            <ul>
                                <li><strong>Lundi - Vendredi</strong><br>08h00 - 16h30</li>
                                <li><strong>Samedi - Dimanche</strong><br>Fermé</li>
                            </ul>
                        </div>

                        <div class="contact-sidebar-card">
                            <div class="sidebar-card-icon">
                                <i class="fa fa-share-alt"></i>
                            </div>
                            <h4>Suivez-nous</h4>
                            <div class="contact-social-links">
                                <a href="#" class="social-link"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="social-link"><i class="fa fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>

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

    {{-- ============ CARTE / MAP ============ --}}
    <section class="contact-map-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="propos-section-label" style="padding-left:0;">
                        <span style="display:none;">.</span>LOCALISATION
                    </span>
                    <h2 class="membre-section-title">Où nous trouver</h2>
                    <p class="membre-section-subtitle">Le siège de la CCIAG est situé à Conakry, République de Guinée.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-map-wrapper about-cop">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3933.318!2d-13.712!3d9.509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwMzAnMzIuNCJOIDEzwrA0Mic0My4yIlc!5e0!3m2!1sfr!2sgn!4v1"
                            width="100%"
                            height="400"
                            style="border:0; border-radius:16px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
