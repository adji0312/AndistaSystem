@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    @if ($booking->rawat_inap != 1)
                        <form action="/changeStatus/{{ $booking->id }}" method="POST">
                            @csrf
                            @if ($booking->status == "Terkonfirmasi")
                                <input type="text" hidden name="status" value="Dimulai">
                                <button type="submit" class="btn btn-outline-primary btn-sm" style="height: 100%;">Mulai</button>
                            @elseif ($booking->status == "Dimulai")
                                <button type="submit" class="btn btn-outline-success btn-sm" style="height: 100%;">Selesai</button>
                                <input type="text" hidden name="status" value="Selesai">
                            @elseif ($booking->status == "Selesai")

                            @endif
                        </form>
                    @endif
                    @if ($booking->status == "Dimulai")
                        @if ($booking->rawat_inap != 1)
                            <button type="button" class="btn btn-warning btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#rawatinap"><i class="fas fa-hospital"></i> Rawat Inap</button>
                        @elseif(($booking->duration != null || $booking->duration != 0) && $booking->rawat_inap == 1 && $booking->status != "di rawat inap")
                            <form action="/changeStatus/{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="text" hidden name="status" value="di rawat inap">
                                <button type="submit" class="btn btn-warning btn-sm mx-2" style="height: 100%;"><i class="fas fa-hospital"></i> Mulai Rawat Inap</button>
                            </form>
                        @endif
                    @elseif($booking->status == "di rawat inap")    
                        <form action="/changeStatus/{{ $booking->id }}" method="POST">
                            @csrf
                            <input type="text" hidden name="status" value="Selesai">
                            <button type="submit" class="btn btn-warning btn-sm mx-2" style="height: 100%;"><i class="fas fa-hospital"></i> Pulangkan Pasien</button>
                        </form>
                    @endif
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                @if ($booking->rawat_inap == 1)
                    <div class="d-flex justify-content-between">
                        <h5 class="m-3">Information</h5>
                        <h5 class="m-3"><i class="fas fa-hospital"></i> Rawat Inap</h5>
                    </div>
                @else
                    <h5 class="m-3">Information</h5>
                @endif
                <div class="d-flex gap-3">
                    <div class="m-3 d-flex flex-column gap-1">
                        <h6 style="color: black; font-weight: 400;">Location : {{ $booking->booking->location->location_name }}</h6>
                        <?php $date = date_create($booking->booking->booking_date) ?>
                        <h6 style="color: black; font-weight: 400">Date : {{ date_format($date, 'd F Y') }}</h6>
                        
                    </div>
                    <div class="m-3">
                        <h6 style="color: black; font-weight: 400">Total : Rp {{ number_format($booking->booking->total_price) }}</h6>
                        @if ($booking->status == "Terkonfirmasi")
                            <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97cbfe">{{ $booking->status }}</button></h6>
                        @elseif ($booking->status == "Dimulai")
                            <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #fee497">{{ $booking->status }}</button></h6>
                        @elseif ($booking->status == "Selesai")
                            <h6 style="color: black; font-weight: 400">Status : <button type="button" class="btn btn-sm" style="background-color: #97fe99">{{ $booking->status }}</button></h6>
                        @endif
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
                                    <td scope="col">Time</td>
                                    <td scope="col">Staff</td>
                                    <td scope="col" style="width: 20%">Duration</td>
                                    <td scope="col" style="width: 20%">Price (Rp)</td>
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
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                <div class="m-2 d-flex">
                    <h5 class="m-3">Statistik</h5>
                    @if ($booking->status == "Dimulai")
                        <button type="button" class="btn btn-sm btn-outline-primary m-2" onclick="submitStatistic()"><i class="fas fa-save"></i> Save Changes</button>
                    @else
                        <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-save"></i> Save Changes</button>
                    @endif
                </div>
                <div class="mx-3 mb-3 mt-4 d-flex flex-column gap-1">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 20%">Data</th>
                                <th scope="col" style="width: 23%">New</th>
                                <th scope="col" style="width: 23%">Latest</th>
                                <th scope="col" style="width: 17%">Before</th>
                                <th scope="col">Updated At</th>
                              </tr>
                            </thead>
                            @if ($booking->status == "Dimulai")
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
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->suhu }} °C</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->suhu }} °C</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else 
                                                <td>-</td>    
                                                <td>-</td>    
                                                <td>-</td>    
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Berat</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 kg" style="width: 90px;" name="berat">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->berat }} kg</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->berat }} kg</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Perilaku</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 90px;" name="perilaku">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->perilaku }}</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->perilaku }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>BCS</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 90px;" name="bcs">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->bcs }}</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->bcs }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Gula Darah</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 mmol/L" style="width: 90px;" name="gula_darah">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->gula_darah }} mmol/L</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->gula_darah }} mmol/L</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Tekanan Darah</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0/0 mmHg" style="width: 90px;" name="tekanan_darah">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->tekanan_darah }} mmHg</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->tekanan_darah }} mmHg</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>CRT</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 90px;" name="crt">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->crt }}</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->crt }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Detak Jantung</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 bpm" style="width: 90px;" name="detak_jantung">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->detak_jantung }} bpm</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->detak_jantung }} bpm</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>MM</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 90px;" name="mm">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->mm }}</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->mm }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Saturasi Oksigen</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 %" style="width: 90px;" name="saturasi_oksigen">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->saturasi_oksigen }}%</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->saturasi_oksigen }}%</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Tingkat Pernapasan</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 bpm" style="width: 90px;" name="tingkat_pernapasan">
                                            </td>
                                            @if (count($beforeStatistic) != 0)
                                                <td>{{ $latestStatistic[0]->tingkat_pernapasan }} bpm</td>
                                                @if (count($beforeStatistic) > 1)
                                                    <td>{{ $beforeStatistic[1]->tingkat_pernapasan }} bpm</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{ date_format($latestStatistic[0]->updated_at, 'd M Y h:i') }}</td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            @endif
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
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Berat</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 kg" style="width: 70px;" name="berat" disabled>
                                            </td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Perilaku</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 70px;" name="perilaku" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>BCS</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 70px;" name="bcs" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Gula Darah</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 mmol/L" style="width: 70px;" name="gula_darah" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Tekanan Darah</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0/0 mmHg" style="width: 70px;" name="tekanan_darah" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>CRT</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 70px;" name="crt" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Detak Jantung</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 bpm" style="width: 70px;" name="detak_jantung" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>MM</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="..." style="width: 70px;" name="mm" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Saturasi Oksigen</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 %" style="width: 70px;" name="saturasi_oksigen" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>Tingkat Pernapasan</td>
                                            <td class="text-primary">
                                                <input type="text" placeholder="0 bpm" style="width: 70px;" name="tingkat_pernapasan" disabled>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </form>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-4">
                <div class="m-2 d-flex">
                    <h5 class="m-3">Catatan</h5>
                    @if ($booking->status == "Dimulai")
                        @if (count($note) == 0)
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" onclick="submitTextBooking()"><i class="fas fa-save"></i> Save</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" onclick="editTextBooking()"><i class="fas fa-save"></i> Update</button>
                        @endif
                    @else
                        @if (count($note) == 0)
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-save"></i> Save</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-save"></i> Update</button>
                        @endif
                    @endif
                </div>
                @if (count($note) == 0)
                    <form action="/submitTextBooking" method="POST">
                        @csrf
                        <div class="m-3">
                            <input type="text" hidden name="booking_id" value="{{ $booking->booking->id }}">
                            <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                            <input id="text" type="hidden" name="text" value="<div><strong>Anamnesa<br></strong><br></div><ul><li><br></li></ul><div><strong>Diagnosis / DD<br></strong><br></div><ul><li><br></li></ul><div><strong>Drh PJ<br></strong><br></div><ul><li><br></li></ul><div><strong>Terapi&nbsp;<br></strong><br></div><ul><li><br><br></li></ul>">
                            <trix-editor input="text"></trix-editor>
                        </div>
                        <button type="submit" hidden id="submitTextBooking"></button>
                    </form>
                @else
                    <form action="/editTextBooking/{{ $note->first()->id }}" method="POST">
                        @csrf
                        <div class="m-3">
                            <input type="text" hidden name="booking_id" value="{{ $booking->booking->id }}">
                            <input type="text" hidden name="sub_booking_id" value="{{ $booking->id }}">
                            <input id="text" type="hidden" name="text" value="{{ $note->first()->text }}">
                            <trix-editor input="text"></trix-editor>
                        </div>
                        <button type="submit" hidden id="editTextBooking"></button>
                    </form>
                @endif
            </div>
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-4">
                <div class="m-2 d-flex">
                    <h5 class="m-3">Keranjang Pasien</h5>
                    @if ($booking->status == "Dimulai")
                        <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Add Product</button>
                        <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Add Service</button>
                    @else
                        <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-plus"></i> Add Product</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary m-2" disabled><i class="fas fa-plus"></i> Add Service</button>    
                    @endif
                    <button type="button" class="btn btn-sm btn-outline-dark m-2"><i class="fas fa-coins"></i> Total : Rp {{ number_format($totalPrice) }}</button>
                </div>
                <div class="table-responsive m-3">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col" style="width: 20%">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index1 = 0; ?>
                            @foreach ($carts as $cart)
                                <?php $index1 += 1; ?>
                                <tr>
                                    <th>{{ $index1 }}</th>
                                    @if ($cart->product_id == null && $cart->service_id != null)
                                        <td>{{ $cart->service->service_name }}</td>
                                    @elseif ($cart->product_id != null && $cart->service_id == null)
                                        <td>{{ $cart->product->product_name }}</td>
                                    @endif
                                    @if ($cart->product_id == null && $cart->service_id != null)
                                        <td>Rp </td>
                                    @elseif ($cart->product_id != null && $cart->service_id == null)
                                        <td>Rp {{ number_format($cart->product->price) }}</td>
                                    @endif
                                    <td>{{ $cart->quantity }}</td>
                                    <td>Rp {{ number_format($cart->total_price) }}</td>
                                    <td>
                                        @if ($cart->flag == 1)
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $cart->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $cart->id }}"><i class="fas fa-trash"></i> Delete</button>
                                                <form action="/saveCartBooking/{{ $cart->id }}" method="post" style="width: 100%">
                                                    @csrf
                                                    <input type="text" hidden name="booking_id" value="{{ $booking->booking_id }}">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Save Cart</button>
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
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
                                        </div>
                                        
                                        <form action="/deleteCartBooking/{{ $cart->id }}" method="GET">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-1">
                                                    <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Delete</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="updateCartBooking{{ $cart->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Quantity Product</h1>
                                        </div>
                                        <form action="/updateCartBooking/{{ $cart->id }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stock Product</label>
                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->product->stock }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

<div class="modal fade" id="addCartProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
        </div>
        <form action="/addCartProduct" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" name="booking_id" hidden value="{{ $booking->booking->id }}">
                    <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                    <input type="text" class="form-control" id="product_id_cart" name="product_id" placeholder="Search here ...">
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

<div class="modal fade" id="addCartService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service</h1>
        </div>
        <form action="/addCartService" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Search Service" required>
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

<div class="modal fade" id="rawatinap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Rawat Inap</h1>
        </div>
        <form action="/changeStatus/{{ $booking->id }}" method="post">
            @csrf
            <input type="text" hidden name="status" value="Rawat Inap">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="booking_date" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration (days)</label>
                    <input type="number" class="form-control" id="duration" name="duration" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-sm btn-outline-primary" id="saveCategory"><i class="fas fa-save"></i> Save changes</button>
            </div>
        </form>    
    </div>
    </div>
</div>
@endsection
