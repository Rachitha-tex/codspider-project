@extends('layouts.main')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@section('content')

<div class="container mt-4">
<a href="{{route('images.create')}}" class="btn btn-warning float-end">Upload Image</a>

<div class="form-group mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category Names</label>
                <select class="form-select form-control" name="category_id" id="cat_name" aria-label="Default select example">
                    <option selected>Open Category</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                      
                  @endforeach
        
                </select>
                @error('category_id')
                    <p class="text-danger">{{$message}}</p>

                @enderror
              </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Products Names</label>
                <select class="form-select form-control" name="product_id" id="prod_name" aria-label="Default select example">
                  <option selected>Open Category</option>
                  @foreach ($products as $product)
                  <option value="{{$product->id}}">{{$product->product_name}}</option>
                    
                @endforeach>
        
                </select>
                @error('product_id')
                <p class="text-danger">{{$message}}</p>

            @enderror
              </div>
        </div>
        <div class="col-md-4">
          
                <div class="mt-4">
                    <button class="btn btn-primary w-50 mt-2" id="search" type="submit">Submit</button>

                </div>
           
        </div>
         
        @foreach ($images as $image)
        <div class="card w-25">
            <div class="card-body">
                <img src="{{$image->image_name}}" alt="">
                <h5 class="mt-2">{{$image->category->category_name}}</h3>
                <p class="mt-2">{{$image->product->product_name}}</p>

            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{route('images.edit',$image->id)}}" class="btn btn-primary ">Edit</a>
                    <form action="{{route('images.destroy',$image->id)}}" method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        @method("DELETE")
                        <button  class="btn btn-danger" style="margin-left: 10px" type="submit">Delete</button>
                    </form>
                </div>
               
            </div>
        </div>
        @endforeach
   
        
    </div>
</div>


</div>
@endsection
