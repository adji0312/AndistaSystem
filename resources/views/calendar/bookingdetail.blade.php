@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    @if ($booking->status == 1)
                        <div class="d-flex gap-2">
                            <form action="/changeStatus/{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="number" hidden name="status" value="2">
                                <button type="submit" class="btn btn-outline-primary btn-sm" style="height: 100%;">Mulai</button>
                            </form>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#batalkanBooking" style="height: 100%;">Batalkan Booking</button>
                        </div>
                    @elseif ($booking->status == 2)
                        <div class="d-flex gap-2">
                            <form action="/changeStatus/{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="number" hidden name="status" value="3">
                                <button type="submit" class="btn-apotek btn btn-sm" style="height: 100%; border: 1.5px solid #7e57c1;">Apotek</button>
                            </form>
                            <form action="/changeStatus/{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="number" hidden name="status" value="1">
                                <input type="text" hidden name="balikantrian" value="99">
                                <button type="submit" class="btn btn-secondary btn-sm" style="height: 100%;">Kembali ke Antrian</button>
                            </form>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#rawatInap" style="height: 100%;">Rawat Inap</button>
                        </div>
                    @elseif ($booking->status == 3)
                        <div class="d-flex gap-2">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#selesaiBooking" class="btn btn-outline-success btn-sm" style="height: 100%;">Selesai</button>
                            <form action="/changeStatus/{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="number" hidden name="status" value="2">
                                <button type="submit" class="btn btn-secondary btn-sm" style="height: 100%;">Kembali ke Dimulai</button>
                            </form>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#rawatInap" style="height: 100%;">Rawat Inap</button>
                        </div>
                    @elseif ($booking->status == 4)
                    @elseif ($booking->status == 5 && $booking->ranap == 1)
                        <div class="d-flex gap-2">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#pasienpulang" class="btn btn-primary btn-sm" style="height: 100%;">Pulangkan Pasien</button>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        
        <div id="dashboard" class="mx-3 mt-3">
            <div class="d-flex gap-4">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 60%;">
                    @if ($booking->category == 2)
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <h5 class="m-3">Informasi</h5>
                            </div>
                            <h5 class="m-3 text-danger"><i class="fas fa-exclamation-triangle"></i> Darurat</h5>
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            @if ($booking->status == 1)
                                <h5 class="m-3">Informasi (Terkonfirmasi)</h5>
                            @elseif ($booking->status == 2)    
                                <h5 class="m-3">Informasi (Dimulai)</h5>
                            @elseif ($booking->status == 3)    
                                <h5 class="m-3">Informasi (Apotek)</h5>
                            @elseif ($booking->status == 4)    
                                <h5 class="m-3">Informasi (Selesai)</h5>
                            @elseif ($booking->status == 5 && $booking->ranap == 1)    
                                <h5 class="m-3">Informasi (Rawat Inap -  {{ Date::now()->diffInDays($booking->rawat_inap) + 1 }} Hari)</h5>
                            @elseif ($booking->status == 5 && $booking->ranap == 2)    
                                <h5 class="m-3">Informasi (Rawat Inap -  Selesai)</h5>
                            @endif
                            {{-- <div class="d-flex"> --}}
                                <button type="button" class="btn btn-dark btn-sm m-3"><small class="fs-6"><i class="fas fa-concierge-bell"></i> Resepsionis ({{ $resepsionis->first_name }})</small></button>
                                
                                {{-- <small class="mx-3 fs-6">{{ $resepsionis->first_name }}</small> --}}
                            {{-- </div> --}}
                        </div>
                        @if ($booking->status == 5 && $booking->ranap == 2)
                            <h6 class="m-3 mt-0">Alasan Pulang : {{ $booking->pesanresepsionis }}</h6>
                        @endif
                    @endif
                    <div class="d-flex gap-3">
                        <div class="m-3 d-flex flex-column gap-1">
                            <h6 style="color: black; font-weight: 400;">Lokasi : {{ $booking->booking->location->location_name }}</h6>
                            <?php $date = date_create($booking->booking->booking_date) ?>
                            <h6 style="color: black; font-weight: 400">Tanggal : {{ $booking->created_at->isoFormat('D MMMM Y') }}</h6>
                            
                        </div>
                        <div class="m-3">
                            <?php $booking->booking ?>
                            <h6 style="color: black; font-weight: 400">Total : Rp {{ number_format($booking->sub_total_price) }}</h6>
                            @if ($booking->rawat_inap == 1)
                                @if ($booking->ranap == 1)
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97cbfe">Terkonfirmasi</button> (belum di rawat inap)</h6>
                                @elseif ($booking->ranap == 2)
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #fee497">Di Rawat Inap</button></h6>
                                @elseif ($booking->ranap == 3)
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97fe99">Selesai</button></h6>
                                @endif
                            @else
                                @if ($booking->status == "Terkonfirmasi")
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97cbfe">{{ $booking->status }}</button></h6>
                                @elseif ($booking->status == "Dimulai")
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #fee497">{{ $booking->status }}</button></h6>
                                @elseif ($booking->status == "Selesai")
                                    <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97fe99">{{ $booking->status }}</button></h6>
                                @endif
                            @endif
                            <h6 style="color: black; font-weight: 400">Alasan Kunjungan : {{ $booking->booking->alasan_kunjungan }}</h6>
                        </div>
                        <div class="m-3 d-flex flex-column gap-1">
                            <h6 style="color: black; font-weight: 400">Pemilik : {{ $booking->booking->customer->first_name }}</h6>
                            <div class="d-flex gap-1">
                                <h6 style="color: black; font-weight: 400">Hewan : {{ $booking->pet->pet_name }} ({{ $booking->pet->pet_type }})</h6>
                                <small class="text-primary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#infoHewan"> (info)</small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-4">
                        <div class="mx-3 mb-3 d-flex flex-column gap-1">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <td scope="col">Nama Servis</td>
                                        <td scope="col">Waktu</td>
                                        <td scope="col">Staff</td>
                                        <td scope="col">Durasi</td>
                                        <td scope="col">Harga (Rp)</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{ $bs->service->service_name }}</td>
                                        <td>{{ $bs->time }}</td>
                                        @if ($booking->staff)
                                            <td>{{ $booking->staff->first_name }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($bs->servicePrice)
                                            <td>{{ $bs->servicePrice->duration }} {{ $bs->servicePrice->duration_type }} ({{ $bs->servicePrice->price_title }})</td>
                                            <td>Rp {{ number_format($bs->servicePrice->price) }}</td>
                                        @else
                                            <td>
                                                -
                                            </td>
                                            <td>-</td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 40%;">
                    <div class="m-2 d-flex">
                        <h5 class="m-3">Riwayat Pemeriksaan {{ $booking->pet->pet_name }} ({{ $booking->booking->customer->first_name }})</h5>
                    </div>
                    <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                        <div class="table-responsive" style="overflow: auto; height: 200px;">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" style="width: 40%">Tanggal</th>
                                    <th scope="col">Alasan Kunjungan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historyBook as $hstBook)
                                        @if ($hstBook->status == 4 || ($hstBook->status == 5 && $hstBook->ranap == 2))
                                            <tr>
                                                <td class="text-primary" style="cursor: pointer;"><a href="/booking/detail/{{ $hstBook->id }}">{{ date_format($hstBook->created_at, "d M Y H:i") }}</a></td>
                                                <td>
                                                    {{ $hstBook->booking->alasan_kunjungan }}
                                                </td>   
                                            </tr>
                                        @else
                                            @continue;
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-4">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 60%;" class="mt-4">
                    <div class="m-2 d-flex">
                        <h5 class="m-3">Statistik</h5>
                        @if ($booking->status == 2 || ($booking->status == 5 && $booking->ranap == 1))
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" onclick="submitStatistic()"><i class="fas fa-save"></i> Simpan</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-save"></i> Simpan</button>
                        @endif
                    </div>
                    <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" style="width: 10%">Data</th>
                                    <th scope="col" style="width: 23%">Nilai</th>
                                  </tr>
                                </thead>
                                @if ($booking->status == 2 || ($booking->status == 5 && $booking->ranap == 1))
                                    <form action="/addStatistic" method="POST">
                                        @csrf
                                        <input type="text" name="sub_booking_id" value="{{ $booking->id }}" hidden>
                                        <input type="text" name="pet_id" value="{{ $booking->subAccount_id }}" hidden>
                                        <tbody>
                                            <tr>
                                                <td>Suhu</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 °C" style="width: 90px;" name="suhu">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 kg" style="width: 90px;" name="berat">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Perilaku</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 90px;" name="perilaku">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>BCS</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 90px;" name="bcs">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gula Darah</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 mmol/L" style="width: 90px;" name="gula_darah">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Darah</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0/0 mmHg" style="width: 90px;" name="tekanan_darah">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CRT</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 90px;" name="crt">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Detak Jantung</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 bpm" style="width: 90px;" name="detak_jantung">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MM</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 90px;" name="mm">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Saturasi Oksigen</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 %" style="width: 90px;" name="saturasi_oksigen">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tingkat Pernapasan</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 bpm" style="width: 90px;" name="tingkat_pernapasan">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <button type="submit" id="submitStatistic" hidden></button>
                                    </form>
                                @else
                                    <form action="" method="">
                                        <tbody>
                                            <tr>
                                                <td>Suhu</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 °C" style="width: 70px;" name="suhu" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 kg" style="width: 70px;" name="berat" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Perilaku</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 70px;" name="perilaku" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>BCS</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 70px;" name="bcs" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gula Darah</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 mmol/L" style="width: 70px;" name="gula_darah" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Darah</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0/0 mmHg" style="width: 70px;" name="tekanan_darah" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CRT</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 70px;" name="crt" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Detak Jantung</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 bpm" style="width: 70px;" name="detak_jantung" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MM</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="..." style="width: 70px;" name="mm" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Saturasi Oksigen</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 %" style="width: 70px;" name="saturasi_oksigen" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tingkat Pernapasan</td>
                                                <td class="text-primary">
                                                    <input type="text" placeholder="0 bpm" style="width: 70px;" name="tingkat_pernapasan" disabled>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 40%;" class="mt-4">
                    <div class="m-2 d-flex">
                        <h5 class="m-3">Riwayat Statistik</h5>
                    </div>
                    <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 9%">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Data Statistik</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1; ?>
                                @foreach ($statistics as $statistic)
                                    <tr>
                                        <th scope="row">{{ $x++ }}</th>
                                        <td>{{ $statistic->created_at->isoFormat('D MMMM Y') }}</td>
                                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#opendatastatistic{{ $statistic->id }}">Buka Data</button></td>
                                        @if ($booking->status == 2 || ($booking->status == 5 && $booking->ranap == 1))
                                            <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusstatistic{{ $statistic->id }}">Hapus Data</button></td>
                                        @else
                                            <td><button type="button" class="btn btn-danger btn-sm" disabled>Hapus Data</button></td>
                                        @endif
                                    </tr>

                                    <div class="modal fade" id="opendatastatistic{{ $statistic->id }}" value={{ $statistic->id }}>
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Statistik ({{ $statistic->created_at->isoFormat('D MMMM Y') }})</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Suhu</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->suhu }} °C</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Berat</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->berat }} kg</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Perilaku</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->perilaku }}</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>BCS</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->bcs }}</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Gula Darah</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->gula_darah }} mmol/L</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Tekanan Darah</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->tekanan_darah }} mmHg</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>CRT</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->crt }}</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Detak Jantung</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->detak_jantung }} bpm</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>MM</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->mm }}</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Saturasi Oksigen</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->saturasi_oksigen }} %</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                          <div class="col">
                                                            <h5>Tingkat Pernapasan</h5>
                                                          </div>
                                                          <div class="col">
                                                            <h5>: {{ $statistic->tingkat_pernapasan }} bpm</h5>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="hapusstatistic{{ $statistic->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Statistic</h1>
                                            </div>
                                            <form action="/hapusstatistic/{{ $statistic->id }}" method="GET">
                                                @csrf
                                                <input type="text" hidden name="status" value="5">
                                                <div class="modal-body">
                                                    <p class="text-dark">Apakah kamu yakin ingin menghapus data statistik?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Hapus</button>
                                                </div>
                                            </form>    
                                          </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-4">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 60%" class="mt-4">
                    <div class="m-2 d-flex">
                        <h5 class="m-3">Catatan</h5>
                        @if ($booking->status == 2 || ($booking->status == 5 && $booking->ranap == 1))
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" onclick="submitTextBooking()"><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#uploadgambar"><i class="fas fa-paperclip"></i> Upload Gambar</button>  
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-paperclip"></i> Upload Gambar</button>  
                        @endif

                        <div class="modal fade" id="uploadgambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Gambar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/attachFile" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" hidden name="booking_id" value="{{ $booking->booking->id }}">
                                        <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="/submitTextBooking" method="POST">
                        @csrf
                        <div class="m-3">
                            <input type="text" hidden name="booking_id" value="{{ $booking->booking->id }}">
                            <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                            @if ($booking->staff)
                                <input id="text" type="hidden" name="text" value="<div><strong>Anamnesa<br></strong><br></div><ul><li><br></li></ul><div><strong>Diagnosis / DD<br></strong><br></div><ul><li><br></li></ul><div><strong>Drh PJ<br></strong><br></div><ul><li>{{ $booking->staff->first_name }}<br></li></ul><div><strong>Terapi&nbsp;<br></strong><br></div><ul><li><br><br></li></ul>">
                            @else
                                <input id="text" type="hidden" name="text" value="<div><strong>Anamnesa<br></strong><br></div><ul><li><br></li></ul><div><strong>Diagnosis / DD<br></strong><br></div><ul><li><br></li></ul><div><strong>Drh PJ<br></strong><br></div><ul><li><br></li></ul><div><strong>Terapi&nbsp;<br></strong><br></div><ul><li><br><br></li></ul>">
                            @endif
                            <trix-editor input="text"></trix-editor>
                        </div>
                        <button type="submit" hidden id="submitTextBooking"></button>
                    </form>

                    <div class="m-3 d-flex flex-column gap-1">
                        <?php $index = 0; ?>
                        @foreach ($files->where('sub_booking_id', $booking->id) as $file)
                            <?php $index += 1; ?>
                            <div class="p-2" style="background-color: rgb(226, 240, 255); border-radius: 7px; width: 100%">
                                <div class="d-flex justify-content-between">
                                    <a class="text-primary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#fileAttach{{ $file->id }}">{{ $index }}. {{ $file->file_name }}</a>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAttach{{ $file->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                </div>
                            </div>

                            <div class="modal fade" id="fileAttach{{ $file->id }}" tabindex="-1" aria-labelledby="fileAttachLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="fileAttachLabel">File</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $foto = substr($file->image, 7); ?>
                                        <img src="/storage/{{ $foto }}" alt="" style="width: 100%">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteAttach{{ $file->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus File</h1>
                                    </div>
                                    
                                    <form action="/deleteAttach/{{ $file->id }}" method="GET">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-1">
                                                <input type="text" hidden id="deleteId" name="deleteId" value="Hapus" class="form-control mt-1">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 40%;" class="mt-4">
                    <div class="m-2 d-flex">
                        <h5 class="m-3">Riwayat Catatan</h5>
                    </div>
                    <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 9%">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $noteIndex = 1; ?>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <th>{{ $noteIndex++ }}</th>
                                            <td>{{ $note->created_at->isoFormat('D MMMM Y') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"><a href="/booking/detail/catatan/{{ $note->id }}">Buka Catatan</a></button>
                                            </td>   
                                            @if ($booking->status == 2 || ($booking->status == 5 && $booking->ranap == 1))
                                                <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapuscatatan{{ $note->id }}">Hapus Catatan</button></td>
                                            @else
                                                <td><button type="button" class="btn btn-danger btn-sm" disabled>Hapus Catatan</button></td>
                                            @endif
                                        </tr>

                                        <div class="modal fade" id="hapuscatatan{{ $note->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Catatan</h1>
                                                </div>
                                                <form action="/deleteTextBooking/{{ $note->id }}" method="GET">
                                                    @csrf
                                                    <input type="text" hidden name="status" value="5">
                                                    <div class="modal-body">
                                                        <p class="text-dark">Apakah kamu yakin ingin menghapus catatan?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Hapus</button>
                                                    </div>
                                                </form>    
                                              </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if ($booking->ranap != null || $booking->ranap != 0)

                <div class="d-flex gap-4">
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 60%;" class="mt-4">
                        <div class="m-2 d-flex flex-column">
                            <h5 class="m-3">Treatment</h5>
                        </div>
                        @if ($bookingTreatment)
                            @if ($bookingTreatment->treatment)
                                <div class="m-3 mb-4" style="overflow: auto; height: 250px;">
                                    @for ($i = 1; $i <= $bookingTreatment->treatment->duration; $i++)
                                        <h6 class="mx-2 mb-0"><strong>Hari Ke-{{ $i }}</strong></h6>
                                        <div class="table-responsive">
                                            <table class="table mb-5">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Item</th>
                                                        <th scope="col">Frekuensi</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col" class="d-flex justify-content-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listPlanBooking->where('day', $i) as $lpb)
                                                        <tr>
                                                            @if ($lpb->listplan->products)
                                                                <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $lpb->listplan->products->product_name }} <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lpb->listplan->notes ? $lpb->listplan->notes : '-' }}">notes</small></td>
                                                            @elseif ($lpb->listplan->service)
                                                                <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $lpb->listplan->service->service_name }} ({{ $lpb->listplan->servicePrice->price_title }}) <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lpb->listplan->notes ? $lpb->listplan->notes : '-' }}">notes</small></td>
                                                            @elseif ($lpb->listplan->task)
                                                                <td><img src="/img/icon/task.png" alt="" style="width: 22px"> {{ $lpb->listplan->task->task_name }} <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lpb->listplan->notes ? $lpb->listplan->notes : '-' }}">notes</small></td>
                                                            @endif
                                                            <td>{{ $lpb->listplan->frequency->frequency_name }}</td>
                                                            <td>{{ $lpb->listplan->quantity }}</td>
                                                            @if (!$lpb->listplan->task)
                                                                @if ($lpb->flag == 1)
                                                                    <td class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Telah Masuk</button></td>
                                                                @else
                                                                    <td class="d-flex justify-content-center"><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKeranjang{{ $lpb->id }}"><i class="fas fa-plus"></i> Tambah ke Keranjang</button></td>
                                                                @endif
                                                            @else
                                                                @if ($lpb->flag == 1)
                                                                    <td class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Telah Dilakukan</button></td>
                                                                @else
                                                                    <td class="d-flex justify-content-center"><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKeranjang{{ $lpb->id }}"><i class="fas fa-plus"></i> Lakukan</button></td>
                                                                @endif
                                                            @endif
                                                        </tr>

                                                        <div class="modal fade" id="tambahKeranjang{{ $lpb->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                    @if (!$lpb->listplan->task)
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ke Keranjang</h1>
                                                                    @else
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Lakukan Task</h1>
                                                                    @endif
                                                                </div>
                                                                @if (!$lpb->listplan->task)
                                                                    <form action="/tambahkeranjang/{{ $lpb->id }}" method="post">
                                                                        @csrf
                                                                        <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                                                                        <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                                                                        <input type="text" name="staff_id" hidden value="{{ $booking->staff_id }}">
                                                                        <div class="modal-body">
                                                                            <p class="text-dark">Apakah anda yakin ingin menambahkan ke keranjang?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                                        </div>
                                                                    </form>    
                                                                @else
                                                                    <form action="/tambahkeranjang/{{ $lpb->id }}" method="post">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <input type="text" name="task" hidden value="task">
                                                                            <p class="text-dark">Apakah anda yakin ingin melakukan task ini?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                @endif
                                                              </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- @foreach ($listPlan->where('plan_id', $bookingTreatment->treatment_id) as $lp)
                                                        @if ($lp->start_day > $i)
                                                            @continue;
                                                        @else
                                                            <tr>
                                                                @if ($lp->products)
                                                                    <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $lp->products->product_name }} <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lp->notes ? $lp->notes : '-' }}">notes</small></td>
                                                                @elseif ($lp->service)
                                                                    <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $lp->service->service_name }} <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lp->notes ? $lp->notes : '-' }}">notes</small></td>
                                                                @elseif ($lp->task)
                                                                    <td><img src="/img/icon/task.png" alt="" style="width: 22px"> {{ $lp->task->task_name }} <small class="text-primary" style="cursor: pointer;" data-toggle="tooltip" title="{{ $lp->notes ? $lp->notes : '-' }}">notes</small></td>
                                                                @endif
                                                                <td>{{ $lp->frequency->frequency_name }}</td>
                                                                <td>{{ $lp->quantity }}</td>

                                                                @if (!$lp->task)
                                                                    <td class="d-flex justify-content-center"><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKeranjang{{ $lp->id }}"><i class="fas fa-plus"></i> Tambah ke Keranjang</button></td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                            </tr>
                                                        @endif

                                                        <div class="modal fade" id="tambahKeranjang{{ $lp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ke Keranjang</h1>
                                                                </div>
                                                                <form action="/tambahkeranjang/{{ $lp->id }}" method="post">
                                                                    @csrf
                                                                    <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                                                                    <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                                                                    <input type="text" name="staff_id" hidden value="{{ $booking->staff_id }}">
                                                                    <div class="modal-body">
                                                                        <p class="text-dark">Apakah anda yakin ingin menambahkan ke keranjang?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                                    </div>
                                                                </form>    
                                                              </div>
                                                            </div>
                                                        </div>

                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                        @endif
                    </div>


                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 40%;" class="mt-4">
                        <div class="m-2 d-flex">
                            <h5 class="m-3">List Diagnosis</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addDiagnosisBooking"><i class="fas fa-plus"></i> Tambah Diagnosis</button>
                        </div>
                        <div class="table-responsive m-3">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Diagnosis</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $bdIndex = 0; ?>
                                    @foreach ($bookingDiagnosis as $bd)
                                        <?php $bdIndex += 1; ?>
                                        <tr>
                                            <th scope="row">{{ $bdIndex }}</th>
                                            <td>{{ $bd->diagnosis->diagnosis_name }}</td>
                                            @if ($bd->treatment == null)
                                                <td>
                                                    <form action="/editBookingDiagnosis/{{ $bd->id }}" method="POST">
                                                        @csrf
                                                        <select class="form-select" aria-label="Default select example" onchange="selectTreatment({{ $bd->id }})" name="treatment_id">
                                                            <option selected disabled>Pilih Treament</option>
                                                            @foreach ($treatments->where('diagnosis_id', $bd->diagnosis_id) as $treatment)
                                                                @if ($treatment->id == $bd->treatment_id)
                                                                    <option value="{{ $treatment->id }}" selected>{{ $treatment->name }}</option>
                                                                    @continue;
                                                                @endif
                                                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" hidden id="editBookingDiagnosis{{ $bd->id }}"></button>
                                                        <script>
                                                            function selectTreatment(id){
                                                                let button = document.getElementById('editBookingDiagnosis' + id).click();
                                                            }
                                                        </script>
                                                    </form>
                                                </td>
                                            @else
                                                <td>{{ $bd->treatment->name }}</td>    
                                            @endif
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100px" data-bs-toggle="modal" data-bs-target="#deleteBookingDiagnosis{{ $bd->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="deleteBookingDiagnosis{{ $bd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Diagonis</h1>
                                                </div>
                                                
                                                <form action="/deleteBookingDiagnosis/{{ $bd->id }}" method="GET">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <small class="fs-6" style="font-weight: 300">Apakah anda yakin ingin menghapus diagnosis ini?</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-4">
                <div class="m-2 d-flex">
                    <h5 class="m-3">Keranjang Pasien</h5>
                    @if ($booking->status == 5 && $booking->ranap == 1)
                        <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Tambah Produk</button>
                        <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Tambah Servis</button>

                        @if (count($checkCart) > 0)
                            <button type="button" class="btn btn-sm btn-outline-success m-2" data-bs-toggle="modal" data-bs-target="#makeInvoice"><i class="fas fa-file-invoice-dollar"></i> Buat Invoice</button>
                        @endif
                    @else
                        @if ($booking->status == 3)
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Tambah Produk</button>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Tambah Servis</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-plus"></i> Tambah Produk</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-plus"></i> Tambah Servis</button>    
                        @endif
                    @endif
                </div>
                @if ($booking->status == 5)
                    <div class="table-responsive m-3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width: 20%">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="text-center">Aksi</th>
                                <th scope="col" style="width: 10%">Tanggal</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $index1 = 0; ?>
                                @foreach ($carts->skip(1) as $cart)
                                    <?php $index1 += 1; ?>
                                    <tr>
                                        <th>{{ $index1 }}</th>
                                        @if ($cart->product_id == null && $cart->service_id != null)
                                            <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $cart->name }} ({{ $cart->servicePrice->price_title }})</td>
                                        @elseif ($cart->product_id != null && $cart->service_id == null)
                                            <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $cart->name }}</td>
                                        @endif
                                        @if ($cart->product_id == null && $cart->service_id != null)
                                            @if ($cart->total_price == null)
                                                <td>Rp 0</td> 
                                            @else
                                                <td>Rp {{ number_format($cart->servicePrice->price) }}</td>
                                            @endif
                                        @elseif ($cart->product_id != null && $cart->service_id == null)
                                            @if ($cart->product)
                                                <td>Rp {{ number_format($cart->product->price) }}</td>
                                            @else
                                                <?php $priceCart = $cart->total_price / $cart->quantity ?>
                                                <td>Rp {{ number_format($priceCart) }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rp {{ number_format($cart->total_price) }}</td>
                                        <td>
                                            @if ($cart->flag == 1)
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $cart->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                    <form action="/saveCartBooking/{{ $cart->id }}" method="post" style="width: 100%">
                                                        @csrf
                                                        <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                                                        <input type="text" hidden name="booking_id" value="{{ $booking->booking_id }}">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Simpan</button>
                                                    </form>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $cart->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 100px" disabled><i class="fas fa-check"></i> Selected</button>
                                                </div>
                                            @endif
                                        </td>
                                        @if ($cart->invoice)
                                            <td>{{ date_format($cart->invoice->created_at, 'd M Y H:i') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
                                            @if ($cart->invoice_id == null)
                                                <div class="d-flex justify-content-center gap-2">
                                                    Belum Masuk Invoice
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center gap-2">
                                                    Masuk Invoice
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                            </div>
                                            
                                            <form action="/deleteCartBooking/{{ $cart->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Apakah kamu yakin ingin menghapus produk ini?</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>

                                    @if ($cart->product_id != null)
                                        <div class="modal fade" id="updateCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Qty Produk</h1>
                                                </div>
                                                <form action="/updateCartBooking/{{ $cart->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stok Produk</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->product->stock }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Qty</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="modal fade" id="updateCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Service</h1>
                                                </div>
                                                <form action="/updateCartBooking/{{ $cart->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Price</label>
                                                            <select class="form-select" aria-label="Default select example" name="service_price_id">
                                                                <option selected disabled>Select Price</option>
                                                                @foreach ($servicePrice->where('service_id', $cart->service_id) as $sp)
                                                                    @if ($sp->id == $cart->service_price_id)
                                                                        <option value="{{ $sp->id }}" selected>{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                        @continue; 
                                                                    @endif
                                                                    <option value="{{ $sp->id }}">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="table-responsive m-3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width: 20%">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $index1 = 0; ?>
                                @foreach ($carts->skip(1) as $cart)
                                    <?php $index1 += 1; ?>
                                    <tr>
                                        <th>{{ $index1 }}</th>
                                        @if ($cart->product_id == null && $cart->service_id != null)
                                            <td><img src="/img/icon/service.png" alt="" style="width: 22px"> {{ $cart->name }}</td>
                                        @elseif ($cart->product_id != null && $cart->service_id == null)
                                            <td><img src="/img/icon/product.png" alt="" style="width: 22px"> {{ $cart->name }}</td>
                                        @endif
                                        @if ($cart->product_id == null && $cart->service_id != null)
                                            @if ($cart->total_price == null)
                                                <td>Rp 0</td> 
                                            @else
                                                <td>Rp {{ number_format($cart->servicePrice->price) }}</td>
                                            @endif
                                        @elseif ($cart->product_id != null && $cart->service_id == null)
                                            @if ($cart->product)
                                                <td>Rp {{ number_format($cart->product->price) }}</td>
                                            @else
                                                <?php $priceCart = $cart->total_price / $cart->quantity ?>
                                                <td>Rp {{ number_format($priceCart) }}</td>
                                            @endif
                                        @endif
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rp {{ number_format($cart->total_price) }}</td>
                                        <td>
                                            @if ($cart->flag == 1)
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $cart->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $cart->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                    <form action="/saveCartBooking/{{ $cart->id }}" method="post" style="width: 100%">
                                                        @csrf
                                                        <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                                                        <input type="text" hidden name="booking_id" value="{{ $booking->booking_id }}">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Simpan</button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-success btn-sm" style="width: 100px" disabled><i class="fas fa-check"></i> Selected</button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                            </div>
                                            
                                            <form action="/deleteCartBooking/{{ $cart->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Apakah kamu yakin ingin menghapus produk ini?</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>

                                    @if ($cart->product_id != null)
                                        <div class="modal fade" id="updateCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Qty Produk</h1>
                                                </div>
                                                <form action="/updateCartBooking/{{ $cart->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stok Produk</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->product->stock }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Qty</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="modal fade" id="updateCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Service</h1>
                                                </div>
                                                <form action="/updateCartBooking/{{ $cart->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Price</label>
                                                            <select class="form-select" aria-label="Default select example" name="service_price_id">
                                                                <option selected disabled>Select Price</option>
                                                                @foreach ($servicePrice->where('service_id', $cart->service_id) as $sp)
                                                                    @if ($sp->id == $cart->service_price_id)
                                                                        <option value="{{ $sp->id }}" selected>{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                        @continue; 
                                                                    @endif
                                                                    <option value="{{ $sp->id }}">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-4">
                <div class="m-2 d-flex flex-column">
                    <h5 class="m-3">Invoice</h5>
                    <div class="table-responsive mx-3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 5%">No</th>
                                <th scope="col">No Invoice</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($listInvoice as $invoice)
                                    <tr>
                                        <?php $i += 1; ?>
                                        <th scope="row">{{ $i }}</th>
                                        <td class="text-primary" style="cursor: pointer"><a href="/sale/list/detail/{{ $invoice->no_invoice }}">{{ $invoice->no_invoice }}</a></td>
                                        <td>{{ $invoice->created_at->isoFormat('D MMMM YYYY') }}</td>
                                        <td>Rp {{ number_format($invoice->total_price) }}</td>
                                        @if ($invoice->status == 0)
                                            <td>Terbayar ({{ $invoice->updated_at->isoFormat('D MMMM YYYY') }} {{ date_format($invoice->updated_at, 'H:i') }})</td>
                                        @else
                                            <td>Belum Terbayar</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
  </div>

<div class="modal fade" id="addCartProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
        </div>
        <form action="/addCartProduct" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                    <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                    <input type="text" name="staff_id" hidden value="{{ $booking->staff_id }}">
                    <input type="text" class="form-control" id="product_id_cart" name="product_id" placeholder="Cari Produk ...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="addCartService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Servis</h1>
        </div>
        <form action="/addCartService" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                    <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                    @if ($booking->booking->staff)
                        <input type="text" name="staff_id" hidden value="{{ $booking->staff->id }}">
                    @endif
                    <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Cari Servis ..." required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="makeInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Invoice</h1>
        </div>
        <form action="/makeInvoice/{{ $booking->id }}" method="post">
            @csrf
            <div class="modal-body">
                <input type="text" hidden name="status" value="6">
                <p class="text-dark">Apakah anda yakin ingin membuat Invoice?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="addDiagnosisBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Diagnosis</h1>
          </div>
          <form action="/addBookingDiagnosis" method="post">
              @csrf
              <div class="modal-body">
                  <div class="mb-3">
                      <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                      <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                      <input type="text" style="width: 100%" class="form-control" id="booking_diagnosis_id" placeholder="Cari Diagnosa..." name="diagnosis_name">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                  <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
              </div>
          </form>    
        </div>
      </div>
</div>

<div class="modal fade" id="infoHewan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div class="modal fade" id="batalkanBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Batalkan Booking</h1>
        </div>
        <form action="/batalkanbooking/{{ $booking->id }}" method="post">
            @csrf
            <div class="modal-body">
                <p class="text-dark">Apakah kamu yakin ingin membatalkan booking?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="rawatInap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Rawat Inap</h1>
        </div>
        <form action="/changeStatus/{{ $booking->id }}" method="post">
            @csrf
            <input type="text" hidden name="status" value="5">
            <div class="modal-body">
                <p class="text-dark">Apakah kamu yakin ingin mengubah menjadi rawat inap?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="pasienpulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pulangkan Pasien</h1>
        </div>
        <form action="/changeStatus/{{ $booking->id }}" method="post">
            @csrf
            <input hidden type="text" name="pulangpasien" value="1">
            <div class="modal-body">
                <div class="mb-3">
                    <p class="text-dark">Apakah kamu yakin ingin pulangkan pasien?</p>
                </div>
                <div class="mb-3">
                    <label for="alasan_pulang" class="form-label">Alasan Pulang</label>
                    <input type="text" class="form-control" id="alasan_pulang" name="alasan_pulang" placeholder="ketik disini">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

<div class="modal fade" id="selesaiBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Booking Selesai</h1>
        </div>
        <form action="/changeStatus/{{ $booking->id }}" method="POST">
            @csrf
            <input type="number" hidden name="status" value="4">
            <div class="modal-body">
                <p class="text-dark">Apakah kamu yakin ingin menyelesaikan booking?</p>
                <label for="pesan_resepsionis">Pesan Untuk Resepsionis</label>
                <input type="text" name="pesan_resepsionis" id="pesan_resepsionis" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>    
      </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection
