@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="d-flex gap-3 w-100">
                <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $booking->booking_name }}</a>
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="d-flex gap-4">
                        <a href="/calendar" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                        <a class="nav-link active" aria-current="page" onclick="saveBooking()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Simpan</a>
                        <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#discardBooking" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/discard.png" alt="" style="width: 22px"> Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        @include('calendar.sidenavcalendar')

        <div id="dashboard" class="mx-3 mt-3">
            <form action="/editBooking/{{ $booking->id }}" method="POST">
                @csrf
                <input type="text" hidden name="booking_id" value="{{ $booking->id }}">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Informasi</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Pelanggan</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" value="{{ $booking->customer->first_name }}" required readonly>
                        </div>
                        <div class="mb-3">
                          <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id" required>
                            @foreach ($locations as $location)
                                @if ($location->id == $booking->location_id)
                                    <option selected value="{{ $location->id }}" class="selectstatus" name="location_id" style="color: black;">{{ $location->location_name }}</option>
                                    @continue;
                                @endif
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                            <label for="booking_date" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tanggal</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" required readonly>
                            <button type="submit" hidden id="updateBookingDate{{ $booking->id }}"></button>
                        </div>
                    </div>
                    <div class="m-3">
                        <div class="mb-3">
                            <label for="alasan_kunjungan" class="form-label" style="font-size: 15px; color: #7C7C7C;">Alasan Kunjungan</label>
                            <input type="text" class="form-control" id="alasan_kunjungan" name="alasan_kunjungan" value="{{ $booking->alasan_kunjungan }}" required readonly>
                        </div>
                    </div>
                    <div class="mx-3 d-flex gap-3 mb-3 mt-3">
                        <div class="form-check">
                            @if ($booking->category == 1)
                                <input class="form-check-input" type="radio" name="category" id="langsung_datang" value="1" checked>
                                <label class="form-check-label" for="langsung_datang">
                                    Langsung datang
                                </label>
                            @else
                                <input class="form-check-input" type="radio" name="category" id="langsung_datang" value="1" disabled>
                                <label class="form-check-label" for="langsung_datang">
                                    Langsung datang
                                </label>
                            @endif
                        </div>
                        <div class="form-check">
                            @if ($booking->category == 2)
                                <input class="form-check-input" type="radio" name="category" id="darurat" value="2" checked>
                                <label class="form-check-label" for="darurat">
                                    Darurat
                                </label>
                            @else
                                <input class="form-check-input" type="radio" name="" id="darurat" value="2" disabled>
                                <label class="form-check-label" for="darurat">
                                    Darurat
                                </label>
                            @endif
                        </div>
                        <div class="form-check">
                            @if ($booking->category == 3)
                                <input class="form-check-input" type="radio" name="category" id="jadwalkan" value="3" checked>
                                <label class="form-check-label" for="jadwalkan">
                                    Jadwalkan
                                </label>
                            @else
                                <input class="form-check-input" type="radio" name="" id="jadwalkan" value="3" disabled>
                                <label class="form-check-label" for="jadwalkan">
                                    Jadwalkan
                                </label>
                            @endif
                        </div>
                        
                    </div>
                </div>

                <input type="text" name="subAccount" id="subAccount" value="" hidden>
                <button type="submit" id="submitBooking" hidden></button>
            </form>   
                
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex gap-1 m-2">
                        <h5 class="m-3">Sub Akun</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addSubAccount"><i class="fas fa-plus"></i> Tambah Sub Akun Baru</button>
                    </div>
                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Sub Akun</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Ras</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col" class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets->where('customer_id',$booking->customer_id) as $pet)
                                    <tr>
                                        <th>
                                            @if (count($sub_books) == 0)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $pet->id }}]" name="checkBoxPet" value="{{ $pet->id }}">
                                                </div>
                                            @else
                                                @foreach ($sub_books as $sub_book)
                                                    @if ($sub_book->subAccount_id == $pet->id)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkBox[{{ $pet->id }}]" name="checkBoxPet" value="{{ $pet->id }}" checked disabled>
                                                        </div>
                                                        @continue;
                                                    @else  
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkBox[{{ $pet->id }}]" name="checkBoxPet" value="{{ $pet->id }}" disabled>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </th>
                                        <td>{{ $pet->pet_name }}</td>
                                        <td>{{ $pet->pet_type }}</td>
                                        <td>{{ $pet->pet_ras }}</td>
                                        <td>{{ $pet->pet_color }}</td>
                                        @if ($pet->date_of_birth != null)
                                            <?php $date = date_create($pet->date_of_birth) ?>
                                            <td>{{ date_format($date, 'd F Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
                                            @if ($pet->pet_gender == "Male")
                                                Jantan
                                            @else
                                                Betina
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateSubAccount{{ $pet->id }}"><i class="fas fa-pencil-alt"></i> Ubah</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteSubAccount{{ $pet->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Sub Akun</h1>
                                            </div>
                                            
                                            <form action="/deleteSubAccount/{{ $pet->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Kamu yakin ingin menghapus sub akun ini?</small>
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

                                    <div class="modal fade" id="updateSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Sub Akun</h1>
                                            </div>
                                            <form action="/updateSubAccount/{{ $pet->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" value="{{ $booking->customer->id }}" name="customer_id">
                                                        <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Nama</label>
                                                        <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $pet->pet_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tipe</label>
                                                        <input type="text" class="form-control" id="pet_type" name="pet_type" value="{{ $pet->pet_type }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C;">Ras</label>
                                                        <input type="text" class="form-control" id="pet_ras" name="pet_ras" value="{{ $pet->pet_ras }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C;">Warna</label>
                                                        <input type="text" class="form-control" id="pet_color" name="pet_color" value="{{ $pet->pet_color }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_of_birth" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $pet->date_of_birth }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jenis Kelamin</label>
                                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                                                            @if ($pet->pet_gender == "Male")
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;" selected>Jantan</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Betina</option>
                                                            @else
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Jantan</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;" selected>Betina</option>
                                                            @endif
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Services --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex gap-1 m-2">
                        <h5 class="m-3">Services</h5>
                        @if (count($booking_services) <= 0)
                            <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addBookingService"><i class="fas fa-plus"></i> Tambah</button>
                        @endif
                        {{-- <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#checkModal"><i class="fas fa-check"></i> Cek Karyawan</button> --}}
                    </div>
                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Service</th>
                                <th scope="col" style="width: 10%">Waktu</th>
                                {{-- <th scope="col">Karyawan</th> --}}
                                <th scope="col">Durasi</th>
                                <th scope="col">Harga (Rp)</th>
                                <th scope="col" class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $index = 0?>
                                @foreach ($booking_services as $bs)
                                    <?php $index += 1; ?>
                                    {{-- <form action="/checkBookingService" method="POST">
                                        @csrf --}}
                                        <tr>
                                            <td>{{ $index }}</td>
                                            <td>{{ $bs->service->service_name }}</td>
                                            <td>
                                                <form action="/editBookingService/{{ $bs->id }}" method="POST">
                                                    @csrf
                                                    <input type="text" value="{{ $bs->service_price_id }}" name="service_price_id" hidden>
                                                    <input type="text" value="{{ $bs->service_staff_id }}" name="service_staff_id" hidden>
                                                    <input type="text" value="{{ $bs->price }}" name="price" hidden>
                                                    <input type="text" value="{{ $booking->booking_date }}" name="checkDate" hidden>
                                                    <input type="text" class="form-control" value="{{ $bs->time }}" name="time" id="time{{ $bs->id }}" oninput="editTime({{ $bs->id }})">
                                                    <script>
                                                        function editTime(id){
                                                            let time = document.getElementById('time' + id);
                                                            console.log(time.value);

                                                            let button = document.getElementById('submitTime' + id);
                                                            button.click();
                                                        }
                                                    </script>

                                                    <button type="submit" id="submitTime{{ $bs->id }}" hidden></button>
                                                </form>
                                            </td>

                                            {{-- <td>
                                                <form action="/editBookingService/{{ $bs->id }}" method="POST">
                                                    @csrf
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="service_staff_id" id="service_staff_id{{ $bs->id }}" onchange="selectStaff({{ $bs->id }})">
                                                        <option value="" disabled selected>Pilih Karyawan</option>
                                                        @foreach ($service_staff->where('service_id', $bs->service_id) as $ss)
                                                            @if ($ss->staff_id == $bs->service_staff_id)
                                                                <option selected value="{{ $ss->staff_id }}" class="selectstatus" style="color: black;">{{ $ss->staff->first_name }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $ss->staff_id }}" class="selectstatus" style="color: black;">{{ $ss->staff->first_name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <button type="submit" hidden id="editBookingService2{{ $bs->id }}"></button>
                                                    <script>
                                                        function selectStaff(id){
                                                            let button = document.getElementById('editBookingService2' + id).click();
                                                        }
                                                    </script>
                                                </form>
                                            </td> --}}
                                            <td>
                                                <form action="/editBookingService/{{ $bs->id }}" method="POST">
                                                    @csrf
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="service_price_id" id="service_price_id{{ $bs->id }}" onchange="selectPrice({{ $bs->id }})">
                                                        
                                                        <option value="" disabled selected>Pilih Durasi</option>
                                                        
                                                        @foreach ($service_prices->where('service_id', $bs->service_id) as $sp)
                                                            @if ($sp->id == $bs->service_price_id)
                                                                <option selected value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->duration }} {{$sp->duration_type}}({{ $sp->price_title }}) (Rp {{ number_format($sp->price) }})</option>
                                                            <option value="{{ $sp->price }}" id="selectedPrice{{ $sp->id }}" hidden></option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" hidden id="editBookingService{{ $bs->id }}"></button>
                                                    <script>
                                                        function selectPrice(id){
                                                            console.log(id);
                                                            var e = document.getElementById("service_price_id" + id);
                                                            var value = e.value;
                                                            
                                                            var f = document.getElementById("selectedPrice" + value);
    
                                                            var price = document.getElementById("price" + id);
                                                            price.value = f.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
                                                            let button = document.getElementById('editBookingService' + id).click();
                                                            // console.log(button);
                                                        }
                                                    </script>
                                                </form>
                                            </td>
                                            <td>
                                                @if ($bs->price == 0)
                                                    <input disabled class="form-control" type="text" style="border-bottom: none;" id="price{{ $bs->id }}" name="price" value="0">
                                                @else
                                                    <input disabled class="form-control" type="text" style="border-bottom: none;" id="price{{ $bs->id }}" name="price" value="{{ number_format($bs->price) }}">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form action="/checkBookingService/{{ $bs->id }}" method="POST">
                                                        @csrf
                                                        <input type="text" name="checkTime" value="{{ $bs->time }}" hidden>
                                                        <input type="text" name="checkStaff" value="{{ $bs->service_staff_id }}" hidden>
                                                        <input type="text" name="checkDuration" value="{{ $bs->service_price_id }}" hidden>
                                                        <input type="date" name="checkDate" value="{{ $booking->booking_date }}" hidden>
                                                    </form>    
                                                    <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteBookingService{{ $bs->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        {{-- <button type="submit" id="checkService1"></button> --}}
                                    {{-- </form> --}}

                                    <div class="modal fade" id="deleteBookingService{{ $bs->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Service</h1>
                                            </div>
                                            
                                            <form action="/deleteBookingService/{{ $bs->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Apakah kamu yakin ingin menghapus service ini?</small>
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
                
                {{-- <button type="submit" id="submitBooking" hidden></button>
            </form> --}}
        </div>
    </div>
  </div>

    <div class="modal fade" id="addBookingService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Service</h1>
                </div>
                <form action="/addBookingService" method="post">
                    @csrf
                    <input type="text" hidden name="booking_id" value="{{ $booking->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="duration_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Services</label>
                            <input type="text" class="form-control" id="searchService" name="service_name" value="" placeholder="Cari Service" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label" style="font-size: 15px; color: #7C7C7C;">Waktu</label>
                            <?php 
                                $timeNow = date('H:i');
                            ?>
                            <input type="text" class="form-control" name="time" value="{{ $timeNow }}">
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

    <div class="modal fade" id="addSubAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Sub Akun Baru</h1>
            </div>
            <form action="/addSubAccount" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="customer_id" value="{{ $booking->customer_id }}" hidden>
                        <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Nama</label>
                        <input type="text" class="form-control" id="pet_name" name="pet_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tipe</label>
                        <input type="text" class="form-control" id="pet_type" name="pet_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jenis Kelamin</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                            <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Jantan</option>
                            <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Betina</option>
                        </select>
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

    <div class="modal fade" id="discardBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Batalkan Booking</h1>
            </div>
            
            <form action="/discardBooking/{{ $booking->id }}" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <small class="fs-6" style="font-weight: 300">Kamu yakin akan membatalkan booking ini?</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Batalkan</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Jadwal Karyawan</h1>
            </div>
            
            <form action="/checkModal/{{ $booking->id }}" method="GET">
                @csrf
                <div class="modal-body">
                    <?php $bookingDate = date_create($booking->booking_date) ?>
                    <p class="mx-1" style="font-size: 16px; font-weight: 450; color: black;">{{ date_format($bookingDate,"d F Y") }}</p> 
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Staff Name</th>
                            <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $indexBook = 0; ?>
                            @foreach ($staff_book->where('booking_date', $booking->booking_date)->where('staff_id', '!=', 0) as $sb)
                                <?php $indexBook += 1; ?>
                                <tr>
                                    <th scope="row">{{ $indexBook }}</th>
                                    <td>{{ $sb->staff->first_name }}</td>
                                    <td>{{ $sb->services[0]->time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                </div>
            </form>
          </div>
        </div>
    </div> --}}

    @include('sweetalert::alert')
@endsection
