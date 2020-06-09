<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('admin.pages.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'new')
        {
            $order->status = 'viewed';
            $order->save();
        }
        return view('admin.pages.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.index');
    }

    /**
     * Change status of the order
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, int $id) {
        if (!$request->has('status'))
            abort(400);
        $order = Order::findOrFail($id);
        $order->status = $request->get('status');
        $order->save();
        return redirect()->back();
    }
}
