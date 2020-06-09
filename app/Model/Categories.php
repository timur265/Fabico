<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class Categories extends Model
{
    use Sluggable , NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }



    protected $fillable = [
        'ru_title',
        'ru_description',
        'parent_id',
    ];

    public function uploadImage($image)
    {
        if($image == null) return;

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function removeImage()
    {
        if($this->image != null)
            Storage::delete('uploads/' . $this->image);
    }

    public function getImage()
    {
        if($this->image != null)
            return '/uploads/' . $this->image;
        else
            return asset('assets/img/avatars/avatar9.jpg');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Categories', 'parent_id', 'id');
    }

    public function hasChildren()
    {
        return (isset($this->children[0])) ? true : false;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * Get all ancestors slugs as url string
     *
     * @return string
    */
    public function getAncestorsSlugs()
    {
        $slugs = $this->ancestors()->pluck('slug');
        $slugs[] = $this->slug;
        return implode("/", $slugs->toArray());
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'ru_title'
            ]
        ];
    }

    /**
     * Get all products include from descendants
     *
     * @return \Illuminate\Support\Collection
    */
    public function getAllProducts($orderByPrice = null)
    {
        $categories = $this->descendants()->pluck('id');
        $categories[] = $this->getKey();
        $productQuery = Product::whereIn('category_id', $categories);
        $user = auth()->user();
        if (!$user || ($user && !$user->hasRole('admin') && !$user->confirmed))
            $productQuery = $productQuery->where('is_auth', false);
        if ($orderByPrice)
            $productQuery = $productQuery->orderBy('price', $orderByPrice);
        return $productQuery->get();
    }

    /**
     * Get N last products
     *
     * @param int $count
     * @return \Illuminate\Support\Collection
    */
    public function getLastProducts(int $count)
    {
        $categories = $this->descendants()->pluck('id');
        $categories[] = $this->getKey();
        $productQuery = Product::whereIn('category_id', $categories);
        $user = auth()->user();
        if (!$user || ($user && !$user->hasRole('admin') && !$user->confirmed))
            $productQuery->where('is_auth', false);
        return $productQuery->orderBy('created_at', 'desc')->take($count)->get();
    }
}
