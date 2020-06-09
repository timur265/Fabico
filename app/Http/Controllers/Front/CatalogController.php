<?php

namespace App\Http\Controllers\Front;

use App\Model\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    /**
     * A main action for all catalog actions
     *
     * @param Request $request
     * @param string $params
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request, string $params)
    {
        $paramsArray = explode('/', trim($params, '/'));
        $slug = end($paramsArray);

        $brand = Brands::where('slug', '=', $slug)->first();
        if ($brand)
            return $this->processBrand($request, $brand);
        $category = Categories::where('slug', '=', $slug)->first();
        if ($category)
            return $this->processCategory($request, $category);
        $product = Product::where('slug', '=', $slug)->first();
        if ($product)
            return $this->processProduct($product);
        abort(404);
    }

    private function processCategory(Request $request, Categories $category)
    {
        $data = [
            'products' => $category->getAllProducts($request->get('price_order')),
            'category' => $category,
            'brands' => Brands::all(),
            'catalogType' => 'category'
        ];
        return view('front.catalog.index', $data);
    }

    private function processProduct(Product $product)
    {
        return view('front.catalog.product', compact('product'));
    }

    private function processBrand(Request $request, Brands $brand)
    {
        $query = $brand->products();
        if ($request->has('price_order'))
            $query = $query->orderBy('price', $request->get('price_order'));
        if (!Auth::check())
            $query = $query->where('is_auth', false);
        $data = [
            'products' => $query->get(),
            'brand' => $brand,
            'brands' => Brands::all(),
            'catalogType'=> 'brand'
        ];
        return view('front.catalog.index', $data);
    }
}
