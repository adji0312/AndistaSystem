@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('location.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Setting</a>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-3">

            <div class="d-flex gap-2">
                {{-- <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                    <div class="d-flex justify-content-between">
                        <h5 class="m-3">Usage Address</h5>
                        <div class="m-3">
                            <button type="button" class="btn btn-sm btn-outline-dark insert_unit" id="insert_unit"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="m-3 mt-0 d-flex gap-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                                <th scope="col" style="color: #7C7C7C">Usage Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div> --}}

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h5 class="m-3">Usage Address</h5>
                        </div>
                        <div class="m-3">
                            <button type="button" class="btn btn-sm btn-outline-dark insert_unit" data-bs-toggle="modal" data-bs-target="#addUsageAddress"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="m-3 mt-0 d-flex gap-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="color: #7C7C7C; width: 50px;">No</th>
                                <th scope="col" style="color: #7C7C7C">Type Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $index1 = 0; ?>
                                @foreach ($usageAddress as $ua)
                                    <?php $index1 += 1; ?>
                                    <tr>
                                        <th scope="row">{{ $index1 }}</th>
                                        <td style="cursor: pointer;" class="text-primary hovertext" data-bs-toggle="modal" data-bs-target="#editUsageAddress{{ $ua->id }}">{{ $ua->usage_name }}</td>
                                    </tr>

                                    <div class="modal fade" id="editUsageAddress{{ $ua->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" value="{{ $ua->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Usage Address</h1>
                                                </div>
                                                <form action="/editUsageAddress/{{ $ua->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" value="{{ $ua->usage_name }}">
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
                    <div class="modal fade" id="addUsageAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Usage Address</h1>
                            </div>
                            <form action="/addUsageAddress" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <input type="text" class="form-control mt-1" id="usage_name" name="usage_name">
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
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h5 class="m-3">Usage Contact</h5>
                        </div>
                        <div class="m-3">
                            <button type="button" class="btn btn-sm btn-outline-dark insert_unit" data-bs-toggle="modal" data-bs-target="#addUsageContact"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="m-3 mt-0 d-flex gap-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="color: #7C7C7C; width: 50px;">No</th>
                                <th scope="col" style="color: #7C7C7C">Type Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $index2 = 0; ?>
                                @foreach ($usageContact as $uc)
                                    <?php $index2 += 1 ?>
                                    <tr>
                                        <th scope="row">{{ $index2 }}</th>
                                        <td style="cursor: pointer;" class="text-primary hovertext" data-bs-toggle="modal" data-bs-target="#editUsageContact{{ $uc->id }}">{{ $uc->usage_name }}</td>
                                    </tr>

                                    <div class="modal fade" id="editUsageContact{{ $uc->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" value="{{ $uc->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Usage Contact</h1>
                                                </div>
                                                <form action="/editUsageContact/{{ $uc->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" value="{{ $uc->usage_name }}">
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
                    <div class="modal fade" id="addUsageContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Usage Contact</h1>
                            </div>
                            <form action="/addUsageContact" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <input type="text" class="form-control mt-1" id="usage_name" name="usage_name">
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
                </div>

                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h5 class="m-3">Type Messenger</h5>
                        </div>
                        <div class="m-3">
                            <button type="button" class="btn btn-sm btn-outline-dark insert_unit" data-bs-toggle="modal" data-bs-target="#addTypeMessenger"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="m-3 mt-0 d-flex gap-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" style="color: #7C7C7C; width: 50px;">No</th>
                                <th scope="col" style="color: #7C7C7C">Type Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $index3 = 0; ?>
                                @foreach ($typeMessenger as $tm)
                                    <?php $index3 += 1; ?>
                                    <tr>
                                        <th scope="row">{{ $index3 }}</th>
                                        <td style="cursor: pointer;" class="text-primary hovertext" data-bs-toggle="modal" data-bs-target="#editMessenger{{ $tm->id }}">{{ $tm->type_name }}</td>
                                    </tr>

                                    <div class="modal fade" id="editMessenger{{ $tm->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" value="{{ $tm->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Messenger Type</h1>
                                                </div>
                                                <form action="/updateMessengerType/{{ $tm->id }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <input type="text" class="form-control mt-1" id="type_name" name="type_name" value="{{ $tm->type_name }}">
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
                    <div class="modal fade" id="addTypeMessenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messenger Type</h1>
                            </div>
                            <form action="/addTypeMessenger" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <input type="text" class="form-control mt-1" id="type_name" name="type_name">
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
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
