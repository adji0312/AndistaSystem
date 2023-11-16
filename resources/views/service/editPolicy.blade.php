@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand">{{ $policy->form_name }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/policy" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" onclick="savePolicy()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                <form action="/updatePolicy/{{ $policy->id }}" method="post">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3" style="width: 30%">
                                <label for="form_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Name</label>
                                <input type="text" class="form-control @error('form_name') is-invalid @enderror" id="form_name" name="form_name" value="{{ $policy->form_name }}">
                                @error('form_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3" style="width: 16%">
                                <label class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C;" name="status">
                                    @if ($policy->status == "Active")
                                        <option value="Active" class="selectstatus" style="color: black;" selected>Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                    @else
                                        <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                        <option value="Disabled" class="selectstatus" style="color: black;" selected>Disabled</option>
                                    @endif
                                </select>
                            </div>
                            
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3" style="width: 50%">
                                {{-- <form action=""> --}}
                                <input id="text" type="hidden" name="text" value="{{ $policy->text }}">
                                <trix-editor input="text" class="@error('text') is-invalid @enderror"></trix-editor>
                                @error('text')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitPolicy" hidden></button>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staffservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Staff</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Job Title</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        </th>
                        <td>Drh Benny</td>
                        <td>Laki Laki</td>
                        <td>Dokter Umum</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="facility" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Facility</h1>
              </div>
              <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1"></th>
                        <th scope="col">Facility Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Units</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        </th>
                        <td>Kandang Besar</td>
                        <td>Andista Animal Care</td>
                        <td>1</td>
                        <td>6</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
        </div>
    </div>
@endsection