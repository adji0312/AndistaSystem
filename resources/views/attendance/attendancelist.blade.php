@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <form action="" method="get" id="formFilterLocation">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Choose Location</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="location_id" onchange="changeLocation(this)">
                                    <option value="" class="selectstatus" style="color: black;" disabled selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->location_name }}" class="selectstatus" style="color: black;" id="locationFilter{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Month</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="month">
                                    <option value="" class="selectstatus" disabled selected>Select Month</option>
                                    <option value="01" style="color: black;">January</option>
                                    <option value="02" style="color: black;">February</option>
                                    <option value="03" style="color: black;">March</option>
                                    <option value="04" style="color: black;">April</option>
                                    <option value="05" style="color: black;">May</option>
                                    <option value="06" style="color: black;">June</option>
                                    <option value="07" style="color: black;">July</option>
                                    <option value="08" style="color: black;">August</option>
                                    <option value="09" style="color: black;">September</option>
                                    <option value="10" style="color: black;">October</option>
                                    <option value="11" style="color: black;">November</option>
                                    <option value="12" style="color: black;">December</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Year</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="year">
                                    <option value="" class="selectstatus" disabled selected>Select Year</option>
                                    <option value="2023" style="color: black;">2023</option>
                                    <option value="2024" style="color: black;">2024</option>
                                    <option value="2025" style="color: black;">2025</option>
                                    <option value="2026" style="color: black;">2026</option>
                                    <option value="2027" style="color: black;">2027</option>
                                    <option value="2028" style="color: black;">2028</option>
                                    <option value="2029" style="color: black;">2029</option>
                                    <option value="2030" style="color: black;">2030</option>
                                    <option value="2031" style="color: black;">2031</option>
                                    <option value="2032" style="color: black;">2032</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary m-3 mt-0 btn-sm" id="buttonfilter" onclick="submitAttach()">Submit</button>
                    </div>

                    <button type="submit" hidden id="gotolocation"></button>
                </form>
            </div>
        </div>
    </div>

@endsection