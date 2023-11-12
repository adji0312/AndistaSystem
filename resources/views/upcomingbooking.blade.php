@extends('main')
@section('container')

    <div class="wrapper">
        @include('menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="/newBooking" class="nav-link active" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
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
                {{-- get date now --}}
                <p class="mx-2" style="font-size: 18px; font-weight: 700; color: black;">{{ date_format(Date::now(),"d F Y") }}</p> 
                <table class="table w-100">
                    <thead>
                      <tr >
                        <th scope="col" style="color: #7C7C7C; width: 15%;">Start Time</th>
                        <th scope="col" style="color: #7C7C7C; width: 15%;">End Time</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%;">Location</th>
                        <th scope="col" style="color: #7C7C7C; width: 40px;">Customer</th>
                        <th scope="col" style="color: #7C7C7C; width: 20px;">Service Name</th>
                        <th scope="col" style="color: #7C7C7C; width: 20px;">Staff</th>
                        <th scope="col" style="color: #7C7C7C; width: 10px;">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-primary" style="cursor: pointer;">10:00 AM</td>
                            <td>12:00 AM</td>
                            <td>Andista Animal Care</td>
                            <td class="text-primary" style="cursor: pointer;">Adji - Coco</td>
                            <td>Konsultasi / Jasa Dokter Pemeriksaan</td>
                            <td>drh. Putri Febriani Dasopang</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-success btn-sm">completed</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection 