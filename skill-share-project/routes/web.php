<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UtilisateursController;
use App\Http\Controllers\admin\competenceController;
use App\Http\Controllers\admin\sessionsController;
use App\Http\Controllers\etudiants\EtudiantController;
use App\Http\Controllers\etudiants\bookingController;
use App\Http\Controllers\etudiants\notificationsController;
use App\Http\Controllers\etudiants\ToDoController;
use App\Http\Controllers\etudiants\profileController;
use App\Http\Controllers\visiteure\searchController;
use App\Http\Controllers\visiteure\CoursController;
use App\Http\Controllers\visiteure\VisitprofileController;

// ==========================
// VISITEUR
// ==========================

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

// Cours et recherche accessibles sans auth
Route::get('/cours', [CoursController::class, 'index'])->name('cours');
Route::get('/search', [searchController::class, 'index'])->name('search');
Route::get('/visit/profile/{id}', [VisitprofileController::class, 'show'])->name('profile.show');

// ==========================
// AUTHENTIFIÉS
// ==========================

Route::middleware(['auth'])->group(function () {

    // ==========================
    // ADMIN
    // ==========================
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Utilisateurs
        Route::get('/dashboard/utilisateur', [UtilisateursController::class, 'index'])->name('admin.utilisateurs');
        Route::patch('/dashboard/utilisateur/{id}/suspendre', [UtilisateursController::class, 'suspendre'])->name('admin.utilisateurs.suspendre');
        Route::patch('/dashboard/utilisateur/{id}/reactiver', [UtilisateursController::class, 'reactiver'])->name('admin.utilisateurs.reactiver');
        Route::delete('/dashboard/utilisateur/{id}', [UtilisateursController::class, 'supprimer'])->name('admin.utilisateurs.supprimer');

        // Sessions & Compétences
        Route::get('/dashboard/session', [sessionsController::class, 'index'])->name('admin.session');
        Route::get('/dashboard/competence', [competenceController::class, 'index'])->name('admin.competence');
    });

    // ==========================
    // ETUDIANT
    // ==========================
    Route::middleware('role:etudiant')->group(function () {
        Route::get('/dashboard/etudiant', [EtudiantController::class, 'index'])->name('etudiant.dashboard');


        // Booking
        Route::get('/dashboard/booking', [BookingController::class, 'index'])->name('etudiant.booking');
        Route::post('/dashboard/booking', [BookingController::class, 'store'])->name('etudiant.booking.store');
        Route::get('/dashboard/session/{id}', [BookingController::class, 'show'])->name('etudiant.session.show');
        Route::put('/dashboard/session/{id}', [BookingController::class, 'update'])->name('etudiant.session.update');
        Route::post('/dashboard/session/{id}/complete', [BookingController::class, 'complete'])->name('etudiant.session.complete');

        // Profile
        Route::get('/dashboard/profile', [profileController::class, 'index'])->name('etudiant.profile');
        Route::get('/profile/edit', [profileController::class, 'edit'])->name('etudiant.profile.edit');
        Route::post('/profile/update', [profileController::class, 'update'])->name('etudiant.profile.update');

        // Notifications
        Route::get('/dashboard/notification', [notificationsController::class, 'index'])->name('etudiant.notification');

        // ToDo
        Route::get('/dashboard/todo', [ToDoController::class, 'index'])->name('etudiant.todo');
        Route::get('/dashboard/todo/create', [ToDoController::class, 'create'])->name('etudiant.todo.create');
        Route::post('/dashboard/todo', [ToDoController::class, 'store'])->name('etudiant.todo.store');
        Route::get('/dashboard/todo/{id}/edit', [ToDoController::class, 'edit'])->name('etudiant.todo.edit');
        Route::put('/dashboard/todo/{id}', [ToDoController::class, 'update'])->name('etudiant.todo.update');
        Route::delete('/dashboard/todo/{id}', [ToDoController::class, 'destroy'])->name('etudiant.todo.destroy');
        Route::put('/etudiant/todo/{id}/categorie', [ToDoController::class, 'updateCategorie'])->name('etudiant.todo.updateCategorie');
        Route::patch('/dashboard/todo/{id}/status', [ToDoController::class, 'updateStatus'])->name('etudiant.todo.status');
    });
});
