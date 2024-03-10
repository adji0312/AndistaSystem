@extends('main')
@section('container')

    <div class="wrapper">
        @include('staff.menu')
        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div class="d-flex gap-4">
                            @if(Auth::user()->role->staff_staff_list === 1 || Auth::user()->role->staff_staff_list === 2)
                                <a href="/staff/add-new-staff" class="nav-link active" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                                <a href="/staff/export-staff-list " class="nav-link active" style="color: #f28123; cursor: pointer;"><img src="/img/icon/filter.png" alt="" style="width: 22px"> Export</a>
                            @else
                            @endif
                            @if(Auth::user()->role->staff_staff_list === 1)
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCustomer" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </li>
                            @else
                            @endif
                        </div>
                        <form class="d-flex" role="search" action="/staff/list">
                            <input class="form-control me-2" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('staff.sidenavstaff')

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table w-100">
                    <thead>
                      <tr >
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C;">Name</th>
                        <th scope="col" style="color: #7C7C7C;">Telephone</th>
                        <th scope="col" style="color: #7C7C7C;">Email</th>
                        {{-- <th scope="col" style="color: #7C7C7C; width: 40px;">Gender</th> --}}
                        <th scope="col" style="color: #7C7C7C;">Job Title</th>
                        <th scope="col" style="color: #7C7C7C;">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($staffs as $staff)
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $staff->id }}]" name="checkBox"  value="{{ $staff->id }}">
                                    <input type="hidden" id="serviceName{{ $staff->id }}" value="{{ $staff->service_name }}">
                                </div>
                            </th>
                            <td class="text-primary" style="cursor: pointer;"><a href="/staff/update-data/{{ $staff->id }}"> {{$staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</a></td>
                            <td>{{ $staff->phone }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->position->position_name }}</td>
                            <td>{{ $staff->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Customer</h1>
            </div>
            
            <form action="/deleteStaff" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        {{-- <input type="text" id="deleteId"> --}}
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