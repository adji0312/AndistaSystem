@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('location.menu')

    <div id="contents">
      <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">New Location</a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/location/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
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
              <div class="d-flex">
                  <div class="form-check m-3" style="font-size: 15px;">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                      <label class="form-check-label" for="flexRadioDefault1" >
                        Branch
                      </label>
                    </div>
                    <div class="form-check m-3">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Offsite
                      </label>
                  </div>
              </div>
              <div class="m-3 d-flex gap-5">
                  <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                      <option value="Active" class="selectstatus" style="color: black;">Active</option>
                      <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                    </select>
                  </div>
              </div>
            </div>

            {{-- OPERATING HOURS --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Operating Hours</h5>

              <div class="m-3 mb-0 mt-4 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Toggle All
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>

              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Monday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Tuesday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Wednesday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Thrusday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Friday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
              <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Saturday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
        
              <div class="m-3 mt-0 mx-5 d-flex gap-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px; width: 100px">
                    Sunday
                  </label>
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="From" style="width: 150px;">
                </div>
                <div class="mb-3 d-flex align-items-center">
                  <i class="far fa-clock icon" style="color: #949494;">
                  </i>
                  <input type="text" class="form-control" placeholder="To" style="width: 150px;">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1" style="font-size: 15px;">
                    All Day
                  </label>
                </div>
              </div>
            </div>

            {{-- ADDRESS --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Address</h5>
              <div class="m-3 d-flex flex-column">
                  <div class="mb-3" style="width: 70%">
                      <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Street Address</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                  </div>
                  <div class="mb-3" style="width: 70%">
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Additional info: Apartment, suite, unit, building, floor, etc.">
                  </div>
              </div>
              <div class="m-3 d-flex gap-5">
                <div class="mb-3">
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="City">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="State">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Postal Code">
                </div>
              </div>
              <div class="m-3 d-flex gap-5">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Country</label>
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                    <option value="Active" class="selectstatus" style="color: black;">Indonesia</option>
                    <option value="Disabled" class="selectstatus" style="color: black;">Malaysia</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                    <option value="Active" class="selectstatus" style="color: black;">Tempat Tinggal</option>
                    <option value="Disabled" class="selectstatus" style="color: black;">Klinik Cabang Utama</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- PHOTOS --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3 mb-0">Photos</h5>
              <div class="m-3 mt-0">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                  <input type="file" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number">
                </div>
              </div>
            </div>

            
            {{-- CONTACT --}}
            <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Contact</h5>

              <div class="mt-4 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3">Phone</h5>
                <div class="m-3 d-flex gap-5">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example" id="mySelectPhone" onchange="changePhone()">
                      <option value="Active" class="selectstatus" style="color: black;">Utama</option>
                      <option value="Disabled" class="selectstatus" style="color: black;">Rumah</option>
                      <option value="phoneusage" class="selectstatus" style="color: black;">+ Create New</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                    <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example">
                      <option value="Active" class="selectstatus" style="color: black;">Mobile</option>
                      <option value="Disabled" class="selectstatus" style="color: black;">Fax</option>
                      <option value="Disabled" class="selectstatus" style="color: black;">Fixed-line phone</option>
                    </select>
                  </div>
                  <div class="mb-3 d-flex align-items-center" style="cursor: pointer">
                    <img src="/img/icon/minus.png" alt="" style="width: 20px">
                  </div>
                </div>

                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-plus"></i> Add</button>
                </div>
                
              </div>
              <div class="mt-2 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3">Email</h5>
                <div class="m-3 d-flex gap-5">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                      <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example" id="mySelectEmail" onchange="changeEmail()">
                        <option value="Active" class="selectstatus" style="color: black;">Active</option>
                        <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                        <option value="emailusage" class="selectstatus" style="color: black;">+ Create New</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                      <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">
                    </div>
                    <div class="mb-3 d-flex align-items-center" style="cursor: pointer">
                      <img src="/img/icon/minus.png" alt="" style="width: 20px">
                    </div>
                </div>
                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>
              <div class="mt-2 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3">Messenger</h5>
                <div class="m-3 d-flex gap-5">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example" id="mySelectMessenger" onchange="changeMessenger()">
                      <option value="Active" class="selectstatus" style="color: black;">Utama</option>
                      <option value="Disabled" class="selectstatus" style="color: black;">Rumah</option>
                      <option value="messengerusage" class="selectstatus" style="color: black;">+ Create New</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                    <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example" id="mySelectMessengerType" onchange="typeMessenger()">
                      <option value="Active" class="selectstatus" style="color: black;">Whatsaap</option>
                      <option value="messengertype" class="selectstatus" style="color: black;">+ Create New</option>
                    </select>
                  </div>
                  <div class="mb-3 d-flex align-items-center" style="cursor: pointer">
                    <img src="/img/icon/minus.png" alt="" style="width: 20px">
                  </div>
                </div>

                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>

            
          </form>
      </div>
    </div>
  </div>


  {{-- ALL MODAL --}}

  {{-- MODAL ADD NEW PHONE USAGE --}}
  <div class="modal fade" id="usagephone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Phone Usage</h1>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- MODAL ADD NEW EMAIL USAGE --}}
  <div class="modal fade" id="usageemail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Email Usage</h1>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- MODAL ADD NEW MESSENGER USAGE --}}
  <div class="modal fade" id="usagemessenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messenger Usage</h1>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- MODAL ADD NEW MESSENGER TYPE --}}
  <div class="modal fade" id="typemessenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messenger Type</h1>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <input type="text" class="form-control mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
          <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
