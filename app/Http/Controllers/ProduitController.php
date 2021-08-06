<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;
class ProduitController extends Controller
{
    public function getbyid($id){
        $produit=Produit::find($id);
        return view('produit',compact('produit'));
    }
    public function getbycat($id){
        $produits=Produit::where('categorie_id','=',$id)->paginate(1);

        return view('welcome')->with([
            'produits'=>$produits,
            'categories'=>Categorie::all()
        ]);
    }

}
