<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UtilisateursController;
use App\Http\Controllers\etudiants\EtudiantController;
use App\Http\Controllers\etudiants\bookingController;
use App\Http\Controllers\etudiants\notificationsController;
use App\Http\Controllers\etudiants\todoController;
use App\Http\Controllers\etudiants\searchController;
use App\Http\Controllers\etudiants\profileController;
use App\Http\Controllers\admin\competenceController;
use App\Http\Controllers\admin\sessionsController;


// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboards avec Middleware de rôle
Route::middleware(['auth'])->group(function () {
    // Route Admin
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
    // Route Utilisateur
    Route::get('/dashboard/utilisateur', [utilisateursController::class, 'index'])->middleware('role:admin')->name('admin.utilisateurs');
    // Route Etudiant
    Route::get('/dashboard/etudiant', [EtudiantController::class, 'index'])->middleware('role:etudiant')->name('etudiant.dashboard');
// Suspendre un utilisateur
Route::patch('/dashboard/utilisateur/{id}/suspendre', [UtilisateursController::class, 'suspendre'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.utilisateurs.suspendre');

// Réactiver un utilisateur suspendu
Route::patch('/dashboard/utilisateur/{id}/reactiver', [UtilisateursController::class, 'reactiver'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.utilisateurs.reactiver');

// Supprimer un utilisateur
Route::delete('/dashboard/utilisateur/{id}', [UtilisateursController::class, 'supprimer'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.utilisateurs.supprimer');
    // Route booking
    Route::get('/dashboard/booking', [bookingController::class, 'index'])->middleware('role:etudiant')->name('etudiant.booking');
    // Route profile
    Route::get('/dashboard/profile', [profileController::class, 'index'])->middleware('role:etudiant')->name('etudiant.profile');
        // Nouvelle Route : Modifier le profil (Étudiant)
        Route::get('/profile/edit', [profileController::class, 'edit'])
        ->middleware('role:etudiant')
        ->name('etudiant.profile.edit');
    
    Route::post('/profile/update', [profileController::class, 'update'])
        ->middleware('role:etudiant')
        ->name('etudiant.profile.update');
        
    // Route notification
    Route::get('/dashboard/notification', [notificationsController::class, 'index'])->middleware('role:etudiant')->name('etudiant.notification');
    // route todo
    Route::get('/dashboard/todo', [todoController::class, 'index'])->middleware('role:etudiant')->name('etudiant.todo');
    // route search
    Route::get('/dashboard/search', [searchController::class, 'index'])->middleware('role:etudiant')->name('etudiant.search');
    // route admin Session
    Route::get('/dashboard/session', [sessionsController::class, 'index'])->middleware('role:admin')->name('admin.session');
    //route competence
    Route::get('/dashboard/competence', [competenceController::class, 'index'])->middleware('role:admin')->name('admin.competence');

});