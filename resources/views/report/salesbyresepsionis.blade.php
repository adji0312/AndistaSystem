@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('report.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="cursor: pointer;">
                            <a href="/report" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                <div class="d-flex gap-2 m-3">
                    <form action="" class="d-flex gap-2">
                        <input type="date" class="form-control" value="{{ request('datefrom') }}" name="datefrom" id="datefrom">
                        <input type="date" class="form-control" value="{{ request('dateto') }}" name="dateto" id="dateto">
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 120px"><i class="fas fa-filter"></i> Filter</button>
                            <a href="/report/byStaff" class="btn btn-outline-secondary btn-sm" style="width: 120px">Reset</a>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="/report/byReceptionistExport" class="btn btn-outline-secondary btn-sm" style="width: 120px">Export</a>
                        </div>
                    </form>
                </div>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 3%">No</th>
                            <th scope="col" style="width: 15%">Nama Staff</th>
                            <th scope="col">Jumlah Booking</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            <?php $index = 0; ?>
                            @foreach ($staffs as $staff)
                            <?php $index += 1; ?>
                                <?php $count = 0; ?>
                                <tr>
                                    <th scope="row">{{ $index }}</th>
                                    <td>{{ $staff->first_name }}</td>

                                    {{-- @if (request('datefrom') && request('dateto')) --}}
                                    <?php $jumlahBooking = 0; ?>
                                    @foreach ($subbooks->where('admin_id', $staff->id) as $sub)
                                        <?php $jumlahBooking += 1; ?>
                                    @endforeach
                                    <td>{{ $jumlahBooking }}</td>
                                    {{-- @else
                                        <td>{{ count($staff->subbooks) }}</td>
                                    @endif --}}
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            @if (request('datefrom') && request('dateto'))
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                    <h5 class="m-3" style="width: 10%">Detail Produktivitas </h5>
                    <div class="m-3 table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 3%">No</th>
                                <th scope="col" style="width: 15%">Tanggal</th>
                                <th scope="col" style="width: 15%">Nama Staff</th>
                                <th scope="col">Detail Booking</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                <?php $indexProduktivitas = 0; ?>
                                @foreach ($subbooks as $produktivitas)
                                <?php $indexProduktivitas += 1; ?>
                                    <?php $count = 0; ?>
                                    <tr>
                                        <th scope="row">{{ $indexProduktivitas }}</th>
                                        <td>{{ $produktivitas->created_at->isoFormat('D MMMM Y') }}</td>
                                        @if ($produktivitas->admin_id != '')
                                            @foreach ($staffs->where('id', $produktivitas->admin_id) as $stf)
                                                <td>{{ $stf->first_name }}</td>
                                            @endforeach
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td><a type="button" href="/booking/detail/{{ $produktivitas->id }}" class="btn btn-primary btn-sm">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
  </div>
@endsection
