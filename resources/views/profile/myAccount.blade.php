@extends('main')

@section('container')
    
    <div class="wrapper">
        {{-- @include('menu') --}}

        <div id="contents">
            <div id="dashboard" class="mx-3 mt-4">
                <form action="/saveUpdatedStaffInfo/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container border" style="border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 100%;">Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Auth::user()->first_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 100%;">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" name="location" id="location" required>
                                <option value="{{ Auth::user()->location_id }}" class="selectstatus" style="color: black;" selected>{{ Auth::user()->location->location_name ?? '' }}</option>
                                @foreach ($locations as $location)
                                <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label"><strong>New Password</strong></label>
                                        <div class="input-group">
                                            <input id="myInput" type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                            <div class="input-group-append">
                                                <span class="input-group-text eye" onclick="myFunction()">
                                                    <i id="hide1" class="fas fa-eye" style="display: none"></i>
                                                    <i id="hide2" class="fas fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label"><strong>Confirm Password</strong></label>
                                        <div class="input-group">
                                            <input id="myInput2" type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="confirm_password"
                                                name="confirm_password">
                                            <div class="input-group-append">
                                                <span class="input-group-text eye" onclick="myFunction2()">
                                                <i id="hide12" class="fas fa-eye" style="display: none"></i>
                                                <i id="hide22" class="fas fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <form>
                    <input type="hidden" value="{{ Auth::user()->UUID }}" id="qrtoscan">
                </form>
                <div class="d-flex flex-column justify-content-center m-auto align-items-center m-4 p-4">
                    <div class="d-flex align-items-center m-auto">
                        <h1>QR Code Attendance</h1>
                    </div> 
                    <div class="container vh-80 m-auto bg-light border-dark p-4" style="border: 1px; border-style:solid;border-color:black">
                        <div id="qrcode" class="d-flex align-items-center justify-content-center m-auto p-4"></div>
                    </div>
                    
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                    <h5 class="m-3">Presence History</h5>
                    <div class="m-3 table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Shift</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Check Out</th>
                                <th scope="col">Status</th>
                                <th scope="col">Lembur</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $key => $attendance)
                                    <tr>
                                        <th scope="row">{{ $attendances->firstItem() + $key }}</th>
                                        <td>{{ date_format($attendance->created_at, "d M Y") }}</td>
                                        <td>{{ $attendance->shift->shift_name }}</td>
                                        <td>{{ date_format($attendance->created_at, "H:i") }}</td>
                                        @if ($attendance->check_out == null)
                                            <td>
                                                <form action="/checkoutButton/{{ $attendance->id }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Check Out</button>
                                                </form>
                                            </td>
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
                    <div class="d-flex justify-content-end mx-3">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction(){
          var x = document.getElementById("myInput");
          var y = document.getElementById("hide1");
          var z = document.getElementById("hide2");
    
          if(x.type === 'password'){
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
          }else{
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
          }
        }
      </script>
    <script>
        function myFunction2(){
          var x = document.getElementById("myInput2");
          var y = document.getElementById("hide12");
          var z = document.getElementById("hide22");
    
          if(x.type === 'password'){
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
          }else{
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
          }
        }
      </script>

      <!-- (C) CREATE QR CODE ON PAGE LOAD -->
    <script>
        let src_qr = document.getElementById("qrtoscan").value;
        // console.log(src_qr);
        window.addEventListener("load", () => {
            
          var qrc = new QRCode(document.getElementById("qrcode"), src_qr);
        });
        </script>

@endsection