<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('/', [HomeController::class, 'index']);
route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');
route::get('/view_category', [AdminController::class, 'view_category']);
route::post('/add_catagory', [AdminController::class, 'add_catagory']);
route::get('/delete_catagory/{id}', [AdminController::class, 'delete_catagory']);
// {{url('/view_product')}}
route::get('/view_product', [AdminController::class, 'view_product']);
route::post('/add_product', [AdminController::class, 'add_product']);
route::get('/show_product', [AdminController::class, 'show_product']);
route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
route::get('/update_product/{id}', [AdminController::class, 'update_product']);
route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
route::get('/order', [AdminController::class, 'order']);
route::get('/product_details/{id}', [HomeController::class, 'product_details']);
route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
route::get('/show_cart', [HomeController::class, 'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
route::get('/cash_order', [HomeController::class, 'cash_order']);

route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
route::post('stripe/{totalprice}', [HomeController::class, 'stripe.post'])->name('stripe.post');

route::get('/delivered/{id}', [AdminController::class, 'delivered']);
route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

route::get('/send_email/{id}', [AdminController::class, 'send_email']);
route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
route::get('/search', [AdminController::class, 'searchdata']);  
route::get('/orders', [HomeController::class, 'show_order']);
route::get('/cancel_order{id}', [HomeController::class, 'cancel_order']);

