<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends BaseShopController
{
    public function index() {
        return view('shop.order.index');
    }

    public function payment(Request $request) {
        $taking_method = $request->taking_method;
        $address = $request->address;
        return view('shop.order.payment', compact('taking_method','address'));
    }

    public function order (Request $request) {
        $order = new Order();
        $order->taking_method = $request->taking_method;
        $order->address = $request->address;
        $order->date = date('Y-m-d');
        $order->status = 'Доставлен';
        $order->user_id = Auth::user()->id;
        $order->save();
    }
}
