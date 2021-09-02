<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    $favorites = DB::table('likes')
    ->select(DB::raw('count(*) as favorite_count, produit_id'))
    ->groupByRaw('produit_id')
    ->orderBy('favorite_count','desc')
    ->paginate(5);
    $res=array();
    foreach ($favorites as $favorite) {
     array_push($res,Produit::where('id','=',$favorite->produit_id)->get()->first());
    }
    return view('welcome')->with([
        'categories'=> Categorie::all(),
        'produits' => Produit::latest()->paginate(4),
        'favorites'=> $res,
        'reduction' => Produit::where('old_price','>',0)->latest()->paginate(5)
    ]);
})->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/', function () { return view('admin.login');})->name('admin.loginpage');
    Route::post('/auth',[AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashbord',[AdminController::class, 'index'])->name('admin.dashbord');
        Route::get('/statistique', [CommandeController::class, 'indexStatistic'])->name('admin.statistic');
        Route::get('/catlist', function () {  return view('admin.catlist')->with(['cat'=>Categorie::all()]);})->name('admin.catlist');
        Route::get('/userlist', function () {  return view('admin.uselist')->with(['user'=>User::all()]);})->name('admin.userlist');
        Route::get('/prod-list', function () {  return view('admin.prodlist')->with(['produit'=>Produit::all()]);})->name('admin.prodlist');
        Route::get('/user-delete/{id}', function ($id) { User::find($id)->delete();  return redirect()->route('admin.userlist');})->name('admin.userdelete');

        Route::post('/logout',[AdminController::class, 'logout'])->name('admin.logout');
        Route::post('/addcat',[CategorieController::class, 'add'])->name('admin.addcat');
        Route::post('/cat-update',[CategorieController::class, 'update'])->name('admin.catupdate');
        Route::post('/prod-update',[ProduitController::class, 'update'])->name('admin.produpdate');
        Route::post('/user-update',[UserController::class, 'updateFromAdmin'])->name('admin.userupdate');
        Route::get('/delete-cat/{id}',[CategorieController::class, 'delete'])->name('admin.deletecat');
        Route::get('/delete-prod/{id}',[ProduitController::class, 'delete'])->name('admin.deleteprod');
        Route::get('/edit-cat/{id}',[CategorieController::class,function ($id) {  return view('admin.catedit')->with(['cat'=>Categorie::find($id)]);} ])->name('admin.editcat');
        Route::post('/cmd-adddate',[CommandeController::class, 'insertdate'])->name('admin.add_date');
        Route::post('/cmd-update',[CommandeController::class, 'update'])->name('admin.cmdupdate');
        Route::post('/prod-add',[ProduitController::class, 'add'])->name('admin.addprod');
        Route::get('/add-prod',[ProduitController::class,function () {  return view('admin.prodadd')->with(['categories'=>Categorie::all()]);} ])->name('admin.prodadd');
        Route::get('/commande-list',[CommandeController::class,'getcomd'])->name('admin.cmdlist');
        Route::get('/edit-prod/{id}',[CategorieController::class,function ($id) {  return view('admin.prodedit')->with(['categories'=>Categorie::all(),'produit'=>Produit::find($id)]);} ])->name('admin.editprod');
        Route::get('/prod/{id}',[CategorieController::class,function ($id) {  return view('admin.prod')->with(['produit'=>Produit::find($id)]);} ])->name('admin.prodetails');
        Route::get('/cmd-edit/{id}',[CommandeController::class,function ($id) {  return view('admin.cmdedit')->with(['cmd'=>Commande::find($id)]);} ])->name('admin.cmdedit');
        Route::get('/del-cmd/{id}',[CommandeController::class,'delete'])->name('admin.deletecmd');

        // CRUD USERS
        Route::get('user-edit/{id}',[UserController::class,function ($id) {  return view('admin.useredit')->with(['user'=>User::find($id)]);} ])->name('admin.useredit');
        Route::get('user-add',[UserController::class,function () {  return view('admin.useradd');} ])->name('admin.useradd');
        Route::post('add-user',[UserController::class,'add'])->name('admin.adduser');
    });

});




Auth::routes();
Route::get('pagination/fetch_data/{cat}',[ProduitController::class,'fetch_data']);
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
Route::get('payer/',[PaymentController::class,'handelPayment'])->name('payer')->middleware('auth:web');
Route::get('cancelpayer/',[PaymentController::class,'cancelPayement'])->name('cancelPayement')->middleware('auth:web');
Route::get('successpayer/',[PaymentController::class,'successPayement'])->name('successPayement')->middleware('auth:web');
// Contact Us
Route::get('contact',function(){
    return view('contact.formulaire');
});
Route::post('/sendemail', [ContactController::class,'create'])->name('send');
// Search
Route::post('/deepsearch', [SearchController::class,'deepsearch'])->name('deepsearch');
Route::post('/search',[SearchController::class,'fetch'] )->name('autocomplete.fetch');

Route::middleware('web')->group(function () {
    Route::get('/user/commandes', [UserController::class, 'commandes'])->name('mycommandes');
    Route::get('/user/userEdit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/setting', [UserController::class, 'settingpage'])->name('user.setting');
    Route::get('/user/passwordEdit', [UserController::class, 'editpassword'])->name('user.editpassword');
    Route::post('/user/updatepassword', [UserController::class, 'updatepassword'])->name('user.updatepassword');
    Route::post('/user/updateuser', [UserController::class, 'update'])->name('user.upadte');
});
