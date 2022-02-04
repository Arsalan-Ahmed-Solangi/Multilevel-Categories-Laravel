<?php

namespace App\Http\Controllers;
use App\Models\CategoryImage;
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
        $categories = Category::where('parent_category','=',null)->get();
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
        $category = Category::create([
            'category_name' => $request->category_name ?? null,
            'parent_category' =>$request->parent_category ?? null,
        ]);

        $files = [];
        if($request->hasfile('category_images'))
         {
            foreach($request->file('category_images') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
         }
        //***End of Creating Category*******//

         $image = new CategoryImage;
         $image->category_id = $category->category_id;
         $image->image=json_encode($files);

        return redirect()->route('categories.index')->with('success', 'New Category has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        print_r($category->category_name);

        $data = $this->fetch($category);

        return view('categories.show',compact('data'));
    }

    //****Start of Custom Recursive Function********//
    public function fetch($category)
    {
        foreach($category ?? array() as  $values)
        {
            echo ">>".$category->category_name;
			if(count($category->childCategories) > 0)
			{
				$this->fetch($category->Child);
			}

        }
    }
    //****End of Custom Recursive Function*********//

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
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
        $validator = $request->validate([
            'category_name'     => 'required',
            'parent_category'=> 'nullable|numeric'
        ]);
        if($request->category != $category->category || $request->parent_category != $category->parent_category)
        {
            if(isset($request->parent_category))
            {
                $checkDuplicate = Category::where('name', $request->category_name)->where('parent_id', $request->parent_category)->first();
                if($checkDuplicate)
                {
                    return redirect()->back()->with('error', 'Category already exist in this parent.');
                }
            }
            else
            {
                $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
                if($checkDuplicate)
                {
                    return redirect()->back()->with('error', 'Category already exist with this name.');
                }
            }
        }

        $category->category_name = $request->category_name;
        $category->parent_category = $request->parent_category;
        $category->save();
        return redirect()->back()->with('success', 'Category has been updated successfully.');
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
