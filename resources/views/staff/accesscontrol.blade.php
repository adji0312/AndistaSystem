{{-- //Rencananya akan ada dropdown untuk pilih role dan nanti setiap dia klik save akan melakukan save secara otomatis pada db --}}
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
                  <a class="nav-link active" aria-current="page" onclick="saveUpdateCustomer()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
                </li>
              </ul>
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
        </div>
        
    </nav>

        {{-- <div id="dashboard" class="mx-3 mt-3">
            {{ $title }}
        </div> --}}

        {{-- <div>
          {{ $roles }}
        </div> --}}

        <div class="m-3 d-flex gap-5">
          <div class="mb-3">
            <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label>
            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                <option value="" class="selectstatus" style="color: black;" selected disabled>Select Degree</option>
                {{-- @foreach ($locations as $location)
                    <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                @endforeach --}}
                <option value="Administrator" class="selectstatus" style="color: black;">Administrator</option>
                <option value="Manager" class="selectstatus" style="color: black;">Manager</option>
                <option value="Veterinarian" class="selectstatus" style="color: black;">Veterinarian</option>
                <option value="Veterinary Assistant" class="selectstatus" style="color: black;">Veterinary Assistant</option>
                <option value="Receptionist" class="selectstatus" style="color: black;">Receptionist</option>
                <option value="Support" class="selectstatus" style="color: black;">Support</option>
                <option value="Multimedia Staff" class="selectstatus" style="color: black;">Multimedia Staff</option>
            </select>
        </div>
        </div>

        <table class="table table-striped m-2">
          <thead>
            <tr>
              <th scope="col"><b>Home</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Overview</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Degree</option>
                      {{-- @foreach ($locations as $location)
                          <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                      @endforeach --}}
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row">Upcoming Booking</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Degree</option>
                      {{-- @foreach ($locations as $location)
                          <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                      @endforeach --}}
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
@endsection
