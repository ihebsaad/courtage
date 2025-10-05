<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EtudePrevoyanceController;
use App\Http\Controllers\EtudeMutuelleController;

//Route::resource('categories', CategoriesController::class);
Route::resource('users', UsersController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Settings
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::post('/update_setting', [App\Http\Controllers\SettingsController::class, 'update_setting'])->name('update_setting');
Route::post('/update_text', [App\Http\Controllers\SettingsController::class, 'update_text'])->name('update_text');


// users
Route::get('profile', [UsersController::class, 'profile'])->name('profile');
Route::post('/updateuser',[UsersController::class, 'updateuser'])->name('updateuser');
Route::get('/loginAs/{id}', [UsersController::class, 'loginAs'])->name('loginAs');
Route::post('/users/ajoutimage',[UsersController::class, 'ajoutimage'])->name('users.ajoutimage');
Route::post('/activer/{id}', [UsersController::class, 'activer'])->name('activer');
Route::post('/desactiver/{id}', [UsersController::class, 'desactiver'])->name('desactiver');



Route::middleware(['auth'])->group(function () {
    // Routes clients
    Route::resource('clients', ClientController::class);
    
    // Routes spéciales pour clients
    Route::post('clients/{client}/convert-to-client', [ClientController::class, 'convertToClient'])
         ->name('clients.convert');
    
    // API Routes
    Route::post('api/siren-data', [ClientController::class, 'getSirenData'])
         ->name('api.siren.data');
});

// routes/api.php (si vous voulez séparer les routes API)


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('siren-data', [ClientController::class, 'getSirenData']);
    Route::get('clients/search', [ClientController::class, 'search']);
});


Route::get('clients-datatable', [ClientController::class, 'datatable'])->name('clients.datatable');
Route::post('clients-bulk-action', [ClientController::class, 'bulkAction'])->name('clients.bulk-action');
Route::get('clients-cities', [ClientController::class, 'cities'])->name('clients.cities');
Route::get('clients-search', [ClientController::class, 'search'])->name('clients.search');
Route::patch('clients/{client}/status', [ClientController::class, 'updateStatus'])->name('clients.update-status');
Route::post('clients/{client}/update-documents', [ClientController::class, 'updateDocuments'])->name('clients.update-documents');
Route::post('clients/{client}/update-status', [ClientController::class, 'updateStatus'])->name('clients.update-status');
Route::get('clients/{client}/documents/{documentIndex}', [ClientController::class, 'downloadDocument'])->name('clients.download-document');



// Route pour générer le PDF
Route::get('/etude-prevoyance/pdf', [EtudePrevoyanceController::class, 'generatePdf'])
    ->name('etude-prevoyance.pdf');

// Route pour prévisualiser le document (optionnel)
Route::get('/etude-prevoyance/preview', [EtudePrevoyanceController::class, 'showPreview'])
    ->name('etude-prevoyance.preview');


Route::get('/etude-mutuelle/pdf', [EtudeMutuelleController::class, 'generatePdf'])
    ->name('etude-mutuelle.pdf');

// Route pour prévisualiser l'étude mutuelle (optionnel)
Route::get('/etude-mutuelle/preview', [EtudeMutuelleController::class, 'showPreview'])
    ->name('etude-mutuelle.preview');