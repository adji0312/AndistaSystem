@extends('main')
@section('container')

    <div class="wrapper">
        @include('product.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">New Product</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                      <div class="d-flex gap-4">
                        <a class="nav-link active" aria-current="page" href="/product/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                        <a class="nav-link active" aria-current="page" onclick="saveCustomer()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
                      </div>
                    </div>
                </div>
            </div>
            @include('product.sidenavproduct')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Product Details</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="product_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ old('product_name') }}" required>
                                @error('product_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="simple_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Simple Name</label>
                                <input type="text" class="form-control" name="simple_name" id="simple_name" value="{{ old('simple_name') }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="last_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="status" id="status">
                                    <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="brand_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Brand</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="brand_id" id="brand_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Brand</option>
                                    @foreach ($brands as $b)
                                        <option value="{{ $b->id }}" class="selectstatus" style="color: black;">{{ $b->brand_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Supplier</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="supplier_id" id="supplier_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Supplier</option>
                                    @foreach ($suppliers as $sup)
                                        <option value="{{ $sup->id }}" class="selectstatus" style="color: black;">{{ $sup->suppliers_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category Product</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="category_id" id="category_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Category Product</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" class="selectstatus" style="color: black;">{{ $cat->category_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="phone_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Phone</label>
                                <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="{{ old('phone_customer') }}">
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="category_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="category_service_id" id="category_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="selectstatus" style="color: black;">{{ $category->category_service_name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            
                            {{-- <div class="mb-3">
                                <label for="tax_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_id" id="tax_id">
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Tax</option>
                                    @foreach ($tax as $t)
                                        <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="description" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ old('description') }}" required>
                                {{-- @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="status" id="status" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Status</option>
                                    {{-- @foreach ($suppliers as $sup)
                                        <option value="{{ $sup->id }}" class="selectstatus" style="color: black;">{{ $sup->suppliers_name }}</option>
                                    @endforeach --}}
                                    <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                    {{-- <option value="Mr" class="selectstatus" style="color: black;">Mr</option> --}}
                                    {{-- <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location_id" id="location_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Location</option>
                                    @foreach ($location as $loc)
                                        <option value="{{ $loc->id }}" class="selectstatus" style="color: black;">{{ $loc->location_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Active</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Disabled</option> --}}
                                    {{-- <option value="Mr" class="selectstatus" style="color: black;">Mr</option> --}}
                                    {{-- <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                        </div>
                        

                    {{-- Sub Customer List (PET) --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Pricing</h5>
                        {{-- <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;"> --}}
                            <div class="m-3 d-flex gap-5">
                                <div class="mb-3">
                                    <label for="tax_rate_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax</label>
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_rate_id" id="tax_rate_id">
                                        <option value="" class="selectstatus" style="color: black;" selected disabled>Select Tax Rate</option>
                                        
                                        @foreach ($tax as $t)
                                            <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }}</option>
                                        @endforeach
                                        {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                        <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                        <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                        <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Price</label>
                                    <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Stock</label>
                                    <input type="text" class="form-control" name="stock" id="stock" value="{{ old('stock') }}">
                                </div>
                                
                            </div>
                            {{-- <div class="m-3 d-flex gap-5">
                                <div class="mb-3">
                                    <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Gender</label>
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="gender" id="gender" required>
                                        <option value="" class="selectstatus" style="color: black;" selected disabled>Select Gender</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach
                                        <option value="Male" class="selectstatus" style="color: black;">Male</option>
                                        <option value="Female" class="selectstatus" style="color: black;">Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_birth_pet" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth_pet" name="date_of_birth_pet" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Color</label>
                                    <input type="text" class="form-control" name="pet_color" id="pet_color" value="{{ old('pet_color') }}">
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                        {{-- <div id="afterPrice" class="table-responsive"> --}}
                            {{-- <table class="table m-3" style="width: 95%;" id="priceDuplicate">
                                <thead>
                                <tr>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Units</th>
                                    <th scope="col">Price (Rp)</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                        <input type="text" class="form-control" name="duration[]" id="duration">
                                    </td>
                                    <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="duration_type[]" id="duration_type">
                                            <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                                            <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                                            <option value="Days" class="selectstatus" style="color: black;">Days</option>
                                            <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>
                                        </select>
                                    </td>
                                    <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                        <input type="text" class="form-control" name="price[]" id="price">
                                    </td>
                                    <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id[]" id="location_price_id">
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                        <input type="text" class="form-control"name="price_title[]" id="price_title">
                                    </td>
                                    <td style="border: none">
                                        <div class="mb-3 mt-2 d-flex align-items-center" style="cursor: pointer" onclick="deletePrice(this.parentNode.parentNode.parentNode.parentNode.id)">
                                            <img src="/img/icon/minus.png" alt="" style="width: 20px">
                                        </div>
                                    </td>
                                </tr> 
                                </tbody>
                            </table> --}}
                        {{-- </div> --}}
                        
                        {{-- <div class="m-3 mt-4">
                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicatePriceService()"><i class="fas fa-plus"></i> Add</button>
                        </div> --}}

                        
                    </div>
                    

                    <button type="submit" id="submitCustomer" hidden></button>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staffservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Staff</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Job Title</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        {{-- @foreach ($staff as $st)
                            <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="getIdStaff" name="getIdStaff" value="{{ $st->id }}">
                            </th>
                            <td>{{ $st->staff_name }}</td>
                            <td>{{ $st->gender }}</td>
                            <td>{{ $st->job_title }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary" id="staffSave" onclick="saveStaff()"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="facility" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Facility</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Facility Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Units</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($facilities as $facility)
                            <tr>
                                <th>
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                </th>
                                <td>{{ $facility->facility_name }}</td>
                                <td>{{ $facility->location->location_name }}</td>
                                <td>{{ $facility->capacity }}</td>
                                <td>{{ $facility->units->count() }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>
@endsection