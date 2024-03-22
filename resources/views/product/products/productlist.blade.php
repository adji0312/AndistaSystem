@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('product.menu')

    <div id="contents">
      <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="d-flex gap-3 w-100">
            <a class="navbar-brand" id="navbar-brand-title" href="#">List Produk</a>
            <div class="d-flex justify-content-between w-100 align-items-center">
                <div class="d-flex gap-4">
                    {{-- @dd(Auth::user()->role->product_list) --}}
                    @if(Auth::user()->role->product_list === 1 || Auth::user()->role->product_list === 2)
                        <a class="nav-link active" aria-current="page" href="/product/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> Tambah Produk</a>
                    @else
                    @endif
                    @if(Auth::user()->role->product_list === 1)
                    <li class="nav-item" id="deleteButton" style="display: none;">
                        <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCustomer" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Hapus</a>
                    </li>
                    @else
                    @endif
                </div>
                <form class="d-flex" role="search" action="/product/list">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    @include('product.sidenavproduct')

    <div id="dashboard" class="mx-3 mt-4">
        <table class="table">
            <thead>
              <tr>
                <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                <th scope="col" style="color: #7C7C7C">Nama Produk</th>
                <th scope="col" style="color: #7C7C7C">Harga </th>
                <th scope="col" style="color: #7C7C7C">Stok </th>
                {{-- <th scope="col" style="color: #7C7C7C">Created</th> --}}
                <th scope="col" style="color: #7C7C7C">Status</th>
                {{-- <th scope="col" style="color: #7C7C7C">Action</th> --}}
                {{-- <th scope="col" style="color: #7C7C7C">Pet Gender</th> --}}
              </tr>
            </thead>
            <tbody>
                {{-- @dd($products->all()) --}}
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkBox[{{ $product->id }}]" name="checkBox"  value="{{ $product->id }}">
                                <input type="hidden" id="serviceName{{ $product->id }}" value="{{ $product->service_name }}">
                            </div>
                        </th> 
                        <td><a href="/product/edit/{{ $product->id }}" class="text-primary">{{ $product->product_name }}</a></td>
                        {{-- <td>{{ $product->product_name}}</td> --}}
                        <td>Rp {{ number_format($product->price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->status }}</td>
                        {{-- <td>
                            <div class="btn-group">
                                <a href="/customer/list/update/{{ $product->id }}" class="btn btn-primary active me-1">Edit
                                </a>
                                <a href="/customer/list/delete/{{ $product->id }}" class="btn btn-danger">Delete</a>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
    </div>
    
    <form action="/deleteProduct" method="GET">
        @csrf
        <div class="modal-body">
            <div class="mb-1">
                {{-- <input type="text" id="deleteId"> --}}
                <input type="text" hidden id="deleteId" name="deleteId" value="Hapus" class="form-control mt-1">
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
@endsection