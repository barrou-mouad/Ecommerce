<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashbord',[AdminController::class, 'index'])->name('admin.dashbord')->middleware('auth:admin');
    Route::get('/', function () { return view('admin.login');})->name('admin.loginpage');
    Route::post('/auth',[AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout',[AdminController::class, 'logout'])->name('admin.logout');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add', [AdminController::class, 'create']);
Route::get('/getcategories', [CategorieController::class, 'getall']);
Route::get('/getproduits/{id}', [ProduitController::class, 'getbyid']);
