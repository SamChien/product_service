<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proArr = Products::orderBy('id')->get();
        foreach ($proArr as $pro) {
            $this->changeColsToOutFormat($pro);
        }
        return response()->json($proArr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cols = Schema::getColumnListing('products');
        unset($cols[0]);
        unset($cols[8]);
        unset($cols[9]);
        return response()->json(array_values($cols));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pros = new Products;
        $pros->name = $request->input('name');
        $pros->colors = $request->input('colors');
        $pros->sizes = $request->input('sizes');
        $pros->content = $request->input('content');
        $pros->price = $request->input('price');
        $pros->picture = $request->input('picture');
        $pros->seller_id = $request->input('seller_id');
        $pros->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pro = Products::find($id);
        $this->changeColsToOutFormat($pro);
        return response()->json($pro);
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

    public function getProductsByName($proName) {
        $proArr = Products::where('name', 'like', "%$proName%")->orderBy('id')->get();
        foreach ($proArr as $pro) {
            $this->changeColsToOutFormat($pro);
        }
        return response()->json($proArr);
    }

    private function changeColsToOutFormat($pro) {
        $pro['colors'] = json_decode($pro['colors']);
        $pro['sizes'] = json_decode($pro['sizes']);
        $pro['price'] =  '$' . number_format($pro['price'], 2);
    }
}
