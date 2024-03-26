@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('service.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
            </div>
        </nav>
        @include('service.sidenavservice')

        <div id="dashboard" class="mx-3 mt-3">
          <div class="d-flex justify-content-between gap-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/list.png" alt="" style="width: 30px"> Services</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($services) }}</h2>
                </div>
            </div>
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/treatment.png" alt="" style="width: 30px"> Treatment</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($treatment) }}</h2>
                </div>
            </div>
            
          </div>
          <div class="d-flex justify-content-between gap-4 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/diagnosis.png" alt="" style="width: 30px"> Diagnosis</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($diagnosis) }}</h2>
                </div>
            </div>
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/category.png" alt="" style="width: 30px"> Category</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($category) }}</h2>
                </div>
            </div>
            {{-- <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/policy.png" alt="" style="width: 30px"> Policy</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($policy) }}</h2>
                </div>
            </div> --}}
          </div>
        </div>
    </div>
  </div>
@endsection
