@extends('layouts.app')
@section('content')
  <div class="p-2 mt-2 bg-white border rounded">
    <h5>Search Results</h5>
  </div>

  <div class="p-2 mt-2 bg-white border rounded">
    <div class="crystalHome">
      <p>{{ request()->input('query')}}</p>
    </div>
  </div>
@endsection
