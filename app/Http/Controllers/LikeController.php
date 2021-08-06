<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index(){
       $likes= Like::where('user_id','=',Auth::user()->id)->get();
      return view('favourite',compact('likes'));
    }
    public function like($id){
        $likes=Like::where([['user_id','=',Auth::id()],['produit_id','=',$id]])->get()->first();
        if($likes==null){
      /*       $like=new Like();
            $like->produit_id=$id;
            $like->user_id=Auth::user()->id;
            $like->save(); */
            Like::create(['produit_id'=>$id,'user_id' =>Auth::user()->id]);
        }

        return back();
    }
    public function dislike($id){
      $produit=Like::where([['user_id','=',Auth::id()],['produit_id','=',$id]])->get()->first();
      $produit->delete();
      return back();
    }
}
