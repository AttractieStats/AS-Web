<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RideCounterController;
use App\Http\Controllers\AdminAttractionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\AdminSuggestionController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\FriendController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Hier worden alle web routes geregistreerd.
| Deze routes zijn gekoppeld aan controllers of closures.
|
*/

// Root route -> eerst inloggen verplicht, daarna home
Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/language', [ProfileController::class, 'updateLanguage'])->name('profile.language.update');

});


Route::middleware(['auth'])->group(function () {
    // Gebruikersoverzicht
    Route::get('/gebruikers', [UserController::class, 'index'])->name('users.index');

    // Profiel van een andere gebruiker
    Route::get('/gebruikers/{user}', [UserController::class, 'show'])->name('users.show');
});

//Friend
Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
        Route::post('/friends/accept/{id}', [FriendController::class, 'accept'])->name('friends.accept');
    Route::delete('/friends/reject/{id}', [FriendController::class, 'reject'])->name('friends.reject');
        Route::post('/friends/request/{user}', [FriendController::class, 'sendRequest'])->name('friends.sendRequest');

});


// Suggesties
Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

// Admin - Suggesties
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/suggestions', [AdminSuggestionController::class, 'index'])->name('admin.suggestions');
    Route::get('/admin/suggestions/{id}/edit', [AdminSuggestionController::class, 'edit'])->name('admin.suggestions.edit');
    Route::put('/admin/suggestions/{id}', [AdminSuggestionController::class, 'update'])->name('admin.suggestions.update');
    Route::post('/admin/suggestions/{id}/approve', [AdminSuggestionController::class, 'approve'])->name('admin.suggestions.approve');
Route::post('/admin/suggestions/{id}/reject', [AdminSuggestionController::class, 'reject'])
    ->name('admin.suggestions.reject');
});



// Admin - Gebruikers
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');
});


// RideCounter en Park routes
Route::middleware('auth')->group(function () {
    Route::get('/ridecounts', [RideCounterController::class, 'index'])->name('ridecounts.index');
    Route::post('/ridecounts', [RideCounterController::class, 'store'])->name('ridecounts.store');
    Route::put('/ridecounts/{id}', [RideCounterController::class, 'update'])->name('ridecounts.update');
    Route::post('/ridecounts/increment', [RideCounterController::class, 'increment'])->name('ridecounts.increment');

    Route::get('/parks', [ParkController::class, 'index'])->name('parks.index');
    Route::get('/parks/{park}', [ParkController::class, 'show'])->name('parks.show');

    Route::post('/attractions/{attraction}/increment', [RideCounterController::class, 'increment'])->name('attractions.increment');
    Route::get('/attractions/{attraction}', [AdminAttractionController::class, 'show'])->name('admin.attractions.show');
});

// Admin routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/attractions', [AdminAttractionController::class, 'index'])->name('admin.attractions.index');
    Route::get('/admin/attractions/create', [AdminAttractionController::class, 'create'])->name('admin.attractions.create');
    Route::post('/admin/attractions', [AdminAttractionController::class, 'store'])->name('admin.attractions.store');
    Route::get('/admin/attractions/{attraction}/edit', [AdminAttractionController::class, 'edit'])->name('admin.attractions.edit');
    Route::put('/admin/attractions/{attraction}', [AdminAttractionController::class, 'update'])->name('admin.attractions.update');
});

// User routes
Route::middleware(['auth', 'role:Normal User'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';