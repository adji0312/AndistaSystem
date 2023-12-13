@extends('main')
@section('container')

  
  <div class="wrapper">
    
    @include('presence.menu')

    <div id="contents">
      @if(Auth::user()->role->presence_today != 4)
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
          <div class="mb-3"> 
            <form action="/presence/scan" method="POST">
              @csrf
              <input type="text" class="form-control mt-1 w-50" id="qrid" name="qrid" placeholder="scan qr here">
              <button type="submit" hidden></button>
            </form>
          </div>
          {{-- get date now --}}
          <small>jarak waktu = </small>{{ $timeDifference }} menit<br>
          {{ $timeDateNow }}
          <p class="mx-2" style="font-size: 18px; font-weight: 700; color: black;">{{ date_format(Date::now(),"d F Y") }}</p> 
          <table class="table w-100">
              <thead>
                <tr >
                  <th scope="col" style="color: #7C7C7C;">Staff Name</th>
                  <th scope="col" style="color: #7C7C7C;">Check In</th>
                  <th scope="col" style="color: #7C7C7C;">Check Out</th>
                  <th scope="col" style="color: #7C7C7C;">Shift</th>
                  <th scope="col" style="color: #7C7C7C;">Location</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Adji Budhi</td>
                      <td>08:00 AM</td>
                      <td>16:20 PM</td>
                      <td>1</td>
                      <td>Andista Animal Care</td>
                  </tr>
              </tbody>
          </table>
        </div>    
        @else
        @endif
    </div>
    
  </div>
@endsection
