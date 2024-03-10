@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('calendar.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/calendar" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveBooking()" style="color: #f28123; cursor: pointer;">Selanjutnya <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">
            <form action="/addBooking" method="POST">
                @csrf
                <input type="text" hidden name="admin_id" value="{{ Auth::user()->id }}">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
                        <h5 class="m-3">Penjadwalan</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addNewCustomer"><i class="fas fa-plus"></i> Tambah Pelanggan</button>
                    </div>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="customer_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Pelanggan</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" value="" placeholder="Cari Pelanggan" required>
                        </div>
                        <div class="mb-3">
                          <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi</label>
                          <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 230px" id="location_id" name="location_id" required>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" class="selectstatus" name="location_id" style="color: black;">{{ $location->location_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="booking_date" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tanggal</label>
                          <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        </div>
                    </div>
                    <div class="m-3">
                        <div class="mb-3">
                            <label for="alasan_kunjungan" class="form-label" style="font-size: 15px; color: #7C7C7C;">Alasan Kunjungan</label>
                            <input type="text" class="form-control" id="alasan_kunjungan" name="alasan_kunjungan" value="" placeholder="Search Alasan Kunjungan" required>
                        </div>
                    </div>
                    <div class="mx-3 d-flex gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="langsung_datang" value="1" checked>
                            <label class="form-check-label" for="langsung_datang">
                                Langsung datang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="darurat" value="2">
                            <label class="form-check-label" for="darurat">
                                Darurat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="jadwalkan" value="3">
                            <label class="form-check-label" for="jadwalkan">
                                Jadwalkan
                            </label>
                        </div>
                    </div>
                </div>
                
                <button type="submit" id="submitBooking" hidden></button>
            </form>
        </div>
    </div>
  </div>

<div class="modal fade" id="addNewCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan Baru</h1>
        </div>
        <form action="/addNewCustomer" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="first_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Nama</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label" style="font-size: 15px; color: #7C7C7C;">No Hp</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jenis Kelamin</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="gender" name="gender" required>
                        <option value="Male" class="selectstatus" name="gender" style="color: black;">Laki Laki</option>
                        <option value="Female" class="selectstatus" name="gender" style="color: black;">Perempuan</option>
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
@endsection
