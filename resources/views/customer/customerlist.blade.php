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
                            @if(Auth::user()->role->customer_list === 1|Auth::user()->role->customer_list === 2)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/customer/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li>
                            @else
                            @endif
                            @if(Auth::user()->role->customer_list === 1)
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
                        <th scope="col" style="color: #7C7C7C">Customer Name</th>
                        <th scope="col" style="color: #7C7C7C">Pet Name</th>
                        <th scope="col" style="color: #7C7C7C">Phone</th>
                        <th scope="col" style="color: #7C7C7C">Email</th>
                        <th scope="col" style="color: #7C7C7C">Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            {{-- @dd($customer) --}}
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $customer->id }}]" name="checkBox"  value="{{ $customer->id }}">
                                        <input type="hidden" id="serviceName{{ $customer->id }}" value="{{ $customer->service_name }}">
                                    </div>
                                </th>
                                {{-- @dd($customer) --}}
                                <td><a href="/customer/list/saved/edit/{{ $customer->id }}" class="text-primary">{{ $customer->first_name }}</a></td>
                                <td>
                                    @foreach ($customer->pets as $pet)
                                        {{ $pet->pet_name}}<br>
                                    @endforeach
                                </td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->created_at ? $customer->created_at : "-" }}</td>
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