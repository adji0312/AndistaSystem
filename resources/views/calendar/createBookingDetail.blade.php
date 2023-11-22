@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $booking->booking_name }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/calendar" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveBooking()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
            <form action="/editBooking/{{ $booking->id }}" method="POST">
                @csrf
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Scheduling</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Customer</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" value="{{ $booking->customer_id }}" required>
                        </div>
                        <div class="mb-3">
                          <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id" required>
                            @foreach ($locations as $location)
                                @if ($location->id == $booking->location_id)
                                    <option selected value="{{ $location->id }}" class="selectstatus" name="location_id" style="color: black;">{{ $location->location_name }}</option>
                                    @continue;
                                @endif
                                <option value="{{ $location->id }}" class="selectstatus" name="location_id" style="color: black;">{{ $location->location_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="booking_date" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                          <input type="date" class="form-control" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" required>
                        </div>
                    </div>
                    <div class="m-3">
                        <div class="mb-3">
                            <label for="alasan_kunjungan" class="form-label" style="font-size: 15px; color: #7C7C7C;">Alasan Kunjungan</label>
                            <input type="text" class="form-control" id="alasan_kunjungan" name="alasan_kunjungan" value="{{ $booking->alasan_kunjungan }}" required>
                        </div>
                    </div>
                    <div class="mx-3 d-flex gap-3 mb-3 mt-3">
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
                <button type="submit" hidden id="submitBooking"></button>
            </form>
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex gap-1 m-2">
                        <h5 class="m-3">Services</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addBookingService"><i class="fas fa-plus"></i> Add</button>
                    </div>
                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Time</th>
                                <th scope="col">Staff</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Price (Rp)</th>
                                <th scope="col" class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0?>
                                @foreach ($booking_services as $bs)
                                    <?php $index += 1; ?>
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $bs->service->service_name }}</td>
                                        <td>{{ $bs->time }}</td>
                                        <td>
                                            <form action="/editBookingService/{{ $bs->id }}" method="POST">
                                                @csrf
                                                <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="service_staff_id" id="service_staff_id{{ $bs->id }}" onchange="selectStaff({{ $bs->id }})">
                                                    <option value="" disabled selected>Select Staff</option>
                                                    @foreach ($service_staff->where('service_id', $bs->service_id) as $ss)
                                                        @if ($ss->staff_id == $bs->service_staff_id)
                                                            <option selected value="{{ $ss->staff_id }}" class="selectstatus" style="color: black;">{{ $ss->staff->first_name }}</option>
                                                            @continue;
                                                        @endif
                                                        <option value="{{ $ss->staff_id }}" class="selectstatus" style="color: black;">{{ $ss->staff->first_name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <button type="submit" hidden id="editBookingService2{{ $bs->id }}"></button>
                                                <script>
                                                    function selectStaff(id){
                                                        let button = document.getElementById('editBookingService2' + id).click();
                                                    }
                                                </script>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="/editBookingService/{{ $bs->id }}" method="POST">
                                                @csrf
                                                <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="service_price_id" id="service_price_id{{ $bs->id }}" onchange="selectPrice({{ $bs->id }})">
                                                    
                                                    <option value="" disabled selected>Select Duration</option>
                                                    
                                                    @foreach ($service_prices->where('service_id', $bs->service_id) as $sp)
                                                        @if ($sp->id == $bs->service_price_id)
                                                            <option selected value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                            @continue;
                                                        @endif
                                                        <option value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                        <option value="{{ $sp->price }}" id="selectedPrice{{ $sp->id }}" hidden></option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" hidden id="editBookingService{{ $bs->id }}"></button>
                                                <script>
                                                    function selectPrice(id){
                                                        console.log(id);
                                                        var e = document.getElementById("service_price_id" + id);
                                                        var value = e.value;
                                                        
                                                        var f = document.getElementById("selectedPrice" + value);

                                                        var price = document.getElementById("price" + id);
                                                        price.value = f.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                                        let button = document.getElementById('editBookingService' + id).click();
                                                        // console.log(button);
                                                    }
                                                </script>
                                            </form>
                                        </td>
                                        <td>
                                            @if ($bs->price == 0)
                                                <input disabled class="form-control" type="text" style="border-bottom: none;" id="price{{ $bs->id }}" name="price" value="0">
                                            @else
                                                <input disabled class="form-control" type="text" style="border-bottom: none;" id="price{{ $bs->id }}" name="price" value="{{ number_format($bs->price) }}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-primary btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-check"></i> Check</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteUnit"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <button type="submit" id="submitFacility" hidden></button>
            {{-- </form> --}}
        </div>
    </div>
  </div>

    <div class="modal fade" id="addBookingService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service</h1>
                </div>
                <form action="/addBookingService" method="post">
                    @csrf
                    <input type="text" hidden name="booking_id" value="{{ $booking->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="duration_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Services</label>
                            <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Search Service" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label" style="font-size: 15px; color: #7C7C7C;">Time</label>
                            <?php 
                                $timeNow = date('H:i');
                            ?>
                            <input type="text" class="form-control" name="time" value="{{ $timeNow }}">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="service_price_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="service_price_id" id="service_price_id">
                                @foreach ($service_prices as $sp)
                                    <option value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price_title" class="form-label" style="font-size: 15px; color: #7C7C7C;">Price</label>
                            <input type="text" class="form-control" id="price_title" name="price_title">
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
@endsection
