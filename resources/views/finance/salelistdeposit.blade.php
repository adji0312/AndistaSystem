@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Paid</a>
                            </li> --}}
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        <th scope="col" style="color: #7C7C7C">Location</th>
                        <th scope="col" style="color: #7C7C7C">Date</th>
                        <th scope="col" style="color: #7C7C7C">Customer</th>
                        <th scope="col" style="color: #7C7C7C">Deposit</th>
                        <th scope="col" style="color: #7C7C7C">Remaining</th>
                        <th scope="col" style="color: #7C7C7C">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $sale->id }}]" name="checkBox"  value="{{ $sale->id }}">
                                    </div>
                                </th>
                                <td class="text-primary" style="cursor: pointer">
                                    <a href="/sale/list/deposit/{{ $sale->no_invoice }}">{{ $sale->no_invoice }}</a>
                                </td>
                                <td>{{ $sale->booking->location->location_name }}</td>
                                <?php $date = date_create($sale->booking->booking_date) ?>
                                <td>{{ date_format($date, 'd M Y') }}</td>
                                <td>{{ $sale->booking->customer->first_name }}</td>
                                <td>Rp {{ number_format($sale->deposit) }}</td>
                                <td>Rp {{ number_format($sale->total_price - $sale->deposit) }}</td>
                                <td>Rp {{ number_format($sale->total_price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection