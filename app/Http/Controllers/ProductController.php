<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('category');
        if($filter) {
            $products = Product::all()->whereIn('category_id', $filter);
            
        }
        else{
            $products = Product::all();
        }
        $categories = Category::all();
        return view('products.index')->with('products',$products)->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $this->authorize('create',$product);
        $categories = Category::all();
        return view('products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create',$product);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category-id' => 'required',
            'description' => 'required|string',
            'image' => 'required|image|max:5000'
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category-id');
        $product->description = $request->input('description');
        $product->image = $request->image->store('products');

        $product->save();

        return redirect( route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update',$product);

        $categories = Category::all();
        return view('products.edit')->with('product',$product)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update',$product);

         $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category-id' => 'required',
            'description' => 'required|string',
            'image' => 'image|max:5000'
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category-id');
        $product->description = $request->input('description');
        if ($request->hasFile('image')) {
            $product->image = $request->image->store('products');           
        }

        $product->save();

        $request->session()->flash('status','Update successful');
        return redirect(route('products.edit',['product'=>$product->id]));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete',$product);

        $product->delete();
        return redirect(route('products.index'))->with('status','Product has been removed');
    }
}
