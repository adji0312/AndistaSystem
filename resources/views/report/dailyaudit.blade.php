@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('report.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/report" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3" style="width: 10%">Filter Tanggal</h5>
                <div class="d-flex gap-2 m-3">
                    <form action="" class="d-flex gap-2">
                        <input type="date" class="form-control" value="{{ request('datefrom') }}" name="datefrom" id="datefrom">
                        <input type="date" class="form-control" value="{{ request('dateto') }}" name="dateto" id="dateto">
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 120px"><i class="fas fa-filter"></i> Filter</button>
                            <a href="/report/daily" class="btn btn-outline-secondary btn-sm" style="width: 120px">Reset</a>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="/report/dailyExport" class="btn btn-outline-secondary btn-sm" style="width: 120px">Export</a>
                        </div>
                    </form>
                </div>
                <div class="table-responsive m-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #f2f2f2"></th>
                                <th scope="col" style="background-color: #f2f2f2"></th>
                                <th scope="col" colspan="4" class="text-center" style="background-color: #f2f2f2">Payment Summary</th>
                            </tr>
                            <tr>
                                <th scope="col" style="background-color: #f2f2f2; width: 100px" class="text-center">No</th>
                                <th scope="col" style="background-color: #f2f2f2">Tanggal</th>
                                <th scope="col" style="background-color: #f2f2f2">Cash</th>
                                <th scope="col" style="background-color: #f2f2f2">Credit Card</th>
                                <th scope="col" style="background-color: #f2f2f2">Bank Transfer</th>
                                <th scope="col" style="background-color: #f2f2f2">Debit Card</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if (request('datefrom') && request('dateto'))
                                    <th scope="row" class="text-center">1</th>
                                    <?php 
                                        $datefrom = date_create(request('datefrom'));
                                        $convertDateFrom = \Carbon\Carbon::parse($datefrom);
                                        $dateto = date_create(request('dateto'));
                                        $convertDateTo = \Carbon\Carbon::parse($dateto);
                                    ?>
                                    <td>{{ $convertDateFrom->isoFormat('D MMMM YYYY') }} - {{ $convertDateTo->isoFormat('D MMMM YYYY') }}</td>
                                    <td>Rp {{ number_format($cashsale) }}</td>
                                    <td>Rp {{ number_format($creditsale) }}</td>
                                    <td>Rp {{ number_format($banksale) }}</td>
                                    <td>Rp {{ number_format($debitsale) }}</td>
                                @else
                                    <th scope="row" class="text-center">1</th>
                                    <?php $dateNow = \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') ?>
                                    <td>{{ $dateNow }}</td>
                                    <td>Rp {{ number_format($cashsale) }}</td>
                                    <td>Rp {{ number_format($creditsale) }}</td>
                                    <td>Rp {{ number_format($banksale) }}</td>
                                    <td>Rp {{ number_format($debitsale) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">Total</th>
                                <td colspan="5" class="text-end"><strong>Rp {{ number_format($allTotal) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                <h5 class="m-3" style="width: 10%">List Invoice</h5>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 60px">No</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Hewan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Metode Pembayaran</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach ($invoice as $sale)
                                <?php $index += 1; ?>
                                @if (request('datefrom') && request('dateto'))
                                    <tr>
                                        <th scope="row" class="align-middle">{{ $index }}</th>
                                        <td class="align-middle">{{ $sale->no_invoice }}</td>
                                        <td class="align-middle">{{ $sale->created_at->isoFormat('D MMMM YYYY') }} {{ date_format($sale->created_at, 'H:i') }}</td>
                                        <td class="align-middle">{{ $sale->booking->customer->first_name }}</td>
                                        <td class="align-middle">{{ $sale->sub_booking->pet->pet_name }}</td>
                                        <td class="align-middle">Rp {{ number_format($sale->total_price) }}</td>
                                        <td class="align-middle">
                                            @foreach ($sale->invoicepayment as $method)
                                                - {{ $method->method }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @else
                                    <?php $checkDate = date_format($sale->created_at, 'Y-m-d'); ?>
                                    @if ($checkDate == date_format(Date::now(), 'Y-m-d'))
                                        <tr>
                                            <th scope="row">{{ $index }}</th>
                                            <td>{{ $sale->no_invoice }}</td>
                                            <td>{{ $sale->created_at->isoFormat('D MMMM YYYY') }} {{ date_format($sale->created_at, 'H:i') }}</td>
                                            <td>{{ $sale->booking->customer->first_name }}</td>
                                            <td>{{ $sale->sub_booking->pet->pet_name }}</td>
                                            <td>Rp {{ number_format($sale->total_price) }}</td>
                                            <td>
                                                @foreach ($sale->invoicepayment as $method)
                                                    - {{ $method->method }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
