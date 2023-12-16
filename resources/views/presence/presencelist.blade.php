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
          <table class="table w-100">
              <thead>
                <tr >
                  <th scope="col" style="color: #7C7C7C;">Staff Name</th>
                  <th scope="col" style="color: #7C7C7C;">Date</th>
                  <th scope="col" style="color: #7C7C7C;">Check In</th>
                  <th scope="col" style="color: #7C7C7C;">Check Out</th>
                  <th scope="col" style="color: #7C7C7C;">Status</th>
                  <th scope="col" style="color: #7C7C7C;">Shift</th>
                  <th scope="col" style="color: #7C7C7C;">Location</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attendances as $attendance)
                  <tr>
                      <td>{{ $attendance->staff->first_name }}</td>
                      <td>{{ date_format($attendance->created_at, 'd M Y') }}</td>
                      <td>{{ date_format($attendance->created_at, "H:i") }}</td>
                      @if ($attendance->check_out == null)
                        <td>-</td>
                      @else
                        <td>{{ date_format($attendance->updated_at, "H:i") }}</td>
                      @endif
                      @if ($attendance->status == "Normal")
                          <td class="text-success">{{ $attendance->status }}</td>
                      @elseif ($attendance->status == "Late")
                          <?php $hour = $attendance->over_hour/60;
                                $minute = $attendance->over_hour%60;
                                $panjangHour = strlen(floor($hour));
                                $panjangMinute = strlen($minute);

                                $printHour = '';
                                $printMinute = '';
                                if($panjangHour == 1){
                                  $printHour = '0'.floor($hour);
                                }else{
                                  $printHour = floor($hour);
                                }

                                if($panjangMinute == 1){
                                  $printMinute = '0'.floor($minute);
                                }else{
                                  $printMinute = floor($minute);
                                }
                          ?>
                          <td class="text-danger">{{ $attendance->status }} {{ $printHour }}:{{ $printMinute }} ({{ $attendance->over_hour }} minutes)</td>
                      @else
                          <td class="text-primary">{{ $attendance->status }}</td>
                      @endif
                      <td>{{ $attendance->staff->shift->shift_name }} ({{ $attendance->staff->shift->start_hour }} - {{ $attendance->staff->shift->end_hour }})</td>
                      <td>{{ $attendance->staff->location->location_name }}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>    
      @else
      @endif
    </div>
    
  </div>

  @include('sweetalert::alert')
@endsection
