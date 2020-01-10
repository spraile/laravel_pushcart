<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index(Category $category)
    {
        $this->authorize('viewAny',$category);

    	$categories = Category::all();
    	return view("categories.index")
    	->with('categories',$categories);
    }

    public function show(Category $category)
    {
        $this->authorize('viewAny',$category);

    	// $result = Category::find($category);
    	return view('categories.show')
    	->with('category',$category);
    }
    public function create(Category $category)
    {
        $this->authorize('create',$category);

    	return view('categories.create');
    }

    public function edit(Category $category)
    {
        $this->authorize('update',$category);

    	// $result = Category::find($category);
    	return view('categories.edit')
    	->with('category',$category);
    }


    public function store(Request $request,Category $category)
    {
        $this->authorize('create',$category);

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
        $this->authorize('update',$category);

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
        $this->authorize('delete',$category);

    	// $result = Category::find($category);
    	// $result->delete();
    	$category->delete();
    	return redirect(route('categories.index'));
    }
}
