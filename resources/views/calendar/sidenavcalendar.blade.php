<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/calendar.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Kalender</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->calendar_create_booking != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/calendar" class="pt-3 nav-link"><img src="/img/icon/calendar.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Kalender</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->calendar_create_booking != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/newBooking" class="pt-3 nav-link"><img src="/img/icon/plusgrey.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Buat Booking</a>
                </li>
            @else
            @endif
            
            @if(Auth::user()->role->calendar_list_booking != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $darurat = App\Models\SubBook::all()->where('category', 2)->where('status', 1); ?>
                    <a id="locationslist" href="/booking/darurat" class="pt-3 nav-link"><img src="/img/icon/darurat.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Darurat ({{ count($darurat) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $terjadwal = App\Models\SubBook::all()->where('category', 3); ?>
                    <a id="locationslist" href="/booking/terjadwal" class="pt-3 nav-link"><img src="/img/icon/terjadwal.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Terjadwal ({{ count($terjadwal) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $ranap = App\Models\SubBook::all()->where('status', 5)->where('ranap', 1); ?>
                    <a id="locationslist" href="/booking/rawatinap" class="pt-3 nav-link"><img src="/img/icon/rawatinap.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Rawat Inap ({{ count($ranap) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $kedatangan = App\Models\SubBook::all()->where('status', 1)->where('category', '!=', 3); ?>
                    <a id="locationslist" href="/booking/kedatangan" class="pt-3 nav-link"><img src="/img/icon/kedatangan.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Kedatangan ({{ count($kedatangan) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $memulai = App\Models\SubBook::all()->where('status', 2); ?>
                    <a id="locationslist" href="/booking/memulai" class="pt-3 nav-link"><img src="/img/icon/memulai.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Memulai ({{ count($memulai) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $apotek = App\Models\SubBook::all()->where('status', 3); ?>
                    <a id="locationslist" href="/booking/apotek" class="pt-3 nav-link"><img src="/img/icon/apotek.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Apotek ({{ count($apotek) }})</a>
                </li>
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <?php $selesai = App\Models\SubBook::where('status', 4)->orWhere('ranap', 2)->get(); ?>
                    <a id="locationslist" href="/booking/selesai" class="pt-3 nav-link"><img src="/img/icon/selesai.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Selesai ({{ count($selesai) }})</a>
                </li>
            @else
            @endif
        </div>
    </div>
</nav>