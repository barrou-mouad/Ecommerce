<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
class ProduitController extends Controller
{
    public function getbyid($id){
        $produits=Produit::where('categorie_id','=',$id)->get();
        return view('produits',compact('produits'));
    }
}
