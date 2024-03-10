@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item" style="cursor: pointer;">
                                <a href="/booking/detail/{{ $note->sub_booking_id }}" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                            </li>
                            <li class="nav-item" style="cursor: pointer;">
                                <a onclick="editTextBooking()" class="nav-link active" style="color: #f28123" ><img src="/img/icon/save.png" alt="" style="width: 22px"> Perbarui</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <div id="dashboard" class="mx-3 mt-3">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <div class="d-flex">
                    <form action="/editTextBooking/{{ $note->id }}" method="POST" class="w-100">
                        @csrf
                        <div class="m-3">
                            <input type="text" hidden name="sub_booking_id" value="{{ $note->sub_booking_id }}">
                            <input id="text" type="hidden" name="text" value="{{ $note->text }}">
                            <trix-editor input="text"></trix-editor>
                        </div>
                        <button type="submit" hidden id="editTextBooking"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>



@include('sweetalert::alert')
@endsection
