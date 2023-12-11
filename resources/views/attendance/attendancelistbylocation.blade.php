@extends('main')
@section('container')

    <div class="wrapper">
        @include('attendance.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }} for {{ $location->location_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/attendance/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            
            <div class="m-3">
                @if ($month == 1)
                    <h5>Report for January {{ $year }}</h5>
                @elseif($month == 2)
                    <h5>Report for February {{ $year }}</h5>
                @elseif($month == 3)
                    <h5>Report for March {{ $year }}</h5>
                @elseif($month == 4)
                    <h5>Report for April {{ $year }}</h5>
                @elseif($month == 5)
                    <h5>Report for May {{ $year }}</h5>
                @elseif($month == 6)
                    <h5>Report for June {{ $year }}</h5>
                @elseif($month == 7)
                    <h5>Report for July {{ $year }}</h5>
                @elseif($month == 8)
                    <h5>Report for August {{ $year }}</h5>
                @elseif($month == 9)
                    <h5>Report for September {{ $year }}</h5>
                @elseif($month == 10)
                    <h5>Report for October {{ $year }}</h5>
                @elseif($month == 11)
                    <h5>Report for November {{ $year }}</h5>
                @elseif($month == 12)
                    <h5>Report for December {{ $year }}</h5>
                @endif
            </div>
            <div id="dashboard" class="mx-3 mt-4">
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Staff Name</th>
                        <th scope="col" style="color: #7C7C7C">Start Work</th>
                        <th scope="col" style="color: #7C7C7C">End Work</th>
                        <th scope="col" style="color: #7C7C7C">Over Time</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                        <th scope="col" style="color: #7C7C7C">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                1
                            </th>
                            <td>Dr. Adji Budhi</td>
                            <td>00:10</td>
                            <td>08:00</td>
                            <td>-</td>
                            <td style="color: red">late (10 Minutes)</td>
                            <td>3 Desember 2023</td>
                        </tr>
                        <tr>
                            <th>
                                2
                            </th>
                            <td>Dr. Adji Budhi</td>
                            <td>00:00</td>
                            <td>09:00</td>
                            <td>60 minutes</td>
                            <td style="color: blue">normal</td>
                            <td>3 Desember 2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection