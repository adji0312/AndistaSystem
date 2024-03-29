@extends('main')
@section('container')

  
  <div class="wrapper">
    
    @include('presence.menu')

    <div id="contents">
      @if(Auth::user()->role->presence_today != 4)
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Absen Karyawan</a>
                {{-- <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </form> --}}
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
          <div class="mb-3"> 
            <form action="/presence/scan" method="POST">
              @csrf
              <input type="text" class="form-control mt-1 w-50" id="qrid" name="qrid" placeholder="SCAN QR DISINI">
              <button type="submit" hidden></button>
            </form>
          </div>
          <table class="table w-100">
              <thead>
                <tr >
                  <th scope="col" style="color: #7C7C7C;">Tanggal</th>
                  <th scope="col" style="color: #7C7C7C;">Nama Karyawan</th>
                  <th scope="col" style="color: #7C7C7C;">Shift</th>
                  <th scope="col" style="color: #7C7C7C;">Check In</th>
                  <th scope="col" style="color: #7C7C7C;">Check Out</th>
                  {{-- <th scope="col" style="color: #7C7C7C;">Status</th> --}}
                  <th scope="col" style="color: #7C7C7C;">Lokasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($attendances as $attendance)
                  <tr>
                    <td>{{ date_format($attendance->created_at, 'd M Y') }}</td>
                    @if ($attendance->staff)
                      <td>{{ $attendance->staff->first_name }}</td>
                    @else
                      <td>-</td>
                    @endif
                    @if ($attendance->shift)
                      <td>{{ $attendance->shift->shift_name }} ({{ $attendance->shift->start_hour }} - {{ $attendance->shift->end_hour }})</td>
                    @else
                      <td>-</td>
                    @endif
                    <td>{{ date_format($attendance->created_at, "H:i") }}</td>
                    @if ($attendance->check_out == null)
                      <td>-</td>
                    @else
                      <td>{{ date_format($attendance->updated_at, "H:i") }}</td>
                    @endif
                    {{-- @if ($attendance->status == "Normal")
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
                    @endif --}}
                    @if ($attendance->staff)
                      <td>{{ $attendance->staff->location->location_name }}</td>
                    @else
                      <td>-</td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>  
        <div class="d-flex justify-content-end mx-3">
          {{ $attendances->links() }}
        </div>  
      @else
      @endif
    </div>
    
  </div>

  <script>
    window.onload = function() {
    document.getElementById("qrid").focus();
    console.log('ansdabsd');
    };
  </script>

  @include('sweetalert::alert')
@endsection
