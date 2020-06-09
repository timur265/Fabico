<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Order;
use App\Model\Contact;
use App\Mail\OrderConfirmed;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return view('front.catalog.cart');
    }

    public function addToCart(Request $request) {
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $colorHex = $request->get('colorHex');
        $colorName = $request->get('colorName');

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $productId => [
                    "name" => $product->title,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "photo" => $product->getCatalogImage(),
                    'colorName' => $colorName,
                    'colorHex' => $colorHex
                ]
            ];
            session()->put('cart', $cart);
        }
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
            session()->put('cart', $cart);
        }

        $cart[$productId] = [
            "name" => $product->title,
            "quantity" => $quantity,
            "price" => $product->price,
            "photo" => $product->getCatalogImage(),
            'colorName' => $colorName,
            'colorHex' => $colorHex
        ];
        session()->put('cart', $cart);
    }

    public function removeFromCart(Request $request) {
        if ($request->has('productId')) {
            $cart = session()->get('cart');
            if (isset($cart[$request->get('productId')])) {
                unset($cart[$request->get('productId')]);
                session()->put('cart', $cart);
            }
        }
    }

    public function update(Request $request) {
        if (!$request->has('productId') || !$request->has('quantity'))
            abort(401);
        $cart = session()->get('cart');
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }

    public function createOrder(Request $request) {
        if ($request->has('makeContract')) {
            Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'phone_number' => ['required', 'string'],
                'company_name' => ['required', 'string', 'unique:registration_requests'],
                'bank' => ['required', 'string'],
                'address' => ['required', 'string'],
                'tin' => ['required', 'string', 'min:9', 'max:9'],
                'ctea' => ['required', 'string', 'min:5', 'max:5'],
                'mfi' => ['required', 'string', 'min:5', 'max:5'],
            ])->validate();
            $order = Order::create($request->all());
        } else {
            Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'phone_number' => ['required', 'string']
            ])->validate();
            $order = Order::create([
                'name' => $request->get('name'),
                'phone_number' => $request->get('phone_number'),
                'email' => $request->get('email'),
                'comment' => $request->get('comment'),
                'user_id' => \Auth::check() ? auth()->user()->id : null
            ]);
        }
        foreach (session()->get('cart') as $productId => $details) {
            $orderItem = $order->orderItems()->create([
                'title' => $details['name'],
                'price' => $details['price'],
                'quantity' => $details['quantity'],
                'product_id' => $productId,
                'preview_image' => '',
                'color_name' => $details['colorName'],
                'color_hex' => $details['colorHex']
            ]);
            $orderItem->uploadImage($details['photo']);
        }
        session()->forget('cart');
        $adminEmail = Contact::find(1)->email;
        Mail::send(new OrderConfirmed($order, $adminEmail));
        Mail::send(new NewOrderNotification($order, $adminEmail));
        return view('front.catalog.confirm', compact('order'));
    }
}
