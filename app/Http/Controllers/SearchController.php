<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;
class SearchController extends Controller
{
     public function index(){
     return view('searchresult');
}

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
       $query = $request->get('query');
      $data = Produit::where('title', 'like', "%{$query}%")
        ->get();
      $output = '<div class="list-group">';
      foreach($data as $row)
      {
       $output .= '
       <a class="list-group-item list-group-item-action" href="/getproduit/'.$row->id.'">'.$row->title.'</a>
       ';
      }
      $output .= '</div>';
      echo $output;


     }
    }

    public function deepsearch(Request $req){

      $produits=Produit::where([['price','>=',$req->priceMin],['price','<=',$req->priceMax],['categorie_id','=',$req->catSearch]])->get();
      return view('searchresult',compact('produits'))->with([
          'categorie' => Categorie::find($req->catSearch)->title,
          'priceMin'=> $req->priceMin,
          'priceMax'=>$req->priceMax
      ]);
    }
}
