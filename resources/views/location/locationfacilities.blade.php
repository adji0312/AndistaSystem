@extends('main')
@section('container')

    <div class="wrapper">
        @include('location.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex gap-4">
                        @if(Auth::user()->role->customer_list === 1|Auth::user()->role->customer_list === 2)
                            <a class="nav-link active" aria-current="page" href="/location/facility/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a> 
                        @else
                        @endif
                        @if(Auth::user()->role->customer_list === 1)
                        <li class="nav-item" id="deleteButton" style="display: none;">
                            <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteFacility" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                        </li>
                        @else
                        @endif
                    </div>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    </div>
                </div>
            </div>
            @include('location.sidenavlocation')

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        <th scope="col" style="color: #7C7C7C">Location</th>
                        <th scope="col" style="color: #7C7C7C">Capacity</th>
                        <th scope="col" style="color: #7C7C7C">Units</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities as $facility)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $facility->id }}]" name="checkBox"  value="{{ $facility->id }}">
                                    </div>
                                </th>
                                <td><a href="/location/facility/{{ $facility->facility_name }}" class="text-primary">{{ $facility->facility_name }}</a></td>
                                <td>{{ $facility->location->location_name }}</td>
                                <td>{{ $facility->capacity }}</td>
                                <td>{{ $facility->units->where('unit_status', "Active")->count() }}</td>
                                <td>{{ $facility->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteFacility" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Facility</h1>
            </div>
            
            <form action="/deleteFacility" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="text" hidden id="deleteId" name="deleteId" value="Hapus" class="form-control mt-1">
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
    
@endsection