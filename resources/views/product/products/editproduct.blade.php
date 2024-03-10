@extends('main')
@section('container')

    <div class="wrapper">
        @include('product.menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">View or Edit Product</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                      <div class="d-flex gap-4">
                            <a class="nav-link active" aria-current="page" href="/product/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          @if(Auth::user()->role->product_list === 1 || Auth::user()->role->product_list === 2)
                            <a class="nav-link active" aria-current="page" onclick="saveCustomer()" style="color: #f28123; cursor: pointer;">Save <img src="/img/icon/save.png" alt="" style="width: 22px"></a>
                          @else
                          @endif
                      </div>
                    </div>
                </div>
            </div>
            @include('product.sidenavproduct')

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/saveEditProduct/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Product Details</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="product_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ $product->product_name ?? '' }}" required>
                                @error('product_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="simple_name" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Simple Name</label>
                                <input type="text" class="form-control" name="simple_name" id="simple_name" value="{{ $product->simple_name }}">
                            </div>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="brand_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Brand</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="brand_id" id="brand_id">
                                    {{-- <option value="{{ $product->brand_id }}" class="selectstatus" style="color: black;" selected >{{ $brandChoosen->brand_name ?? '' }}</option>
                                    @foreach ($brands as $b)
                                        <option value="{{ $b->id }}" class="selectstatus" style="color: black;">{{ $b->brand_name }}</option>
                                    @endforeach --}}
                                    @foreach ($brands as $b)
                                        @if ($b->id == $product->brand_id)
                                            <option value="{{ $b->id }}" class="selectstatus" style="color: black;" selected>{{ $b->brand_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $b->id }}" class="selectstatus" style="color: black;">{{ $b->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Supplier</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="supplier_id" id="supplier_id">
                                    {{-- <option value="{{ $product->supplier_id }}" class="selectstatus" style="color: black;" selected disabled>{{ $supplierChoosen->suppliers_name ?? ''  }}</option>
                                    @foreach ($suppliers as $sup)
                                        <option value="{{ $sup->id }}" class="selectstatus" style="color: black;">{{ $sup->suppliers_name }}</option>
                                    @endforeach --}}
                                    @foreach ($suppliers as $sup)
                                        @if ($sup->id == $product->supplier_id)
                                            <option value="{{ $sup->id }}" class="selectstatus" style="color: black;" selected>{{ $sup->suppliers_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $sup->id }}" class="selectstatus" style="color: black;">{{ $sup->suppliers_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category Product</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="category_id" id="category_id" required>
                                    {{-- <option value="{{ $product->category_id }}" class="selectstatus" style="color: black;" selected disabled>{{ $categoryChoosen->category_name ?? '' }}</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" class="selectstatus" style="color: black;">{{ $cat->category_name }}</option>
                                    @endforeach --}}
                                    @foreach ($categories as $cat)
                                        @if ($cat->id == $product->category_id)
                                            <option value="{{ $cat->id }}" class="selectstatus" style="color: black;" selected>{{ $cat->category_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $cat->id }}" class="selectstatus" style="color: black;">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="phone_customer" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Phone</label>
                                <input type="text" class="form-control" name="phone_customer" id="phone_customer" value="{{ old('phone_customer') }}">
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="category_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Category</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="category_service_id" id="category_id" required>
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="selectstatus" style="color: black;">{{ $category->category_service_name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            
                            {{-- <div class="mb-3">
                                <label for="tax_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_id" id="tax_id">
                                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Tax</option>
                                    @foreach ($tax as $t)
                                        <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }} ({{ $t->tax_rate }}%)</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="description" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ $product->description ?? '' }}">
                                {{-- @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="status" id="status" required>
                                    @if ($product->status == "Active")
                                        <option value="Active" class="selectstatus" style="color: black;" selected>Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                    @else
                                        <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;" selected>Disabled</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="location_id" id="location_id">
                                    @foreach ($location as $loc)
                                        @if ($loc->id == $product->location_id)
                                            <option value="{{ $loc->id }}" class="selectstatus" style="color: black;" selected>{{ $loc->location_name }}</option>
                                            @continue
                                        @endif
                                        <option value="{{ $loc->id }}" class="selectstatus" style="color: black;">{{ $loc->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                    {{-- Sub Customer List (PET) --}}
                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Pricing</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="tax_rate_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px;" name="tax_rate_id" id="tax_rate_id">
                                    <option value="{{ $product->tax_rate_id }}" class="selectstatus" style="color: black;" selected>{{ $taxChoosen->tax_name ?? '' }}</option>
                                    @foreach ($tax as $t)
                                        <option value="{{ $t->id }}" class="selectstatus" style="color: black;">{{ $t->tax_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Price</label>
                                <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label" style="font-size: 15px; color: #7C7C7C; width: 250px;">Stock</label>
                                <input type="text" class="form-control" name="stock" id="stock" value="{{ $product->stock }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submitCustomer" hidden></button>
                </form>
            </div>
        </div>
    </div>
@endsection