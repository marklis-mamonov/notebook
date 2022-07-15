<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\Commodity;

class BasketController extends BaseShopController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $comid = $request->session()->get('comid_basket');
        $comcount = $request->session()->get('comcount_basket');
        if (isset($comid[0])) {
            for ($i=0; $i<count($comid); $i++) {
                $items[$i] = Commodity::get()->where('id', $comid[$i])->first();
                $items[$i]['count'] = $comcount[$i];
            }
        }
        else {
            $items = false;
        }
        return view('shop.basket', compact('items'));
    }

    public function segment($id)
    {
        
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
        //
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
        //
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

    public function addInBasket(Request $request)
    {
        $comid = $request->session()->get('comid_basket');
        if (isset($comid[0])) {
            $comid_count = count($comid);
            $key = array_search($request['id'], $comid);
            if (is_numeric($key))
            {
            $comcount = $request->session()->get('comcount_basket');
            $comcount[$key] = $comcount[$key] + $request['count'];
            $request->session()->forget('comcount_basket');
            for($i=0;$i<$comid_count;$i++)
            {
                $request->session()->push('comcount_basket', $comcount[$i]);
            }
            }
            else
            {
                $request->session()->push('comid_basket', $request['id']);
                $request->session()->push('comcount_basket', $request['count']);
            }
            return $data = $comcount;
        }
        else {
            $request->session()->push('comid_basket', $request['id']);
            $request->session()->push('comcount_basket', $request['count']);
            return $data = $_POST['id'];
        }
        
    }
}
