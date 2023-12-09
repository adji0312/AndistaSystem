@extends('main')

@section('container')
    
    <div class="wrapper">
        {{-- @include('menu') --}}

        <div id="contents">
            <div id="dashboard" class="mx-3 mt-4">
                <form action="/saveUpdatedStaffInfo/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="simple_service_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location" id="location" required>
                                    <option value="{{ Auth::user()->location_id }}" class="selectstatus" style="color: black;" selected>{{ Auth::user()->location->location_name }}</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                    {{-- <option value="Tn" class="selectstatus" style="color: black;">Male</option>
                                    <option value="Ny" class="selectstatus" style="color: black;">Female</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="password" class="form-label"><strong>Change Password</strong></label>
                                
                                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                @enderror
                              </div>
                            <div class="my-auto">
                                <span class="eye " onclick="myFunction()">
                                    <i id="hide1" class="fas fa-eye"></i>
                                    <i id="hide2" class="fas fa-eye-slash"></i>
                                  </span>
                              </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </form>
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

@endsection