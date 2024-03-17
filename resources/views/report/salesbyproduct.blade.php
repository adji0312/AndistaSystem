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
                            <a href="/report/byProduct" class="btn btn-outline-secondary btn-sm" style="width: 120px">Reset</a>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="/report/byProductExport" class="btn btn-outline-secondary btn-sm" style="width: 120px">Export</a>
                        </div>
                    </form>
                </div>
                <div class="m-3 table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 3%">No</th>
                            <th scope="col" style="width: 20%">Nama Product</th>
                            <th scope="col" style="width: 20%">Terjual</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            <?php $index = 0; ?>
                            @foreach ($products as $product)
                            <?php $index += 1; ?>
                                <?php $count = 0; ?>
                                <tr>
                                    <th scope="row">{{ $index }}</th>
                                    <td>{{ $product->product_name }}</td>
                                    @if (request('datefrom') && request('dateto'))
                                        <?php $quantity = 0; 
                                            $total_price = 0;
                                        ?>
                                        @foreach ($cartbooking->where('product_id', $product->id) as $cart)
                                            <?php $quantity += $cart->quantity; 
                                                $total_price += $cart->total_price;
                                            ?>
                                        @endforeach
                                        <td>{{ $quantity }} item</td>
                                        <td>Rp {{ number_format($total_price) }}</td>
                                    @else
                                        <td>{{ $product->carts->sum('quantity') }} item</td>
                                        <td>Rp {{ number_format($product->carts->sum('total_price')) }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            @if (request('datefrom') && request('dateto'))
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;" class="mt-4">
                    <h5 class="m-3" style="width: 10%">Detail Penjualan</h5>
                    <div class="m-3 table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 3%">No</th>
                                <th scope="col" style="width: 15%">Tanggal</th>
                                <th scope="col" style="width: 20%">Nama Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                <?php $indexCart = 0; ?>
                                @foreach ($cartbooking as $cart)
                                <?php $indexCart += 1; ?>
                                    <?php $count = 0; ?>
                                    <tr>
                                        <th scope="row">{{ $indexCart }}</th>
                                        <td>{{ $cart->created_at->isoFormat('D MMMM Y') }}</td>
                                        <td>{{ $cart->name }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rp {{ number_format($cart->total_price) }}</td>
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
