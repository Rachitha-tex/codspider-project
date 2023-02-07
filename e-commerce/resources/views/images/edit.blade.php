@extends('layouts.main')

@section('content')
<div class="container">
    <a href="{{route('images.index')}}" class="btn btn-primary float-end mb-3">All Images</a>
    <form action="{{route('images.update',$image->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Names</label>
                        <select class="form-select form-control" name="category_id" aria-label="Default select example">
                            <option selected>Open Category</option>
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($image->category->id == ($category->id))selected
                              
                            @endif>{{$category->category_name}}</option>
                              
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
                        <select class="form-select form-control" name="product_id" aria-label="Default select example">
                          <option selected>Open Category</option>
                          @foreach ($products as $product)
                          <option value="{{$product->id}}" @if ($image->product->id == ($product->id)) selected
                              
                          @endif >{{$product->product_name}}</option>
                            
                        @endforeach>
                
                        </select>
                        @error('product_id')
                        <p class="text-danger">{{$message}}</p>

                    @enderror
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 form-check">
                        <label class="form-label" for="exampleCheck1">Upload Image</label>
                        <input type="file" class="form-control" name="image_name" id="exampleCheck1">
                        @error('image_name')
                        <p class="text-danger">{{$message}}</p>

                    @enderror
                      </div>
                </div>

                
            </div>
            <div class="row">
              <div class="col-md-4">
                <img src="{{asset($image->image_name)}}" alt="" srcset="">
              </div>
            </div>
        </div>
  
        <button type="submit" class="btn btn-success mt-3">Submit</button>
      </form>

</div>
@endsection