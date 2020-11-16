@extends('layouts.app')

@section('content')


    <div class="p-4 bg-white border rounded">
      <div class="col-md-10 offset-1" id="order_page" style="min-height:500px;">
        <h4><b>My Order(s)</b></h4>
        <hr>

              {{-- d-flex justify-content-between align-items-center --}}
        <ul  class="list-group" id="list-group">

          @if (isset($tranlist))
            @foreach ($tranlist as $key => $value)
              <li class="list-group-item  list-group-item-warning mb-2">
                @if ($value['stat'] == 0)
                  <span class="badge badge-secondary float-right badge-pill">Cancelled</span>
                @elseif ($value['stat'] == 1)
                  <span class="badge badge-primary float-right badge-pill">Pending</span>

                @elseif ($value['stat'] == 2)
                <span class="badge badge-primary float-right badge-pill">To ship</span>

                @elseif ($value['stat'] == 3)
                <span class="badge badge-primary float-right badge-pill">To receive</span>

                @elseif ($value['stat'] == 4)
                <span class="badge badge-success float-right badge-pill">Completed</span>

                @elseif ($value['stat'] == 9)
                <span class="badge badge-secondary float-right badge-pill">Declined</span>

                @else
                  {{--    --}}
                @endif
                <h5>Reference number: {{$value['transID']}}</h5>
                <small><b>Date ordered:</b><i> {{ date("M. d, Y",strtotime($value['dateStart']))}}</i> <b class="ml-5">Date Delivered:</b> @if ($value['dateFinished'] == null)
                  <i>N/A</i>
                  @else
                  <i>{{ date("M. d, Y",strtotime($value['dateFinished']))}}</i>
                @endif</small>
                <ul>
                  <p class="ml-0 mb-0"><b>Item(s)</b></p>
                  @foreach ($value['details'] as $val)
                    <li class="ml-3"><b class="mr-5">{{$val['brandName']." - ".$val['size']}}</b>{{$val['quantity']}}pc(s)</li>
                  @endforeach
                  <hr class="mt-0">
                  <p ><b>Total Amount:</b> ₱ {{number_format($value['total'], 2, '.', ',')}}</p>
                </ul>
                @if ($value['stat'] == 1 || $value['stat'] == 2 )
                  <button type="button" class="btn cnlOrder btn-secondary btn-sm float-right" rel="{{$value['transID']}}"name="button">Cancel</button>

                @endif
              </li>

            @endforeach


          @endif
          {{-- <li class="list-group-item  list-group-item-warning">
            <span class="badge badge-primary float-right badge-pill">14</span>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </li> --}}

        </ul>
     </div>
    </div>

@endsection
