<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

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