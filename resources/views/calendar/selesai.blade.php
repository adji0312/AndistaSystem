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
                        <th scope="col" style="color: #7C7C7C">Time Scheduled</th>
                        <th scope="col" style="color: #7C7C7C">Start Booking</th>
                        <th scope="col" style="color: #7C7C7C">End Booking</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Client</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Location</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings->where('status', 'Selesai') as $booking)
                        @if ($booking->booking->temp == 1)
                            @continue
                        @endif
                        <tr>
                            <td class="align-middle">
                                <a href="/booking/detail/{{ $booking->id }}" class="d-flex flex-column text-primary">
                                    <?php $date = date_create($booking->booking->booking_date); ?>
                                    {{ date_format($date, 'd M Y') }} <br>
                                    {{ $booking->booking->services[0]->time }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <?php $date1 = date_create($booking->start_booking); ?>
                                {{ date_format($date1, 'd M Y') }} <br>
                                {{ date_format($date1, 'h:i') }}
                            </td>
                            <td class="align-middle">
                                <?php $date2 = date_create($booking->end_booking); ?>
                                {{ date_format($date2, 'd M Y') }} <br>
                                {{ date_format($date2, 'h:i') }}
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
                            <td class="align-middle">{{ $booking->booking->staff->first_name }}</td>
                            <td class="align-middle">{{ $booking->booking->location->location_name }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm" style="background-color: #cef9bf">{{ $booking->status }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection

