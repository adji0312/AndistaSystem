@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">New Treatment Plan</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/treatmentplan" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="#" style="color: #f28123" onclick="saveTreatment()">Next <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
                          </li>
                      </ul>
                      <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addTreatment" method="post">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Treatment Name</label>
                                
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" style="width: 300px" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="location_id" id="location_id" required> 
                                    <option value="" class="selectstatus" style="color: black;" disabled selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="mySelectDiagnosis" class="form-label" style="font-size: 15px; color: #7C7C7C;">Diagnosis</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" onchange="changeDiagnosis()" id="mySelectDiagnosis" name="diagnosis_id" required>
                                    <option value="" selected disabled class="selectstatus" style="color: black;">Select Diagnosis</option>
                                    @foreach ($diagnosis as $diagno)
                                        <option value="{{ $diagno->id }}" class="selectstatus" style="color: black;">{{ $diagno->diagnosis_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration Treatment (days)</label>
                                <input type="number" class="form-control" id="duration" name="duration" style="width: 300px">
                            </div>

                        </div>
                    </div>

                    <button type="submit" hidden id="submitTreatment"></button>
                </form>
            </div>
        </div>
    </div>
@endsection