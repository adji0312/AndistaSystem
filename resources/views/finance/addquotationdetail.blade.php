@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $quotation->quotation_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/quotation/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Paid</a>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addQuotation" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        {{-- <h5 class="m-3">Basic Info</h5> --}}
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" required style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id">
                                    @foreach ($locations as $location)
                                        @if ($location->id == $quotation->location_id)
                                            <option selected value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                            @continue;
                                        @endif
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3" style="width: 230px">
                                <label for="capacity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                                <input type="date" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ $quotation->quotation_date }}">
                                @error('capacity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                              <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Customer</label>
                              <input type="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ $quotation->customer->first_name }}" disabled>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex justify-content-between m-2">
                            <div class="d-flex m-2">
                                <h5 class="m-3">Item</h5>
                                <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Add Product</button>
                            </div>
                        </div>
    
                        <div class="mx-4 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%">No</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Staff</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $index = 0; ?>
                                    @foreach ($quoItem as $qi)
                                        <?php $index += 1; ?>
                                        <tr>
                                            <th>{{ $index }}</th>
                                            <td>{{ $qi->product->product_name }}</td>
                                            <td>{{ $qi->quantity }}</td>
                                            <td>{{ $qi->staff->first_name }}</td>
                                            <td>Rp {{ number_format($qi->price) }}</td>
                                            @if ($qi->flag == 1)
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $qi->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $qi->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                        <form action="/saveCartBooking3/{{ $qi->id }}" method="post" style="width: 100%">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Save</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $qi->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>

                                        <div class="modal fade" id="updateCartBooking{{ $qi->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product Cart</h1>
                                                </div>
                                                <form action="/updateCartBooking3/{{ $qi->id }}" method="post">
                                                    @csrf
                                                    <input type="text" name="quotation_id" value="{{ $quotation->id }}" hidden>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stock Product</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $qi->product->stock }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $qi->quantity }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Staff</label>
                                                            <select class="form-select" aria-label="Default select example" name="staff_id">
                                                                <option selected disabled>Select Staff</option>
                                                                @foreach ($staffs as $staff)
                                                                    @if ($staff->id == $qi->staff_id)
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

                                        <div class="modal fade" id="deleteCartBooking{{ $qi->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                                    </div>
                                                    
                                                    <form action="/deleteCartBooking3/{{ $qi->id }}" method="GET">
                                                        @csrf
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="width: 50%;" class="float-end">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-end">Sub-total</th>
                                <td colspan="2">Rp {{ number_format($quotation->total_price) }}</td>
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
                                <td colspan="2">Rp {{ number_format($quotation->total_price) }}</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCartProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
            </div>
            <form action="/addCartProduct3" method="post">
                @csrf
                <input type="text" value="{{ $quotation->id }}" name="quotation_id" hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="product_id_cart" name="product_id" placeholder="Search here ...">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Staff</label>
                        <select class="form-select" aria-label="Default select example" name="staff_id">
                            <option selected disabled>Select Staff</option>
                            @foreach ($staffs as $staff)
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
@endsection