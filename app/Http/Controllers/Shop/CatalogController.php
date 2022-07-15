<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commodity;

class CatalogController extends BaseShopController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $items = Category::all()->where('parent_id', null);
        return view('shop.catalog.index', compact('items'));
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
    public function show($name)
    {
        $category = Category::get()->where('name', $name)->first();
        $child_categories_count = Category::where('parent_id', $category->id)->count();
        if ($child_categories_count>0) {
            $child_category_check = true;
            $items = Category::all()->where('parent_id', $category->id);
        }
        else {
            $child_category_check = false;
            $items = Commodity::all();
        }
        return view('shop.catalog.show', compact('child_category_check','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

    public function load()
    {
        return view('shop.load');
    }

    public function search (Request $request) {

    }
}
