@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex gap-3 w-100">
                <a class="navbar-brand" id="navbar-brand-title" href="/booking/darurat">Booking {{ $title }}</a>
            </div>
        </div>
        @include('calendar.sidenavcalendar')

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C">Waktu</th>
                        <th scope="col" style="color: #7C7C7C">Durasi</th>
                        <th scope="col" style="color: #7C7C7C; width: 25%">Pelanggan</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Lokasi</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings->where('category', 2) as $booking)
                        <tr>
                            <td class="align-middle">
                                <a href="/booking/detail/{{ $booking->id }}" class="d-flex flex-column text-primary">
                                    <?php $date = $booking->created_at->isoFormat('D MMMM Y'); ?>
                                    {{ $date }} <br>
                                    {{ date_format($booking->created_at, 'H:i') }}
                                </a>
                            </td>
                            <?php 
                                $dateNow = \Carbon\Carbon::now()->format('H:i');
                                $durasi = \Carbon\Carbon::parse($booking->created_at)->diffInMinutes(\Carbon\Carbon::parse($dateNow));
                            ?>
                            <td class="align-middle">
                                {{ $durasi }} Minutes
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
