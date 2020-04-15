@extends('layouts.app')
@section('content')
  <div class="p-2 mt-2 bg-white border rounded">
    @if(isset($title))
      <h5><a href="/"> Home </a><b>></b>@php echo $title['catDesc']@endphp</h5>
      <input type="hidden" id="CategoryID" value="@php echo $title['catID']@endphp">
    @endif

  </div>
  <br >
  <div class="p-4 bg-white border rounded" id="showBG">
    <div class="row">
      <div id="latest" class="row col-md-11 offset-1">
          <ul class="thumbnails" id="FilteredProducts">
          </ul>
      </div>

    </div>
  </div>

@endsection
