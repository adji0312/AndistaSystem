@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }} for {{ $location ?? '' }}</a>
                    {{-- @foreach ($now as $n)
                        {{ $n }}
                    @endforeach --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                            </li>
                        </ul>
                        {{-- <form action="" class="d-flex gap-3">
                            <select class="form-select form-select" aria-label="Small select example" style="background-color: transparent; border-bottom: none; width: 200px" id="filterstaff" name="filterstaff">
                                <option selected>Filter Staff</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%"><i class="fas fa-filter"></i> Filter</button>
                        </form>
                        @if (request('filterstaff'))
                            <form action="/booking/rawatinap">
                                <button type="submit" class="btn btn-outline-secondary btn-sm mx-2" style="width: 100%; height: 100%">Reset</button>
                            </form>
                        @endif   --}}
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
                
                <table class="table w-100">
                <thead>
                  <tr >
                      <th scope="col" style="color: #7C7C7C;">Date</th>
                    <th scope="col" style="color: #7C7C7C;">Staff Name</th>
                    <th scope="col" style="color: #7C7C7C;">Check In</th>
                    <th scope="col" style="color: #7C7C7C;">Check Out</th>
                    <th scope="col" style="color: #7C7C7C;">Status</th>
                    <th scope="col" style="color: #7C7C7C;">Shift</th>
                    <th scope="col" style="color: #7C7C7C;">Over Working Day</th>
                  </tr>
                </thead>
                
                <tbody>
                @foreach ($now as $n)
                    <tr>
                        <td>
                            {{ date_format($n, 'd M Y') }}
                        </td>
                        <td>{{ $staff->first_name }}</td>
                        @if (count($attendances) != 0)
                            @foreach ($attendances as $attendance)
                                @if (date_format($attendance->created_at, 'd-m-Y') == date_format($n, 'd-m-Y'))
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
                                    <td>{{ $attendance->shift->shift_name }} ({{ $attendance->shift->start_hour }} - {{ $attendance->shift->end_hour }})</td>
                                    <?php $hour1 = $attendance->duration_work/60;
                                        $minute1 = $attendance->duration_work%60;
                                        $panjangHour1 = strlen(floor($hour1));
                                        $panjangMinute = strlen($minute1);

                                        $printHour1 = '';
                                        $printMinute1 = '';
                                        if($panjangHour1 == 1){
                                        $printHour1 = '0'.floor($hour1);
                                        }else{
                                        $printHour1 = floor($hour1);
                                        }

                                        if($panjangMinute == 1){
                                        $printMinute1 = '0'.floor($minute1);
                                        }else{
                                        $printMinute1 = floor($minute1);
                                        }
                                    ?>
                                    <td>{{ $printHour1 }}:{{ $printMinute1 }} ({{ $attendance->duration_work }} minutes)</td>

                                @else {{-- TIDAK ADA ABSEN / LIBUR --}}
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                            @endforeach
                        @else
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        @endif
                    </tr>
                @endforeach
      </tbody>
  </table>
            </div>
        </div>
    </div>
@endsection