@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white border rounded" id="cartDes">
      <form method="post" action="#" id="cartForm">
         @csrf
      <div class="row">
        <div class="col-md-8 cartDisplay">
          <h3>Order Summary</h3>
          <table class="table table-bordered table-stripped">
            <thead>
              <tr>
                <th width="60%">Item</th>
                <th width="20%">Price</th>
                <th width="20%">Qty</th>
              </tr>
            </thead>
            <tbody>
              @php

                foreach ($products as $value) {
                  echo '<tr>';
                  echo '<td>'.$value[0].'</td>';
                  echo '<td>'.$value[1].'</td>';
                  echo '<td>'.$value[2].'</td>';
                  echo '</tr>';
                }
              @endphp
            </tbody>
          </table>

        </div>
        <div class="col-md-4 cartDelivery" >
          <div class="row">
            <div class="col-md-10 offset 1">
              <p><i class=" fa fa-map-marker fa-lg"></i> Location</p>
            </div>
            <div class="col-md-2">
              <a class="float-right" href="{{route('profile')}}">Change</a>

            </div>
          </div>

          <textarea name="address" id="address" class="form-control" readonly rows="3" cols="80">@php echo $address; @endphp
          </textarea>
          {{-- <h5>Contact Number:</h5>
          <input type="text" name="" value=""> --}}

          <hr>
          <h5 class="pb-2">Payment Type</h5>
          <div class="form-group ml-2">
            <input type="radio" name="cod" checked > <label for="cod"><i class="fa fa-truck"></i> Cash on Delivery</label></input>
          </div>
          <hr>
          <p class="float-right">@php
            echo  number_format($total, '2', '.', ',');
          @endphp</p><span class="float-right">P</span>
          <h5>Total Amount</h5>
          <p></p>
          <br>
          <button type="button" class="btn btn-primary orderBtn" rel="@php echo $stat; @endphp" name="button">PLACE ORDER</button>
        </div>
      </div>
      </form>
    </div>

@endsection
