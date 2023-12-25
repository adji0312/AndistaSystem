@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Data Kehadiran Karyawan</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="m-4">
                @if ($month == 1)
                    <h5>Laporan Bulan Januari {{ $year }}</h5>
                @elseif($month == 2)
                    <h5>Laporan Bulan Februari {{ $year }}</h5>
                @elseif($month == 3)
                    <h5>Laporan Bulan Maret {{ $year }}</h5>
                @elseif($month == 4)
                    <h5>Laporan Bulan April {{ $year }}</h5>
                @elseif($month == 5)
                    <h5>Laporan Bulan Mei {{ $year }}</h5>
                @elseif($month == 6)
                    <h5>Laporan Bulan Juni {{ $year }}</h5>
                @elseif($month == 7)
                    <h5>Laporan Bulan Juli {{ $year }}</h5>
                @elseif($month == 8)
                    <h5>Laporan Bulan Agustus {{ $year }}</h5>
                @elseif($month == 9)
                    <h5>Laporan Bulan September {{ $year }}</h5>
                @elseif($month == 10)
                    <h5>Laporan Bulan Oktober {{ $year }}</h5>
                @elseif($month == 11)
                    <h5>Laporan Bulan November {{ $year }}</h5>
                @elseif($month == 12)
                    <h5>Laporan Bulan Desember {{ $year }}</h5>
                @endif
            </div>

            <div id="dashboard" class="mx-3 mt-4"> 
                <table class="table w-100">
                    <thead>
                        <tr >
                            <th scope="col" style="color: #7C7C7C;">Tanggal</th>
                            <th scope="col" style="color: #7C7C7C;">Nama</th>
                            <th scope="col" style="color: #7C7C7C;">Shift</th>
                            <th scope="col" style="color: #7C7C7C;">Check In</th>
                            <th scope="col" style="color: #7C7C7C;">Check Out</th>
                            <th scope="col" style="color: #7C7C7C;">Status</th>
                            <th scope="col" style="color: #7C7C7C;">Lembur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <?php $date = date_create($attendance->check_in); ?>
                                <td>{{ date_format($date, 'd M Y') }}</td>
                                <td>{{ $staff->first_name }}</td>
                                <td>{{ $attendance->shift->shift_name }} ({{ $attendance->shift->start_hour }} - {{ $attendance->shift->end_hour }})</td>
                                <td>{{ date_format($attendance->created_at, 'H:i') }}</td>
                                @if ($attendance->check_out == null)
                                    <td>Belum Check Out</td>
                                @else
                                    <td>{{ date_format($attendance->updated_at, 'H:i') }}</td>
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
                                @endif
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection