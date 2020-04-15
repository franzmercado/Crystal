@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white border rounded" id="cartDes">
      <form method="post" action="{{ route('checkOut')}}" id="cartForm">
         @csrf
      <div class="row">
        <div class="col-md-8 cartDisplay">
          <div class="selAll">
            <h5>Cart Item(s)</h5>
          </div>


            <ul class="cartItems list-group">

            </ul>

        </div>
        <div class="col-md-4 cartDelivery" >
          <h4 class="pb-2">Order Summary</h4>
          <b>Subtotal</b>
          <p class="float-right" id="subTotal">0.00</p><span class="float-right">P</span>
          <br><br>
          <b>Shipping Fee</b>
          <p class="float-right" id="subShip"></p><span class="float-right">P</span>
          <br>
          <hr>
          <p class="float-right" id="total"></p><span class="float-right">P</span>

          <h5>Total</h5>
          <p ></p>
          <br>
          <input type="submit" name="submit" class="btn btn-primary pcdBtn btn-lg mx-4" value="PROCEED TO CHECKOUT">
        </div>
      </div>
      </form>
    </div>

@endsection
