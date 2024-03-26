@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div class="d-flex gap-4">
                        </div>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('finance.sidenavfinance')

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">No</th>
                        <th scope="col" style="color: #7C7C7C">Invoice No</th>
                        <th scope="col" style="color: #7C7C7C">Tanggal</th>
                        <th scope="col" style="color: #7C7C7C">Pelanggan</th>
                        <th scope="col" style="color: #7C7C7C">Sub Pelanggan</th>
                        <th scope="col" style="color: #7C7C7C">Total</th>
                        <th scope="col" style="color: #7C7C7C">Metode Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        @foreach ($sales as $sale)
                            <tr>
                                <th class="align-middle">
                                    {{ $index++ }}
                                </th>
                                <td class="text-primary align-middle" style="cursor: pointer;">
                                    <a href="/sale/list/detail/{{ $sale->no_invoice }}">{{ $sale->no_invoice }}</a>
                                </td>
                                {{-- <td class="align-middle">{{ $sale->booking ? $sale->booking->location->location_name : "-" }}</td> --}}
                                <td class="align-middle">{{ $sale->created_at->isoFormat('D MMMM Y') }} {{ date_format($sale->created_at, 'H:i') }}</td>
                                <td class="align-middle">{{ $sale->customer_name }}</td>
                                <td class="align-middle">{{ $sale->sub_booking ? $sale->sub_booking->pet->pet_name : "-" }}</td>
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