<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
class Produit extends Model
{
    use HasFactory;
    public function likes(){
        return $this->HasMany(Like::class);
    }
}
