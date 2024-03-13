@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $service->service_name }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                      <div class="d-flex gap-4">
                        <a class="nav-link active" aria-current="page" href="/service/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                        @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 1)
                            <a class="nav-link active" aria-current="page" onclick="saveFacility()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Simpan</a>
                        @else
                        @endif
                        @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                            <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#discardChange" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/discard.png" alt="" style="width: 22px"> Batalkan</a>
                        @else
                        @endif
                      </div>
                    </div>
                </div>
            </div>
            @include('service.sidenavservice')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/saveChange/{{ $service->id }}" method="POST">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Nama Servis</label>
                                <input type="text" class="form-control @error('service_name') is-invalid @enderror" name="service_name" id="service_name" value="{{ old('service_name', $service->service_name) }}" required>
                                @error('service_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi</label>
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
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Kategori</label>
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
                            
                            {{-- <div class="mb-3">
                                <label for="tax_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                                @if ($service->tax_id == 0)
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_id" id="tax_id">
                                        <option value="" class="selectstatus" style="color: black;" selected disabled>Select Tax</option>
                                        @foreach ($tax as $t)
                                            <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_id" id="tax_id">
                                        @foreach ($tax as $t)
                                            @if ($t->id == $service->tax_id)
                                                <option value="{{ $t->id }}" class="selectstatus" style="color: black;" selected>{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>
                                                @continue
                                            @endif
                                            <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>
                                        @endforeach
                                        <option value="0" class="selectstatus" style="color: black;">No Tax</option>
                                    </select>
                                @endif
                            </div> --}}
                        </div>
    
    
                        {{-- <div class="m-3 d-flex gap-5">
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
                        </div> --}}
                    </div>
                    <button type="submit" id="submitFacility" hidden></button>
                </form>

                {{-- PRICES --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
                        <h5 class="m-3">Harga Servis</h5>
                        @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addPriceService"><i class="fas fa-plus"></i> Add</button>
                        @else
                        @endif
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" style="width: 8%">Durasi</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Harga (Rp)</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Nama</th>
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
                                                @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updatePriceService{{ $ps->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                @else
                                                @endif
                                                @if(Auth::user()->role->service_list === 1)  
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deletePriceService{{ $ps->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                @else
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deletePriceService{{ $ps->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Harga Servis</h1>
                                            </div>
                                            
                                            <form action="/deletePriceService/{{ $ps->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Apakah anda yakin ingin menghapus item ini?</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                    @if(Auth::user()->role->service_list === 1)
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Hapus</button>
                                                    @else
                                                    @endif
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="updatePriceService{{ $ps->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Harga Servis</h1>
                                            </div>
                                            <form action="/updatePriceService/{{ $ps->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" value="{{ $service->id }}" name="service_id">
                                                        <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Durasi</label>
                                                        <input type="number" class="form-control" id="duration" name="duration" value="{{ $ps->duration }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="duration_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Waktu</label>
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
                                                        <label for="price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Harga (Rp)</label>
                                                        <input type="number" class="form-control" id="price" name="price" value="{{ $ps->price }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location_price_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi</label>
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
                                                        <label for="price_title" class="form-label" style="font-size: 15px; color: #7C7C7C;">Nama</label>
                                                        <input type="text" class="form-control" id="price_title" name="price_title" value="{{ $ps->price_title }}">
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                    @if(Auth::user()->role->service_list === 1)
                                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                    @else
                                                    @endif
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
                {{-- <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
                        <h5 class="m-3">Staff</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#staffservice"><i class="fas fa-plus"></i> Add</button>
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col" style="width: 50%">Gender</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index2 = 0 ?>
                                @foreach ($servicestaff as $s)
                                    <?php $index2 += 1; ?>
                                    <tr>
                                        <th>{{ $index2 }}</th>
                                        <td>{{ $s->staff->first_name }}</td>
                                        <td>{{ $s->staff->gender }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteStaffService{{ $s->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteStaffService{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Staff</h1>
                                            </div>
                                            
                                            <form action="/deleteStaffService/{{ $s->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                    @if(Auth::user()->role->service_list === 1)
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Delete</button>
                                                    @else
                                                    @endif
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                {{-- FACILITY --}}
                {{-- <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
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
                                            @if(Auth::user()->role->service_list === 1)
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteFacilityService{{ $sf->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                            @else
                                            @endif
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
                                                    @if(Auth::user()->role->service_list === 1)
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Delete</button>
                                                    @else
                                                    @endif
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}

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
                        <input type="number" class="form-control" id="duration" name="duration" required>
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
                        <input type="number" class="form-control" id="price" name="price" required>
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
                    @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                    @else
                    @endif
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
                <form action="/addStaffService" method="POST">
                    @csrf
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Staff Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Job Title</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($staff as $s)
                                    @if ($s->position->position_name == "Dokter Umum")
                                        @if (App\Models\ServiceAndStaff::where('service_id', $service->id)->where('staff_id', $s->id)->exists())
                                            @continue;
                                        @endif
                                        <tr>
                                            <th>
                                                <input type="hidden" value="{{ $service->id }}" name="service_id">
                                                <input class="form-check-input" type="checkbox" value="{{ $s->id }}" id="staff_id" name="staff_id[]">
                                            </th>
                                            <td>{{ $s->first_name }}</td>
                                            <td>{{ $s->gender }}</td>
                                            <td>{{ $s->position->position_name }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                        <button type="submit" class="btn btn-sm btn-outline-primary" id="staffSave"><i class="fas fa-save"></i> Save changes</button>
                        @else
                        @endif
                    </div>
                </form>
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
                        @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                        @else
                        @endif
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
                    @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Discard</button>
                    @else
                    @endif
                </div>
            </form>
          </div>
        </div>
    </div>
@endsection

