<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = ['product_id'];

    /**
     * Reference for product color
     * 
     */
    public function color()
    {
        return $this->hasOne(ProductColor::class, 'id', 'product_color_id');
    }

    public function uploadImage($image)
    {

        if($image == null) { return; }
        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        \Image::make($image)->widen(1200)->save(public_path() . '/uploads/product/' . $filename);
        \Image::make($image)->widen(300)->save(public_path() . '/uploads/product/catalog/' . $filename);
        $this->img = $filename;
        $this->img_catalog = $filename;
        $this->save();
    }

    public function getImage()
    {
        if($this->img == null)
        {
            return '/img/no-image.png';
        }
        return '/uploads/product/' . $this->img;
    }

    public function getCatalogImage()
    {
        if ($this->img_catalog)
            return '/uploads/product/catalog/' . $this->img_catalog;
        return '/img/no-image.png';
    }

    public function removeImage()
    {
        if ($this->img != null)
        {
            Storage::delete('uploads/product/' . $this->img);
        }
    }

    /**
     * Override delete method to delete image too
     *
     * @return void
     * @throws \Exception
     */
    public function delete()
    {
        $this->removeImage();
        parent::delete();
    }
}
