<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
public function handelPayment(){
$data=$this->getdata();
$provider = new ExpressCheckout;
$response = $provider->setExpressCheckout($data);

// Use the following line when creating recurring payment profiles (subscriptions)
$response = $provider->setExpressCheckout($data, true);
return redirect($response['paypal_link']);
    }
public function cancelPayement(){
    return redirect()->route('index');
}
public function successPayement(Request $req){
    $paypalModule=new ExpressCheckout;
    $response=$paypalModule->getExpressCheckoutDetails($req->token);
    $response = $paypalModule->doExpressCheckoutPayment($this->getdata(), $req->token, $req->PayerID);
    if(in_array($response['ACK'],['Success'])){
        foreach(\Cart::getContent() as $item){
      Commande::create(
          [
              'user_id'=> Auth::id(),
              'produit_id' =>$item->id  ,
              'qty'=>  $item->quantity,
              'total'=>  $item->quantity * $item->price
          ]

          );
          $produit= Produit::find($item->id);
          $produit->in_stock=(int) $produit->in_stock - (int) $item->quantity;
          $produit->save();
            }

    \Cart::Clear();
    return redirect()->route('index');
    }
    else{
        return redirect()->route('index')->with(['error'=>'le payement n\' est pas bien réusssi ']);
    }

}
public function getdata(){
    $data = [];
    $data['items'] = [
    /*     [
            'name' => 'Product 1',
            'price' => 9.99,
            'desc'  => 'Description for product 1',
            'qty' => 1
        ] */
    ];
    foreach(\Cart::getContent() as $item){
    array_push($data['items'],[
        'name' =>$item->name,
        'price' =>$item->price,
        'desc'=> $item->associatedModel->desc,
        'qty' =>$item->quantity
    ]);
    }

    $data['invoice_id'] = uniqid();
    $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
    $data['return_url'] = route('successPayement');
    $data['cancel_url'] = route('cancelPayement');

    $total = 0;
    foreach($data['items'] as $item) {
        $total += $item['price']*$item['qty'];
    }
    $data['total'] = $total;
    return $data;
}
}








