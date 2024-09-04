<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginRegisterController;

Route::get('/', function () {
    return view('home');
});

Route::controller(LoginRegisterController::class)->group(function(){
    // Login
    Route::get('/login', 'showLoginPage');
    Route::post('/login/store', 'StoreLogin');

    // Register
    Route::get('/register', 'showRegisterPage');
    Route::post('/register/store', 'StoreRegister');

    // Logout
    Route::post('/logout', 'logout')->middleware('is_login');

});
Route::get('/invoices', [InvoiceController::class, 'showUserInvoices']);

// Rute untuk kategori menggunakan controller
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories/create', 'create')->middleware('is_admin');
    Route::post('/categories', 'store')->middleware('is_admin');
    Route::get('/categories/{id}/edit', 'edit')->middleware('is_admin');
    Route::post('/categories/{id}', 'update')->middleware('is_admin');
    Route::delete('/categories/{id}', 'destroy')->middleware('is_admin');
});

// Rute untuk produk menggunakan controller
Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
    Route::get('/products/create', 'create')->middleware('is_admin');
    Route::post('/products', 'store')->middleware('is_admin');  
    Route::get('/products/{id}/edit', 'edit')->middleware('is_admin');
    Route::post('/products/{id}', 'update')->middleware('is_admin');
    Route::delete('/products/{id}', 'destroy')->middleware('is_admin');
});

Route::controller(CartController::class)->group(function(){
    Route::post('/cart/add', 'addToCart')->middleware('is_login');
    Route::get('/cart', 'showCart');
    Route::post('/checkout', 'checkout')->middleware('is_login');
});
