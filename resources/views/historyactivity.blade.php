@extends('main')
<meta http-equiv="refresh" content="7">
@section('container')
    
    <div class="wrapper">
        @include('menu')

        <div id="contents">
            <div class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="d-flex gap-3 w-100">
                    <a class="navbar-brand" id="navbar-brand-title" href="#">{{ $title }}</a>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                    </div>
                </div>
            </div>
            {{-- @include('service.sidenavservice') --}}

            <div id="dashboard" class="mx-3 mt-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="color: #7C7C7C; width: 50px;">#</th>
                        <th scope="col" style="color: #7C7C7C">Tanggal</th>
                        <th scope="col" style="color: #7C7C7C">Staff</th>
                        <th scope="col" style="color: #7C7C7C">Jenis</th>
                        <th scope="col" style="color: #7C7C7C">Item</th>
                        <th scope="col" style="color: #7C7C7C">Status</th>
                        <th scope="col" style="color: #7C7C7C">Deskripsi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $key => $history)
                            <tr>
                                <th scope="row">{{ $histories->firstItem() + $key }}</th>
                                <td>
                                    @if ($history->product_id != null)
                                        @if ($history->status != "Hapus")
                                            <?php $prod = App\Models\Product::find($history->product_id);  ?>
                                            @if ($prod)
                                                <a href="/product/edit/{{ $history->product_id }}" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @else
                                                <a href="/product/list" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @endif
                                        @else
                                            <a href="/product/list" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                        @endif
                                    @elseif ($history->service_id != null)
                                        @if ($history->status != "Hapus")
                                            <?php $servis = App\Models\Service::find($history->service_id);  ?>
                                            @if ($servis)
                                                <a href="/service/list/{{ $servis->service_name }}" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @else
                                                <a href="/service/list" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @endif
                                        @else
                                            <a href="/service/list" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                        @endif
                                    @elseif ($history->booking_id != null)
                                        <a href="/booking/detail/{{ $history->booking_id }}" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                    @elseif ($history->treatment_id != null)
                                        @if ($history->status == "Hapus")
                                            <a href="/service/treatmentplan" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                        @else
                                            @if ($history->treatment)
                                                <a href="/service/treatmentplan/add/{{ $history->treatment ? $history->treatment->name : "-" }}" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @else
                                                <a href="/service/treatmentplan" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                            @endif
                                        @endif
                                    @elseif ($history->invoice_id != null)
                                        <a href="/sale/list/detail/{{ $history->invoice->no_invoice }}" class="text-primary">{{ date_format($history->created_at, "d M Y H:i") }}</a>
                                    @endif
                                </td>
                                <td>{{ $history->username }}</td>
                                <td>
                                    @if ($history->product_id != null)
                                        <a href="/product/list" class="text-primary" style="text-decoration: underline;">Product</a>
                                    @elseif ($history->service_id != null)
                                        <a href="/service/list" class="text-primary" style="text-decoration: underline;">Service</a>
                                    @elseif ($history->booking_id != null)
                                        <a href="/calendar" class="text-primary" style="text-decoration: underline;">Booking</a>
                                    @elseif ($history->treatment_id != null)
                                        <a href="/service/treatmentplan" class="text-primary" style="text-decoration: underline;">Treatment</a>
                                    @elseif ($history->invoice_id != null)
                                        <a href="/finance" class="text-primary" style="text-decoration: underline;">Invoice</a>
                                    @endif
                                </td>
                                <td>{{ $history->nama }}</td>
                                @if ($history->status == "Hapus")
                                    <td class="text-danger">{{ $history->status }}</td>
                                @elseif ($history->status == "Tambah")
                                    <td class="text-success">{{ $history->status }}</td>
                                @elseif ($history->status == "Edit")
                                    <td class="text-primary">{{ $history->status }}</td>
                                @endif
                                <td>{{ $history->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mx-3">
                {{ $histories->links() }}
            </div>
        </div>
    </div>

@endsection