@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/calendar" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveBooking()" style="color: #f28123; cursor: pointer;">Next <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            <form action="/addBooking" method="POST">
                @csrf
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Scheduling</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Customer</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                        </div>
                        <div class="mb-3">
                          <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id" required>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" class="selectstatus" name="location_id" style="color: black;">{{ $location->location_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="booking_date" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                          <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        </div>
                    </div>
                    <div class="m-3">
                        <div class="mb-3">
                            <label for="alasan_kunjungan" class="form-label" style="font-size: 15px; color: #7C7C7C;">Alasan Kunjungan</label>
                            <input type="text" class="form-control" id="alasan_kunjungan" name="alasan_kunjungan" value="" placeholder="Search Alasan Kunjungan" required>
                            {{-- <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Search Service" required> --}}
                        </div>
                    </div>
                    <div class="mx-3 d-flex gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checkCategory" id="tidak_dikenakan_biaya" value="tidak_dikenakan_biaya">
                            <label class="form-check-label" for="tidak_dikenakan_biaya">
                                Tidak dikenakan biaya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checkCategory" id="langsung_datang" value="langsung_datang">
                            <label class="form-check-label" for="langsung_datang">
                                Langsung datang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checkCategory" id="rawat_inap" value="rawat_inap">
                            <label class="form-check-label" for="rawat_inap">
                                Rawat Inap
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checkCategory" id="darurat" value="darurat">
                            <label class="form-check-label" for="darurat">
                                Darurat
                            </label>
                        </div>

                        <input type="text" hidden name="category" id="category">
                    </div>
                    <div class="mx-3 mt-4 mb-3" id="duration_field" style="display: none;">
                        <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                        <div class="d-flex">
                            <input type="number" class="form-control" id="duration" name="duration" style="width: 7%;"> Days
                        </div>
                    </div>
                </div>
                
                <button type="submit" id="submitBooking" hidden></button>
            </form>
        </div>
    </div>
  </div>
@endsection
