@extends('main')
@section('container')
    <div class="wrapper">
        @include('location.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        {{-- <div class="d-flex gap-4">
                            @if(Auth::user()->role->location_list === 1|Auth::user()->role->location_list === 2)
                                <a class="nav-link active" aria-current="page" href="/location/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            @else
                            @endif
                        </div> --}}
                        {{-- <form class="d-flex" role="search" action="/location/list">
                            <input class="form-control me-2" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </div>
            @include('location.sidenavlocation')

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