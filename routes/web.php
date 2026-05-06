<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedecinController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    if ($user->isMedecin()) {
        return redirect()->route('medecin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Routes Communes (Messagerie) ---
    Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{userId}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{userId}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

    // --- Routes Patient ---
    Route::resource('rendezvous', RendezVousController::class);

    // --- Routes Médecin ---
    Route::middleware(['role:medecin'])->group(function () {
        Route::get('/medecin/dashboard', [\App\Http\Controllers\EspaceMedecinController::class, 'index'])->name('medecin.dashboard');
        Route::get('/medecin/horaires', [\App\Http\Controllers\EspaceMedecinController::class, 'horaires'])->name('medecin.horaires');
        Route::put('/medecin/horaires', [\App\Http\Controllers\EspaceMedecinController::class, 'updateHoraires'])->name('medecin.horaires.update');
        Route::get('/medecin/patient/{id}', [\App\Http\Controllers\EspaceMedecinController::class, 'dossierPatient'])->name('medecin.patient');
        Route::put('/medecin/patient/{id}', [\App\Http\Controllers\EspaceMedecinController::class, 'updateDossier'])->name('medecin.patient.update');
        Route::put('/medecin/rdv/{id}/reponse', [\App\Http\Controllers\EspaceMedecinController::class, 'repondreRdv'])->name('medecin.rdv.reponse');
        
        // Dossier Unique Patient
        Route::get('/medecin/patient/{id}/dossier', [\App\Http\Controllers\DossierController::class, 'index'])->name('medecin.dossier.index');
        Route::put('/medecin/patient/{id}/dossier', [\App\Http\Controllers\DossierController::class, 'updateInfos'])->name('medecin.dossier.update');
        Route::post('/medecin/patient/{id}/dossier/remarque', [\App\Http\Controllers\DossierController::class, 'storeRemarque'])->name('medecin.dossier.remarque');
    });

    // --- Routes Admin ---
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('medecins', MedecinController::class);
        Route::get('/admin/rendezvous', [AdminController::class, 'allRendezVous'])->name('admin.rendezvous');
    });
});

require __DIR__.'/auth.php';
