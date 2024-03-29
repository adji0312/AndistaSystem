@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">Atur Shift Karyawan</a>
                </div>
            </div>
            @include('attendance.sidenavattendance')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="" method="get" id="formFilterLocation2">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Pilih Lokasi</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-0">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="location_id" onchange="changeLocation(this)">
                                    <option value="" class="selectstatus" style="color: black;" disabled selected>Pilih Lokasi</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->location_name }}" class="selectstatus" style="color: black;" id="locationFilter{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary m-3 mt-0 btn-sm" id="buttonfilter">Submit</button>
                    </div>

                    <button type="submit" hidden id="gotolocation"></button>
                </form>
            </div>
        </div>
    </div>

@endsection