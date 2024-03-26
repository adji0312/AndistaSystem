@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('finance.menu')

    <div id="contents">
        <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex gap-3 w-100">
                <a class="navbar-brand" id="navbar-brand-title" href="#">Dashboard Keuangan</a>
            </div>
        </div>
        @include('finance.sidenavfinance')

        <div id="dashboard" class="mx-3 mt-3">
          <div class="d-flex justify-content-between gap-4 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/list.png" alt="" style="width: 30px"> Semua Total Penjualan</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>Rp {{ number_format($totalSales) }}</h2>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
