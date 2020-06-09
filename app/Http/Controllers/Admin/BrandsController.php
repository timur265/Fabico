<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Model\Brands;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brands::orderBy('id', 'desc')->get();
        return view('admin.pages.brands.index', compact(
            'brands'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brands.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBrandRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $brands = Brands::create($request->all());
        $brands->uploadImage($request->file('logotype'));

        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brands::findOrFail($id);
        return view('admin.pages.brands.edit', compact(
            'brand'
        ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBrandRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brands = Brands::findOrFail($id);
        $brands->update($request->all());
        $brands->uploadImage($request->file('logotype'));

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Brands::findOrFail($id);
        $brands->removeImage();

        $brands->delete();

        return redirect()->route('brands.index');
    }
}
