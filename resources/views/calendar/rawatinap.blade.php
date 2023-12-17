@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/booking/darurat">Booking {{ $title }}</a>
                </div>
                <select class="form-select form-select" aria-label="Small select example" style="background-color: transparent; border-bottom: none;" id="filterstatus">
                    <option selected>Filter Status</option>
                    <option value="Terkonfirmasi">Terkonfirmasi</option>
                    <option value="Dirawat Inap">Dirawat Inap</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C">Time</th>
                        <th scope="col" style="color: #7C7C7C">Day</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Client</th>
                        <th scope="col" style="color: #7C7C7C; width: 15%">Servis</th>
                        <th scope="col" style="color: #7C7C7C; width: 15%">Staff</th>
                        <th scope="col" style="color: #7C7C7C; width: 10%">Location</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        @if ($booking->booking->temp == 1)
                            @continue
                        @endif
                        <tr>
                            <td class="align-middle">
                                <a href="/booking/detail/{{ $booking->id }}" class="d-flex flex-column text-primary">
                                    <?php $date = date_create($booking->start_booking); ?>
                                    {{ date_format($date, 'd M Y') }} <br>
                                    {{ date_format($date, 'H:i') }}
                                </a>
                            </td>
                            <td class="align-middle">
                                @if ($booking->ranap == 1)
                                    -    
                                @else
                                    <?php $days = $now->diffInDays($booking->start_booking) + 1; ?>
                                    {{ $days }}
                                @endif
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
                                @if ($booking->status == "Dimulai")
                                    @if ($booking->ranap == 1)
                                        <button type="button" class="btn btn-sm" style="background-color: #97cbfe;">Terkonfirmasi</button>
                                    @elseif ($booking->ranap == 2)
                                        <button type="button" class="btn btn-sm" style="background-color: #fee497;">Di Rawat Inap</button>
                                    @endif
                                @elseif ($booking->status == "Selesai" && $booking->ranap == 3)
                                    <button type="button" class="btn btn-sm" style="background-color: #cef9bf;">Selesai</button>
                                @endif
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
