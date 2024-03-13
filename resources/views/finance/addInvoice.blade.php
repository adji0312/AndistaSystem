@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Invoice Baru</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/sale/list/unpaid" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" onclick="saveNewInvoice()" style="color: #f28123; cursor: pointer;">Selanjutnya <img src="/img/icon/continue.png" alt="" style="width: 22px"></a>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/storeNewInvoice" method="POST">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <button type="button" class="btn btn-sm btn-outline-dark m-3" data-bs-toggle="modal" data-bs-target="#addNewCustomer"><i class="fas fa-plus"></i> Tambah Pelanggan</button>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                              <label for="customer_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Pelanggan</label>
                              <input type="text" required class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" placeholder="cari pelanggan">
                                @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" hidden id="submitNewInvoice">Submit</button>
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

    @include('sweetalert::alert')
@endsection