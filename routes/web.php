<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\AttachmentController;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('variants', VariantController::class);
Route::resource('orders', OrderController::class);
Route::resource('discounts', DiscountController::class);
Route::resource('coupons',CouponController::class);
Route::resource('attachments', AttachmentController::class)->middleware('admin');
Route::resource('users', UserController::class)->middleware(['admin','verified']);
Route::resource('biography', BiographyController::class);
Route::resource('address', AddressController::class);


Route::post('/archive', [OrderController::class, 'archive'])->name('orders.archive')->middleware(['auth', 'verified']);
Route::post('/refund',[OrderController::class, 'refund'])->name('orders.refund')->middleware(['auth', 'verified']);
Route::get('/search',[OrderController::class, 'search'])->name('orders.search')->middleware(['auth', 'verified']);

Route::get('/', function () {
    return Inertia::render('Front/Master/Index',['auth'=>auth()->user()]);
})->name('main.index');

Route::get('/checkout', [StripeController::class, 'checkoutIndex'])->name('checkout.index')->middleware(['auth', 'verified']);

Route::group(['prefix'=>'charts','middleware'=>'admin'], function () {
    Route::get('/orders',[ChartController::class,'orders'])->name('chart.orders');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Cart Controller
Route::prefix('carts')->group(function(){
    Route::get('/',[CartController::class,'listCart'])->name('cart.index');
    Route::post('/addCart/{product}',[CartController::class,'addCart'])->name('cart.add');
    Route::post('/updateCart/{product}',[CartController::class,'updateCart'])->name('cart.update');
    Route::post('/removeCart/{product}',[CartController::class,'removeCart'])->name('cart.remove');
    Route::post('/clearAll',[CartController::class,'clearAll'])->name('cart.clear');
});

//Stripe Controller
Route::middleware(['auth','verified'])->group(function () {
    //Stripe
    Route::prefix('stripe')->group(function(){
        Route::post('/createCustomer',[StripeController::class,'createCustomer'])->name('stripe.createCustomer');
        Route::get('/retrieveCustomer',[StripeController::class,'retrieveCustomer'])->name('stripe.retrieveCustomer');
        Route::post('/finalPayments',[StripeController::class,'finalPayments'])->name('stripe.finalPayments');
        Route::post('/createOrder',[StripeController::class,'createorder'])->name('stripe.createOrder');
    });
});

//Admin Controllers
Route::group(['prefix'=>'admin', 'middleware' => ['admin','verified']], function(){
    Route::get('/index', function () {
        return Inertia::render('Admin/Dashboard/Index');
    })->name('admin.index');
    Route::get('/products', [ProductController::class,'admin'])->name('products.admin');
    Route::post('/orders/fulfilled',[OrderController::class,'fulfillStatus'])->name('orders.fulfilled');
});

//Test Pinia
Route::get('/test/pinia', function () {
    return Inertia::render('Stores/TestTwo');
});


require __DIR__.'/auth.php';
