@extends('main')
@section('container')
    <div class="wrapper">
        @include('service.menu')
        
        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div class="d-flex gap-4">
                            @if(Auth::user()->role->service_list === 1|Auth::user()->role->service_list === 2)
                                <a class="nav-link active" aria-current="page" href="/service/list/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            @else
                            @endif
                            @if(Auth::user()->role->service_list === 1)
                                <div id="deleteButton" style="display: none;">
                                    <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteService" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                                </div>
                            @else
                            @endif
                        </div>
                        <form class="d-flex" role="search" action="/service/list">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('service.sidenavservice')

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Name</th>
                        <th scope="col" style="color: #7C7C7C">Category</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $key => $service)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $service->id }}]" name="checkBox"  value="{{ $service->id }}">
                                        <input type="hidden" id="serviceName{{ $service->id }}" value="{{ $service->service_name }}">
                                    </div>
                                </th>
                                <td><a href="/service/list/{{ $service->service_name }}" class="text-primary">{{ $service->service_name }}</a></td>
                                <td>{{ $service->category->category_service_name ?? 'No Category'}}</td>
                                <td>{{ $service->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mx-3">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deleteService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Service</h1>
            </div>
            
            <form action="/deleteService" method="GET">
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