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
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/staff/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveStaff()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            {{-- <form action="/addFacility" method="POST" enctype="multipart/form-data"> --}}
                <form action="/staff/addStaff" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Staff</h5>
                    {{-- First Name
                    Middle Name
                    Last Name
                    Nickname
                    Gender
                    Status
                    Phone
                    Description
                    Email --}}
                    
                    <div class="m-3 d-flex flex-column gap-5">
                        <div class="mb-3">
                            <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="mb-3">
                            <label for="middle_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="mb-3">
                            <label for="nick_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Nick Name</label>
                            <input type="text" class="form-control" id="nick_name" name="nick_name">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                            <input type="text" class="form-control" id="status" name="status">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label" style="font-size: 15px; color: #7C7C7C;">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label" style="font-size: 15px; color: #7C7C7C;">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" style="font-size: 15px; color: #7C7C7C;">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        {{-- <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="status" name="status">
                            <option value="Active" class="selectstatus" style="color: black;">Active</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                          <input type="date" class="form-control">
                        </div> --}}
                        {{-- <div class="mb-3">
                          <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="status" name="status">
                            <option value="Active" class="selectstatus" style="color: black;">Terdaftar Sementara</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Terkonfirmasi</option>
                          </select>
                        </div> --}}
                    </div>
                </div>
                <button type="submit" id="submitStaff" hidden></button>
            </form>
        </div>
    </div>
  </div>
@endsection
