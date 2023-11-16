@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('presence.menu')

    <div id="contents">
      <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">{{ $title }}</a>
          </div>
      </nav>

      <div id="dashboard" class="mx-3 mt-3">
          <div class="mb-3"> 
            <input type="text" class="form-control mt-1 w-50" id="qrid" name="qrid" placeholder="scan qr here">
          </div>
      </div>
    </div>
  </div>
@endsection
