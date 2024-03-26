@extends('main')
<meta http-equiv="refresh" content="10">
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex gap-3 w-100">
                <a class="navbar-brand" id="navbar-brand-title" href="/booking/darurat">Booking {{ $title }}</a>
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex gap-4">
                        <form action="" class="d-flex gap-2">
                            <input type="date" class="form-control" value="{{ request('datefrom') }}" name="datefrom" id="datefrom">
                            <input type="date" class="form-control" value="{{ request('dateto') }}" name="dateto" id="dateto">
                            <div class="d-flex gap-1">
                                <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 120px"><i class="fas fa-filter"></i> Filter</button>
                                <a href="/booking/terjadwal" class="btn btn-outline-secondary btn-sm" style="width: 120px">Reset</a>
                            </div>
                        </form>
                    </div>
                    <form class="d-flex" role="search" action="/booking/terjadwal">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        @include('calendar.sidenavcalendar')

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C">Tanggal</th>
                        <th scope="col" style="color: #7C7C7C; width: 25%">Pelanggan</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Lokasi</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings->where('category', 3) as $booking)
                        <tr>
                            <td class="align-middle">
                                <a href="/booking/detail/{{ $booking->id }}" class="d-flex flex-column text-primary">
                                    <?php 
                                        $convertDate = date_create($booking->booking->booking_date);
                                        $date = \Carbon\Carbon::parse($convertDate);
                                    ?>
                                    {{ $date->isoFormat('D MMMM Y') }} <br>
                                    {{ $booking->booking->services[0]->time }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex flex-column align-middle">
                                    {{ $booking->booking->customer->first_name }} <br>
                                    <div>
                                        <img src="/img/icon/paws.png" alt="" style="width: 18px"> {{ $booking->pet->pet_name }} ({{ $booking->pet->pet_type }}) <br>
                                    </div>
                                    <div>
                                        <img src="/img/icon/information.png" alt="" style="width: 17px"> {{ $booking->booking->alasan_kunjungan }}
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                @foreach ($booking->carts as $sc)
                                    {{ $sc->service->service_name }}
                                    @break;
                                @endforeach
                            </td>
                            @if ($booking->staff_id == null || $booking->staff_id == 0 || $booking->staff_id == '')
                                <td class="align-middle">-</td>
                            @else
                                @if ($booking->staff)
                                    <td class="align-middle">{{ $booking->staff->first_name }}</td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                            @endif
                            <td class="align-middle">{{ $booking->booking->location->location_name }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm" style="background-color: #97cbfe;">Terkonfirmasi</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mx-3">
            {{ $bookings->links() }}
        </div>
    </div>
  </div>
@endsection
