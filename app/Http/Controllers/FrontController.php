<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return redirect()->action('FrontController@cart');
    }

    public function test() {
    // echo "test";
        $product = Product::all();
        // echo"<pre>";print_r($product);echo"</pre>";exit;

    return view('test')->with('products', $product);
    }
    
    public function cart() {
    if (Request::isMethod('post')) {
        $product_id = Request::get('product_id');
        // echo $product_id;exit;
        $product = Product::find($product_id);

        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
    }

    // if (Request::get('product_id')) {
    //     $rowId = Cart::search(array('id' => Request::get('product_id')));
    //     $item = Cart::get($rowId[0]);
    //     Cart::remove($rowId);
    // }

    if (Request::get('product_id') && (Request::get('increment')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty + 1);
    }

    //decrease the quantity
    if (Request::get('product_id') && (Request::get('decrease')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty - 1);
    }

    $cart = Cart::content();
       // echo"<pre>";print_r($cart);echo"</pre>";exit;

    return view('cart')->with('cart',$cart);
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
        //
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
    public function update($product_id,$increment)
    {
        if ($increment=='increment') {
        // $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($product_id);

        Cart::update($product_id, $item->qty + 1);
        }

        if ($increment=='decrease') {
        // $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($product_id);

        Cart::update($product_id, $item->qty - 1);
        }
        $cart = Cart::content();
        return view('cart')->with('cart',$cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // echo "sewak";exit;
        Cart::destroy();
        $cart = Cart::content();
       // echo"<pre>";print_r($cart);echo"</pre>";exit;

    return view('cart')->with('cart',$cart);
    }

    public function delete($product_id)
    {
       
        Cart::remove($product_id);
       // echo"<pre>";print_r($cart);echo"</pre>";exit;
        $cart = Cart::content();
    return view('cart')->with('cart',$cart);
    }
}
