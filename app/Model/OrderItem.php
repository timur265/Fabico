<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderItem extends Model
{
    protected $fillable = [
        'title',
        'price',
        'quantity',
        'product_id',
        'preview_image',
        'color_name',
        'color_hex'
    ];

    public function uploadImage($image)
    {
        if($image == null) { return; }

        $filename = str_random(10) . '.' . pathinfo($image, PATHINFO_EXTENSION);
        Storage::copy($image, '/uploads/orders/'.$filename);
        $this->preview_image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if(!$this->preview_image)
            return '/img/no-image.png';
        return '/uploads/orders/' . $this->preview_image;
    }

}
