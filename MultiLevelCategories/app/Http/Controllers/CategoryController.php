<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
class CategoryController extends Controller
{

    public function index()
    {

        $categories = Category::latest()->where('parent_category','=', null)->orderBy('category_id','ASC')->get();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::where('parent_category','=',null)->pluck('category_name','category_id');
        return view('categories.create',compact('categories'));
    }


    public function store(Request $request)
    {

        $request->validate([

            'category_name'     => 'required|unique:categories,category_name',
            // 'category_images.*' => 'mimes:jpg,jpeg,png|max:4096|required_if:parent_category,=,null',
            'parent_category'       => 'numeric|nullable',

        ]);

        // dd($request->all());

        //***Start of Creating Category*******//
        Category::create([
            'category_name' => $request->category_name ?? null,
            'parent_category' =>$request->parent_category ?? null,
        ]);
        //***End of Creating Category*******//

        return redirect()->back()->with('success', 'New Category has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if(count($category->childCategories))
        {
            $nestedCategories = $category->childCategories ?? array();
            foreach($nestedCategories ?? array() as $column)
            {
                $column = Category::findOrFail($column->category_id);
                $column->parent_category = null;
                $column->save();
            }
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category has been deleted successfully');
    }
}
