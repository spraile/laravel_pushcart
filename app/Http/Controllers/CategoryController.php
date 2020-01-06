<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index()
    {
    	$categories = Category::all();
    	return view("categories.index")
    	->with('categories',$categories);
    }

    public function show(Category $category)
    {
    	// $result = Category::find($category);
    	return view('categories.show')
    	->with('category',$category);
    }
    public function create()
    {
    	return view('categories.create');
    }

    public function edit(Category $category)
    {
    	// $result = Category::find($category);
    	return view('categories.edit')
    	->with('category',$category);
    }


    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'string|required|max:50|unique:categories,name' 
    	]);

    	$category = new Category;
    	$category->name = $request->input('name');
    	$category->save();
    	return redirect(route('categories.index'));
    }

    public function update(Category $category, Request $request)
    {
    	$request->validate([
    		'name' => 'string|required|max:50|unique:categories,name' 
    	]);
    	// $result = Category::find($category);
    	$category->name = $request->input('name');
    	$category->save();
    	return redirect(route('categories.show',['category' => $category->id]));
    }

    public function destroy(Category $category)
    {
    	// $result = Category::find($category);
    	// $result->delete();
    	$category->delete();
    	return redirect(route('categories.index'));
    }
}
