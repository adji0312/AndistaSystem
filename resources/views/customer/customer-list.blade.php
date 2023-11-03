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
    {{-- Customer Statistics --}}
    <div id="flexbox" class="container m-2">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <p class="card-text">Total Customer</p>
                  <h2 class="card-title">1200 Customer</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <p class="card-text">New Customer This Month</p>
                  <h2 class="card-title">53 Customer</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
    {{-- Customer Graph --}}
    

  </div>
@endsection
