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
                        @if ($sale->status == 0)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Print</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Paid</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makeDeposit" style="color: #f28123; cursor: pointer;"><img src="/img/icon/deposit.png" alt="" style="width: 22px"> Deposit</a>
                            </li>
                        @endif
                      </ul>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    {{-- <h5 class="m-3">Basic Info</h5> --}}
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Booking No</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->booking->booking_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                            <input type="text" class="form-control" value="{{ $sale->booking->location->location_name }}" readonly>
                        </div>
                        <div class="mb-3" style="width: 230px">
                            <label for="capacity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Booking Date</label>
                            <input type="date" class="form-control" id="capacity" name="capacity" value="{{ $sale->booking->booking_date }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Customer</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->booking->customer->first_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Sub Customer</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->sub_booking->pet->pet_name }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
                        <h5 class="m-3">Item</h5>
                        @if ($sale->status == 0)
                            <button disabled type="button" class="btn btn-sm btn-outline-secondary m-2"><i class="fas fa-plus"></i> Add Product</button>
                            <button disabled type="button" class="btn btn-sm btn-outline-secondary m-2"><i class="fas fa-plus"></i> Add Service</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Add Product</button>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Add Service</button>
                        @endif
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Staff</th>
                                    <th scope="col">Sub Account</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bookingService)
                                    <tr>
                                        <th>1 - {{ $bookingService->id }}</th>
                                        <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $bookingService->service->service_name }}</td>
                                        <td>1</td>
                                        <td>{{ $bookingService->staff->first_name }}</td>
                                        <td>{{ $bookingService->subBooking->pet->pet_name }}</td>
                                        <td>Rp {{ number_format($bookingService->servicePrice->price) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteBookingService{{ $bookingService->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>

                                            <div class="modal fade" id="deleteBookingService{{ $bookingService->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                                        </div>
                                                        
                                                        <form action="/deleteBookingService2/{{ $bookingService->id }}" method="GET">
                                                            @csrf
                                                            <input type="text" hidden name="sale_id" value="{{ $sale->id }}">
                                                            <div class="modal-body">
                                                                <div class="mb-1">
                                                                    <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
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
                                        </td>
                                    </tr>
                                @endif
                                <?php 
                                    if($bookingService){
                                        $itemIndex = 1; 
                                    }else{
                                        $itemIndex = 0; 
                                    }
                                ?>
                                @foreach ($carts as $item)
                                    @if ($item->sub_booking_id == 0 || $item->staff_id == 0 || $item->flag == 1)
                                        {{-- @if ($item->subBooking->status == "Selesai") --}}
                                            <?php $itemIndex += 1; ?>
                                            <tr>
                                                <th>{{ $itemIndex }}</th>
                                                @if ($item->product_id != null)
                                                    <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $item->product->product_name }}</td>
                                                @else
                                                    <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $item->service->service_name }}</td>
                                                @endif
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    @if ($item->staff_id == 0)
                                                        -
                                                    @else
                                                        {{ $item->staff->first_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->sub_booking_id == 0)
                                                        -
                                                    @else
                                                        {{ $item->subBooking->pet->pet_name }}
                                                    @endif
                                                </td>
                                                <td>Rp {{ number_format($item->total_price) }}</td>
                                                <td>
                                                    @if ($item->flag == 1)
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $item->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $item->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                            <form action="/saveCartBooking2/{{ $item->id }}" method="post" style="width: 100%">
                                                                @csrf
                                                                <input type="text" hidden name="booking_id" value="{{ $sale->booking->booking_id }}">
                                                                <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Save</button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $item->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="deleteCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                                    </div>
                                                    
                                                    <form action="/deleteCartBooking2/{{ $item->id }}" method="GET">
                                                        @csrf
                                                        <input type="text" hidden name="sale_id" value="{{ $sale->id }}">
                                                        <div class="modal-body">
                                                            <div class="mb-1">
                                                                <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
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
                                        {{-- @endif --}}
                                    @else
                                        @if ($item->subBooking->status == "Selesai")
                                            <?php $itemIndex += 1; ?>
                                            <tr>
                                                <th>{{ $itemIndex }} - {{ $item->id }}</th>
                                                @if ($item->product_id != null)
                                                    <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $item->product->product_name }}</td>
                                                @else
                                                    <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $item->service->service_name }}</td>
                                                @endif
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->staff->first_name }}</td>
                                                <td>{{ $item->subBooking->pet->pet_name }}</td>
                                                <td>Rp {{ number_format($item->total_price) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $item->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="deleteCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                                    </div>
                                                    
                                                    <form action="/deleteCartBooking2/{{ $item->id }}" method="GET">
                                                        @csrf
                                                        <input type="text" hidden name="sale_id" value="{{ $sale->id }}">
                                                        <div class="modal-body">
                                                            <div class="mb-1">
                                                                <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
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
                                        @endif
                                    @endif

                                    @if ($item->product_id != null)
                                        <div class="modal fade" id="updateCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product Cart</h1>
                                                </div>
                                                <form action="/updateCartBooking2/{{ $item->id }}" method="post">
                                                    @csrf
                                                    <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stock Product</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->product->stock }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Staff</label>
                                                            <select class="form-select" aria-label="Default select example" name="staff_id">
                                                                <option selected disabled>Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    @if ($staff->id == $item->staff_id)
                                                                        <option value="{{ $staff->id }}" selected>{{ $staff->first_name }}</option>
                                                                        @continue;
                                                                    @endif
                                                                    <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                                                                @endforeach
                                                            </select>
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
                                    @else
                                        <div class="modal fade" id="updateCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Service Cart</h1>
                                                </div>
                                                <form action="/updateCartBooking2/{{ $item->id }}" method="post">
                                                    @csrf
                                                    <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Price</label>
                                                            <select class="form-select" aria-label="Default select example" name="service_price_id">
                                                                <option selected disabled>Select Price</option>
                                                                @foreach ($servicePrice->where('service_id', $item->service_id) as $sp)
                                                                    @if ($sp->id == $item->service_price_id)
                                                                        <option value="{{ $sp->id }}" selected>{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                        @continue; 
                                                                    @endif
                                                                    <option value="{{ $sp->id }}">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Staff</label>
                                                            <select class="form-select" aria-label="Default select example" name="staff_id">
                                                                <option selected disabled>Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    @if ($staff->id == $item->staff_id)
                                                                        <option value="{{ $staff->id }}" selected>{{ $staff->first_name }}</option>
                                                                        @continue;
                                                                    @endif
                                                                    <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                                                                @endforeach
                                                            </select>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 50%; margin-left: 10px;" class="float-end mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-end">Sub-total</th>
                                <td colspan="2">Rp {{ number_format($subbook->sub_total_price) }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sale->status == 0)
                                <tr>
                                    <th scope="row" class="text-end">Additional Cost (Description)</th>
                                    <td colspan="2"><input readonly type="text" placeholder="Description" style="width: 100%" name="deskripsi_tambahan_biaya" value="{{ $sale->deskripsi_tambahan_biaya }}"></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-end">Additional Cost (Price)</th>
                                    <td colspan="2"><input readonly type="number" placeholder="0.00" style="width: 100%" oninput="inputAdditionalCost()" name="tambahan_biaya" id="tambahan_biaya" value="{{ $sale->tambahan_biaya }}"></td>
                                </tr>
                            @else
                                <form action="/updateAddCost/{{ $sale->id }}" method="POST">
                                    @csrf
                                    <tr>
                                        <th scope="row" class="text-end">Additional Cost (Description)</th>
                                        <td colspan="2"><input type="text" placeholder="Description" style="width: 100%" name="deskripsi_tambahan_biaya" value="{{ $sale->deskripsi_tambahan_biaya }}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">Additional Cost (Price)</th>
                                        <td colspan="2"><input type="number" placeholder="0.00" style="width: 100%" oninput="inputAdditionalCost()" name="tambahan_biaya" id="tambahan_biaya" value="{{ $sale->tambahan_biaya }}"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">Discount (Percentage)</th>
                                        <td colspan="2"><input type="number" placeholder="0.00" style="width: 100%" oninput="inputAdditionalCost()" name="tambahan_biaya" id="tambahan_biaya" value="{{ $sale->tambahan_biaya }}"></td>
                                    </tr>
                                    <button type="submit" id="buttonAddCost" hidden></button>
                                </form>
                            @endif
                            <tr>
                                <th scope="row" class="text-end">Total Price</th>
                                <input type="number" id="total_price" name="total_price" value="">
                                <input type="number" id="before_total_price" name="before_total_price" value="{{ $sale->total_price }}" hidden>
                                <td colspan="2" id="total_price_sale">Rp {{ number_format($sale->total_price) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($sale->status == 0)
                        <button type="button" disabled class="btn btn-outline-secondary btn-sm float-end" onclick="addAdditionalCost()"><i class="fas fa-save"></i> Save Price</button>
                    @else
                        <button type="button" class="btn btn-outline-primary btn-sm float-end" onclick="addAdditionalCost()"><i class="fas fa-save"></i> Save Price</button>
                    @endif
                </div>

                <div class="mt-4 mb-4">
                    <small><strong>Instruksi Pembayaran</strong></small>
                    <p style="color: black; font-size: 15px">Gunakan informasi berikut ini untuk transfer bank, internet banking, deposit, dan buku cek: BCA
                        Atas nama: PT. Andista Medika Veteriner
                        Nomor rekening: 31-0032-049-4</p>
                </div>
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
                <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
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
    
    <div class="modal fade" id="makeDeposit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Make Deposit</h1>
            </div>
            <form action="/makeDeposit" method="post">
                @csrf
                <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
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
                        <label for="deposit" class="form-label" style="font-size: 15px; color: #7C7C7C;">Deposit</label>
                        <input type="number" class="form-control mt-1" id="deposit" name="deposit">
                    </div>
                    <div class="mb-3">
                        <label for="payment_note" class="form-label" style="font-size: 15px; color: #7C7C7C;">Note</label>
                        <input type="text" class="form-control mt-1" id="payment_note" name="payment_note">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Make Deposit</button>
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
            <form action="/addCartProduct2" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        {{-- {{ $sale->booking }} --}}
                        <input type="text" name="booking_id" hidden value="{{ $sale->booking->id }}">
                        <input type="text" name="sale_id" hidden value="{{ $sale->id }}">
                        {{-- <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
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
            <form action="/addCartService2" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="booking_id" hidden value="{{ $sale->booking->id }}">
                        <input type="text" name="sub_booking_id" hidden value="{{ $sale->sub_booking->id }}">
                        <input type="text" name="sale_id" hidden value="{{ $sale->id }}">
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