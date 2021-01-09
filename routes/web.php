<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Livewire\About;

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

// Route::get('/', function () {
//     return view('welcome');
// });

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