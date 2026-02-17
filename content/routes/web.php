<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;


//AUTHENTIFICATION
    Route::get('/admin_cciag', [LoginController::class, 'login'])->name('login');
    Route::get('/verify', [LoginController::class, 'verify'])->middleware(['auth'])->name('verify');
    Route::POST('/disconnect', [LoginController::class, 'deconnexion'])->middleware(['auth'])->name('disconnect');

    //PASSWORD
    Route::get('/password', [PasswordController::class, 'mot_de_passe'])->name('mot_de_passe');
    Route::POST('/password/reset/pwd/', [PasswordController::class, 'mot_de_passe_reset'])->name('mot_de_passe_reset');
//AUTHENTIFICATION


Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/propos', [SiteController::class, 'propos'])->name('propos');
Route::get('/membre', [SiteController::class, 'membre'])->name('membre');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/actualites', [SiteController::class, 'actualites'])->name('actualites');
Route::get('/actualites/{slug}', [SiteController::class, 'article'])->name('article');

// ========================================
// TOUTES LES ROUTES PROTÉGÉES
// ========================================
Route::middleware(['auth'])->group(function () {

    //DASHBOARD
    Route::get('/magasin/dashboard', [MagasinController::class, 'dashboard'])->name('magasin.dashboard');
    Route::get('/dashboard/ventes-par-article', [MagasinController::class, 'ventesParArticle'])->name('dashboard.ventes-par-article');
    Route::get('/pdg/dashboard', [MagasinController::class, 'dashboard'])->name('pdg.dashboard');

    //UTILISATEURS
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
    Route::post('/utilisateurs/store', [UserController::class, 'store'])->name('utilisateurs.store');
    Route::post('/utilisateurs/{id}/update', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::post('/utilisateurs/{id}/delete', [UserController::class, 'destroy'])->name('utilisateurs.delete');
    Route::post('/utilisateurs/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('utilisateurs.toggle-status');
    Route::post('/utilisateurs/{id}/reset-password', [UserController::class, 'resetPassword'])->name('utilisateurs.reset-password');
    Route::get('/utilisateurs_load/{limit}', [UserController::class, 'load'])->name('utilisateurs.load');



}); // fin middleware auth


require __DIR__.'/auth.php';