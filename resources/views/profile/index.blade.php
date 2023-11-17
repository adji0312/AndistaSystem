@extends('main')

@section('container')
    
    <div class="wrapper">
        {{-- @include('menu') --}}

        <div id="contents">
            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addService" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Name</label>
                                <input type="text" class="form-control" name="service_name" id="service_name">
                            </div>
                            <div class="mb-3">
                                <label for="simple_service_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Email</label>
                                <input type="text" class="form-control" name="simple_service_name" id="simple_service_name">
                            </div>
                            <div class="mb-3">
                                <label for="simple_service_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Location</label>
                                <input type="text" class="form-control" name="simple_service_name" id="simple_service_name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection