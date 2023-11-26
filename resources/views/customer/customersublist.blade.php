@extends('main')
@section('container')
    <div class="wrapper">
        @include('customer.menu')
        
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/customer/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li> --}}
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteCustomer" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                {{-- Sub Customer List (PET) --}}
                <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <div class="d-flex gap-1 m-2">
                        <h5 class="m-3">Sub Account</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark m-2" data-bs-toggle="modal" data-bs-target="#addSubAccount"><i class="fas fa-plus"></i> Add New Sub Account</button>
                    </div>
                    <div class="mx-4 table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sub Account Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Ras</th>
                                <th scope="col">Color</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Gender</th>
                                <th scope="col" class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $pet)
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkBox[{{ $pet->id }}]" name="checkBoxPet"  value="{{ $pet->id }}">
                                            </div>
                                        </th>
                                        <td>{{ $pet->pet_name }}</td>
                                        <td>{{ $pet->pet_type }}</td>
                                        <td>{{ $pet->pet_ras }}</td>
                                        <td>{{ $pet->pet_color }}</td>
                                        <?php $date = date_create($pet->date_of_birth) ?>
                                        <td>{{ date_format($date, 'd F Y') }}</td>
                                        <td>{{ $pet->pet_gender }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-outline-success btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#updateSubAccount{{ $pet->id }}"><i class="fas fa-pencil-alt"></i> Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" style="width: 90px" data-bs-toggle="modal" data-bs-target="#deleteSubAccount{{ $pet->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Sub Account</h1>
                                            </div>
                                            
                                            <form action="/deleteSubAccount/{{ $pet->id }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-1">
                                                        <small class="fs-6" style="font-weight: 300">Are you sure delete this sub account?</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-save"></i> Discard</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="updateSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sub Account</h1>
                                            </div>
                                            <form action="/updateSubAccount/{{ $pet->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        {{-- <input type="hidden" value="{{ $booking->customer->id }}" name="customer_id"> --}}
                                                        <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                                        <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $pet->pet_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                                                        <input type="text" class="form-control" id="pet_type" name="pet_type" value="{{ $pet->pet_type }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C;">Ras</label>
                                                        <input type="text" class="form-control" id="pet_ras" name="pet_ras" value="{{ $pet->pet_ras }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C;">Color</label>
                                                        <input type="text" class="form-control" id="pet_color" name="pet_color" value="{{ $pet->pet_color }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_of_birth" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date of Birth</label>
                                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $pet->date_of_birth }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                                                            @if ($pet->pet_gender == "Male")
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;" selected>Male</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Female</option>
                                                            @else
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Male</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;" selected>Female</option>
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

                                    <div class="modal fade" id="addSubAccount{{ $pet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub Account</h1>
                                            </div>
                                            <form action="/addSubAccount/{{ $pet->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        {{-- <input type="hidden" value="{{ $booking->customer->id }}" name="customer_id"> --}}
                                                        <label for="pet_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                                        <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $pet->pet_name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_type" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                                                        <input type="text" class="form-control" id="pet_type" name="pet_type" value="{{ $pet->pet_type }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_ras" class="form-label" style="font-size: 15px; color: #7C7C7C;">Ras</label>
                                                        <input type="text" class="form-control" id="pet_ras" name="pet_ras" value="{{ $pet->pet_ras }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_color" class="form-label" style="font-size: 15px; color: #7C7C7C;">Color</label>
                                                        <input type="text" class="form-control" id="pet_color" name="pet_color" value="{{ $pet->pet_color }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="date_of_birth" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date of Birth</label>
                                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $pet->date_of_birth }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pet_gender" class="form-label" style="font-size: 15px; color: #7C7C7C;">Gender</label>
                                                        <select class="form-select" style="font-size: 15px; color: #7C7C7C;" id="pet_gender" name="pet_gender" required>
                                                            @if ($pet->pet_gender == "Male")
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;" selected>Male</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;">Female</option>
                                                            @else
                                                                <option value="Male" class="selectstatus" name="pet_gender" style="color: black;">Male</option>
                                                                <option value="Female" class="selectstatus" name="pet_gender" style="color: black;" selected>Female</option>
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
                    {{-- <div id="afterPrice" class="table-responsive">
                        <table class="table m-3" style="width: 95%;" id="priceDuplicate">
                            <thead>
                            <tr>
                                <th scope="col">Duration</th>
                                <th scope="col">Units</th>
                                <th scope="col">Price (Rp)</th>
                                <th scope="col">Location</th>
                                <th scope="col">Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control" name="duration[]" id="duration">
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="duration_type[]" id="duration_type">
                                        <option value="Minutes" class="selectstatus" style="color: black;">Minutes</option>
                                        <option value="Hours" class="selectstatus" style="color: black;">Hours</option>
                                        <option value="Days" class="selectstatus" style="color: black;">Days</option>
                                        <option value="Weeks" class="selectstatus" style="color: black;">Weeks</option>
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control" name="price[]" id="price">
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="location_price_id[]" id="location_price_id">
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                                    <input type="text" class="form-control"name="price_title[]" id="price_title">
                                </td>
                                <td style="border: none">
                                    <div class="mb-3 mt-2 d-flex align-items-center" style="cursor: pointer" onclick="deletePrice(this.parentNode.parentNode.parentNode.parentNode.id)">
                                        <img src="/img/icon/minus.png" alt="" style="width: 20px">
                                    </div>
                                </td>
                            </tr> 
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="m-3 mt-4">
                        <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicatePriceService()"><i class="fas fa-plus"></i> Add</button>
                    </div> --}}

                    
                </div>
                

                <button type="submit" id="submitPets" hidden></button>
            </form>
        </div>
    </div>
</div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Customer</h1>
            </div>
            
            <form action="/deleteCustomer" method="GET">
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