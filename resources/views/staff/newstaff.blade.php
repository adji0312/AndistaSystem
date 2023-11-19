@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('staff.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/staff/list" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            {{-- @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
            <form method="POST" action="/addnewstaff" enctype="multipart/form-data">
                @csrf
                {{-- firstname --}}
                <div class="row mb-3">
                    <label for="first_name">First Name &nbsp; &nbsp; &nbsp;</label>
                    <input id="first_name" name="first_name" type="text" class="@error('first_name') is-invalid @enderror">
                </div>
                {{-- middlename --}}
                <div class="row mb-3">
                    <label for="middle_name">Middle Name &nbsp; &nbsp; &nbsp;</label>
                    <input id="middle_name" name="middle_name" type="text" class="@error('middle_name') is-invalid @enderror">
                </div>
                {{-- lastname --}}
                <div class="row mb-3">
                    <label for="last_name">Last Name &nbsp; &nbsp; &nbsp;</label>
                    <input id="last_name" name="last_name" type="text" class="@error('last_name') is-invalid @enderror">
                </div>
                {{-- nickname --}}
                <div class="row mb-3">
                    <label for="nickname">Nickname &nbsp; &nbsp; &nbsp;</label>
                    <input id="nickname" name="nickname" type="text" class="@error('nickname') is-invalid @enderror">
                </div>
                {{-- gender --}}
                <div class="row mb-3">
                    <label for="gender">Gender &nbsp; &nbsp; &nbsp;</label>
                    <input id="gender" name="gender" type="text" class="@error('gender') is-invalid @enderror">
                </div>
                {{-- status --}}
                
                {{-- description --}}

                {{-- phone --}}

                {{-- email --}}

                {{-- role --}}

                {{-- password --}}

                {{-- confirm password --}}

                {{-- submit button --}}
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-success btn-block text-white">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
