<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ProduitController extends Controller
{
    public function getbyid($id){
        $produit=Produit::find($id);
        return view('produit',compact('produit'));
    }

    public function getbycat($id){
        $produits=Produit::where('categorie_id','=',$id)->paginate(4);
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
            'produits'=>$produits,
            'categories'=>Categorie::all(),
            'favorites'=> $res,
            'reduction' => Produit::where('old_price','>',0)->latest()->paginate(5)
        ]);
    }
public function getlast(){

      $likes= Like::groupByRaw('produit_id')->paginate(5)->produit;
               $orders = DB::table('likes')
                ->select(DB::raw('count(*) as favorite_count, produit_id'))
                ->groupByRaw('produit_id')
                ->orderBy('favorite_count','desc')
                ->paginate(5);

                $res=array();
                foreach ($orders as $user) {
                 array_push($res,Produit::where('id','=',$user->produit_id)->get());
                }
                return $res;
}
public function fetch_data(Request $request,$cat)
{
 if($request->ajax())
 {
     if($cat==0){

      $produits=  Produit::latest()->paginate(4);
     }
     else{
        $produits = Produit::where('categorie_id','=',$cat)->paginate(4);
     }

    return view('produits', compact('produits'))->render();
 }
}
public function add(Request $req){
    $produit=new Produit();
    $produit->title=$req->title;
    $produit->desc=$req->desc;
    $produit->price=$req->price;
    $produit->in_stock=$req->in_stock;
    $produit->categorie_id=$req->categorie_id;
    if ($req->hasFile('img')) {
        $name=time().'.'.$req->img->getClientOriginalExtension();
        $req->img->move(public_path('images'),$name);
        $produit->image=$name;
    }
    $produit->save();
return redirect()->route('admin.prodlist');

}
public function update(Request $req){
    $produit=Produit::find($req->id);
    $produit->title=$req->title;
    $produit->desc=$req->desc;
    $produit->categorie_id=$req->categorie_id;
    if($produit->price!=$req->price)
    $produit->old_price=$produit->price;
    $produit->price=$req->price;
    if ($req->hasFile('img')) {

        if (File::exists(public_path('images/'.$produit->image))) {
            //File::delete($image_path);
            unlink(public_path('images/'.$produit->image));
        }
        $name=time().'.'.$req->img->getClientOriginalExtension();
        $req->img->move(public_path('images'),$name);
        $produit->image=$name;



}
$produit->save();
return back();
}
public function delete($id){
    $produit=Produit::find($id);
    if (File::exists(public_path('images/'.$produit->image))) {
        //File::delete($image_path);
        unlink(public_path('images/'.$produit->image));
    }
    $produit->delete();

   return redirect()->route('admin.prodlist');
}}
