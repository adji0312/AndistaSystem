<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/reports.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Report</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::user()->role->reports_all != 4)
        <li style="cursor: pointer" class="active">
            <a id="locationsdashboard" href="/report" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Sale Report</a>
        </li>
        @else
        @endif
        @if(Auth::user()->role->reports_booking != 4)
        <li style="cursor: pointer" class="{{ ($title === "Attendance List") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/list" class="px-4"><img src="/img/icon/booking.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Booking</a>
        </li>
        @else
        @endif
        {{-- <li style="cursor: pointer" class="{{ ($title === "Attendance List") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/list" class="px-4"><img src="/img/icon/customer.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Customer</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Working Shift") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/workingshift" class="px-4"><img src="/img/icon/staff.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Staff</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/service.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Service</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/product.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/location.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Location</a>
        </li> --}}
        @if(Auth::user()->role->reports_finance != 4)
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/finance.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Finance</a>
        </li>
        @else
        @endif
        {{-- <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/attendance.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Attendance</a>
        </li> --}}
    </ul>
</nav>