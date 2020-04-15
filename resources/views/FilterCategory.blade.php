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
          </ul>
      </div>

    </div>
  </div>

@endsection
