<?php

namespace App\Http\Controllers;

use App\Model\Categories;
use App\Model\Slider;
use App\Model\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::all();
        $products = Categories::findOrFail(3)->getLastProducts(8);
        return view('front.welcome', compact('sliders', 'products'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function createFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);
        Feedback::create($request->all());
        return redirect()->back();
    }
}
