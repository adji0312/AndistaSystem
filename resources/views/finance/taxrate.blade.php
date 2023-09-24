@extends('main')
@section('container')
    <div class="wrapper">
        @include('finance.menu')
        
        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{ $title }}</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#addTaxRate" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                            </li>
                            <li class="nav-item" id="deleteButton" style="display: none;">
                                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteTax" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
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
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Tax Name</th>
                        <th scope="col" style="color: #7C7C7C">Tax Rate</th>
                        <th scope="col" style="color: #7C7C7C">Created By</th>
                        <th scope="col" style="color: #7C7C7C">Created At</th>
                        <th scope="col" style="color: #7C7C7C">Updated By</th>
                        <th scope="col" style="color: #7C7C7C">Updated At</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tax as $t)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkBox[{{ $t->id }}]" name="checkBox"  value="{{ $t->id }}">
                                    </div>
                                </th>
                                <td class="text-primary" data-bs-toggle="modal" data-bs-target="#editTaxRate{{ $t->id }}" style="cursor: pointer;">{{ $t->tax_name }}</td>
                                <td>{{ $t->tax_rate }}%</td>
                                <td>{{ $t->created_by }}</td>
                                <td>{{ $t->created_at->format('j F Y') }}</td>
                                @if ($t->updated_by == '')
                                    <td><small>none</small></td>
                                    <td><small>none</small></td>
                                @else
                                    <td>{{ $t->updated_by }}</td>
                                    <td>{{ $t->updated_at->format('j F Y') }}</td>
                                @endif
                            </tr>

                            <div class="modal fade" id="editTaxRate{{ $t->id }}" value={{ $t->id }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tax</h1>
                                    </div>
                                    <form action="/updateTaxRate/{{ $t->id }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="tax_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Name</label>
                                                <input type="text" class="form-control" id="tax_name" name="tax_name" value="{{ $t->tax_name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tax_rate" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                                                <input type="number" class="form-control" id="tax_rate" name="tax_rate" value="{{ $t->tax_rate }}">
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
    </div>

    <div class="modal fade" id="addTaxRate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Tax</h1>
            </div>
            <form action="/addTaxRate" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tax_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Name</label>
                        <input type="text" class="form-control" id="tax_name" name="tax_name">
                    </div>
                    <div class="mb-3">
                        <label for="tax_rate" class="form-label" style="font-size: 15px; color: #7C7C7C;">Tax Rate</label>
                        <input type="number" class="form-control" id="tax_rate" name="tax_rate">
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

    <div class="modal fade" id="deleteTax" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Tax</h1>
            </div>
            
            <form action="/deleteTax" method="GET">
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