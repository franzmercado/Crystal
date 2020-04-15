@extends('layouts.app')
@section('content')
  <div class="p-0 mt-2">
    <div class="row">
      <div class="col-md-12">
        @if(isset($title))
          <p class="float-left m-0"><a href="/"> Home </a><b>></b><a href="/category=@php echo $title['catID']@endphp"> @php echo $title['catDesc']@endphp </a><b>></b>@php echo $title['prodName']@endphp </p>
        @endif
      </div>
    </div>
  </div>
  <div class="p-4 bg-white border rounded" id="showBG">
            @if(isset($product))
            <div class="row">
              <div class="col-md-3 disImg">
                <img src="{{ URL::to('/') }}/productImg/@php echo $product->thumbnail @endphp" class="cimg" alt="">
              </div>

              <div class="col-md-5 ml-3 desc">
                <div class="" style="min-height: 245px;">
                  <b><h4>@php echo $product->brandName." ".$product->size @endphp</h4></b><hr>
                  <h5><b>₱</b>@php echo number_format($product->price, 2, '.', ', ')  @endphp </h5>
                  <p>Sold: @php echo $product->sold @endphp</p>
                  <p>@php echo $product->description @endphp</p>
                </div>

                @if(Auth::guard('web')->check())
                <div class=""style="position: absolute; bottom: 0; margin-bottom: 10px;">
                  <button type="button" class="btn btn-info btn-lg addCart" id="@php echo $product->prodID @endphp" name="button"><span><i class="fa fa-shopping-cart fa-lg"></i></span> Add to Cart</button>
                </div>
              @endif
              </div>
              <div class="col-md-3 disDelivery">
                <div class=" m-3 px-1">
                  <h5><span class="fa fa-truck"></span> Standard Delivery</h5>
                  <i class="ml-3"><span class=" fa fa-circle fa-sm"></span>2-4 Days</i>
                  <p class="float-right">₱50.00</p>
                  <br>
                  <br>
                  <small class="p-1">Enjoy free shipping with minimum spend of <b>₱1,000.00</b></small>
                </div>
                <hr>
                 <div class=" m-3 p-1">
                  <h5><span class="fa fa-money-bill-wave"></span> Payment option</h5>
                  <p class="ml-3">Cash on Delivery</p>
                  </div>
                  <hr>
                <div class="m-3 p-1">
                  <h5><i class="fa fa-ban"></i> No return policy</h5>
                </div>


              </div>
            </div>
          @endif
  </div>

      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
