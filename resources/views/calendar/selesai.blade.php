@extends('main')
<meta http-equiv="refresh" content="10">
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/booking/darurat">Booking {{ $title }}</a>
                </div>
                {{-- <form action="" class="d-flex gap-3">
                    <select class="form-select form-select" aria-label="Small select example" style="background-color: transparent; border-bottom: none; width: 200px" id="filterstatus" name="filterstatus">
                        @if (request('filterstatus'))
                            @if (request('filterstatus') == "Booking Biasa")
                                <option value="Booking Biasa" selected>Booking Biasa</option>
                                <option value="Rawat Inap">Dirawat Inap</option>
                            @elseif (request('filterstatus') == "Rawat Inap")
                                <option value="Booking Biasa">Booking Biasa</option>
                                <option value="Rawat Inap" selected>Rawat Inap</option>
                            @endif
                        @else
                            <option selected>Filter Status</option>
                            <option value="Booking Biasa">Booking Biasa</option>
                            <option value="Rawat Inap">Rawat Inap</option>
                        @endif
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%"><i class="fas fa-filter"></i> Filter</button>
                </form>
                @if (request('filterstatus'))
                    <form action="/booking/rawatinap">
                        <button type="submit" class="btn btn-outline-secondary btn-sm mx-2" style="width: 100%; height: 100%">Reset</button>
                    </form>
                @endif     --}}
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #7C7C7C">Waktu Mulai</th>
                        <th scope="col" style="color: #7C7C7C">Waktu Selesai</th>
                        <th scope="col" style="color: #7C7C7C; width: 25%">Pelanggan</th>
                        <th scope="col" style="color: #7C7C7C; width: 20%">Servis</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Lokasi</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $subbook)
                        <tr>
                            @if ($subbook->ranap)
                                <td class="align-middle">
                                    <a href="/booking/detail/{{ $subbook->id }}" class="d-flex flex-column text-primary">
                                        <?php $date = \Carbon\Carbon::parse($subbook->rawat_inap);
                                            $time = date_create($subbook->rawat_inap);
                                        ?>
                                        {{ $date->isoFormat('D MMMM Y') }} <br>
                                        {{ date_format($time, 'H:i') }}
                                    </a>
                                </td>
                            @else
                                <td class="align-middle">
                                    <a href="/booking/detail/{{ $subbook->id }}" class="d-flex flex-column text-primary">
                                        <?php $date = $subbook->created_at->isoFormat('D MMMM Y'); ?>
                                        {{ $date }} <br>
                                        {{ date_format($subbook->created_at, 'H:i') }}
                                    </a>
                                </td>
                            @endif
                            <td class="align-middle">
                                <a href="/booking/detail/{{ $subbook->id }}" class="d-flex flex-column text-primary">
                                    <?php $date = $subbook->updated_at->isoFormat('D MMMM Y'); ?>
                                    {{ $date }} <br>
                                    {{ date_format($subbook->updated_at, 'H:i') }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex flex-column align-middle">
                                    {{ $subbook->booking->customer->first_name }} <br>
                                    <div>
                                        <img src="/img/icon/paws.png" alt="" style="width: 18px"> {{ $subbook->pet->pet_name }} ({{ $subbook->pet->pet_type }}) <br>
                                    </div>
                                    <div>
                                        <img src="/img/icon/information.png" alt="" style="width: 17px"> {{ $subbook->booking->alasan_kunjungan }}
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                @foreach ($subbook->carts as $sc)
                                    {{ $sc->service->service_name }}
                                    @break;
                                @endforeach
                            </td>
                            @if ($subbook->staff_id == null || $subbook->staff_id == 0 || $subbook->staff_id == '')
                                <td class="align-middle">-</td>
                            @else
                                @if ($subbook->staff)
                                    <td class="align-middle">{{ $subbook->staff->first_name }}</td>
                                @else
                                    <td class="align-middle">-</td>
                                @endif
                            @endif
                            <td class="align-middle">{{ $subbook->booking->location->location_name }}</td>
                            @if ($subbook->status == 1)
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm" style="background-color: #97cbfe;">Terkonfirmasi</button>
                                </td>
                            @elseif ($subbook->status == 2)
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm" style="background-color: #fee497;">Dimulai</button>
                                </td>
                            @elseif ($subbook->status == 3)
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm text-white" style="background-color: #7e57c1;">Apotek</button>
                                </td>
                            @elseif ($subbook->status == 4)
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm" style="background-color: #cef9bf;">Selesai</button>
                                </td>
                            @elseif ($subbook->status == 5)
                                <td class="align-middle">
                                    <button type="button" class="btn btn-sm" style="background-color: #cef9bf;">Rawat Inap (Selesai)</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mx-3">
            {{ $bookings->links() }}
        </div>
    </div>
  </div>
@endsection

