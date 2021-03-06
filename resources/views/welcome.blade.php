@extends('layouts.app')
@section('content')

  <div class="crystalHome">
<div class="row">
  <div class="col-md-3">
    <div class="categorySection" >
      <!-- <font class="float-right mr-2 mt-1" color="black">v</font> -->

        <i class="fas fa-angle-down fa-lg float-right mt-2 mr-2"></i>

        <h5 class="m-2" id="cathead" align="center">Categories </h5>
      <ul class="list-group" id="categoryList" >
      </ul>
    </div>
  </div>
  <div class="col-md-9">
    <div id="onSale" class="carousel slide" data-ride="carousel" style="height:500px;">

      <ul class="carousel-indicators">
        <li data-target="#onSale" data-slide-to="0" class="active"></li>
        <li data-target="#onSale" data-slide-to="1"></li>
        <li data-target="#onSale" data-slide-to="2"></li>
      </ul>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('dist/img/flag/1.jpg')}}" alt="">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('dist/img/flag/2.jpg')}}" alt="" >
        </div>
        <div class="carousel-item">
          <img src="{{ asset('dist/img/flag/3.jpg')}}" alt="" >
        </div>
      </div>
      <a class="carousel-control-prev" href="#onSale" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#onSale" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>

    </div>
  </div>
</div>

<div class="row">
  <div id="latest" class="col-md-11 offset-1">
    <hr>
    <a class="float-right " href="{{ route('showAll')}}">Show all >></a>

    <h4>Latest Products </h4>
    <hr>
            <ul class="thumbnails" id="latestProducts">
            </ul>
  </div>
  <div id="popular" class="col-md-11 offset-1">
      <hr>
    <h4>Popular Products </h4>
      <hr>

            <ul class="thumbnails" id="popularProducts">
            </ul>
  </div>
</div>

</div>
@endsection
