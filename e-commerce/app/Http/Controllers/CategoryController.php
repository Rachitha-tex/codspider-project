<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryStoreRequest;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //get all category data

    public function index()
    {
        $category=Category::where('status','=',1)->get();
        return response()->json($category);
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

     //store category data
    public function store(CategoryStoreRequest $request)
    {
            $validate=$request->validated();

            if(!$validate){
                return response()->json('Erro in submitting category');
            }else{
             $category=new Category([
            'category_name'=>$request->input('category_name'),
            'slug'=>Str::slug($request->input('category_name'),'-')
            
              ]);
              $category->save();

             return response()->json("Catgoery saved");
            }
      

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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    //update category data
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $validate=$request->validated();
      
        if(!$validate){
            return response()->json('error in updating');
        }else{
            $category->update(
                ['category_name'=>$request->input('category_name'),
                'slug'=>Str::slug($request->input('category_name'),'-')]
            );
            return response()->json([
                "success" => true,
                "message" => "Catgeory Updated successfully.",
                "data" => $category  
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

     //delete category data
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            "success" => true,
            "message" => "Catgeory Deleted successfully.",
            "data" => $category  
        ]);
    }
}
