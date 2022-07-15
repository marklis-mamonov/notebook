<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedCommodity;
use App\Models\Commodity;
use Illuminate\Support\Facades\Auth;

class CabinetController extends BaseShopController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::all()->where('user_id', Auth::user()->id);
        foreach ($orders as $order)  {
            $ordered_commodities = $order->ordered_commodities()->get();
            foreach ($ordered_commodities as $ordered_commodity)  {
                $commodities[] = $ordered_commodity->commodity()->get();
                $commodities[array_key_last($commodities)][0]['count'] = $ordered_commodity->count;
            }
            $order['commodities'] = $commodities;
        }
        return view('shop.cabinet.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::find($id);
        return view('shop.cabinet.edit', compact('item'));
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
        $item = User::find($id);
        $data = $request->all();
        $result = $item->update($data);
        return view('shop.cabinet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
