{{-- //Rencananya akan ada dropdown untuk pilih role dan nanti setiap dia klik save akan melakukan save secara otomatis pada db --}}
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
                <a class="nav-link active" aria-current="page" onclick="saveUpdateAccessControl()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
              </div>
              {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form> --}}
            </div>
        </div>
        
      </div>
      @include('staff.sidenavstaff')

        <div class="m-3">
          <h3>{{ $roles->role_name }}</h3>
        </div>
      <form action="/saveAccessControl/{{ $roles->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Home Page --}}
        <table class="table m-2">
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="home_overview" id="home_overview">
                      <option value="{{ $roles->home_overview }}" class="selectstatus" style="color: black;" selected >
                      @if($roles->home_overview === 1)
                        Full
                      @elseif($roles->home_overview === 2)
                        Write
                      @elseif($roles->home_overview === 3)
                        Read
                      @elseif($roles->home_overview === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Histori Aktivitas</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="home_upcoming_booking" id="home_upcoming_booking">
                      <option value="{{ $roles->home_upcoming_booking }}" class="selectstatus" style="color: black;" selected>@if($roles->home_upcoming_booking === 1)
                        Full
                      @elseif($roles->home_upcoming_booking === 2)
                        Write
                      @elseif($roles->home_upcoming_booking === 3)
                        Read
                      @elseif($roles->home_upcoming_booking === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Kalender</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Kalender</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="calendar_calendar" id="calendar_calendar">
                      <option value="{{ $roles->calendar_calendar }}" class="selectstatus" style="color: black;" selected>@if($roles->calendar_calendar === 1)
                        Full
                      @elseif($roles->calendar_calendar === 2)
                        Write
                      @elseif($roles->calendar_calendar === 3)
                        Read
                      @elseif($roles->calendar_calendar === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Buat Booking</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="calendar_create_booking" id="calendar_create_booking">
                      <option value="{{ $roles->calendar_create_booking }}" class="selectstatus" style="color: black;" selected>@if($roles->calendar_create_booking === 1)
                        Full
                      @elseif($roles->calendar_create_booking === 2)
                        Write
                      @elseif($roles->calendar_create_booking === 3)
                        Read
                      @elseif($roles->calendar_create_booking === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="calendar_list_booking" id="calendar_list_booking">
                      <option value="{{ $roles->calendar_list_booking }}" class="selectstatus" style="color: black;" selected>@if($roles->calendar_list_booking === 1)
                        Full
                      @elseif($roles->calendar_list_booking === 2)
                        Write
                      @elseif($roles->calendar_list_booking === 3)
                        Read
                      @elseif($roles->calendar_list_booking === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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

         {{-- Customer --}}
         <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Pelanggan</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">List Pelanggan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="customer_list" id="customer_list">
                      <option value="{{ $roles->customer_list }}" class="selectstatus" style="color: black;" selected >
                      @if($roles->customer_list === 1)
                        Full
                      @elseif($roles->customer_list === 2)
                        Write
                      @elseif($roles->customer_list === 3)
                        Read
                      @elseif($roles->customer_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Karyawan</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">List Karyawan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="staff_staff_list" id="staff_staff_list">
                      <option value="{{ $roles->staff_staff_list }}" class="selectstatus" style="color: black;" selected>@if($roles->staff_staff_list === 1)
                        Full
                      @elseif($roles->staff_staff_list === 2)
                        Write
                      @elseif($roles->staff_staff_list === 3)
                        Read
                      @elseif($roles->staff_staff_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="staff_job" id="staff_job">
                      <option value="{{ $roles->staff_job }}" class="selectstatus" style="color: black;" selected>@if($roles->staff_job === 1)
                        Full
                      @elseif($roles->staff_job === 2)
                        Write
                      @elseif($roles->staff_job === 3)
                        Read
                      @elseif($roles->staff_job === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="staff_access_control" id="staff_access_control">
                      <option value="{{ $roles->staff_access_control }}" class="selectstatus" style="color: black;" selected>@if($roles->staff_access_control === 1)
                        Full
                      @elseif($roles->staff_access_control === 2)
                        Write
                      @elseif($roles->staff_access_control === 3)
                        Read
                      @elseif($roles->staff_access_control === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C">Security Group</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="staff_security_groups" id="staff_security_groups">
                      <option value="{{ $roles->staff_security_groups }}" class="selectstatus" style="color: black;" selected>@if($roles->staff_security_groups === 1)
                        Full
                      @elseif($roles->staff_security_groups === 2)
                        Write
                      @elseif($roles->staff_security_groups === 3)
                        Read
                      @elseif($roles->staff_security_groups === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
          </tbody>
        </table>


        {{-- Service --}}
        <table class="table m-2 mt-4">
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_dashboard" id="service_dashboard">
                      <option value="{{ $roles->service_dashboard }}" class="selectstatus" style="color: black;" selected>@if($roles->service_dashboard === 1)
                        Full
                      @elseif($roles->service_dashboard === 2)
                        Write
                      @elseif($roles->service_dashboard === 3)
                        Read
                      @elseif($roles->service_dashboard === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_list" id="service_list">
                      <option value="{{ $roles->service_list }}" class="selectstatus" style="color: black;" selected>@if($roles->service_list === 1)
                        Full
                      @elseif($roles->service_list === 2)
                        Write
                      @elseif($roles->service_list === 3)
                        Read
                      @elseif($roles->service_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_treatment_plan" id="service_treatment_plan">
                      <option value="{{ $roles->service_treatment_plan }}" class="selectstatus" style="color: black;" selected>@if($roles->service_treatment_plan === 1)
                        Full
                      @elseif($roles->service_treatment_plan === 2)
                        Write
                      @elseif($roles->service_treatment_plan === 3)
                        Read
                      @elseif($roles->service_treatment_plan === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_category" id="service_category">
                      <option value="{{ $roles->service_category }}" class="selectstatus" style="color: black;" selected>@if($roles->service_category === 1)
                        Full
                      @elseif($roles->service_category === 2)
                        Write
                      @elseif($roles->service_category === 3)
                        Read
                      @elseif($roles->service_category === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_diagnosis" id="service_diagnosis">
                      <option value="{{ $roles->service_diagnosis }}" class="selectstatus" style="color: black;" selected>@if($roles->service_diagnosis === 1)
                        Full
                      @elseif($roles->service_diagnosis === 2)
                        Write
                      @elseif($roles->service_diagnosis === 3)
                        Read
                      @elseif($roles->service_diagnosis === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C">Policy</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="service_policy" id="service_policy">
                      <option value="{{ $roles->service_policy }}" class="selectstatus" style="color: black;" selected>@if($roles->service_policy === 1)
                        Full
                      @elseif($roles->home_overview === 2)
                        Write
                      @elseif($roles->home_overview === 3)
                        Read
                      @elseif($roles->home_overview === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
          </tbody>
        </table>


        {{-- Product --}}
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Product</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Product</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="product_dashboard" id="product_dashboard">
                      <option value="{{ $roles->product_dashboard }}" class="selectstatus" style="color: black;" selected>@if($roles->product_dashboard === 1)
                        Full
                      @elseif($roles->product_dashboard === 2)
                        Write
                      @elseif($roles->product_dashboard === 3)
                        Read
                      @elseif($roles->product_dashboard === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
            <tr>
              <th scope="row" style="color: #7C7C7C; width:300px">Product List</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="product_list" id="product_list">
                      <option value="{{ $roles->product_list }}" class="selectstatus" style="color: black;" selected>@if($roles->product_list === 1)
                        Full
                      @elseif($roles->product_list === 2)
                        Write
                      @elseif($roles->product_list === 3)
                        Read
                      @elseif($roles->product_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="product_brand" id="product_brand">
                      <option value="{{ $roles->product_brand }}" class="selectstatus" style="color: black;" selected>@if($roles->product_brand === 1)
                        Full
                      @elseif($roles->product_brand === 2)
                        Write
                      @elseif($roles->product_brand === 3)
                        Read
                      @elseif($roles->product_brand === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="product_category" id="product_category">
                      <option value="{{ $roles->product_category }}" class="selectstatus" style="color: black;" selected disabled>@if($roles->product_category === 1)
                        Full
                      @elseif($roles->product_category === 2)
                        Write
                      @elseif($roles->product_category === 3)
                        Read
                      @elseif($roles->product_category === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="product_suppliers" id="product_suppliers">
                      <option value="{{ $roles->product_suppliers }}" class="selectstatus" style="color: black;" selected>@if($roles->product_suppliers === 1)
                        Full
                      @elseif($roles->product_suppliers === 2)
                        Write
                      @elseif($roles->product_suppliers === 3)
                        Read
                      @elseif($roles->product_suppliers === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Lokasi</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Lokasi</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="dashboard_location" id="dashboard_location">
                      <option value="{{ $roles->dashboard_location }}" class="selectstatus" style="color: black;" selected >@if($roles->dashboard_location === 1)
                        Full
                      @elseif($roles->dashboard_location === 2)
                        Write
                      @elseif($roles->dashboard_location === 3)
                        Read
                      @elseif($roles->dashboard_location === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">List Lokasi</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location_list" id="location_list">
                      <option value="{{ $roles->location_list }}" class="selectstatus" style="color: black;" selected>@if($roles->location_list === 1)
                        Full
                      @elseif($roles->location_list === 2)
                        Write
                      @elseif($roles->location_list === 3)
                        Read
                      @elseif($roles->location_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Setting Lokasi</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="setting_location" id="setting_location">
                      <option value="{{ $roles->setting_location }}" class="selectstatus" style="color: black;" selected>@if($roles->setting_location === 1)
                        Full
                      @elseif($roles->setting_location === 2)
                        Write
                      @elseif($roles->setting_location === 3)
                        Read
                      @elseif($roles->setting_location === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Keuangan</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Keuangan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="dashboard_finance" id="dashboard_finance">
                      <option value="{{ $roles->dashboard_finance }}" class="selectstatus" style="color: black;" selected>@if($roles->dashboard_finance === 1)
                        Full
                      @elseif($roles->dashboard_finance === 2)
                        Write
                      @elseif($roles->dashboard_finance === 3)
                        Read
                      @elseif($roles->dashboard_finance === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="sale_list" id="sale_list">
                      <option value="{{ $roles->sale_list }}" class="selectstatus" style="color: black;" selected>@if($roles->sale_list === 1)
                        Full
                      @elseif($roles->sale_list === 2)
                        Write
                      @elseif($roles->sale_list === 3)
                        Read
                      @elseif($roles->sale_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C">Quotation List</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="quotation_list" id="quotation_list">
                      <option value="{{ $roles->quotation_list }}" class="selectstatus" style="color: black;" selected>@if($roles->quotation_list === 1)
                        Full
                      @elseif($roles->quotation_list === 2)
                        Write
                      @elseif($roles->quotation_list === 3)
                        Read
                      @elseif($roles->quotation_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C">Tax Rate</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_rate" id="tax_rate">
                      <option value="{{ $roles->tax_rate }}" class="selectstatus" style="color: black;" selected>@if($roles->tax_rate === 1)
                        Full
                      @elseif($roles->tax_rate === 2)
                        Write
                      @elseif($roles->tax_rate === 3)
                        Read
                      @elseif($roles->tax_rate === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
          </tbody>
        </table>

        {{-- Attendance --}}
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Kehadiran</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Dashboard Kehadiran</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="dashboard_attendance" id="dashboard_attendance">
                      <option value="{{ $roles->dashboard_attendance }}" class="selectstatus" style="color: black;" selected>@if($roles->dashboard_attendance === 1)
                        Full
                      @elseif($roles->dashboard_attendance === 2)
                        Write
                      @elseif($roles->dashboard_attendance === 3)
                        Read
                      @elseif($roles->dashboard_attendance === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Data Kehadiran</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="attendance_list" id="attendance_list">
                      <option value="{{ $roles->attendance_list }}" class="selectstatus" style="color: black;" selected >@if($roles->attendance_list === 1)
                        Full
                      @elseif($roles->attendance_list === 2)
                        Write
                      @elseif($roles->attendance_list === 3)
                        Read
                      @elseif($roles->attendance_list === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Jam Kerja</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="working_shift" id="working_shift">
                      <option value="{{ $roles->working_shift }}" class="selectstatus" style="color: black;" selected>@if($roles->working_shift === 1)
                        Full
                      @elseif($roles->working_shift === 2)
                        Write
                      @elseif($roles->working_shift === 3)
                        Read
                      @elseif($roles->working_shift === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" style="color: #7C7C7C">Atur Shift Karyawan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="manage_staff_shift" id="manage_staff_shift">
                      <option value="{{ $roles->manage_staff_shift }}" class="selectstatus" style="color: black;" selected >@if($roles->manage_staff_shift === 1)
                        Full
                      @elseif($roles->manage_staff_shift === 2)
                        Write
                      @elseif($roles->manage_staff_shift === 3)
                        Read
                      @elseif($roles->manage_staff_shift === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4">
          <thead>
            <tr>
              <th scope="col"><b>Absent</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            {{-- <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Absent</th>
              <td>
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="absent" id="absent">
                      <option value="{{ $roles->absent }}" class="selectstatus" style="color: black;" selected>@if($roles->absent === 1)
                        Full
                      @elseif($roles->absent === 2)
                        Write
                      @elseif($roles->absent === 3)
                        Read
                      @elseif($roles->absent === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
                      <option value="1" class="selectstatus" style="color: black;">Full</option>
                      <option value="2" class="selectstatus" style="color: black;">Write</option>
                      <option value="3" class="selectstatus" style="color: black;">Read</option>
                      <option value="4" class="selectstatus" style="color: black;">None</option>
                      </select>
              </div>
              </td>
            </tr> --}}
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Absen Karyawan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="presence_today" id="presence_today">
                      <option value="{{ $roles->presence_today }}" class="selectstatus" style="color: black;" selected>@if($roles->presence_today === 1)
                        Full
                      @elseif($roles->presence_today === 2)
                        Write
                      @elseif($roles->presence_today === 3)
                        Read
                      @elseif($roles->presence_today === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
        <table class="table m-2 mt-4 ">
          <thead>
            <tr>
              <th scope="col"><b>Laporan</b></th>
              <th scope="col">Permission</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" style="color: #7C7C7C;width:300px">Semua Laporan</th>
              <td>
                {{-- Role Dropdown --}}
                <div class="mb-1">
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="reports_all" id="reports_all">
                      <option value="{{ $roles->reports_all }}" class="selectstatus" style="color: black;" selected>@if($roles->reports_all === 1)
                        Full
                      @elseif($roles->reports_all === 2)
                        Write
                      @elseif($roles->reports_all === 3)
                        Read
                      @elseif($roles->reports_all === 4)
                        None
                      @else
                        Select Permission
                      @endif</option>
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
