@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $sale->no_invoice }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/sale/list/unpaid" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Paid</a>
                        </li>
                      </ul>
                      <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                {{-- {{ $sale }} --}}
                <form action="/addQuotation" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex m-2">
                            <h5 class="m-3">Item</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Add Product</button>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Add Service</button>
                        </div>
    
                        <div class="mx-4 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%">No</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Staff</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $bookingService->service->service_name }}</td>
                                        <td>1</td>
                                        <td>{{ $bookingService->staff->first_name }}</td>
                                        <td>Rp {{ number_format($bookingService->servicePrice->price) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteFacilityService"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $itemIndex = 1; ?>
                                    @foreach ($item->carts as $item)
                                        <?php $itemIndex += 1; ?>
                                        <tr>
                                            <th>{{ $itemIndex }}</th>
                                            @if ($item->product_id != null)
                                                <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $item->product->product_name }}</td>
                                            @else
                                                <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $item->service->service_name }}</td>
                                            @endif
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $bookingService->staff->first_name }}</td>
                                            <td>Rp {{ number_format($item->total_price) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteFacilityService"><i class="fas fa-trash"></i> Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="width: 50%;" class="float-end mb-3">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-end">Sub-total</th>
                                <td colspan="2">Rp {{ number_format($sale->total_price) }}</td>
                              </tr>
                            </thead>
                            <tbody>
                              
                              <tr>
                                <th scope="row" class="text-end">Additional Cost (Description)</th>
                                <td colspan="2"><input type="text" placeholder="Description" style="width: 100%"></td>
                              </tr>
                              <tr>
                                <th scope="row" class="text-end">Additional Cost (Price)</th>
                                <td colspan="2"><input type="number" placeholder="0.00" style="width: 100%"></td>
                              </tr>
                              <tr>
                                <th scope="row" class="text-end">Total Price</th>
                                <td colspan="2">Rp {{ number_format($sale->total_price) }}</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addQuotationPrice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
            </div>
            <form action="/addQuotationPrice" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tax_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Item Name</label>
                        <input type="text" class="form-control" id="tax_name" name="tax_name">
                    </div>
                    <div class="mb-3">
                        <label for="tax_rate" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                        <input type="number" class="form-control" id="tax_rate" name="tax_rate">
                    </div>
                    <div class="mb-3">
                        <label for="tax_rate" class="form-label" style="font-size: 15px; color: #7C7C7C;">Staff</label>
                        <input type="text" class="form-control" id="tax_rate" name="tax_rate">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>

    <div class="modal fade" id="makePayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Make Payment</h1>
            </div>
            <form action="/makePayment" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="total_price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Total Price</label><br>
                        <small style="font-size: 17px;">Rp {{ number_format($sale->total_price) }}</small>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Payment Method</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" name="payment_method" id="payment_method">
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Debit Card">Debit Card</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Note</label>
                        <input type="text" class="form-control mt-1" id="payment_note" name="payment_note">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Make Payment</button>
                </div>
            </form>    
          </div>
        </div>
    </div>

    <div class="modal fade" id="addCartProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
            </div>
            <form action="/addCartProduct" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        {{-- <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                        <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                        <input type="text" name="staff_id" hidden value="{{ $booking->booking->staff->id }}"> --}}
                        <input type="text" class="form-control" id="product_id_cart" name="product_id" placeholder="Search here ...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="addCartService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service</h1>
            </div>
            <form action="/addCartService" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        {{-- <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                        <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                        <input type="text" name="staff_id" hidden value="{{ $booking->booking->staff->id }}"> --}}
                        <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Search Service" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
@endsection