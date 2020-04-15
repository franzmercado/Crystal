@extends('layouts.admins')
@section('content')
<div class="p-3 bg-white border rounded">
    <div class="row">
        <div class="col-md-10 offset-1">
            <h4>Add Product</h4>
        </div>
    </div>
    <form id="addProduct" method="post" enctype="multipart/form-data">
    <div class="row"  style="min-height:480px;">
      <div class="col-md-8 offset-2">
          @csrf
            <div class="col-md-6  mb-2">
              <label for="Thumbnail">Image: </label>
              <input type="file" class="form-control" name="Thumbnail" accept="image/*" required>
            </div>
            <div class="col-md-8 mb-2">
              <label for="Productname">Product Name: </label>
              <input type="text" class="form-control " name="Productname" required>
            </div>
            <div class="col-md-5 float-left mb-2">
              <label for="Category">Category: </label>
              <select class="form-control" name="Category" required>
                <option value="" disabled selected></option>
                @isset($category)
                  @foreach ($category as $value)
                      <option value="@php echo $value->id @endphp">@php echo $value->description @endphp</option>
                  @endforeach
                @endisset
              </select>
            </div>

            <div class="col-md-3 float-left mb-2">
              <label for="Size">Size: </label>
              <select class="form-control" name="Size" required>
                <option value="" selected disabled></option>
                <option value="325ml">325ml</option>
                <option value="500ml">500ml</option>
                <option value="750ml">750ml</option>
                <option value="1L">1L</option>
                <option value="1.5L">1.5L</option>
                <option value="1.75L">1.75L</option>
                <option value="2L">2L</option>
                </select>
            </div>
            <div class="col-md-5 float-left mb-2">
              <label for="Price">Price: </label>
              <input type="number" min="1.00" max="10000.00"  step="0.01" name="Price" class="form-control" required>
            </div>
            <div class="col-md-3 float-left mb-2">
              <label for="Qty">Qty. : </label>
              <input type="number" min="1" max="10000"  step="1" name="Qty" class="form-control" required>
            </div>
            <div class="col-md-8 float-left mb-2">
              <label for="Description">Description: </label>
              <textarea name="Description" rows="4" name="Description"class="form-control" required></textarea>
            </div>
            <div class="col-md-4 float-left offset-5">
              <input type="submit" class="btn btn-primary" value="Submit">
              <button type="button"  class="btn btn-secondary clr" name="button">Clear</button>
            </div>



      </div>
    </div>
    </form>
</div>
@endsection
