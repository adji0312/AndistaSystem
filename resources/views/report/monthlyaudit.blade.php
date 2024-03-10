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
                            <a href="/report" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3" style="width: 10%">Filter Bulan Tahun</h5>
                <div class="d-flex gap-2 m-3">
                    <form action="" class="d-flex gap-2">
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="month">
                            <option value="" class="selectstatus" disabled selected>Select Month</option>
                            @if (request('month') == '01')
                                <option value="01" style="color: black;" selected>January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '02')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;" selected>February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '03')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;" selected>March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '04')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;" selected>April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '05')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;" selected>May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '06')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;" selected>June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '07')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;" selected>July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '08')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;" selected>August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '09')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;" selected>September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '10')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;" selected>October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '11')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;" selected>November</option>
                                <option value="12" style="color: black;">December</option>
                            @elseif(request('month') == '12')
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;" selected>December</option>
                            @else
                                <option value="01" style="color: black;">January</option>
                                <option value="02" style="color: black;">February</option>
                                <option value="03" style="color: black;">March</option>
                                <option value="04" style="color: black;">April</option>
                                <option value="05" style="color: black;">May</option>
                                <option value="06" style="color: black;">June</option>
                                <option value="07" style="color: black;">July</option>
                                <option value="08" style="color: black;">August</option>
                                <option value="09" style="color: black;">September</option>
                                <option value="10" style="color: black;">October</option>
                                <option value="11" style="color: black;">November</option>
                                <option value="12" style="color: black;">December</option>
                            @endif
                        </select>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="year">
                            <option value="" class="selectstatus" disabled selected>Select Year</option>
                            <option value="2023" style="color: black;">2023</option>
                            <option value="2024" style="color: black;">2024</option>
                            <option value="2025" style="color: black;">2025</option>
                            <option value="2026" style="color: black;">2026</option>
                            <option value="2027" style="color: black;">2027</option>
                            <option value="2028" style="color: black;">2028</option>
                            <option value="2029" style="color: black;">2029</option>
                            <option value="2030" style="color: black;">2030</option>
                            <option value="2031" style="color: black;">2031</option>
                            <option value="2032" style="color: black;">2032</option>
                        </select>
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 120px"><i class="fas fa-filter"></i> Filter</button>
                            <a href="/report/monthly" class="btn btn-outline-secondary btn-sm" style="width: 120px">Reset</a>
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
                                <th scope="col" style="background-color: #f2f2f2">Month</th>
                                <th scope="col" style="background-color: #f2f2f2">Cash</th>
                                <th scope="col" style="background-color: #f2f2f2">Credit Card</th>
                                <th scope="col" style="background-color: #f2f2f2">Bank Transfer</th>
                                <th scope="col" style="background-color: #f2f2f2">Debit Card</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if (request('month') && request('year'))
                                    <th scope="row" class="text-center">1</th>
                                    <?php 
                                        $newDate = request('year').'-'.request('month').'-'.'01';
                                        $convertMonthFrom = \Carbon\Carbon::parse($newDate); 
                                    ?>
                                    <td>{{ $convertMonthFrom->isoFormat('MMMM YYYY') }}</td>
                                    <td>Rp {{ number_format($cashsale) }}</td>
                                    <td>Rp {{ number_format($creditsale) }}</td>
                                    <td>Rp {{ number_format($banksale) }}</td>
                                    <td>Rp {{ number_format($debitsale) }}</td>
                                @else
                                    <th scope="row" class="text-center">1</th>
                                    <?php $monthNow = \Carbon\Carbon::now()->isoFormat('MMMM YYYY') ?>
                                    <td>{{ $monthNow }}</td>
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
                            @foreach ($sales as $sale)
                                <?php $index += 1; ?>
                                <tr>
                                    <th scope="row" class="align-middle">{{ $index }}</th>
                                    <td class="align-middle">{{ $sale->no_invoice }}</td>
                                    <td class="align-middle">{{ $sale->created_at->isoFormat('D MMMM YYYY') }}</td>
                                    <td class="align-middle">{{ $sale->booking->customer->first_name }}</td>
                                    <td class="align-middle">{{ $sale->sub_booking->pet->pet_name }}</td>
                                    <td class="align-middle">Rp {{ number_format($sale->total_price) }}</td>
                                    <td class="align-middle">
                                        @foreach ($sale->invoicepayment as $method)
                                            - {{ $method->method }} <br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
