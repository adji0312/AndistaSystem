@extends('main')
@section('container')

    <div class="wrapper">
        @include('location.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">New Facility</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/location/facility" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/location/list/add" style="color: #f28123"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                            <div class="mb-3" style="width: 230px">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Facility Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3" style="width: 230px">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Capacity</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                              <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" aria-label="Default select example">
                                <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                              </select>
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" aria-label="Default select example">
                                  <option value="Active" class="selectstatus" style="color: black;">Andista Animal Care</option>
                                </select>
                              </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                              <select class="form-select mt-1" style="font-size: 15px; color: #7C7C7C; width: 230px" aria-label="Default select example">
                                <option value="Active" selected disabled class="selectstatus" style="color: black;">Share facilty with</option>
                                <option value="Disabled" class="selectstatus" style="color: black;">Andista Animal Care</option>
                              </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Units Available</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3" style="width: 230px">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" aria-label="Default select example">
                                  <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                  <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                </select>
                            </div>
                            <div class="mb-3" style="width: 50%">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Notes</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3 d-flex align-items-center" style="cursor: pointer">
                                <img src="/img/icon/minus.png" alt="" style="width: 20px">
                            </div>
                        </div>
                        <div class="m-3">
                            <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
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

@endsection