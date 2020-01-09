<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Product;
use App\Status;
use Illuminate\Http\Request;
use Str;
use Auth;
use Session;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $transactions = Transaction::whereIn('user_id', [$user_id])->get();

        return view('transactions.index')->with('transactions',$transactions)->with('statuses',Status::all());
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
        // transaction table: transaction code /user_id/

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->transaction_code = Auth::user()->id . Str::random(10);

        $transaction->save();

        $product_ids = array_keys(Session::get('cart'));
        $products = Product::find($product_ids);
        $total = 0;
        foreach($products as $product) {
            $product->quantity = Session::get("cart.$product->id");
            $product->subtotal = $product->price * $product->quantity;
            $total += $product->subtotal;

            $transaction->products()
            ->attach(
                $product->id,
                [
                    'quantity'=> $product->quantity, 
                    'subtotal' => $product->subtotal,
                    'price' => $product->price
            ]);
        }

        $transaction->total = $total;
        $transaction->save();

        Session::forget('cart');


        // pivot table: product_id/transaction_id/quantity/subtotal
        return redirect(route('transactions.show',['transaction' => $transaction->id]));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        return view('transactions.show')->with('transaction',$transaction)->with('statuses',Status::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $status = $request->status;
        $transaction->status_id = $status;
        $transaction->save();
        $request->session()->flash('status','Status update successful');
        return redirect(route('transactions.show',['transaction' => $transaction->id]));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
