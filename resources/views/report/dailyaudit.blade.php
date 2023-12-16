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
                            <a href="/report" class="nav-link active" style="color: #f28123" ><img src="/img/icon/previous.png" alt="" style="width: 22px"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <div class="d-flex gap-3">
                    <h5 class="m-3">Daily Audit</h5>
                    <div style="width: 30%" class="m-3 d-flex gap-2">
                        <input type="date" class="form-control" value="{{ Date::now()->format('Y-m-d') }}">
                        <button type="button" class="btn btn-outline-primary btn-sm" style="width: 100px"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
                <div class="table-responsive m-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #f2f2f2"></th>
                                <th scope="col" style="background-color: #f2f2f2"></th>
                                <th scope="col" colspan="4" class="text-center" style="background-color: #f2f2f2">Payment Summary</th>
                            </tr>
                            <tr>
                                <th scope="col" style="background-color: #f2f2f2; width: 100px">Day</th>
                                <th scope="col" style="background-color: #f2f2f2">Date</th>
                                <th scope="col" style="background-color: #f2f2f2">Cash</th>
                                <th scope="col" style="background-color: #f2f2f2">Debit Card</th>
                                <th scope="col" style="background-color: #f2f2f2">Credit Card</th>
                                {{-- <th scope="col">Total</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <td>{{ date_format(Date::now(), 'd F Y') }}</td>
                                <td>Rp 300,000</td>
                                <td>Rp 100,000</td>
                                <td>Rp 4,000,000</td>
                                {{-- <td class="tex-end">Rp 4,400,000</td> --}}
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">Total</th>
                                <td colspan="5" class="text-end"><strong>Rp 4,400,000</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                <div class="d-flex gap-3">
                    <h5 class="m-3">Cash</h5>
                </div>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
