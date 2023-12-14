@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('report.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3">Finance</h5>
                <div class="m-3 mb-0 d-flex flex-column">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/daily">Daily Audit</a></label>
                    </div>
                    <hr class="mt-0">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/monthly">Monthly Audit</a></label>
                    </div>
                    <hr class="mt-0">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/byProduct">Sales by Product</a></label>
                    </div>
                    <hr class="mt-0">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/byServices">Sales by Services</a></label>
                    </div>
                    <hr class="mt-0">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/byStaff">Sales by Staff</a></label>
                    </div>
                    <hr class="mt-0">
                    <div class="mb-0">
                        <label for="exampleInputEmail1" class="form-label text-primary" style="font-size: 17px; cursor: pointer;"><a href="/report/byStaff">Quotation</a></label>
                    </div>
                    <hr class="mt-0">
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
