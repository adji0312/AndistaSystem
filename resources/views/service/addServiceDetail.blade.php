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
                            <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteService" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/discard.png" alt="" style="width: 22px"> Discard</a>
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
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateUnit" onclick="updateUnit()"><i class="fas fa-pencil-alt"></i> Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- STAFF --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex justify-content-between m-2">
                        <h5 class="m-3">Staff</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addPriceService"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index2 = 0 ?>
                                {{-- @foreach ($priceService as $ps)
                                    <?php $index2+= 1; ?>
                                    <tr>
                                        <th>{{ $index }}</th>
                                        <td>{{ $ps->duration }}</td>
                                        <td>{{ $ps->duration_type }}</td>
                                        <td>{{ number_format($ps->price) }}</td>
                                        <td>{{ $ps->location->location_name }}</td>
                                        <td>{{ $ps->price_title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateUnit" onclick="updateUnit()"><i class="fas fa-pencil-alt"></i> Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}

                                <tr>
                                    <th>1</th>
                                    <td>Dr. Adji Budhi Setyawan</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateUnit" onclick="updateUnit()"><i class="fas fa-pencil-alt"></i> Update</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

@endsection

{{-- STAFF --}}
                    {{-- <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Staff</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <div class="d-flex">
                                    <div class="form-check m-3 mb-0" style="font-size: 15px;">
                                        <input class="form-check-input" type="radio" name="staff" id="nostaff" value="nostaff" checked>
                                        <label class="form-check-label" for="nostaff">
                                            No Staff
                                        </label>
                                        </div>
                                        <div class="form-check m-3 mb-0">
                                        <input class="form-check-input" type="radio" name="staff" id="withstaff" value="withstaff">
                                        <label class="form-check-label" for="withstaff">
                                            With Staff
                                        </label>
                                        
                                    </div>
                                </div>

                                @if (isset($lengthStaff))
                                    <div class="mt-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Job Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($lengthStaff))
                                                    @for ($i = 0; $i < $lengthStaff; $i++)
                                                        <tr>
                                                            <td>{{ App\Models\Staff::find($staffId[$i])->staff_name }}</td>
                                                            <td>{{ App\Models\Staff::find($staffId[$i])->job_title }}</td>
                                                        </tr>
                                                        
                                                    @endfor
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="m-3" id="addstaff" style="display: none">
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staffservice" onclick="viewId()"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div> --}}

                    {{-- FACILITY --}}
                    {{-- <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Facility</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <div class="d-flex">
                                    <div class="form-check m-3 mb-0" style="font-size: 15px;">
                                        <input class="form-check-input" type="radio" name="facility" id="nofacility" value="nofacility" checked>
                                        <label class="form-check-label" for="nofacility">
                                            No Facility
                                        </label>
                                        </div>
                                        <div class="form-check m-3 mb-0">
                                        <input class="form-check-input" type="radio" name="facility" id="withfacility" value="withfacility">
                                        <label class="form-check-label" for="withfacility">
                                            With Facility
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3" id="addfacility" style="display: none">
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#facility"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div> --}}

