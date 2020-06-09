<?php

namespace App\Http\Controllers\Admin;

use App\Model\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('admin.pages.categories.index', compact(
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->where('parent_id', null)->get();
        return view('admin.pages.categories.create', compact(
            'categories'
        ));
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
            'ru_title' => 'required'
        ]);



        $category = Categories::create($request->all());
        $category->uploadImage($request->file('image'));

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function categories($id)
    {
        $categories = Categories::findOrFail($id)->children;

        return view('admin.pages.categories.categories', compact(
            'categories'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $categories = Categories::orderBy('id', 'desc')->where('parent_id', null)->get();

        return view('admin.pages.categories.edit', compact(
            'category', 'categories'
        ));
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

        $request->validate([
            'ru_title' => 'required'
        ]);

        $category = Categories::findOrFail($id);
        $category->update($request->all());
        $category->uploadImage($request->file('image'));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->removeImage();
        $category->delete();

        return redirect()->route('categories.index');
    }
}
