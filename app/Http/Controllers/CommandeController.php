<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
class CommandeController extends Controller
{

    public function getBycategorie($id){
        return Commande::where('categorie_id','=',$id)->get();
    }
}
