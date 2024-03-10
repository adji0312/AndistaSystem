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
                                <a class="nav-link active" aria-current="page" href="/service/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
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
                        <th scope="col" style="color: #7C7C7C">Sub Customer</th>
                        <th scope="col" style="color: #7C7C7C">Total</th>
                        <th scope="col" style="color: #7C7C7C">Metode Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <th class="align-middle">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $sale->id }}]" name="checkBox"  value="{{ $sale->id }}">
                                    </div>
                                </th>
                                <td class="text-primary align-middle" style="cursor: pointer;">
                                    <a href="/sale/list/detail/{{ $sale->no_invoice }}">{{ $sale->no_invoice }}</a>
                                </td>
                                <td class="align-middle">{{ $sale->booking->location->location_name }}</td>
                                <?php $date = date_create($sale->booking->booking_date) ?>
                                <td class="align-middle">{{ date_format($date, 'd M Y') }}</td>
                                <td class="align-middle">{{ $sale->booking->customer->first_name }}</td>
                                <td class="align-middle">{{ $sale->sub_booking->pet->pet_name }}</td>
                                <td class="align-middle">Rp {{ number_format($sale->total_price - $sale->amount_discount) }}</td>
                                <td class="align-middle">
                                    @foreach ($sale->invoicepayment as $si)
                                        {{ $si->method }} <br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection