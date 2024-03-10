{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template HTML untuk Export PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
        }
        img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Attendance List Export</h1>
    <p>Berikut ini adalah daftar kehadiran karyawan</p>
    <h3>Contoh Tabel</h3>
    <table>
        @foreach ($staffs as $s)
            <p>{{ $s }}</p>
        @endforeach
    </table>
</body>
</html> --}}
@extends('mainexport')
@section('content')
<h1>Attendance List</h1>
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
    @if($attendances!=null)
    <tbody>
      @foreach ($attendances as $attendance)
        <tr>
            <td>{{ $attendance->staff_id }}</td>
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
            <td>{{ $attendance->staff_id }} ({{ $attendance->staff_id }} - {{ $attendance->staff_id }})</td>
            <td>{{ $attendance->staff_id }}</td>
        </tr>
      @endforeach
    </tbody>
    @else
    @endif
</table> 


<style>
    .table {
      border: 1px solid #ddd; /* Light gray border for the table */
    }
    
    .table th,
    .table td {
      border: 1px solid #ddd; /* Light gray border for each cell */
      padding: 8px; /* Add some padding for better readability */
    }
    
    .thead-dark {
      background-color: #343a40; /* Adjust the background color if needed */
      color: #fff; /* White text for the table header */
    }
  </style>
  
  @endsection
