<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';



    use Sluggable;

    protected $fillable = [
        'is_auth',
        'title',
        'description',
        'price',
        'category_id',
        'brand_id',
        'char_title',
        'char_value',
        'preview_image'
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function colors(){

        return $this->hasMany(ProductColor::class, 'product_id', 'id');

    }

    public function category(){
        return $this->hasOne('App\Model\Categories', 'id', 'category_id');
    }

    public function brand() {
        return $this->hasOne(Brands::class, 'id', 'brand_id');
    }

    /**
     * Get product params
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function params()
    {
        return $this->hasMany(ProductParam::class, 'product_id', 'id');
    }

    /**
     * Create or update params
     *
     * @param Request $request
     * @return void
     */
    public function setParams(Request $request)
    {
        $this->params()->delete();
        if ($request->has('params'))
        {
            $params = $request->get('params');
            foreach ($params as $param) {
                $this->params()->create($param);
            }
        }
    }

    public function uploadImage($image)
    {
        if($image == null) { return; }

        $this->removePreviewImage();
        $filename = str_random(10) . '.' . $image->extension();
        \Image::make($image)->widen(1200)->save(public_path() . '/uploads/product/' . $filename);
        \Image::make($image)->widen(300)->save(public_path() . '/uploads/product/catalog/' . $filename);
        $this->preview_image = $filename;
        $this->preview_image_catalog = $filename;
        $this->save();
    }

    private function uploadSideImage($image, string $field)
    {
        if (!$image) return;
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads/product/', $filename);
        $this->$field = $filename;
        $this->save();
    }

    public function uploadSidesImages($request)
    {
        if ($this->left_image && $request->has('left_image'))
            Storage::delete('uploads/product/'.$this->left_image);
        if ($this->front_image && $request->has('front_image'))
            Storage::delete('uploads/product/'.$this->front_image);
        if ($this->right_image && $request->has('right_image'))
            Storage::delete('uploads/product/'.$this->right_image);
        $this->uploadSideImage($request->file('left_image'), 'left_image');
        $this->uploadSideImage($request->file('front_image'), 'front_image');
        $this->uploadSideImage($request->file('right_image'), 'right_image');
    }



    public function getImage()
    {
        if($this->preview_image == null)
            return '/img/no-image.png';
        return '/uploads/product/' . $this->preview_image;
    }

    public function getCatalogImage()
    {
        if ($this->preview_image_catalog)
            return '/uploads/product/catalog/' . $this->preview_image_catalog;
        return '/img/no-image.png';
    }

    public function getLeftImage()
    {
        if ($this->left_image)
            return '/uploads/product/' . $this->left_image;
        return '/img/no-image.png';
    }

    public function getFrontImage()
    {
        if ($this->front_image)
            return '/uploads/product/' . $this->front_image;
        return '/img/no-image.png';
    }

    public function getRightImage()
    {
        if ($this->right_image)
            return '/uploads/product/' . $this->right_image;
        return '/img/no-image.png';
    }

    /**
     * Check if product has three sides images
     *
     * @return boolean
    */
    public function hasSidesImages()
    {
        return $this->left_image != null &&
            $this->right_image != null &&
            $this->front_image != null;
    }

    /**
     * Check if product has any color images
     *
     * @return boolean
    */
    public function hasAnyColorImages()
    {
        foreach ($this->colors as $color)
            if ($color->images()->count() > 0)
                return true;
        return false;
    }


    public function removePreviewImage()
    {
        if ($this->preview_image != null)
        {
            Storage::delete('uploads/product/' . $this->preview_image);
        }
    }

    public function getShortDescription()
    {
        return Str::limit($this->description, 150);
    }

    /**
     * Get all ancestors slugs from category and its ancestors and plus product slug
     *
     * @return string
    */
    public function getAncestorsSlugs()
    {
        $category = $this->category;
        $categoriesSlugs = ($category) ? $category->getAncestorsSlugs() : '';
        $slugs = $categoriesSlugs . "/$this->slug";
        return $slugs;
    }

    /**
     * Get all product images from colors
     *
     * @return array
    */
    public function getAllImages()
    {
        $images = collect();
        foreach ($this->colors as $color)
            foreach ($color->images as $image)
                $images->push($image);
        return $images;
    }

    public function getAllImagesWithPreview()
    {
        $images = collect();
        $images->push($this->getCatalogImage());
        foreach ($this->getAllImages() as $image)
            $images->push($image);
        return $images;
    }
}
