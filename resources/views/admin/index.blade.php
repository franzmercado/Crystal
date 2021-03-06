@extends('layouts.admins')
@section('content')

      <div class="p-3 bg-white border rounded">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
            <br>
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>@php  echo $val['orders'];  @endphp</h3>

                    <p>New Orders</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-shopping-bag fa-lg"></i>
                  </div>
                  <a href="{{ route('admin.transactions')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>@php  echo $val['products'];  @endphp</h3>

                      <p>Products</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-tags fa-lg"></i>
                    </div>
                    <a href="{{route('admin.manageProducts')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>@php  echo $val['users'];  @endphp</h3>

                      <p>Active Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users fa-lg"></i>
                    </div>
                    <a href="{{ route('admin.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>@php  echo $val['low'];  @endphp</h3>

                      <p>Low Stocks Products</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-arrow-alt-circle-down fa-lg"></i>
                    </div>
                    <a href="{{ route('admin.restockProduct')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <canvas id="lineChart"  height="200"></canvas>
            </div>
            <div class="col-md-6">
              <canvas id="barChart"  height="200"></canvas>

            </div>
          </div>


      </div>
@endsection
