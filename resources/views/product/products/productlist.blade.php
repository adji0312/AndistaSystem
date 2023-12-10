@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('product.menu')

    <div id="contents">
      <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- @dd(Auth::user()->role->product_list) --}}
                    @if(Auth::user()->role->product_list === 1 || Auth::user()->role->product_list === 2)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/product/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                    </li>
                    @else
                    @endif
                    @if(Auth::user()->role->product_list === 1)
                    <li class="nav-item" id="deleteButton" style="display: none;">
                        <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCustomer" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                    </li>
                    @else
                    @endif
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div id="dashboard" class="mx-3 mt-4">
        <table class="table">
            <thead>
              <tr>
                <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                <th scope="col" style="color: #7C7C7C">Name</th>
                <th scope="col" style="color: #7C7C7C">Price </th>
                <th scope="col" style="color: #7C7C7C">Created</th>
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
                        <td>{{ $product->product_name}}</td>
                        <td>{{ $product->price }}</td>
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
      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
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
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Delete</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection