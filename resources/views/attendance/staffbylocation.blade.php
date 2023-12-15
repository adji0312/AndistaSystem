@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }} for {{ $location->location_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/managestaff" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                            </li>
                            {{-- <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link active" style="color: #f28123" data-bs-toggle="modal" data-bs-target="#filterModal"><img src="/img/icon/filter.png" alt="" style="width: 22px"> Filter</a>
                            </li> --}}
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Staff Name</th>
                        <th scope="col" style="color: #7C7C7C">Staff Position</th>
                        <th scope="col" style="color: #7C7C7C">Shift Name</th>
                        <th scope="col" style="color: #7C7C7C" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $key => $st)
                            <tr>
                                <th>{{ $staff->firstItem() + $key }}</th>
                                <td>{{ $st->first_name }}</td>
                                <td>{{ $st->position->position_name }}</td>
                                <td>{{ $st->shift->shift_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateShift{{ $st->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="updateShift{{ $st->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Update Shift</h1>
                                    </div>
                                    <form action="/updateShift/{{ $st->id }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="shift_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Shift</label>
                                                <select class="form-select" aria-label="Default select example" name="shift_id">
                                                    @foreach ($shifts as $shift)
                                                        @if ($shift->id == $st->shift->id)
                                                            <option selected value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                                            @continue;
                                                        @endif
                                                        <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                                                    @endforeach
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
    </div>

    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Staff</h1>
            </div>
            <form action="/addCategory" method="post">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Role</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_id" id="location_id">
                            <option value="" class="selectstatus" style="color: black;" selected disabled>Select Role</option>
                            {{-- @foreach ($locations as $location)
                                <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                            @endforeach --}}
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Shift</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="category_service_id" id="category_service_id">
                                <option value="" class="selectstatus" style="color: black;" selected disabled>Select Shift</option>
                                {{-- @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="selectstatus" style="color: black;">{{ $category->category_service_name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary" id="saveCategory" disabled><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
@endsection