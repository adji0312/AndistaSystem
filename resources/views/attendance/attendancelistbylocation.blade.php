@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }} for {{ $location ?? '' }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            
            <div class="m-3">
                @if ($month == 1)
                    <h5>Report for January {{ $year }}</h5>
                @elseif($month == 2)
                    <h5>Report for February {{ $year }}</h5>
                @elseif($month == 3)
                    <h5>Report for March {{ $year }}</h5>
                @elseif($month == 4)
                    <h5>Report for April {{ $year }}</h5>
                @elseif($month == 5)
                    <h5>Report for May {{ $year }}</h5>
                @elseif($month == 6)
                    <h5>Report for June {{ $year }}</h5>
                @elseif($month == 7)
                    <h5>Report for July {{ $year }}</h5>
                @elseif($month == 8)
                    <h5>Report for August {{ $year }}</h5>
                @elseif($month == 9)
                    <h5>Report for September {{ $year }}</h5>
                @elseif($month == 10)
                    <h5>Report for October {{ $year }}</h5>
                @elseif($month == 11)
                    <h5>Report for November {{ $year }}</h5>
                @elseif($month == 12)
                    <h5>Report for December {{ $year }}</h5>
                @endif
            </div>
            <div id="dashboard" class="mx-3 mt-4">
                {{-- @dd($result) --}}
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
        </div>
    </div>
@endsection