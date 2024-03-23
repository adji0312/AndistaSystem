@extends('main')
@section('container')

    <div class="wrapper">
        @include('finance.menu')
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $sale->no_invoice }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if ($sale->status == 1)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/sale/list/unpaid" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> Kembali ke List</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/sale/list/paid" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> Kembali ke List</a>
                            </li>
                        @endif
                        @if ($sale->status == 0)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" style="color: #f28123; cursor: pointer;" onclick="window.print()"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Print</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#makePayment" style="color: #f28123; cursor: pointer;"><img src="/img/icon/paid.png" alt="" style="width: 22px"> Paid</a>
                            </li>
                        @endif
                      </ul>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Informasi</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Invoice No</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->no_invoice }}" readonly>
                        </div>
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Lokasi`</label>
                                <input type="text" class="form-control" value="{{ $sale->booking->location->location_name }}" readonly>
                            </div>
                        @endif
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <div class="mb-3" style="width: 230px">
                                <label for="capacity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tanggal</label>
                                <input type="date" class="form-control" id="capacity" name="capacity" value="{{ $sale->booking->booking_date }}" readonly>
                            </div>
                        @endif
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Pelanggan</label>
                                <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->booking->customer->first_name }}" readonly>
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Pelanggan</label>
                                <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->customer_name }}" readonly>
                            </div>
                        @endif
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Sub Account</label>
                                <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $sale->sub_booking->pet->pet_name }}" readonly>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($invoice_method != null)
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                        <h5 class="m-3">Metode Pembayaran</h5>
                        <div class="d-flex flex-column">
                            @foreach ($invoice_method as $im)
                                <div class="m-3 d-flex gap-5">
                                    <div class="mb-3">
                                        <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Metode Pembayaran</label>
                                        <p class="text-dark fs-6">{{ $im->method }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jumlah Pembayaran</label>
                                        <p class="text-dark fs-6">Rp {{ number_format($im->price) }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tanggal</label>
                                        <p class="text-dark fs-6">{{ date_format($im->created_at, 'd M Y H:i') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex m-2">
                        <h5 class="m-3">Item</h5>
                        @if ($sale->status != 0)
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartProduct"><i class="fas fa-plus"></i> Tambah Produk</button>
                            <button type="button" class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addCartService"><i class="fas fa-plus"></i> Tambah Servis</button>
                        @endif
                    </div>

                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">No</th>
                                    <th scope="col">Nama Item</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Staff</th>
                                    <th scope="col">Sub Account</th>
                                    <th scope="col">Harga</th>
                                    @if ($sale->status == 1)
                                        <th scope="col" class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($bookingService){
                                        $itemIndex = 1; 
                                    }else{
                                        $itemIndex = 0; 
                                    }
                                ?>
                                @foreach ($carts as $item)
                                    <?php $itemIndex += 1; ?>
                                    <tr>
                                        <td>{{$itemIndex}}</td>
                                        @if ($item->product_id != null)
                                            <td>{{ $item->name }}</td>
                                        @else
                                            @if ($item->service_price_id == null)
                                                <td>{{ $item->name }} (-)</td>
                                            @else
                                                <td>{{ $item->name }} ({{ $item->servicePrice ? $item->servicePrice->price_title : "-" }})</td>
                                            @endif
                                        @endif
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->staff ? $item->staff->first_name : "-" }}</td>
                                        <td>{{ $item->subBooking ? $item->subBooking->pet->pet_name : "-" }}</td>
                                        @if ($sale->status == 1)
                                            <td>
                                                <form action="/editCartPrice/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                                                    <input type="number" name="total_price" id="total_price{{ $item->id }}" value="{{ $item->total_price }}" oninput="editPrice({{ $item->id }})">
                                                    <script>
                                                        function editPrice(id){
                                                            let price = document.getElementById('total_price' + id);
                                                            console.log(price.value);

                                                            let button = document.getElementById('submitPrice' + id);
                                                            button.click();

                                                        }
                                                    </script>
                                                    <button type="submit" id="submitPrice{{ $item->id }}" hidden></button>
                                                </form>
                                            </td>
                                        @else   
                                            <td>
                                                Rp {{ number_format($item->total_price) }}
                                            </td>
                                        @endif
                                        @if ($sale->status == 1)
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @if ($item->flag == 1)
                                                        <button type="button" class="btn btn-outline-success btn-sm" style="width: 100%; height: 100%;" data-bs-toggle="modal" data-bs-target="#updateCartBooking{{ $item->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                        <form action="/saveCartBooking/{{ $item->id }}" method="post" style="width: 100%">
                                                            @csrf
                                                            @if ($sale->booking)
                                                                <input type="text" hidden name="booking_id" value="{{ $sale->booking->booking_id }}">
                                                            @else
                                                                <input type="text" hidden name="booking_id" value="0">
                                                            @endif
                                                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 100%; height: 100%;"><i class="fas fa-save"></i> Simpan</button>
                                                        </form>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#deleteCartBooking{{ $item->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                                    @else
                                                        <button type="button" class="btn btn-outline-success btn-sm" style="width: 100px" disabled><i class="fas fa-check"></i> Selected</button>    
                                                    @endif
                                                </div>
                                            </td>

                                            @if ($item->product_id != null)
                                                {{-- Product --}}
                                                <div class="modal fade" id="updateCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Qty Produk</h1>
                                                        </div>
                                                        <form action="/updateCartBooking/{{ $item->id }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Stok Produk</label>
                                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->product->stock }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Qty</label>
                                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}">
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
                                                {{-- Service --}}
                                                <div class="modal fade" id="updateCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Servis</h1>
                                                        </div>
                                                        <form action="/updateCartBooking/{{ $item->id }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Harga Servis</label>
                                                                    <select class="form-select" aria-label="Default select example" name="service_price_id">
                                                                        {{-- <option value="" selected>Pilih Harga Servis</option> --}}
                                                                        @foreach ($item->service->prices as $price)
                                                                            @if ($price->id == $item->service_price_id)
                                                                                <option selected value="{{ $price->id }}">{{ $price->price_title }} ({{ $price->duration }} menit - Rp {{ number_format($price->price) }})</option>
                                                                                @continue;
                                                                            @endif
                                                                            <option value="{{ $price->id }}">{{ $price->price_title }} ({{ $price->duration }} menit - Rp {{ number_format($price->price) }})</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Qty</label>
                                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $item->quantity }}">
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
                                            @endif
                                            
                                            <div class="modal fade" id="deleteCartBooking{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Item</h1>
                                                    </div>
                                                    
                                                    <form action="/deleteCartBooking2/{{ $item->id }}" method="GET">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <small>Apakah anda yakin ingin menghapus item ini?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>

                                        @endif
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4 mb-4">
                    <h5 class="m-3">Pesan Resepsionis</h5>
                    <div class="d-flex flex-column">
                        @if ($sale->pesan_resepsionis == null)
                            <p class="mx-3 text-dark">-</p>
                        @else
                            <p class="mx-3 text-dark">{{ $sale->pesan_resepsionis }}</p>
                        @endif
                    </div>
                </div>

                <div style="width: 50%; margin-left: 10px;" class="float-end mb-3">
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            @if ($sale->status == 0)
                            @else
                                {{-- <form action="/updateTambahanBiaya/{{ $sale->id }}" method="POST">
                                    @csrf
                                    <tr>
                                        <th scope="row" class="text-end">Tambahan Biaya</th>
                                        <td colspan="2"><input type="number" placeholder="0" style="width: 100%" oninput="inputTambahanBiaya()" name="tambahan_biaya" id="tambahan_biaya" value="{{ $sale->tambahan_biaya }}"></td>
                                    </tr>
                                    <button type="submit" id="buttonTambahanBiaya" hidden></button>
                                </form> --}}
                                <form action="/updateAddCost/{{ $sale->id }}" method="POST">
                                    @csrf
                                    <tr>
                                        <th scope="row" class="text-end">Diskon (Persentase)</th>
                                        <td colspan="2"><input type="number" placeholder="0.00" style="width: 100%" oninput="inputDiscount()" name="discount" id="discount" value="{{ $sale->diskon }}"></td>
                                    </tr>
                                    <button type="submit" id="buttonAddCost" hidden></button>
                                </form>
                            @endif
                            <tr>
                                <th scope="row" class="text-end">Sub Total</th>
                                <td colspan="2" id="total_price_sale">Rp {{ number_format($sub_total) }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Dison (Persentase)</th>
                                <td colspan="2" id="total_price_sale">{{ $sale->diskon }}%</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Biaya Tambahan</th>
                                <td colspan="2" id="total_price_sale">Rp {{ number_format($sale->tambahan_biaya) }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-end">Total Harga</th>
                                <input type="number" id="before_total_price" name="before_total_price" value="{{ $sale->total_price }}" hidden>
                                <td colspan="2" id="total_price_sale">Rp {{ number_format($sale->total_price - $sale->amount_discount + $sale->tambahan_biaya) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 mb-4">
                    <small><strong>Instruksi Pembayaran</strong></small>
                    <p style="color: black; font-size: 15px">Gunakan informasi berikut ini untuk transfer bank, internet banking, deposit, dan buku cek: BCA
                        Atas nama: PT. Andista Medika Veteriner
                        Nomor rekening: 31-0032-049-4</p>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="makePayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
            </div>
            <form action="/makePayment" method="post">
                @csrf
                <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" hidden name="resepsionis_id" value="{{ Auth::user()->id }}">
                        <input type="text" hidden name="hargaasli" value="{{ $sale->total_price }}">
                        <label for="total_price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Total Harga</label><br>
                        <small style="font-size: 17px;">Rp {{ number_format($sale->total_price - $sale->amount_discount + $sale->tambahan_biaya) }}</small>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Metode Pembayaran 1</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" name="payment_method1" id="payment_method1" required>
                            <option value="" selected>Pilih Metode Pembayaran</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Debit Card">Debit Card</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jumlah Pembayaran 1</label>
                        <input type="number" class="form-control mt-1" id="price1" name="price1" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Metode Pembayaran 2</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" name="payment_method2" id="payment_method2">
                            <option value="" selected>Pilih Metode Pembayaran</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Debit Card">Debit Card</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Jumlah Pembayaran 2</label>
                        <input type="number" class="form-control mt-1" id="price2" name="price2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Bayar</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="makeDeposit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Make Deposit</h1>
            </div>
            <form action="/makeDeposit" method="post">
                @csrf
                <input type="text" name="sale_id" value="{{ $sale->id }}" hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="total_price" class="form-label" style="font-size: 15px; color: #7C7C7C;">Total Price</label><br>
                        <small style="font-size: 17px;">Rp {{ number_format($sale->total_price) }}</small>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" style="font-size: 15px; color: #7C7C7C;">Metode Pembayaran</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" name="payment_method" id="payment_method">
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Debit Card">Debit Card</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deposit" class="form-label" style="font-size: 15px; color: #7C7C7C;">Deposit</label>
                        <input type="number" class="form-control mt-1" id="deposit" name="deposit">
                    </div>
                    <div class="mb-3">
                        <label for="payment_note" class="form-label" style="font-size: 15px; color: #7C7C7C;">Note</label>
                        <input type="text" class="form-control mt-1" id="payment_note" name="payment_note">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Make Deposit</button>
                </div>
            </form>    
          </div>
        </div>
    </div>

    <div class="modal fade" id="addCartProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
            </div>
            <form action="/addCartProduct2" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" hidden name="invoice_id" value="{{ $sale->id }}">
                        {{-- {{ $sale->booking }} --}}
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <input type="text" name="booking_id" hidden value="{{ $sale->booking->id }}">
                        @else
                            <input type="text" name="booking_id" hidden value="0">
                        @endif
                        <input type="text" name="sale_id" hidden value="{{ $sale->id }}">
                        {{-- <input type="text" name="sub_booking_id" hidden value="{{ $booking->id }}">
                        <input type="text" name="staff_id" hidden value="{{ $booking->booking->staff->id }}"> --}}
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Servis</h1>
            </div>
            <form action="/addCartService2" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        @if ($sale->booking_id != 0 || $sale->booking)
                            <input type="text" name="booking_id" hidden value="{{ $sale->booking->id }}">
                        @else
                            <input type="text" name="booking_id" hidden value="0">
                        @endif
                        @if($sale->sub_booking_id != 0)
                            <input type="text" name="sub_booking_id" hidden value="{{ $sale->sub_booking->id }}">
                        @else
                            <input type="text" name="sub_booking_id" hidden value="0">
                        @endif
                        <input type="text" name="sale_id" hidden value="{{ $sale->id }}">
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
    @include('sweetalert::alert');
@endsection