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
                            @if(Auth::user()->role->service_policy === 1|Auth::user()->role->service_policy === 2)
                                <a class="nav-link active" aria-current="page" href="/service/policy/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            @else
                            @endif
                            @if(Auth::user()->role->service_policy === 1)
                            <div id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deletePolicy" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
                            </div>
                            @else
                            @endif
                        </div>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
                        <th scope="col" style="color: #7C7C7C">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($policies as $policy)
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $policy->id }}]" name="checkBox"  value="{{ $policy->id }}">
                                    </div>
                                </th>

                                <?php
                                    $id = encrypt($policy->id);
                                ?>
                                <td><a href="/service/policy/{{ $id }}" class="text-primary hovertext">{{ $policy->form_name }}</a></td>
                                <td>{{ $policy->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal fade" id="deletePolicy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Policy</h1>
            </div>
            
            <form action="/deletePolicy" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
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