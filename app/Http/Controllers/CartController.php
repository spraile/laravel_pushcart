<?php

namespace App\Http\Controllers;
use App\Product;

use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('cart')){
        // get all ids of cart session
            $product_ids = array_keys(Session::get('cart'));
        // query on database
            $products = Product::find($product_ids);
            $total = 0;
            foreach ($products as $product) {
                $product->quantity = Session::get("cart.$product->id");
                $product->subtotal = $product->price * $product->quantity;
                $total += $product->subtotal;
            }
            return view('carts.index')->with('products',$products)->with('total',$total);
        } else {
            return view('carts.index');
        }


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
    public function update(Request $request, $cart)
    {
        $request->validate([
            'quantity' => 'required|min:1'

        ]);
        $quantity = $request->input('quantity');
        // store to session_abort()

        $request->session()->put("cart.$cart", $quantity);
        // dd(Session::get('cart'));
        return redirect(route('carts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cart)
    {
        // Session::forget("cart.$cart");

        $request->session()->forget("cart.$cart");
        if(count($request->session()->get('cart')) == 0) {
            $request->session()->forget('cart');
        }

        return redirect(route('carts.index'))->with('status','Product removed from cart');
    }

    public function empty()
    {
        Session::forget('cart');
        return redirect(route('carts.index'))->with('status','Cart has been cleared');

    }
}
