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
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                <div class="d-flex gap-2 m-3">
                    <form action="" class="d-flex gap-2">
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="month">
                            <option value="" class="selectstatus" disabled selected>Select Month</option>
                            <option value="01" style="color: black;">January</option>
                            <option value="02" style="color: black;">February</option>
                            <option value="03" style="color: black;">March</option>
                            <option value="04" style="color: black;">April</option>
                            <option value="05" style="color: black;">May</option>
                            <option value="06" style="color: black;">June</option>
                            <option value="07" style="color: black;">July</option>
                            <option value="08" style="color: black;">August</option>
                            <option value="09" style="color: black;">September</option>
                            <option value="10" style="color: black;">October</option>
                            <option value="11" style="color: black;">November</option>
                            <option value="12" style="color: black;">December</option>
                        </select>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="year">
                            <option value="" class="selectstatus" disabled selected>Select Year</option>
                            <option value="2023" style="color: black;">2023</option>
                            <option value="2024" style="color: black;">2024</option>
                            <option value="2025" style="color: black;">2025</option>
                            <option value="2026" style="color: black;">2026</option>
                            <option value="2027" style="color: black;">2027</option>
                            <option value="2028" style="color: black;">2028</option>
                            <option value="2029" style="color: black;">2029</option>
                            <option value="2030" style="color: black;">2030</option>
                            <option value="2031" style="color: black;">2031</option>
                            <option value="2032" style="color: black;">2032</option>
                        </select>
                        <button type="button" class="btn btn-outline-primary btn-sm" style="width: 100px;"><i class="fas fa-filter"></i> Filter</button>
                    </form>
                    <form action="/report/daily">
                        <button type="submit" class="btn btn-outline-secondary btn-sm mx-2" style="width: 100%; height: 100%">Reset</button>
                    </form>
                </div>

                <?php 
                    $totalPrice = $bookingServices->sum('price');
                    $quantity = count($bookingServices);
                ?>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 60px">No</th>
                            <th scope="col">Month</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>December</td>
                                <td>{{ $services[0]->service_name }}</td>
                                <td>{{ $quantity }}</td>
                                <td>Rp {{ number_format($totalPrice) }}</td>
                            </tr>
                            <?php $index = 1; ?>
                            @foreach ($services->skip(1) as $service)
                            <?php $index += 1; ?>
                                <?php $count = 0; ?>
                                <tr>
                                    <th scope="row">{{ $index }}</th>
                                    <td>December</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->carts->sum('quantity') }}</td>
                                    <td>Rp {{ number_format($service->carts->sum('total_price')) }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
