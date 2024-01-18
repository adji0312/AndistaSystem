@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Atur Shift Karyawan untuk {{ $location->location_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/managestaff" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                            </li>
                            {{-- <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link active" style="color: #f28123" data-bs-toggle="modal" data-bs-target="#filterModal"><img src="/img/icon/filter.png" alt="" style="width: 22px"> Filter</a>
                            </li> --}}
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Nama Karyawan</th>
                        <th scope="col" style="color: #7C7C7C">Posisi Karyawan</th>
                        {{-- <th scope="col" style="color: #7C7C7C">Shift Name</th> --}}
                        <th scope="col" style="color: #7C7C7C; width: 15%" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $key => $st)

                            @if (count($st->workdays) != 0)
                                <tr>
                                    <th>{{ $staff->firstItem() + $key }}</th>
                                    <td>{{ $st->first_name }}</td>
                                    <td>{{ $st->position->position_name }}</td>
                                    {{-- <td>{{ $st->shift->shift_name }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateWorkDays{{ $st->id }}"><i class="fas fa-pencil-alt"></i> Atur Shift</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="updateWorkDays{{ $st->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Shift {{ $st->first_name }}</h1>
                                        </div>
                                        <form action="/updateWorkDays/{{ $st->workdays[0]->id }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="Monday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Senin</label>
                                                    <select class="form-select" aria-label="Default select example" name="Monday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Monday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Tuesday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Selasa</label>
                                                    <select class="form-select" aria-label="Default select example" name="Tuesday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Tuesday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Wednesday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Rabu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Wednesday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Wednesday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Thursday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Kamis</label>
                                                    <select class="form-select" aria-label="Default select example" name="Thursday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Thursday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Friday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jumat</label>
                                                    <select class="form-select" aria-label="Default select example" name="Friday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Friday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Saturday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Sabtu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Saturday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Saturday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Sunday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Minggu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Sunday">
                                                        @foreach ($shifts as $shift)
                                                            @if ($shift->id == $st->workdays[0]->Sunday)
                                                                <option value="{{ $shift->id }}" selected>{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan perubahan</button>
                                            </div>
                                        </form>    
                                    </div>
                                    </div>
                                </div>
                            @else
                                <tr>
                                    <th>{{ $staff->firstItem() + $key }}</th>
                                    <td>{{ $st->first_name }}</td>
                                    <td>{{ $st->position->position_name }}</td>
                                    {{-- <td>{{ $st->shift->shift_name }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#addWorkDays{{ $st->id }}"><i class="fas fa-pencil-alt"></i> Atur Shift</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="addWorkDays{{ $st->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Shift</h1>
                                        </div>
                                        <form action="/addWorkDays" method="post">
                                            @csrf
                                            <input type="text" name="staff_id" value="{{ $st->id }}" hidden>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="Monday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Senin</label>
                                                    <select class="form-select" aria-label="Default select example" name="Monday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Tuesday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Selasa</label>
                                                    <select class="form-select" aria-label="Default select example" name="Tuesday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Wednesday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Rabu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Wednesday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Thursday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Kamis</label>
                                                    <select class="form-select" aria-label="Default select example" name="Thursday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Friday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jumat</label>
                                                    <select class="form-select" aria-label="Default select example" name="Friday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Saturday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Sabtu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Saturday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Sunday" class="form-label" style="font-size: 15px; color: #7C7C7C;">Minggu</label>
                                                    <select class="form-select" aria-label="Default select example" name="Sunday">
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_hour }} : {{ $shift->end_hour }})</option>
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
                            @endif
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