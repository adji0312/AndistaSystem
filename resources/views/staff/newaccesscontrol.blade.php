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
                            {{-- <li class="nav-item">
                                <a href="/staff/new-staff" class="nav-link active" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li> --}}
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCategory" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </li>
                        </div>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </div>
            @include('staff.sidenavstaff')

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table w-100">
                    <thead>
                      <tr >
                        {{-- <th scope="col" style="color: #7C7C7C; width: 50px;">#</th> --}}
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        {{-- <th scope="col" style="color: #7C7C7C; width: 15%;">Telephone</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%;">Email</th>
                        <th scope="col" style="color: #7C7C7C; width: 40px;">Gender</th>
                        <th scope="col" style="color: #7C7C7C; width: 20px;">Job Title</th> --}}
                        {{-- <th scope="col" style="color: #7C7C7C; width: 20px;">Status</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $r)
                        <tr>
                            {{-- <th scope="row"> --}}
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $r->id }}]" name="checkBox"  value="{{ $r->id }}">
                                    <input type="hidden" id="serviceName{{ $r->id }}" value="{{ $r->role_name }}">
                                </div> --}}
                            {{-- </th> --}}
                            <td class="text-primary" style="cursor: pointer;"><a href="/staff/access-control/detail/{{ $r->id }}">{{ $r->role_name }}</td>
                            {{-- <td>{{ $r->phone }}</td>
                            <td>{{ $r->email }}</td>
                            <td class="text-primary" style="cursor: pointer;">{{ $r->gender }}</td> --}}
                            {{-- <td>{{ optional($r) }}</td> --}}
                            {{-- <td>{{ $r }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection 