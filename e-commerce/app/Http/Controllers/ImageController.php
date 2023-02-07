<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Requests\ImageStoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Image data display
    public function index(Request $request)
    {
        $images=Image::all();
        $categories=Category::where('status','=',1)->get();
        if($request->category_id || $request->product_id){
            $images=Image::where('image_id','like','%'.$request->category_id.'%')
            ->orWhere('product_id','like','%'.$request->product_id.'%')
            ->get();
        }

        $products=Product::all();



        return view('images.index',compact('images','categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //create new image data
    public function create()
    {
        $categories=Category::where('status','=',1)->get();
        $products=Product::all();
        return view('images.create',compact('categories','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //store image data
    public function store(ImageStoreRequest $request)
    {
        $validate=$request->validated();
        if(!$validate){
            return redirect()->back();
        }else{
            $image=new Image();
            $imagePath= 'storage/'. $request->file('image_name')->store('Images','public');
            $image->category_id=$request->category_id;
            $image->product_id=$request->product_id;
            $image->image_name=$imagePath;
            $image->save();
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    // edit image data
    public function edit(Image $image)
    {
        $categories=Category::where('status','=',1)->get();
        $products=Product::all();
        return view('images.edit',compact('image','categories','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */

     //update image data
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'category_id'=>'required',
            'product_id'=>'required',
        ]);

        $images=$image->image_name;

        if($request->hasFile('image_name')){
            Storage::delete($image->image_name);
            $images='storage/'. $request->file('image_name')->store('Images','public');
        }
      
        $image->update([
            'category_id'=>$request->category_id,
            'product_id'=>$request->product_id,
            'image_name'=>$images
            
        ]);

      /*   if($request->has('categories')){
            $menu->categories()->sync($request->categories);

        } */
        return redirect()->route('images.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */

     //dalete image data
    public function destroy(Image $image)
    {
        Storage::delete($image->image_name);
        $image->delete();
        return redirect()->back();
    }
}
