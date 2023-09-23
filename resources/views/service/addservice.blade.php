@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">New Service</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/list/add" style="color: #f28123"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                <form action="">
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                                <input type="text" class="form-control mt-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Simple name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                                    <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" aria-label="Default select example">
                                <option value="Active" class="selectstatus" style="color: black;">Andista Animal Care</option>
                                <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                            </select>
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" aria-label="Default select example">
                                <option value="" class="selectstatus" style="color: black;" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="selectstatus" style="color: black;">{{ $category->category_service_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    {{-- PRICES --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Prices</h5>
                        <table class="table m-3" style="width: 90%;">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">Duration</th>
                                <th scope="col" style="width: 200px;">Units</th>
                                <th scope="col" style="width: 100px;">Price (Rp)</th>
                                <th scope="col" style="width: 100px;">Customers</th>
                                <th scope="col" style="width: 220px;">Location</th>
                                <th scope="col" style="width: 200px;">Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control" style="width: 100px;">
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                                        <option value="Active" class="selectstatus" style="color: black;">Minutes</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Hours</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Days</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Weeks</option>
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control" style="width: 100px;">
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                                        <option value="Active" class="selectstatus" style="color: black;">All Customers</option>
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 220px" aria-label="Default select example">
                                        <option value="Active" class="selectstatus" style="color: black;">Andista Animal Care</option>
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control" style="width: 200px;">
                                </td>
                                <td style="border: none">
                                    <div class="mb-3 mt-2 d-flex align-items-center" style="cursor: pointer">
                                        <img src="/img/icon/minus.png" alt="" style="width: 20px">
                                    </div>
                                </td>
                            </tr> 
                            </tbody>
                        </table>
                        
                        <div class="m-3 mt-4">
                            <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-plus"></i> Add</button>
                        </div>

                        <div class="m-3 mt-4">
                            <div class="mb-3">
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" aria-label="Default select example">
                                    <option selected class="selectstatus" style="color: black;">Tax rate</option>
                                    @foreach ($tax as $t)
                                        <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    

                    {{-- STAFF --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Staff</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <div class="d-flex">
                                    <div class="form-check m-3 mb-0" style="font-size: 15px;">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="nostaff" value="nostaff" checked>
                                        <label class="form-check-label" for="nostaff">
                                            No Staff
                                        </label>
                                        </div>
                                        <div class="form-check m-3 mb-0">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="withstaff" value="withstaff">
                                        <label class="form-check-label" for="withstaff">
                                            With Staff
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3" id="addstaff" style="display: none">
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staffservice"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    {{-- FACILITY --}}
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Facility</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <div class="d-flex">
                                    <div class="form-check m-3 mb-0" style="font-size: 15px;">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="nofacility" value="nofacility" checked>
                                        <label class="form-check-label" for="nofacility">
                                            No Facility
                                        </label>
                                        </div>
                                        <div class="form-check m-3 mb-0">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="withfacility" value="withfacility">
                                        <label class="form-check-label" for="withfacility">
                                            With Facility
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-3" id="addfacility" style="display: none">
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#facility"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
        
                    {{-- PHOTOS --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3 mb-0">Photos</h5>
                    <div class="m-3 mt-0">
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                        <input type="file" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number">
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staffservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Staff</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Job Title</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        </th>
                        <td>Drh Benny</td>
                        <td>Laki Laki</td>
                        <td>Dokter Umum</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="facility" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Facility</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Facility Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Units</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        </th>
                        <td>Kandang Besar</td>
                        <td>Andista Animal Care</td>
                        <td>1</td>
                        <td>6</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>
@endsection