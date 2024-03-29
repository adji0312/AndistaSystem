@extends('main')
@section('container')

    <div class="wrapper">
        @include('customer.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">Edit Customer</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                      <div class="d-flex gap-4">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/customer/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" onclick="saveUpdateCustomer()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
                          </li>
                      </div>
                      <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                </div>
            </div>
            @include('customer.sidenavcustomer')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/saveUpdateCustomer/{{ $customer->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        {{-- @dd($customer->join_date) --}}
                        <h5 class="m-3">Edit Customer {{ $customer->first_name }}</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ $customer->first_name }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $customer->middle_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $customer->last_name }}">
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
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree" required>
                                    <option value="{{ $customer->degree }}" class="selectstatus" style="color: black;" selected>{{ $customer->degree }}</option>
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
                                <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{$customer->nickname}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Phone</label>
                                <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="{{ $customer->phone}}">
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
                                <input type="email" class="form-control" name="email" id="email" value="{{ $customer->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="messenger_type" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messenger</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="messenger_type" id="messenger_type" required>
                                    <option value="{{ $customer->messengerId }}" class="selectstatus" style="color: black;" selected >{{ $messengerTypeCurr->type_name }}</option>
                                    @foreach ($messengerType as $mt)
                                        <option value="{{ $customer->messengerId }}" class="selectstatus" style="color: black;">{{ $mt->type_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Tn</option>  
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="messenger" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messengger ID</label>
                                <input type="text" class="form-control" name="messenger" id="messenger" value="{{ $customer->messenger }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="address" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            </div> --}}
                            
                        </div>
                        
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="card_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Card Type</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="card_type" id="card_type" required>
                                    <option value="{{ $customer->card_type }}" class="selectstatus" style="color: black;" selected>{{ $customer->card_type }}</option>
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
                                <input type="text" class="form-control" name="id_no" id="id_no" value="{{ $customer->no_id }}" required>
                            </div>
                            {{-- <div class="mb-3">
                                join date
                                <label for="join_date" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Join Date</label>
                                <input type="date" class="form-control" id="date_of_birth_customer" name="date_of_birth_customer" value="{{ $customer->join_date }}" required>
                            
                            </div> --}}
                            <div class="mb-3">
                                <label for="customer_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_gender" id="customer_gender" required>
                                    <option value="{{ $customer->gender }}" class="selectstatus" style="color: black;" selected>{{ $customer->gender }}</option>
                                    {{-- @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach --}}
                                    <option value="Male" class="selectstatus" style="color: black;">Male</option>
                                    <option value="Female" class="selectstatus" style="color: black;">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="m-3 d-flex gap-5">
                            
                            <div class="mb-3">
                                {{-- date of birth --}}
                                <label for="date_of_birth_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth_customer" name="date_of_birth_customer" value="{{ $customer->date_of_birth }}" required>
                            
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $customer->address }}">
                            </div>
                        </div>

                        {{-- <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="location" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location" id="gender" required>
                                    <option value="{{ $customer->location_id }}" class="selectstatus" style="color: black;" selected disabled>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                    <option value="Tn" class="selectstatus" style="color: black;">Male</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Female</option>
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="policy_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Policy</label>
                                @if (count($policies) != 0 || count($policies) != null)
                                    <div class="d-flex">
                                        <div class="form-check m-3 mb-0" style="font-size: 15px;">
                                            <input class="form-check-input" type="radio" name="policy_id" id="defaultPolicy" value="{{ $policies[0]->id }}" checked>
                                            <label class="form-check-label" for="defaultPolicy">
                                                Default
                                            </label>
                                            </div>
                                            <div class="form-check m-3 mb-0">
                                            <input class="form-check-input" type="radio" name="policy_id" id="customPolicy" value="customPolicy">
                                            <label class="form-check-label" for="customPolicy">
                                                Custom
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                            
                                <select class="form-select mt-3 mb-4" style="font-size: 15px; color: #7C7C7C; width: 300px" name="policy_id" id="policy_id" disabled>
                                    @foreach ($policies as $policy)
                                        @if ($policy->form_name == "FORM PERSETUJUAN TINDAKAN")
                                            <option value="{{ $policy->id }}" class="selectstatus" style="color: black;" selected>{{ $policy->form_name }}</option>
                                            @continue
                                        @endif
                                            <option value="{{ $policy->id }}" class="selectstatus" style="color: black;">{{ $policy->form_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </div>

                    {{-- Sub Customer List (PET) --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Sub Customer (Pet)</h5>
                        {{-- @dd($customer->pets) --}}
                        <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                            <div class="m-3 d-flex gap-5">
                                {{-- <div class="mb-3">
                                    <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Name</label>
                                    <input type="text" class="form-control" name="pet_name" id="pet_name" value="{{ $customer->pets->pet_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Type</label>
                                    <input type="text" class="form-control" name="pet_type" id="pet_type" value="{{ $customer->pets->pet_type }}">
                                </div>
                                <div class="mb-3">
                                    <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Ras</label>
                                    <input type="text" class="form-control" name="pet_ras" id="pet_ras" value="{{ $customer->pets->pet_ras }}">
                                </div> --}}
                            </div>
                            <div class="m-3 d-flex gap-5">
                                <div class="mb-3">
                                    <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Gender</label>
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="gender" id="gender" required>
                                        {{-- <option value="{{ $customer->pets->pet_gender }}" class="selectstatus" style="color: black;" selected>{{ $customer->pets->pet_gender }}</option> --}}
                                        {{-- @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach --}}
                                        <option value="Male" class="selectstatus" style="color: black;">Male</option>
                                        <option value="Female" class="selectstatus" style="color: black;">Female</option>
                                    </select>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="date_of_birth_pet" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth_pet" name="date_of_birth_pet" value="{{ $customer->pets->date_of_birth }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Pet Color</label>
                                    <input type="text" class="form-control" name="pet_color" id="pet_color" value="{{ $customer->pets->pet_color }}">
                                </div> --}}
                            </div>
                        </div>
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
                    

                    <button type="submit" id="saveUpdateCustomer" hidden></button>
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