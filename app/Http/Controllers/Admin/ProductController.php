<?php

namespace App\Http\Controllers\Admin;

use App\Model\Categories;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\ProductColor;
use App\Model\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->where('parent_id', null)->get();
        $brands = Brands::all();
        return view('admin.pages.products.create', [
            'category' => [],
            'categories' => $categories,
            'delimiter' => '',
            'brands' =>  $brands
        ]);
    }


    public function removeGalleryImage($image_id, $product_id)
    {
        $image = ProductImage::findOrFail($image_id);
        $image->removeImage();
        $image->delete();

        return redirect()->route('products.edit', $product_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ru_title' => 'required',
            'ru_description' => 'required',
            'category_id' => 'required',
            'preview_image' =>  'nullable|image',
            'price' => 'required'
        ]);
        $data = $request->all();
        $product = Product::create([
            'title' => $data['ru_title'],
            'is_auth' => $request->has('is_auth') ? true : false,
            'description' => $data['ru_description'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'brand_id' => $data['brand_id'],
            'preview_image' => ''
        ]);

        $product->setParams($request);

        $product->uploadImage($request->file('preview_image'));
        $product->uploadSidesImages($request);

        if ($request->has('colors')) {
            $this->createColorsForProductFromRequest($product, $request);
        }
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::orderBy('id', 'desc')->where('parent_id', null)->get();
        $brands = Brands::orderBy('id', 'desc')->get();
        $common = [];
        if($product->ru_characteristics_title != null){
            $first = unserialize(urldecode($product->ru_characteristics_title));
            try{
                $second = unserialize(urldecode($product->ru_characteristics_value));
            }catch(\Exception $e){
                $second = '';
            }
            $common = [$first, $second];
        }
        return view('admin.pages.products.edit', [
            'categories' => $categories,
            'product' => $product,
            'delimiter' => '',
            'common' => $common,
            'brands' => $brands
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $product = Product::find($id);

        $product->update([
            'is_auth' => $request->has('is_auth') ? true : false,
            'title' => $data['ru_title'],
            'description' => $data['ru_description'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'brand_id' => $data['brand_id']
        ]);


        $product->setParams($request);

        $product->uploadImage($request->file('preview_image'));
        $product->uploadSidesImages($request);

        if(!$request->has('colors'))
            $product->colors()->delete();
        else {
            $colors = $request->get('colors');
            $productColors = $product->colors;
            foreach ($productColors as $key => $productColor) {
                if (!isset($colors[$key]))
                    ProductColor::destroy($productColor->id);
                else {
                    $productColor->name = $colors[$key]['name'];
                    $productColor->colorHEX = $colors[$key]['hex'];
                    $productColor->save();
                    if ($request->has("color-images-$key")) {
                        $productColor->images()->delete();
                        foreach ($request->file("color-images-$key") as $image) {
                            $productImage = $productColor->images()->create();
                            $productImage->uploadImage($image);
                        }
                    }
                }
            }
            foreach ($colors as $key => $color) {
                if (!isset($productColors[$key])) {
                    $productColor = $product->colors()->create([
                        'name' => $color['name'],
                        'colorHEX' => $color['hex']
                    ]);
                    $productColor->save();
                    if ($request->has("color-images-$key")) {
                        foreach ($request->file("color-images-$key")  as $image) {
                            $productImage = $productColor->images()->create();
                            $productImage->uploadImage($image);
                        }
                    }
                }
            }
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->removePreviewImage();
        $product->colors()->delete();
        $product->params()->delete();
        $product->delete();
        return redirect()->back();
    }

    private function createColorsForProductFromRequest(Product $product, Request $request) {
        $colors = $request->get('colors');
        foreach ($colors as $number => $color) {
            $productColor = $product->colors()->create([
                'name' => $color['name'],
                'colorHEX' => $color['hex']
            ]);
            if ($request->has("color-images-$number")) {
                $images = $request->file("color-images-$number");
                foreach ($images as $image) {
                    $productImage = $productColor->images()->create();
                    $productImage->uploadImage($image);
                }
            }
        }
    }
}
