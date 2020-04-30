@extends('layouts.app')
@section('content')
  <div class="p-0 mt-2">
    <div class="row">

      <div class="col-md-12">
        @if(isset($title))
          <p class="m-0 float-left"><a href="/"> Home </a><b>></b>@php echo $title['catDesc']@endphp</p>
          <input type="hidden" id="CategoryID" value="@php echo $title['catID']@endphp">
        @endif
      </div>
    </div>
  </div>
  <div class="p-4 bg-white border rounded" id="showBG">
    <h4>Category: @php echo $title['catDesc']@endphp</h4>
    <div class="row">
      <div id="latest" class="col-md-12 ml-5">
          <ul class="thumbnails" id="FilteredProducts">
            @if(isset($data))
              @if ($data->total() > 0)
                @foreach ($data as $value)
                  <li class="spanProd">
                    <a href="/category=@php echo $value->categoryID @endphp/show=@php echo $value->prodID @endphp">
                      <div class="thumbnail">
                        <div class="disImgHome">
                          <img src="/productImg/@php echo $value->thumbnail @endphp" class="cimg">
                        </div>
                        <div class="caption">
                          <p>@php echo $value->brandName @endphp <small>@php echo $value->size  @endphp</small></p>
                        </div>
                        <div class="price">
                          <h5><span>₱</span>@php echo $value->price @endphp</h5>
                        </div>
                      </div>
                    </a>
                  </li>
                @endforeach
                @else
                  <br>
                  <div class="col-md-4 offset-4">
                    <h5>No products found.</h5>
                  </div>
              @endif
            @endif

          </ul>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="float-right">
          {{ $data->links()}}
        </div>
      </div>
    </div>
  </div>

@endsection
