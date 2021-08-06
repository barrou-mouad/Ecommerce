<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;
class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'produit_id',
  
    ];
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
