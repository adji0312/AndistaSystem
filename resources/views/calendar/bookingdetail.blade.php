@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <form action="/changeStatus/{{ $booking->id }}" method="POST">
                        @csrf
                        @if ($booking->booking->status == "Terkonfirmasi" && $booking->status == "Terkonfirmasi")
                            <input type="text" hidden name="status" value="Dimulai">
                        @elseif ($booking->booking->status == "Dimulai" && $booking->status == "Dimulai")
                            <input type="text" hidden name="status" value="Selesai">
                        @elseif ($booking->booking->status == "Selesai" && $booking->status == "Selesai")

                        @endif
                        <button type="submit" class="btn btn-outline-primary btn-sm" style="height: 100%;">Mulai</button>
                    </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h5 class="m-3">Information</h5>
                <div class="d-flex gap-3">
                    <div class="m-3 d-flex flex-column gap-1">
                        <h6 style="color: black; font-weight: 400;">Location : {{ $booking->booking->location->location_name }}</h6>
                        <?php $date = date_create($booking->booking->booking_date) ?>
                        <h6 style="color: black; font-weight: 400">Date : {{ date_format($date, 'd F Y') }}</h6>
                        
                    </div>
                    <div class="m-3">
                        <h6 style="color: black; font-weight: 400">Total : Rp {{ number_format($booking->booking->total_price) }}</h6>
                        <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97cbfe">{{ $booking->booking->status }}</button></h6>
                        <h6 style="color: black; font-weight: 400">Alasan Kunjungan : {{ $booking->booking->alasan_kunjungan }}</h6>
                    </div>
                    <div class="m-3 d-flex flex-column gap-1">
                        <h6 style="color: black; font-weight: 400">Pemilik : {{ $booking->booking->customer->first_name }}</h6>
                        <div class="d-flex gap-1">
                            <h6 style="color: black; font-weight: 400">Hewan : {{ $booking->pet->pet_name }} ({{ $booking->pet->pet_type }})</h6>
                            <small class="text-primary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal"> (info)</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3 mt-4">
                    <div class="mx-3 mb-3 d-flex flex-column gap-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <td scope="col">Service Name</td>
                                    <td scope="col" style="width: 10%">Time</td>
                                    <td scope="col">Staff</td>
                                    <td scope="col">Duration</td>
                                    <td scope="col">Price (Rp)</td>
                                  </tr>
                                </thead>
                                <tbody>
                                    <td>{{ $booking->booking->services[0]->service->service_name }}</td>
                                    <td>{{ $booking->booking->services[0]->time }}</td>
                                    <td>{{ $booking->booking->services[0]->staff->first_name }}</td>
                                    <td>{{ $booking->booking->services[0]->servicePrice->duration }} {{ $booking->booking->services[0]->servicePrice->duration_type }} ({{ $booking->booking->services[0]->servicePrice->price_title }})</td>
                                    <td>Rp {{ number_format($booking->booking->services[0]->servicePrice->price) }}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-3">
                <div class="m-2 d-flex">
                    <h5 class="m-3">Statistik</h5>
                    <button type="button" class="btn btn-sm btn-outline-dark m-2" onclick="submitStatistic()"><i class="fas fa-save"></i> Save Changes</button>
                </div>
                <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <td scope="col" style="width: 20%">Data</td>
                                <td scope="col" style="width: 30%">New</td>
                                <td scope="col" style="width: 30%">Latest</td>
                                <td scope="col" style="width: 30%">Before</td>
                                <td scope="col">Perubahan</td>
                              </tr>
                            </thead>
                            <form action="/addStatistic" method="POST">
                                @csrf
                                <input type="text" name="sub_booking_id" value="{{ $booking->id }}" hidden>
                                <input type="text" name="pet_id" value="{{ $booking->subAccount_id }}" hidden>
                                <tbody>
                                    <tr>
                                        <td>Suhu</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 °C" style="width: 70px;" name="suhu">
                                        </td>
                                        @if ($latestStatistic)
                                            <td>{{ $latestStatistic[0]->suhu }} °C</td>
                                        @else
                                            <td>-</td>    
                                        @endif
                                        @if (count($beforeStatistic) > 1)
                                            <td>{{ $beforeStatistic[1]->suhu }} °C</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Berat</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 kg" style="width: 70px;" name="berat">
                                        </td>
                                        @if ($latestStatistic)
                                            <td>{{ $latestStatistic[0]->berat }} kg</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if (count($beforeStatistic) > 1)
                                            <td>{{ $beforeStatistic[1]->berat }} kg</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Perilaku</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="..." style="width: 70px;" name="perilaku">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>BCS</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="..." style="width: 70px;" name="bcs">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Gula Darah</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 mmol/L" style="width: 70px;" name="gula_darah">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Tekanan Darah</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0/0 mmHg" style="width: 70px;" name="tekanan_darah">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>CRT</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="..." style="width: 70px;" name="crt">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Detak Jantung</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 bpm" style="width: 70px;" name="detak_jantung">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>MM</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="..." style="width: 70px;" name="mm">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Saturasi Oksigen</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 %" style="width: 70px;" name="saturasi_oksigen">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Pernapasan</td>
                                        <td class="text-primary" style="cursor: pointer">
                                            <input type="text" placeholder="0 bpm" style="width: 70px;" name="tingkat_pernapasan">
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                                <button type="submit" id="submitStatistic" hidden></button>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Info Hewan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th style="width: 30%;">Name</th>
                        <td>{{ $booking->pet->pet_name }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Type</th>
                        <td>{{ $booking->pet->pet_type }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Gender</th>
                        <td>{{ $booking->pet->pet_gender }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Ras</th>
                        <td>{{ $booking->pet->pet_ras }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Color</th>
                        <td>{{ $booking->pet->pet_color }}</td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Date of Birth</th>
                        <?php $date = date_create($booking->pet->date_of_birth) ?>
                        <td>{{ date_format($date, "d F Y") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection
