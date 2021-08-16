<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'produit_id',
        'total',
        'qty',

    ];

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
