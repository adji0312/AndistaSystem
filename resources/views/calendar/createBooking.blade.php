@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/calendar" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveService()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            <form action="/addFacility" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Scheduling</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="facility_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Customer</label>
                            <input type="text" class="form-control" id="facility_name" name="facility_name">
                        </div>
                        <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="status" name="status">
                            <option value="Active" class="selectstatus" style="color: black;">Active</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                          <input type="date" class="form-control">
                        </div>
                        {{-- <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="status" name="status">
                            <option value="Active" class="selectstatus" style="color: black;">Terdaftar Sementara</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Terkonfirmasi</option>
                          </select>
                        </div> --}}
                    </div>
                </div>

                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Prices</h5>
                    <div id="afterPrice" class="table-responsive">
                        <table class="table m-3" style="width: 95%;" id="priceDuplicate">
                            <thead>
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Time</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Staff</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 30%">
                                    {{-- <input type="text" class="form-control" name="duration[]" id="duration"> --}}
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id[]" id="location_price_id">
                                        {{-- @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 15%;" >
                                    <input type="text" class="form-control">
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 200px;">
                                    {{-- <input type="text" class="form-control" name="price[]" id="price"> --}}
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id[]" id="location_price_id">
                                        {{-- @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </td>
                                {{-- <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" aria-label="Default select example">
                                        <option value="" class="selectstatus" style="color: black;">All Customers</option>
                                    </select>
                                </td> --}}
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id[]" id="location_price_id">
                                        {{-- @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 15%;">
                                    <input disabled type="text" class="form-control"name="price_title[]" id="price_title">
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
                    </div>

                    <div class="m-3 mt-4">
                        <div class="mb-3">
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="tax_id" id="tax_id">
                                <option selected value="" disabled class="selectstatus" style="color: black;">Reason for Visit</option>
                                {{-- @foreach ($tax as $t)
                                    <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>   
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
                
                <button type="submit" id="submitFacility" hidden></button>
            </form>
        </div>
    </div>
  </div>
@endsection
