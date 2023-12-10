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
                  <a class="nav-link active" aria-current="page" onclick="saveUpdateAccessControl()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
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
      <form action="/saveAccessControl" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-3 d-flex gap-5">
          <div class="mb-3">
            <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label>
            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                <option value="" class="selectstatus" style="color: black;" selected disabled>Select Security Group</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" class="selectstatus" style="color: black;">{{ $role->role_name }}</option>
                @endforeach
                {{-- <option value="Administrator" class="selectstatus" style="color: black;">Administrator</option>
                <option value="Manager" class="selectstatus" style="color: black;">Manager</option>
                <option value="Veterinarian" class="selectstatus" style="color: black;">Veterinarian</option>
                <option value="Veterinary Assistant" class="selectstatus" style="color: black;">Veterinary Assistant</option>
                <option value="Receptionist" class="selectstatus" style="color: black;">Receptionist</option>
                <option value="Support" class="selectstatus" style="color: black;">Support</option>
                <option value="Multimedia Staff" class="selectstatus" style="color: black;">Multimedia Staff</option> --}}
            </select>
        </div>
        </div>

        {{-- Home Page --}}
        <table class="table table-striped m-2">
          <thead>
            <tr>
              <th scope="col"><b>Home</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Overview</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Upcoming Booking</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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


        {{-- Calendar --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Calendar</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Calendar</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Create Booking</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">List Booking</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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



        {{-- Staff --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Staff</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Staff List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Job</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Access Control</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Security Group</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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


        {{-- Service --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Service</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Service</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Service List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Treatment Plan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Category</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Diagnosis</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Policy</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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


        {{-- Product --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Product</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Product</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Product List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Brand</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Category</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Suppliers</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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

        {{-- Location --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Location</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Location</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Location List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Facilities</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Setting Location</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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

        {{-- Finance --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Finance</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Finance</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Sale List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Quotation List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Tax Rate</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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

        {{-- Attendance --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Attendance</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Attendance</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Attendance List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Working Shift</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
              <th scope="row" style="color: #7C7C7C">Manage Staff Shift</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Permission</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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

        {{-- Presence --}}
        <table class="table table-striped m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Presence</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Absent</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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

        {{-- Reports --}}
        <table class="table table-striped m-2 mt-4 ">
          <thead>
            <tr>
              <th scope="col"><b>Reports</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Reports All</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-3">
                  {{-- <label for="customer_degree" class="form-label" style="font-size: 15px; color: #7C7C7C;">Security Group</label> --}}
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_degree" id="customer_degree">
                      <option value="" class="selectstatus" style="color: black;" selected disabled>Select Permission</option>
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
    <button type="submit" id="submitSaveUpdateAccessControl" hidden></button>
  </form>
  </div>
@endsection
