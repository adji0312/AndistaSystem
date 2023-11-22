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
                            <a class="nav-link active" aria-current="page" onclick="saveQuotation()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                              <input type="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ $quotation->customer_id }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="m-3">Item</h5>
                            <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addQuotationPrice"><i class="fas fa-plus"></i> Add</button>
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
                                    <th>1</th>
                                    <td>Whiskas</td>
                                    <td>1</td>
                                    <td>Adji Budhi Setyawan</td>
                                    <td>Price</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteFacilityService"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="width: 35%;" class="float-end">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-end">Sub-total</th>
                                <td colspan="2">Rp 100,000</td>
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
                                <td colspan="2">Rp 100,000</td>
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
@endsection