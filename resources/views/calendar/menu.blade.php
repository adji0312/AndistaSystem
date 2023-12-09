<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/calendar.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Calendar</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::user()->role->calendar_create_booking != 4)
        <li style="cursor: pointer" class="{{ ($title === "Booking") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/newBooking" class="px-4"><img src="/img/icon/plusgrey.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Create Booking</a>
        </li>
        @else

        @endif
        {{-- <li style="cursor: pointer" class="{{ ($title === "List Booking") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/list-booking" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; List Booking</a>
        </li> --}}

        @if(Auth::user()->role->calendar_list_booking != 4)
        <li style="cursor: pointer" class="{{ ($title === "Sale List Paid" || $title === "Sale List Unpaid") ? 'active' : '' }}">
            <a id="locationslist" class="dropdown-toggle px-4" data-bs-toggle="dropdown">
                <img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; List Booking
            </a>
            <ul class="dropdown-menu mx-3">
                <li><a class="dropdown-item {{ ($title === "Sale List Unpaid") ? 'active' : '' }}" href="/sale/list/unpaid">Darurat</a></li>
                <li><a class="dropdown-item {{ ($title === "Sale List Paid") ? 'active' : '' }}" href="/sale/list/paid">Langsung Datang</a></li>
                <li><a class="dropdown-item {{ ($title === "Sale List Unpaid") ? 'active' : '' }}" href="/sale/list/unpaid">Rawat Inap</a></li>
            </ul>
        </li>
        @else

        @endif
    </ul>
</nav>