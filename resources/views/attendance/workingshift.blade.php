@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a class="nav-link active" aria-current="page" style="color: #f28123" data-bs-toggle="modal" data-bs-target="#newWorkingShift"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
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
                <table class="table w-50">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Shift Name</th>
                        <th scope="col" style="color: #7C7C7C">Start Work</th>
                        <th scope="col" style="color: #7C7C7C">End Work</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $shift)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkBox[]" name="checkBox" value="">
                                    </div>
                                </th>
                                <td class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editShift{{ $shift->id }}">{{ $shift->shift_name }}</td>
                                <td>{{ $shift->start_hour }}</td>
                                <td>{{ $shift->end_hour }}</td>
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