<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //display all the products
    public function index()
    {
        $product=Product::with('category')->get();
        return response()->json($product);
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

    //create and store product data
    public function store(ProductStoreRequest $request)
    {
        $validate=$request->validated();

        if(!$validate){
            return response()->json('Erro in submitting prducts');
        }else{
         $product=new Product([
        'category_id'=>$request->input('category_id'),
        'product_name'=>$request->input('product_name'),
        'price'=>$request->input('price')     
          ]);
          $product->save();

         return response()->json("Product saved");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    //update all product data 
    public function update(ProductStoreRequest $request, Product $product)
    {
        $validate=$request->validated();
      
        if(!$validate){
            return response()->json('error in updating');
        }else{
            $product->update(
               [ 'category_id'=>$request->input('category_id'),
                'product_name'=>$request->input('product_name'),
                'price'=>$request->input('price')  ]
            );
            return response()->json([
                "success" => true,
                "message" => "Product Updated successfully.",
                "data" => $product  
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

     //delete product data
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "success" => true,
            "message" => "Catgeory Deleted successfully.",
            "data" => $product  
        ]);
    }
}
