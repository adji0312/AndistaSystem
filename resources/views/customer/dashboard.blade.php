@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('customer.menu')

    <div id="contents">
    <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
        </div>
    </nav>

        <div id="dashboard" class="mx-3 mt-3">
            {{ $title }}
        </div>
    </div>
  </div>
@endsection
