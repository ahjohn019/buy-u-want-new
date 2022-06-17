<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::post('/users/details',[UserController::class,'storeDetails']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Cart Controller
Route::prefix('carts')->group(function(){
    Route::get('/listAll',[CartController::class,'listCart']);
    Route::post('/addCart/{product}',[CartController::class,'addCart']);
    Route::post('/updateCart/{product}',[CartController::class,'updateCart']);
    Route::post('/removeCart/{product}',[CartController::class,'removeCart']);
});

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('variants', VariantController::class);

//Stripe Controller
Route::middleware(['auth','verified'])->group(function () {
    //Stripe
    Route::prefix('stripe')->group(function(){
        Route::post('/createCustomer',[StripeController::class,'createCustomer']);
        Route::get('/retrieveCustomer',[StripeController::class,'retrieveCustomer']);
        Route::post('/finalPayments',[StripeController::class,'finalPayments']);
        Route::post('/createOrder',[StripeController::class,'createorder']);
    });
});


require __DIR__.'/auth.php';
