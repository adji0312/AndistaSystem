@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Jam Kerja</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link active" aria-current="page" style="color: #f28123" data-bs-toggle="modal" data-bs-target="#newWorkingShift"><img src="/img/icon/plus.png" alt="" style="width: 22px"> Baru</a>
                            </li>
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteShift" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Hapus</a>
                            </li>
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table w-100">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Shift</th>
                        <th scope="col" style="color: #7C7C7C">Start Bekejra</th>
                        <th scope="col" style="color: #7C7C7C">Selesai Bekerja</th>
                        <th scope="col" style="color: #7C7C7C">Jam Mulai</th>
                        <th scope="col" style="color: #7C7C7C">Jam Berakhir</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $shift)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $shift->id }}]" name="checkBox"  value="{{ $shift->id }}">
                                        <input type="hidden" id="shiftName{{ $shift->id }}" value="{{ $shift->shift_service_name }}">
                                    </div>
                                </th>
                                <td class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editShift{{ $shift->id }}">{{ $shift->shift_name }}</td>
                                <td>{{ $shift->start_hour }}</td>
                                <td>{{ $shift->end_hour }}</td>
                                <td>{{ $shift->jam_mulai }}</td>
                                <td>{{ $shift->jam_berakhir }}</td>
                            </tr>

                            <div class="modal fade" id="editShift{{ $shift->id }}" value="{{ $shift->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Working Shift</h1>
                                    </div>
                                    <form action="/editShift/{{ $shift->id }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="shift_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Shift Name</label>
                                                <input type="text" class="form-control" id="shift_name" name="shift_name" value="{{ $shift->shift_name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_hour" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Work</label>
                                                <input type="text" class="form-control" id="start_hour" name="start_hour" value="{{ $shift->start_hour }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_hour" class="form-label" style="font-size: 15px; color: #7C7C7C;">End Work</label>
                                                <input type="text" class="form-control" id="end_hour" name="end_hour" value="{{ $shift->end_hour }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jam_mulai" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jam Mulai</label>
                                                <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $shift->jam_mulai }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jam_berakhir" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jam Berakhir</label>
                                                <input type="text" class="form-control" id="jam_berakhir" name="jam_berakhir" value="{{ $shift->jam_berakhir }}">
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


    {{-- ADD SHIFT --}}
    <div class="modal fade" id="newWorkingShift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Working Shift</h1>
            </div>
            <form action="/addShift" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="shift_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Shift Name</label>
                        <input type="text" class="form-control" id="shift_name" name="shift_name">
                    </div>
                    <div class="mb-3">
                        <label for="start_hour" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Work</label>
                        <input type="text" class="form-control" id="start_hour" name="start_hour">
                    </div>
                    <div class="mb-3">
                        <label for="end_hour" class="form-label" style="font-size: 15px; color: #7C7C7C;">End Work</label>
                        <input type="text" class="form-control" id="end_hour" name="end_hour">
                    </div>
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jam Mulai</label>
                        <input type="text" class="form-control" id="jam_mulai" name="jam_mulai">
                    </div>
                    <div class="mb-3">
                        <label for="jam_berakhir" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jam Berakhir</label>
                        <input type="text" class="form-control" id="jam_berakhir" name="jam_berakhir">
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

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteShift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Shift</h1>
            </div>
            
            <form action="/deleteShift" method="GET">
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