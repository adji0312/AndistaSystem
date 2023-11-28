@extends('main')
@section('container')

    <div class="wrapper">
        @include('staff.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="/staff/new-staff" class="nav-link active" style="color: #f28123; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addCategory"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li>
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCategory" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
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
                <table class="table w-100">
                    <thead>
                      <tr >
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        {{-- <th scope="col" style="color: #7C7C7C; width: 15%;">Telephone</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%;">Email</th>
                        <th scope="col" style="color: #7C7C7C; width: 40px;">Gender</th>
                        <th scope="col" style="color: #7C7C7C; width: 20px;">Job Title</th> --}}
                        {{-- <th scope="col" style="color: #7C7C7C; width: 20px;">Status</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($position as $p)
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $p->id }}]" name="checkBox"  value="{{ $p->id }}">
                                    <input type="hidden" id="serviceName{{ $p->id }}" value="{{ $p->role_name }}">
                                </div>
                            </th>
                            <td class="text-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editCategory{{ $p->id }}">{{ $p->position_name }}</td>
                            {{-- <td>{{ $r->phone }}</td>
                            <td>{{ $r->email }}</td>
                            <td class="text-primary" style="cursor: pointer;">{{ $r->gender }}</td> --}}
                            {{-- <td>{{ optional($r) }}</td> --}}
                            {{-- <td>{{ $r }}</td> --}}
                        </tr>

                        
                        {{-- @endforeach --}}
                    {{-- </tbody>
                </table>
            </div>
        </div>
    </div> --}}

        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editCategory{{ $p->id ?? '' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" value="{{ $p->id ?? '' }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Position</h1>
                                </div>
                                <form action="/updatePosition/{{ $p->id ?? '' }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <input type="text" class="form-control mt-1" id="brand_name" name="position_name" value="{{ $p->position_name ?? '' }}">
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
    

    {{-- MODAL ADD --}}
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Job Position</h1>
            </div>
            <form action="/addPosition" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="text" class="form-control mt-1" id="product_brand_name" name="position_name" oninput="inputPositionService()">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary" id="saveBrand" disabled><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
    
    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h1>
            </div>
            
            <form action="/deleteStaffJob" method="GET">
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