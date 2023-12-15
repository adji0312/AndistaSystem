@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('finance.menu')

    <div id="contents">
    <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
        </div>
    </nav>

        <div id="dashboard" class="mx-3 mt-3">
          <div class="d-flex justify-content-between gap-4 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/list.png" alt="" style="width: 30px"> All Total Sales</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>Rp {{ number_format($totalSales) }}</h2>
                </div>
            </div>
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/list.png" alt="" style="width: 30px"> All Total Quotation</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>Rp {{ number_format($totalQuotation) }}</h2>
                </div>
            </div>
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/tax.png" alt="" style="width: 30px"> Tax Rate</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($taxrate) }}</h2>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
