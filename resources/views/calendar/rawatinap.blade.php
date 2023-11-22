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
                        <th scope="col" style="color: #7C7C7C; width: 15%">Client</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C; width: 15%">Staff</th>
                        <th scope="col" style="color: #7C7C7C; width: 10%">Location</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">
                            <a href="/booking/detail" class="d-flex flex-column text-primary">
                                22 Nov 2023 <br>
                                01:00
                            </a>
                        </td>
                        <td class="align-middle">1 days</td>
                        <td>
                            <div class="d-flex flex-column align-middle">
                                Adji Budhi <br>
                                <div>
                                    <img src="/img/icon/paws.png" alt="" style="width: 18px"> Cato (Kucing) <br>
                                </div>
                                <div>
                                    <img src="/img/icon/information.png" alt="" style="width: 17px"> Batuk
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            Konsultasi / Jasa Dokter Pemeriksaan
                        </td>
                        <td class="align-middle">Drh Benny Andista</td>
                        <td class="align-middle">Andista Animal Care</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-sm" style="background-color: #97cbfe">Terkonfirmasi</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <a href="/booking/detail" class="d-flex flex-column text-primary">
                                22 Nov 2023 <br>
                                01:00
                            </a>
                        </td>
                        <td class="align-middle">1 days</td>
                        <td>
                            <div class="d-flex flex-column align-middle">
                                Adji Budhi <br>
                                <div>
                                    <img src="/img/icon/paws.png" alt="" style="width: 18px"> Cato (Kucing) <br>
                                </div>
                                <div>
                                    <img src="/img/icon/information.png" alt="" style="width: 17px"> Batuk
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            Konsultasi / Jasa Dokter Pemeriksaan
                        </td>
                        <td class="align-middle">Drh Benny Andista</td>
                        <td class="align-middle">Andista Animal Care</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-sm" style="background-color: #ffc89c">Dirawat Inap</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <a href="/booking/detail" class="d-flex flex-column text-primary">
                                22 Nov 2023 <br>
                                01:00
                            </a>
                        </td>
                        <td class="align-middle">1 days</td>
                        <td>
                            <div class="d-flex flex-column align-middle">
                                Adji Budhi <br>
                                <div>
                                    <img src="/img/icon/paws.png" alt="" style="width: 18px"> Cato (Kucing) <br>
                                </div>
                                <div>
                                    <img src="/img/icon/information.png" alt="" style="width: 17px"> Batuk
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            Konsultasi / Jasa Dokter Pemeriksaan
                        </td>
                        <td class="align-middle">Drh Benny Andista</td>
                        <td class="align-middle">Andista Animal Care</td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-sm" style="background-color: #cef9bf">Selesai</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
