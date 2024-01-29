@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('location.menu')

    <div id="contents">
      <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
          <div class="d-flex gap-3 w-100">
              <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
          </div>
      </div>
      @include('location.sidenavlocation')

        <div id="dashboard" class="mx-3 mt-3">
          <div class="d-flex justify-content-between gap-4 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/list.png" alt="" style="width: 30px"> Locations</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($locations) }}</h2>
                </div>
            </div>
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/facilities.png" alt="" style="width: 30px"> Facilities</p>
                <div class="m-3 d-flex gap-5 mb-2">
                    <h2>{{ count($facilities) }}</h2>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
