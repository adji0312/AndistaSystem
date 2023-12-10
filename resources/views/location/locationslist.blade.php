@extends('main')
@section('container')
    <div class="wrapper">
        @include('location.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if(Auth::user()->role->location_list === 1|Auth::user()->role->location_list === 2)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/location/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li>
                            @else
                            @endif
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        <th scope="col" style="color: #7C7C7C">Type</th>
                        <th scope="col" style="color: #7C7C7C">Address</th>
                        <th scope="col" style="color: #7C7C7C">City</th>
                        <th scope="col" style="color: #7C7C7C">Phone</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $location->id }}]" name="checkBox"  value="{{ $location->id }}">
                                    </div>
                                </th>
                                <?php
                                    $id = encrypt($location->id);
                                ?>
                                <td><a href="/location/{{ $location->location_name }}" class="text-primary">{{ $location->location_name }}</a></td>
                                <td>{{ $location->type }}</td>
                                @if ($location->locationaddresses->count() == 0)
                                    <td></td>
                                    <td></td>
                                @else
                                    @foreach ($location->locationaddresses as $la)
                                        <td>{{ $la->street_address }}</td>
                                        <td>{{ $la->city }}</td>
                                    @endforeach
                                @endif
                                <td>
                                    <div class="d-flex flex-column">
                                        @foreach ($location->phones as $phoneNumber)
                                            <small>{{ $phoneNumber->phone_number }}</small>
                                        @endforeach
                                    </div>    
                                </td> 
                                <td>{{ $location->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection