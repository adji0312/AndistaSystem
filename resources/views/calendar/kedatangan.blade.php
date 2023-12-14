@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/booking/darurat">Booking {{ $title }}</a>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C">Time</th>
                        <th scope="col" style="color: #7C7C7C; width: 25%">Client</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Location</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings->where('status', 'Terkonfirmasi') as $booking)
                        @if ($booking->booking->temp == 1)
                            @continue
                        @endif
                        @if ($booking->booking->langsung_datang == 0 && $booking->booking->darurat == 1 && $booking->booking->rawat_inap == 1)
                            <tr>
                                <td class="align-middle">
                                    <a href="/booking/detail/{{ $booking->id }}" class="d-flex flex-column text-primary">
                                        <?php $date = date_create($booking->booking->booking_date); ?>
                                        {{ date_format($date, 'd M Y') }} <br>
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
                                    {{ $booking->booking->services[0]->service->service_name }}
                                </td>
                                @if ($booking->booking->staff)
                                    <td class="align-middle">{{ $booking->booking->staff->first_name }}</td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                                <td class="align-middle">{{ $booking->booking->location->location_name }}</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm" style="background-color: #97cbfe;">{{ $booking->status }}</button>
                                </td>
                            </tr>
                        @endif
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

