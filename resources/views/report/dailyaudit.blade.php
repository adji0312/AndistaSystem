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
                <div class="d-flex gap-3">
                    <h5 class="m-3">Daily Audit</h5>
                    <div style="width: 30%" class="m-3 d-flex gap-2">
                        <form action="" class="d-flex gap-3">
                            <input type="date" class="form-control" value="{{ request('filterdate') }}" name="filterdate" id="filterdate">
                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100px"><i class="fas fa-filter"></i> Filter</button>
                        </form>
                    </div>
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
                                <th scope="col" style="background-color: #f2f2f2; width: 100px" class="text-center">Day</th>
                                <th scope="col" style="background-color: #f2f2f2">Date</th>
                                <th scope="col" style="background-color: #f2f2f2">Cash</th>
                                <th scope="col" style="background-color: #f2f2f2">Credit Card</th>
                                <th scope="col" style="background-color: #f2f2f2">Bank Transfer</th>
                                <th scope="col" style="background-color: #f2f2f2">Debit Card</th>
                                {{-- <th scope="col">Total</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if (request('filterdate'))
                                    <th scope="row" class="text-center">1</th>
                                    <td>{{ date_format(Date::now(), 'd F Y') }}</td>
                                    <td>Rp {{ number_format($cashsale) }}</td>
                                    <td>Rp {{ number_format($creditsale) }}</td>
                                    <td>Rp {{ number_format($banksale) }}</td>
                                    <td>Rp {{ number_format($debitsale) }}</td>
                                @else
                                    <th scope="row" class="text-center">1</th>
                                    <td>{{ date_format(Date::now(), 'd F Y') }}</td>
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
                <div class="d-flex gap-2 m-3">
                    {{-- <h5 class="m-3">Cash</h5> --}}
                    <form action="" class="d-flex gap-2">
                        <select class="form-select" style="width: 400px" aria-label="Default select example">
                            <option selected>Select Method Payment</option>
                            <option value="1"><h5>Cash</h5></option>
                            <option value="2"><h5>Credit Card</h5></option>
                            <option value="3"><h5>Bank Transfer</h5></option>
                            <option value="3"><h5>Debit Card</h5></option>
                        </select>
                        <button type="button" class="btn btn-outline-primary btn-sm" style="width: 100px;"><i class="fas fa-filter"></i> Filter</button>
                    </form>
                    <form action="/report/daily">
                        <button type="submit" class="btn btn-outline-secondary btn-sm mx-2" style="width: 100%; height: 100%">Reset</button>
                    </form>
                </div>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 60px">No</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Sub Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payment Method</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach ($sales as $sale)
                                <?php $index += 1; ?>
                                @if (request('filterdate'))
                                    @if (request('filterdate') == date_format(Date::now(), 'Y-m-d'))
                                        <tr>
                                            <th scope="row">{{ $index }}</th>
                                            <td>{{ $sale->no_invoice }}</td>
                                            <td>{{ date_format($sale->updated_at, 'd M Y H:i') }}</td>
                                            <td>{{ $sale->booking->customer->first_name }}</td>
                                            <td>{{ $sale->sub_booking->pet->pet_name }}</td>
                                            <td>Rp {{ number_format($sale->total_price) }}</td>
                                            <td>{{ $sale->metode }}</td>
                                        </tr>
                                    @endif
                                @else
                                    <?php $checkDate = date_format($sale->updated_at, 'Y-m-d'); ?>
                                    @if ($checkDate == date_format(Date::now(), 'Y-m-d'))
                                        <tr>
                                            <th scope="row">{{ $index }}</th>
                                            <td>{{ $sale->no_invoice }}</td>
                                            <td>{{ date_format($sale->updated_at, 'd M Y H:i') }}</td>
                                            <td>{{ $sale->booking->customer->first_name }}</td>
                                            <td>{{ $sale->sub_booking->pet->pet_name }}</td>
                                            <td>Rp {{ number_format($sale->total_price) }}</td>
                                            <td>{{ $sale->metode }}</td>
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
