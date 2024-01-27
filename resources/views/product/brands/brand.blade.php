@extends('main')
@section('container')
    <div class="wrapper">
        @include('product.menu')
        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div class="d-flex gap-4">
                            @if(Auth::user()->role->product_brand === 1 || Auth::user()->role->product_brand === 2)
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#addCategory" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            @else
                            @endif
                            @if(Auth::user()->role->product_brand === 1)
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCategory" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </li>
                            @else
                            @endif
                        </div>
                        <form class="d-flex" role="search" action="/product/brand">
                            <input class="form-control me-2" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('product.sidenavproduct')
            
            <div id="dashboard" class="mx-3 mt-4">
                <table class="table w-100">
                    <thead>
                      <tr >
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Brand</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $brand->id }}]" name="checkBox"  value="{{ $brand->id }}">
                                    <input type="hidden" id="categoryName{{ $brand->id }}" value="{{ $brand->brand_name }}">
                                </div>
                            </th>
                            <td style="cursor: pointer;" class="text-primary hovertext" data-bs-toggle="modal" data-bs-target="#editCategory{{ $brand->id }}">{{ $brand->brand_name }}</td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editCategory{{ $brand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" value="{{ $brand->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Brand</h1>
                                </div>
                                <form action="/editBrand/{{ $brand->id }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <input type="text" class="form-control mt-1" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                        @if(Auth::user()->role->product_brand === 1 || Auth::user()->role->product_brand === 2)
                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                                        @else
                                        @endif
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
    

    {{-- MODAL ADD --}}
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brand</h1>
            </div>
            <form action="/addBrand" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="text" class="form-control mt-1" id="product_brand_name" name="brand_name" oninput="inputProductBrandService()">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary" id="saveBrand" disabled><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>    
          </div>
        </div>
    </div>
    
    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h1>
            </div>
            
            <form action="/deleteBrand" method="GET">
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