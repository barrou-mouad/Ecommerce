<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Commande;
use App\Models\Categorie;
class Produit extends Model
{
    use HasFactory;
    public function likes(){
        return $this->HasMany(Like::class);
    }
    public function commandes(){
        return $this->HasMany(Commande::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
