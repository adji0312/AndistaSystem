@extends('main')
@section('container')

    <div class="wrapper">
        @include('location.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $facility->facility_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/facility" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" onclick="saveFacility()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                <form action="/editFacility/{{ $facility->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3" style="width: 230px">
                                <label for="facility_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Facility Name</label>
                                <input type="text" class="form-control" id="facility_name" name="facility_name" value="{{ $facility->facility_name }}">
                            </div>
                            <div class="mb-3" style="width: 230px">
                                <label for="capacity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Capacity</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $facility->capacity }}">
                            </div>
                            <div class="mb-3">
                              <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                              <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="status" name="status">
                                @if ($facility->status == "Active")
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
                                <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id">
                                    @foreach ($locations as $location)
                                        @if ($facility->location_id == $location->id)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;" selected>{{ $location->location_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                              </div>
                            <div class="mb-3">
                              <label for="share_facility" class="form-label" style="font-size: 15px; color: #7C7C7C;">Share With</label>
                              <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="share_facility" name="share_facility">
                                <option value="0" class="selectstatus" style="color: black;">none</option>
                                @foreach ($locations as $location)
                                    @if ($facility->share_facility == $location->id)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;" selected>{{ $location->location_name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submitFacility" hidden></button>
                </form>    

                    <div class="mt-4 mb-4" id="unitContainer" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex justify-content-between m-2">
                            <h5 class="m-3">Units Available</h5>
                            <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addunitfacility"><i class="fas fa-plus"></i> Add</button>
                        </div>
                        <div class="mx-4 table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Unit Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $index = 0; ?>
                                    @foreach ($facility->units as $key => $unit)
                                        <tr>
                                            <?php $index += 1;?>
                                            <th scope="row">
                                                {{ $index }}
                                            </th>
                                            <td>
                                                {{ $unit->unit_name }}
                                            </td>
                                            <td>
                                                {{ $unit->unit_status }}
                                            </td>
                                            <td>
                                                {{ $unit->notes }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateUnit{{ $unit->id }}" onclick="updateUnit({{ $unit->id }})"><i class="fas fa-pencil-alt"></i> Update</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit{{ $unit->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateUnit{{ $unit->id }}" value={{ $unit->id }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Unit {{ $index }}</h1>
                                                </div>
                                                <form action="/updateunitfacility/{{ $unit->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="unit_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                                            <input type="hidden" value="{{ $facility->id }}" name="facility_id">
                                                            <input type="text" class="form-control" id="unit_name" name="unit_name" value="{{ $unit->unit_name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="unit_status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                                            <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="unit_status" name="unit_status">
                                                                @if ($unit->unit_status == "Active")
                                                                    <option value="Active" selected class="selectstatus" style="color: black;">Active</option>
                                                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option> 
                                                                @else
                                                                    <option value="Disabled" selected class="selectstatus" style="color: black;">Disabled</option> 
                                                                    <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="notes" class="form-label" style="font-size: 15px; color: #7C7C7C;">Notes</label>
                                                            <textarea class="form-control" id="notes" name="notes" value="{{ $unit->notes }}">{{ $unit->notes }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-save"></i> Update</button>
                                                    </div>
                                                </form>    
                                                </div>
                                            </div>
                                        </div>

                                        {{-- DELETE UNIT --}}
                                        <div class="modal fade" id="deleteUnit{{ $unit->id }}" value={{ $unit->id }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Unit {{ $index }}</h1>
                                                </div>
                                                <form action="/deleteUnit/{{ $unit->id }}" method="get">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h6>Delete unit {{ $unit->unit_name }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
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

                    <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3 mb-0">Photos</h5>
                        <div class="m-3 mt-3">
                            @if ($facility->image == '-')
                                <img src="/img/icon/noimage.png" alt="" width="25%">
                            @else
                                <img src="/storage/{{ substr($facility->image, 7) }}" alt="" width="20%">
                            @endif
                        </div>
                        <div class="m-3 mt-0">
                          <div class="mb-3">
                            <label for="image" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                            <input type="file" class="form-control mt-1" id="image" name="image">
                          </div>
                        </div>
                    </div>
                    
                {{-- </forma> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addunitfacility" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Unit</h1>
            </div>
            <form action="/addunitfacility" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" value="{{ $facility->id }}" name="facility_id">
                        <label for="unit_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                        <input type="text" class="form-control" id="unit_name" name="unit_name">
                    </div>
                    <div class="mb-3">
                        <label for="unit_status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="unit_status" name="unit_status">
                            <option value="Active" class="selectstatus" style="color: black;">Active</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label" style="font-size: 15px; color: #7C7C7C;">Notes</label>
                        {{-- <input type="text" class="form-control" id="notes" name="notes"> --}}
                        <textarea class="form-control" id="notes" name="notes"></textarea>
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