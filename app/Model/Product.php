<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductGalerie;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function galeries()
    {
        return $this->hasMany(ProductGalerie::class);
    }
}
