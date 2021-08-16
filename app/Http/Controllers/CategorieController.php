<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
class CategorieController extends Controller
{
   public function getall(){
       $categories=Categorie::all();
       return view('categories',compact('categories'));
   }
   public function add(Request $req){
   Categorie::create([
   'title' => $req->title
   ]);
   return redirect()->route('admin.catlist');
   }
   public function update(Request $req){
   $categorie=Categorie::find($req->id);
   $categorie->title=$req->title;
   $categorie->save();
   return redirect()->route('admin.catlist');
   }
   public function delete($id){
    Categorie::find($id)->delete();
    return redirect()->route('admin.catlist');
   }

}
