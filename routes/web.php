<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomerCotroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Runner\Hook;

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
// Route::group([
//     'prefix' => 'administrator',
//     'middleware' => ['auth']
// ], function () {
// Route::get('backend/home', function (){
//     return view('backend.home');
// })->name('backend.home');
// Route::resource('homeBackend', HomeController::class);
Route::group([
    'prefix' => 'administrator',
    'middleware' => ['auth']
], function () {
    Route::prefix('customers')->group(function () {
        Route::get('/trash', [CustomerCotroller::class, 'trashedItems'])->name('customers.trash');
        // Route::get('/export', [CustomerCotroller::class, 'export'])->name('customers.export');
        Route::delete('/force_destroy/{id}', [CustomerCotroller::class, 'force_destroy'])->name('customers.force_destroy');
        Route::get('/restore/{id}', [CustomerCotroller::class, 'restore'])->name('customers.restore');
    });

Route::get('homeBackend',[HomeController::class,'index'])->name('backend.home');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerCotroller::class); 
Route::resource('users', UserController::class); 
Route::resource('userGroups', UserGroupController::class); 

});


Route::get('backend/login', function (){
    return view('backend.login.index');
})->name('login.index');
Route::get('website/product', [ProductController::class,'websiteProduct'])->name('website.product');
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('updateQuantity-cart', [ProductController::class, 'updateQuantity'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('checkouts', [ProductController::class, 'checkouts'])->name('checkouts');
Route::get('/category/{id}', [ProductController::class, 'categories'])->name('website.category');
Route::get('/showProduct/{id}', [ProductController::class, 'showProduct'])->name('showProduct');
Route::post('/comments',[CommentController::class, 'store'])->name('comments.store');

// });
Route::get('administrator/login', [AuthController::class, 'login'])->name('administrator/login');
Route::get('administrator/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('administrator/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
// Route::get('website/product', function (){
//     return view('frontend.website.product');
// })->name('frontend.website.product');
// Route::get('website/home', function (){
//     return view('frontend.layouts.master');
// })->name('frontend.website.home');

// Route::get('website', function () {
//     return view('frontend.layouts.master');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
