<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Produit;
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
    return view('welcome')->with([
        'categories'=> Categorie::all(),
        'produits' => Produit::paginate(1)
    ]);
})->name('index');

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
Route::get('/getproduits/{id}', [ProduitController::class, 'getbycat'])->name('getProdByCat');
Route::get('/getproduit/{id}', [ProduitController::class, 'getbyid'])->name('getProdById');
Route::get('/cart', [CartController::class, 'index'])->name('mycart');
Route::get('/addcart/{id}/{qty}', [CartController::class, 'addProductToCart'])->name('adtocart');
Route::get('/removecart/{id}', [CartController::class, 'removeItembyId'])->name('removefromcart');
Route::post('/editcart', [CartController::class, 'edit'])->name('editcart');
Route::get('/like/{id}', [LikeController::class, 'like'])->name('like')->middleware('auth:web');
Route::get('/likes', [LikeController::class, 'index'])->name('favorite')->middleware('auth:web');
Route::get('/dislike/{id}', [LikeController::class, 'dislike'])->name('dislike')->middleware('auth:web');
// Payement By Paypal
Route::get('payer/',[PaymentController::class,'handelPayment'])->name('payer');
Route::get('cancelpayer/',[PaymentController::class,'cancelPayement'])->name('cancelPayement');
Route::get('successpayer/',[PaymentController::class,'successPayement'])->name('successPayement');
Route::get('contact',function(){
    return view('contact.formulaire');
});
Route::get('/sendemail', [ContactController::class,'create']);
