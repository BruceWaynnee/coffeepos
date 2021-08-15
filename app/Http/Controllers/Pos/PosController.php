<?php

namespace App\Http\Controllers\Pos;

use App\Category;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all category records
        $categories = Category::getCategories();
        if(!$categories->data){
            return view('pos/index')->with('error', $categories->message);
        }
        $categories = $categories->data;        

        // get all product records
        $products = Product::getProducts();
        if(!$products->data){
            return view('pos/index')->with('error', $products->message);
        }
        $products = $products->data;

        // get all customer records
        $customers = Customer::getCustomers();
        if(!$customers->data){
            return view('pos/index')->with('error', $customers->message);
        }
        $customers = $customers->data;

        return view( 'pos/index', compact('categories', 'products', 'customers') );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
