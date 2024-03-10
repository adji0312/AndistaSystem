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
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/service/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li>
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteSaleUnpaid" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="/sale/list/unpaid">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ request('search') }}">
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
                        <th scope="col" style="color: #7C7C7C">Invoice No</th>
                        <th scope="col" style="color: #7C7C7C">Lokasi</th>
                        <th scope="col" style="color: #7C7C7C">Tanggal</th>
                        <th scope="col" style="color: #7C7C7C">Customer</th>
                        <th scope="col" style="color: #7C7C7C">Sub Customer</th>
                        <th scope="col" style="color: #7C7C7C">Total</th>
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
                                <td class="text-primary align-middle" style="cursor: pointer">
                                    <a href="/sale/list/detail/{{ $sale->no_invoice }}">{{ $sale->no_invoice }}</a>
                                </td>
                                @if ($sale->booking || $sale->booking->location)
                                    <td class="align-middle">
                                        {{ $sale->booking->location->location_name }}
                                    </td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                                <?php $date = date_create($sale->booking->booking_date) ?>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($date)->isoFormat('D MMMM YYYY') }}</td>
                                @if ($sale->booking || $sale->booking->customer)
                                    <td class="align-middle">
                                        {{ $sale->booking->customer->first_name }}
                                    </td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                                @if ($sale->sub_booking)
                                    <td class="align-middle">{{ $sale->sub_booking->pet->pet_name }}</td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                                <td class="align-middle">Rp {{ number_format($sale->total_price - $sale->amount_discount) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteSaleUnpaid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Invoice</h1>
            </div>
            
            <form action="/deleteSaleUnpaid" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        {{-- <input type="text" id="deleteId"> --}}
                        <input type="text" hidden id="deleteId" name="deleteId" value="Hapus" class="form-control mt-1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Delete</button>
                </div>
            </form>
          </div>
        </div>
    </div>

@endsection