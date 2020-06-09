<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductParam extends Model
{
    protected $fillable = [
        'name', 'value', 'product_id'
    ];
}
