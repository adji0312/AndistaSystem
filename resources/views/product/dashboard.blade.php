@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('product.menu')

    <div id="contents">
      <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
          <div class="d-flex gap-3 w-100">
              <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
          </div>
      </div>
      @include('product.sidenavproduct')
      <div id="dashboard" class="mx-3 mt-3">
          {{ $title }}
      </div>
    </div>
  </div>
@endsection
