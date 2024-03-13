<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/calendar.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Kalender</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::user()->role->calendar_create_booking != 4)
        <li style="cursor: pointer" class="{{ ($title === "Calendar") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/calendar" class="px-4"><img src="/img/icon/calendar.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Kalender</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Booking") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/newBooking" class="px-4"><img src="/img/icon/plusgrey.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Buat Booking</a>
        </li>
        {{-- <li style="cursor: pointer" class="{{ ($title === "List Booking") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/list-booking" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Daftar Booking</a>
        </li> --}}
        <li style="cursor: pointer" class="{{ ($title === "Darurat") ? 'active' : '' }}">
            <?php $darurat = App\Models\SubBook::all()->where('category', 2)->where('status', 1); ?>
            <a id="locationsdashboard" href="/booking/darurat" class="px-4"><img src="/img/icon/darurat.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Darurat ({{ count($darurat) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Terjadwal") ? 'active' : '' }}">
            <?php $terjadwal = App\Models\SubBook::all()->where('category', 3); ?>
            <a id="locationsdashboard" href="/booking/terjadwal" class="px-4"><img src="/img/icon/terjadwal.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Terjadwal ({{ count($terjadwal) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Rawat Inap") ? 'active' : '' }}">
            <?php $ranap = App\Models\SubBook::all()->where('status', 5)->where('ranap', 1); ?>
            <a id="locationsdashboard" href="/booking/rawatinap" class="px-4"><img src="/img/icon/rawatinap.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Rawat Inap ({{ count($ranap) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Kedatangan") ? 'active' : '' }}">
            <?php $kedatangan = App\Models\SubBook::all()->where('status', 1)->where('category', '!=', 3); ?>
            <a id="locationsdashboard" href="/booking/kedatangan" class="px-4"><img src="/img/icon/kedatangan.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Kedatangan ({{ count($kedatangan) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Memulai") ? 'active' : '' }}">
            <?php $memulai = App\Models\SubBook::all()->where('status', 2); ?>
            <a id="locationsdashboard" href="/booking/memulai" class="px-4"><img src="/img/icon/memulai.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Memulai ({{ count($memulai) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Apotek") ? 'active' : '' }}">
            <?php $apotek = App\Models\SubBook::all()->where('status', 3); ?>
            <a id="locationsdashboard" href="/booking/apotek" class="px-4"><img src="/img/icon/apotek.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Apotek ({{ count($apotek) }})</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Selesai") ? 'active' : '' }}">
            <?php $selesai = App\Models\SubBook::where('status', 4)->orWhere('ranap', 2)->get(); ?>
            <a id="locationsdashboard" href="/booking/selesai" class="px-4"><img src="/img/icon/selesai.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Selesai ({{ count($selesai) }})</a>
        </li>
        @else

        @endif
    </ul>
</nav>