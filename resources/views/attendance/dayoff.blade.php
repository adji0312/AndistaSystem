@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('attendance.menu')

    <div id="contents">
    <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" style="cursor: pointer;">
                        <a class="nav-link active" aria-current="page" style="color: #f28123" data-bs-toggle="modal" data-bs-target="#newDayOff"><img src="/img/icon/plus.png" alt="" style="width: 22px"> New</a>
                    </li>
                    <li class="nav-item" id="deleteButton" style="display: none;">
                        <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#deleteDayOff" onclick="clickDeleteButton()" style="color: #ff3f5b; cursor: pointer;"><img src="/img/icon/trash.png" alt="" style="width: 22px"> Delete</a>
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
            <table class="table w-50">
                <thead>
                  <tr>
                    <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                    <th scope="col" style="color: #7C7C7C;">Date</th>
                    <th scope="col" style="color: #7C7C7C;">Name</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dayoff as $do)
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox[{{ $do->id }}]" name="checkBox"  value="{{ $do->id }}">
                                </div>
                            </th>
                            <?php $date = date_create($do->tanggal_merah); ?>
                            <td class="text-primary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editDayOff{{ $do->id }}">{{ date_format($date, 'd M Y') }}</td>
                            <td>{{ $do->name }}</td>
                        </tr>

                        <div class="modal fade" id="editDayOff{{ $do->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Day Off</h1>
                                </div>
                                <form action="/editDayOff/{{ $do->id }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $do->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_merah" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                                            <input type="date" class="form-control" id="tanggal_merah" name="tanggal_merah" value="{{ $do->tanggal_merah }}">
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

<div class="modal fade" id="newDayOff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Day Off</h1>
        </div>
        <form action="/addDayOff" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="tanggal_merah" class="form-label" style="font-size: 15px; color: #7C7C7C;">Date</label>
                    <input type="date" class="form-control" id="tanggal_merah" name="tanggal_merah">
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

<div class="modal fade" id="deleteDayOff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Day Off</h1>
        </div>
        
        <form action="/deleteDayOff" method="GET">
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
