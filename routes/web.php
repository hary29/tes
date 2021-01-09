<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\About;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [SiteController::class,'index']);
Route::get('/gallery', [SiteController::class,'gallery']);
Route::get('/donation', [SiteController::class,'donation']);
Route::get('/about', [SiteController::class,'about']);
Route::get('/contact', [SiteController::class,'contact']);
Route::get('/dialog', [SiteController::class,'dialog']);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/about-manage', About::class)->name('about-manage'); //Tambahkan routing ini
});

$enableViews = config('fortify.views', true);
if (Features::enabled(Features::registration())) {
    if ($enableViews) {
        Route::get('/r3g', [RegisteredUserController::class, 'create'])
            ->middleware(['guest'])
            ->name('register');
    }

    Route::post('/r3g', [RegisteredUserController::class, 'store'])
        ->middleware(['guest']);
}

//unable route register
Route::any('/register', function()
{
    return abort(404);
});


//require __DIR__.'/auth.php';
