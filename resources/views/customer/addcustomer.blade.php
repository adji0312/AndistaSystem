@extends('main')
@section('container')

    <div class="wrapper">
        @include('customer.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">New Customer</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                      <div class="d-flex gap-4">
                        <a class="nav-link active" aria-current="page" href="/customer/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                        <a class="nav-link active" aria-current="page" onclick="saveCustomer()" style="color: #f28123; cursor: pointer;">Next <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
                      </div>
                    </div>
                </div>
            </div>
            @include('customer.sidenavcustomer')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addCustomer" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Customer Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Degree</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Degree</option>
                                    <option value="Tn" class="selectstatus" style="color: black;">Tn</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Ny</option>
                                    <option value="Mr" class="selectstatus" style="color: black;">Mr</option>
                                    <option value="Mrs" class="selectstatus" style="color: black;">Mrs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nick_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Nick Name</label>
                                <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{ old('nick_name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Phone</label>
                                <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="{{ old('phone_customer') }}" >
                            </div>
                        </div>

                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="email" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="messenger_type" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messenger</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="messenger_type" id="messenger_type" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Messenger Type</option>
                                    @foreach ($messengerType as $mt)
                                        <option value="{{ $mt->id }}" class="selectstatus" style="color: black;">{{ $mt->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="messenger" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Messengger ID</label>
                                <input type="text" class="form-control" name="messenger" id="messenger" value="{{ old('messenger') }}">
                            </div>
                            
                        </div>
                        
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="card_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Card Type</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="card_type" id="card_type" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Card Type</option>
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
                                <label for="location" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location" id="gender" required>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="customer_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_gender" id="customer_gender" >
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Gender</option>
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
                    </div>
                    

                    <button type="submit" id="submitCustomer" hidden></button>
                </form>
            </div>
        </div>
    </div>

@endsection