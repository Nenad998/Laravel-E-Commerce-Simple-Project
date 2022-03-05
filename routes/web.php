<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'showHomePage']);
Route::get('/category/{categoryId}', [ProductController::class, 'getProductsByCategory']);
//Route::get('/product/{productId}', [ProductController::class, 'getProductsById']);
Route::get('/product/{slug}', [ProductController::class, 'getProductsBySlug']);
Route::get('/products/search', [ProductController::class, 'getProductsBySearch']);
Route::post('/cart', [ProductController::class, 'addInCart']);
Route::post('/buy', [ProductController::class, 'buy']);


Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/admin', [AdminController::class, 'showAdminPage']);
    Route::get('/admin/product/new', [AdminController::class, 'showNewProductForm']);
    Route::post('/admin/product', [AdminController::class, 'createNewProduct']);
    Route::get('/admin/category/new', [CategoryController::class, 'showNewCategoryForm']);
    Route::post('/admin/category', [CategoryController::class, 'createNewCategory']);
    Route::get('/admin/product/edit/{id}', [AdminController::class, 'showEditProductForm']);
    Route::put('/admin/product/{id}', [AdminController::class, 'editProduct']);
    Route::delete('/admin/product/{id}', [AdminController::class, 'deleteProduct']);
    Route::get('/admin/orders', [AdminController::class, 'showAllOrders']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
