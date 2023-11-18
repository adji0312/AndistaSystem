@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        <th scope="col" style="color: #7C7C7C">Location</th>
                        <th scope="col" style="color: #7C7C7C">Customer</th>
                        <th scope="col" style="color: #7C7C7C">Category</th>
                        <th scope="col" style="color: #7C7C7C">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[]" name="checkBox"  value="">
                                    <input type="hidden" id="categoryName" value="">
                                </div>
                            </th>
                            <td class="text-primary" style="cursor: pointer;">
                                <a href="/newBooking/{{ $booking->booking_name }}">{{ $booking->booking_name }}</a>
                            </td>
                            <td>{{ $booking->location->location_name }}</td>
                            <td>{{ $booking->customer_id }}</td>
                            <td>{{ $booking->category }}</td>
                            <?php $booking_date = strtotime($booking->booking_date); ?>
                            <td>{{ date('d F Y',$booking_date) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
