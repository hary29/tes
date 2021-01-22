<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\About;
use App\Http\Livewire\UserManage;
use App\Http\Livewire\ArticleManage;
use App\Http\Livewire\GalleryManage;
use App\Http\Livewire\SliderManage;
use App\Http\Livewire\SocialMediaManage;
use App\Http\Livewire\TestimonyManage;
use App\Http\Livewire\PageInfoManage;
use App\Http\Livewire\PaymentCategoryManage;
use App\Http\Livewire\VideoContentManage;
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
Route::get('/article', [SiteController::class,'article']);

//Route::get('/contact', [SiteController::class,'contact']);
Route::get('/dialog', [SiteController::class,'dialog']);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/MburiL4w4ng', function() {
        return view('dashboard');
    })->name('dashboard');

   /* Route::get('/about-manage', About::class)->name('about-manage');*/ //Tambahkan routing ini
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

/*user management*/
Route::group(['middleware'=>'admins'],function(){
	Route::get('/about-manage', About::class)->name('about-manage');
    Route::get('/video-content-manage', VideoContentManage::class)->name('video-content-manage');
    Route::get('/page-info-manage', PageInfoManage::class)->name('page-info-manage');
    Route::get('/payment-category-manage', PaymentCategoryManage::class)->name('payment-category-manage');
    Route::get('/slider-manage', SliderManage::class)->name('slider-manage');
    Route::get('/social-media-manage', SocialMediaManage::class)->name('social-media-manage');
    Route::get('/testimony-manage', TestimonyManage::class)->name('testimony-manage');
    Route::get('/article-manage', ArticleManage::class)->name('article-manage');
    Route::get('/gallery-manage', GalleryManage::class)->name('gallery-manage');
});

/*super only*/
Route::group(['middleware'=>'super'],function(){
    Route::get('/user-manage', UserManage::class)->name('user-manage');
});

//unable route register
Route::any('/register', function()
{
    return abort(404);
});


//require __DIR__.'/auth.php';
