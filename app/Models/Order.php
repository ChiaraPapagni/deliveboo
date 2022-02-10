<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    //Relazione many to many
    //Un prodotto può essere in più ordini
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}