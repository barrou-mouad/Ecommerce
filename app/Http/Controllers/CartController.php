<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class CartController extends Controller
{
public function index(){
    $items=\Cart::getContent();
    return view('cart',compact('items'));
}
public function addProductToCart($id,$qty){
     $produ=Produit::find($id);

      \Cart::add(array(
          'id'=> $produ->id,
          'name' => $produ->title,
          'price' => $produ->price,
          'quantity' => $qty,
          'attributes' => array(),
          'associatedModel' => $produ
      ));
     return \Cart::getContent();
    }
public function removeItembyId($id){
    \Cart::remove($id);
    return back();
}
public function edit(Request $req){

    \Cart::update($req->id, array(
        'quantity' => array(
            'relative' => false,
            'value' => $req->qty
        ),
      ));
      return redirect()->route('mycart');
}
}
