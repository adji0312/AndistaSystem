@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $service->service_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/service/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveFacility()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#discardChange" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/discard.png" alt="" style="width: 22px"> Discard</a>
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
                <form action="/saveChange/{{ $service->id }}" method="POST">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Service Name</label>
                                <input type="text" class="form-control" name="service_name" id="service_name" value="{{ $service->service_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="simple_service_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Simple Name</label>
                                <input type="text" class="form-control" name="simple_service_name" id="simple_service_name" value="{{ $service->simple_service_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="status" id="status">
                                    @if ($service->status == "Active")
                                        <option value="Active" class="selectstatus" style="color: black;" selected>Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                    @else
                                        <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;" selected>Disabled</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location_id" id="location_id">
                                    @foreach ($locations as $location)
                                        @if ($location->id == $service->location_id)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;" selected>{{ $location->location_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="category_service_id" id="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->id == $service->category_service_id)
                                            <option value="{{ $category->id }}" class="selectstatus" style="color: black;" selected>{{ $category->category_service_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $category->id }}" class="selectstatus" style="color: black;">{{ $category->category_service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tax_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_id" id="tax_id">
                                    @foreach ($tax as $t)
                                        @if ($t->id == $service->tax_id)
                                            <option value="{{ $t->id }}" class="selectstatus" style="color: black;" selected>{{ $t->tax_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
    
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Policy</label>
                                            
                                <select class="form-select mt-1 mb-4" style="font-size: 15px; color: #7C7C7C; width: 300px" name="policy_id" id="policy_id">
                                    @foreach ($policies as $policy)
                                        @if ($policy->id == $service->policy_id)
                                            <option value="{{ $policy->id }}" class="selectstatus" style="color: black;" selected>{{ $policy->form_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $policy->id }}" class="selectstatus" style="color: black;">{{ $policy->form_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submitFacility" hidden></button>
                </form>

                {{-- PRICES --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="m-3">Prices</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addPriceService"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" style="width: 8%">Duration</th>
                                    <th scope="col">Units</th>
                                    <th scope="col">Price (Rp)</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0 ?>
                                @foreach ($priceService as $ps)
                                    <?php $index+= 1; ?>
                                    <tr>
                                        <th>{{ $index }}</th>
                                        <td>{{ $ps->duration }}</td>
                                        <td>{{ $ps->duration_type }}</td>
                                        <td>{{ number_format($ps->price) }}</td>
                                        {{-- <td>{{ $ps->location_price_id }}</td> --}}
                                        <td>{{ $ps->location->location_name }}</td>
                                        <td>{{ $ps->price_title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updatePriceService{{ $ps->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deletePriceService{{ $ps->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deletePriceService{{ $ps->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Price</h1>
                                            </div>
                                            
                                            <form action="/deletePriceService/{{ $ps->id }}" method="GET">
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

                                    <div class="modal fade" id="updatePriceService{{ $ps->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Price</h1>
                                            </div>
                                            <form action="/updatePriceService/{{ $ps->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" value="{{ $service->id }}" name="service_id">
                                                        <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                                                        <input type="number" class="form-control" id="duration" name="duration" value="{{ $ps->duration }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="duration_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Units</label>
                                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="duration_type" id="duration_type">
                                                            @if ($ps->duration_type == "Minutes")
                                                                <option value="Minutes" class="selectstatus" style="color: black;" selected>Minutes</option>
                                                                <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                                                                <option value="Days" class="selectstatus" style="color: black;">Days</option>
                                                                <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>
                                                            @elseif($ps->duration_type == "Hours")
                                                                <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                                                                <option value="Hours" class="selectstatus" style="color: black;" selected>Hours</option>
                                                                <option value="Days" class="selectstatus" style="color: black;">Days</option>
                                                                <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>    
                                                            @elseif($ps->duration_type == "Days")
                                                                <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                                                                <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                                                                <option value="Days" class="selectstatus" style="color: black;" selected>Days</option>
                                                                <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>    
                                                            @elseif($ps->duration_type == "Weeks")
                                                                <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                                                                <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                                                                <option value="Days" class="selectstatus" style="color: black;">Days</option>
                                                                <option value="Weeks" class="selectstatus" style="color: black;" selected>Weeks</option>    
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Price (Rp)</label>
                                                        <input type="number" class="form-control" id="price" name="price" value="{{ $ps->price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location_price_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id" id="location_price_id">
                                                            @foreach ($locations as $location)
                                                                @if ($location->id == $ps->location_price_id)
                                                                    <option value="{{ $location->id }}" class="selectstatus" style="color: black;" selected>{{ $location->location_name }}</option>
                                                                    @continue
                                                                @endif
                                                                <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price_title" class="form-label" style="font-size: 15px; color: #7C7C7C;">Title</label>
                                                        <input type="text" class="form-control" id="price_title" name="price_title" value="{{ $ps->price_title }}">
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

                {{-- STAFF --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="m-3">Staff</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#staffservice"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col" style="width: 77%">Staff Name</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index2 = 0 ?>
                                {{-- Looping Staff Table --}}
                                <tr>
                                    <th>1</th>
                                    <td>Dr. A</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- FACILITY --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="m-3">Facility</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#facilityModal"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Units</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index3 = 0 ?>

                                @foreach ($servicefacility as $sf)
                                    <?php $index3 += 1; ?>
                                    <tr>
                                        <th>{{ $index3 }}</th>
                                        <td>{{ $sf->facility->facility_name }}</td>
                                        <td>{{ $sf->facility->location->location_name }}</td>
                                        <td>{{ $sf->facility->capacity }}</td>
                                        <td>{{ $sf->facility->units->where('unit_status', "Active")->count() }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteFacilityService{{ $sf->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteFacilityService{{ $sf->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Facility</h1>
                                            </div>
                                            
                                            <form action="/deleteFacilityService/{{ $sf->id }}" method="GET">
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

            </div>
        </div>
    </div>

    {{-- Price Modal --}}
    <div class="modal fade" id="addPriceService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Price</h1>
            </div>
            <form action="/addPriceService" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" value="{{ $service->id }}" name="service_id">
                        <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                        <input type="number" class="form-control" id="duration" name="duration">
                    </div>
                    <div class="mb-3">
                        <label for="duration_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Units</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="duration_type" id="duration_type">
                            <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                            <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                            <option value="Days" class="selectstatus" style="color: black;">Days</option>
                            <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Price (Rp)</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="location_price_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id" id="location_price_id">
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price_title" class="form-label" style="font-size: 15px; color: #7C7C7C;">Title</label>
                        <input type="text" class="form-control" id="price_title" name="price_title">
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

    {{-- Staff Modal --}}
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
                        @foreach ($staff as $st)
                            <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="getIdStaff" name="getIdStaff" value="{{ $st->id }}">
                            </th>
                            <td>{{ $st->staff_name }}</td>
                            <td>{{ $st->gender }}</td>
                            <td>{{ $st->job_title }}</td>
                            </tr>
                        @endforeach
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

    {{-- Facility Modal --}}
    <div class="modal fade" id="facilityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Facility</h1>
                </div>
                <form action="/addFacilityService" method="POST">
                    @csrf
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Facility Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Units</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($facilities as $facility)
                                    @if (App\Models\ServiceAndFacility::where('service_id', $service->id)->where('facility_id', $facility->id)->exists())
                                        @continue;
                                    @endif
                                    <tr>
                                        <th>
                                            <input type="hidden" value="{{ $service->id }}" name="service_id">
                                            <input class="form-check-input" type="checkbox" value="{{ $facility->id }}" id="facility_id" name="facility_id[]">
                                        </th>
                                        <td>{{ $facility->facility_name }}</td>
                                        <td>{{ $facility->location->location_name }}</td>
                                        <td>{{ $facility->capacity }}</td>
                                        <td>{{ $facility->units->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="discardChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Discard {{ $service->service_name }}</h1>
            </div>
            
            <form action="/discardChange/{{ $service->id }}" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <small class="fs-6" style="font-weight: 300">Are you sure discard this item?</small>
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
@endsection

