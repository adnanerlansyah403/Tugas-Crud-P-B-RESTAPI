<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    $products = Product::query()->get();

    // dd($products);

    return view('products.index', compact('products'));
})->middleware(['withAuth'])->name('homepage');

Route::any('/login', [AuthController::class, 'login'])->name('login')->middleware(['noAuth']);
Route::any('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['withAuth']);

Route::prefix('/products')
    ->name('products.')
    ->controller(ProductController::class)
    ->middleware(['withAuth'])
    ->group(function() {

    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('{id}/show', 'show')->name('show')
        ->where([
        'id' => '[0-9]+',
    ]);
    Route::get('{id}/edit', 'edit')->name('edit')
        ->where([
        'id' => '[0-9]+',
    ]);
    Route::patch('{id}/update', 'update')->name('update')
    ->where([
        'id' => '[0-9]+',
    ]);
    Route::get('{id}/delete', 'destroy')->name('destroy')
    ->where([
        'id' => '[0-9]+',
    ]);

    
    Route::post('/search', 'search')->name('search');
    
}); 

Route::prefix('/blogs')
    ->name('blogs.')
    ->controller(BlogController::class)
    ->middleware(['withAuth'])
    ->group(function() {

    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('{id}/show', 'show')->name('show')
        ->where([
        'id' => '[0-9]+',
    ]);
    Route::get('{id}/edit', 'edit')->name('edit')
        ->where([
        'id' => '[0-9]+',
    ]);
    Route::patch('{id}/update', 'update')->name('update')
    ->where([
        'id' => '[0-9]+',
    ]);
    Route::get('{id}/delete', 'destroy')->name('destroy')
    ->where([
        'id' => '[0-9]+',
    ]);

    
    Route::post('/search', 'search')->name('search');
    
}); 