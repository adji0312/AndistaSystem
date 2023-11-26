@extends('main')
@section('container')

    <div class="wrapper">
        @include('customer.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">New Service</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" onclick="savePets()" style="color: #f28123; cursor: pointer;">Next <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
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
                <form action="/addService" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Customer Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ $customers->first_name }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $customers->middle_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $customers->last_name }}" required>
                            </div>
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
                                <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Degree</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Degree</option>
                                    {{-- @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach --}}
                                    <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nick_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Nick Name</label>
                                <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{ $customers->nickname }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Phone</label>
                                <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="{{ $customers->phone }}" >
                            </div>
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
                                <label for="email" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $customers->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="messenger_type" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messenger</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="messenger_type" id="messenger_type" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Messenger Type</option>
                                    @foreach ($messengerType as $mt)
                                        <option value="{{ $mt->id }}" class="selectstatus" style="color: black;">{{ $mt->type_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="messenger" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messengger ID</label>
                                <input type="text" class="form-control" name="messenger" id="messenger" value="{{ old('messenger') }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="address" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            </div> --}}
                            
                        </div>
                        
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="card_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Card Type</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="card_type" id="card_type" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Card Type</option>
                                    {{-- @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach --}}
                                    <option value="Passport" class="selectstatus" style="color: black;">Passport</option>
                                    <option value="KTP" class="selectstatus" style="color: black;">KTP</option>
                                    <option value="SIM" class="selectstatus" style="color: black;">SIM</option>
                                    <option value="Others" class="selectstatus" style="color: black;">Others</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                {{-- id number --}}
                                <label for="id_no" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">ID Number</label>
                                <input type="text" class="form-control" name="id_no" id="id_no" value="{{ old('id_no') }}" >
                            </div>
                            <div class="mb-3">
                                {{-- join date --}}
                                <label for="join_date" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Join Date</label>
                                <input type="date" class="form-control" id="join_date" name="join_date" >
                            
                            </div>
                        </div>

                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="customer_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_gender" id="customer_gender" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Gender</option>
                                    {{-- @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach --}}
                                    <option value="Male" class="selectstatus" style="color: black;">Male</option>
                                    <option value="Female" class="selectstatus" style="color: black;">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                {{-- date of birth --}}
                                <label for="date_of_birth_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth_customer" name="date_of_birth_customer" >
                            
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="location" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location" id="gender" required>
                                    <option value="{{ $customers->location_id }}" class="selectstatus" style="color: black;" selected disabled>{{ $locCurr->location_name }}</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Male</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Female</option> --}}
                                </select>
                            </div>
                        </div>

                    {{-- Sub Customer List (PET) --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex gap-1 m-2">
                            <h5 class="m-3">Sub Account</h5>
                            <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addSubAccount"><i class="fas fa-plus"></i> Add New Sub Account</button>
                        </div>
                        <div class="mx-4 table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sub Account Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Ras</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Date of Birth</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pets as $pet)
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $pet->id }}]" name="checkBoxPet"  value="{{ $pet->id }}">
                                                </div>
                                            </th>
                                            <td>{{ $pet->pet_name }}</td>
                                            <td>{{ $pet->pet_type }}</td>
                                            <td>{{ $pet->pet_ras }}</td>
                                            <td>{{ $pet->pet_color }}</td>
                                            <?php $date = date_create($pet->date_of_birth) ?>
                                            <td>{{ date_format($date, 'd F Y') }}</td>
                                            <td>{{ $pet->pet_gender }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateSubAccount{{ $pet->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteSubAccount{{ $pet->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <div class="modal fade" id="deleteSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Sub Account</h1>
                                                </div>
                                                
                                                <form action="/deleteSubAccount/{{ $pet->id }}" method="GET">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <small class="fs-6" style="font-weight: 300">Are you sure delete this sub account?</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Discard</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
    
                                        <div class="modal fade" id="updateSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sub Account</h1>
                                                </div>
                                                <form action="/updateSubAccount/{{ $pet->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            {{-- <input type="hidden" value="{{ $booking->customer->id }}" name="customer_id"> --}}
                                                            <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                                            <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $pet->pet_name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                                                            <input type="text" class="form-control" id="pet_type" name="pet_type" value="{{ $pet->pet_type }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C;">Ras</label>
                                                            <input type="text" class="form-control" id="pet_ras" name="pet_ras" value="{{ $pet->pet_ras }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C;">Color</label>
                                                            <input type="text" class="form-control" id="pet_color" name="pet_color" value="{{ $pet->pet_color }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date_of_birth" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date of Birth</label>
                                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $pet->date_of_birth }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                                            <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                                                                @if ($pet->pet_gender == "Male")
                                                                    <option value="Male" class="selectstatus" name="pet_gender" style="color: black;" selected>Male</option>
                                                                    <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Female</option>
                                                                @else
                                                                    <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Male</option>
                                                                    <option value="Female" class="selectstatus" name="pet_gender" style="color: black;" selected>Female</option>
                                                                @endif
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

                                        <div class="modal fade" id="addSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub Account</h1>
                                                </div>
                                                <form action="/addSubAccount/{{ $pet->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            {{-- <input type="hidden" value="{{ $booking->customer->id }}" name="customer_id"> --}}
                                                            <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                                            <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $pet->pet_name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                                                            <input type="text" class="form-control" id="pet_type" name="pet_type" value="{{ $pet->pet_type }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C;">Ras</label>
                                                            <input type="text" class="form-control" id="pet_ras" name="pet_ras" value="{{ $pet->pet_ras }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C;">Color</label>
                                                            <input type="text" class="form-control" id="pet_color" name="pet_color" value="{{ $pet->pet_color }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date_of_birth" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date of Birth</label>
                                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $pet->date_of_birth }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                                            <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                                                                @if ($pet->pet_gender == "Male")
                                                                    <option value="Male" class="selectstatus" name="pet_gender" style="color: black;" selected>Male</option>
                                                                    <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Female</option>
                                                                @else
                                                                    <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Male</option>
                                                                    <option value="Female" class="selectstatus" name="pet_gender" style="color: black;" selected>Female</option>
                                                                @endif
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                        {{-- <div id="afterPrice" class="table-responsive">
                            <table class="table m-3" style="width: 95%;" id="priceDuplicate">
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
                            </table>
                        </div>
                        
                        <div class="m-3 mt-4">
                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicatePriceService()"><i class="fas fa-plus"></i> Add</button>
                        </div> --}}

                        
                    </div>
                    

                    <button type="submit" id="submitPets" hidden></button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pets</h1>
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