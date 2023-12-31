<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/attendance.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Kehadiran</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::user()->role->dashboard_attendance != 4)
        <li style="cursor: pointer" class="{{ ($title === "Attendance Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/attendance" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li>
        @else

        @endif
        @if(Auth::user()->role->attendance_list != 4)
        <li style="cursor: pointer" class="{{ ($title === "Attendance List") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/list" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Data Kehadiran</a>
        </li>
        @else

        @endif
        @if(Auth::user()->role->working_shift != 4)
        <li style="cursor: pointer" class="{{ ($title === "Working Shift") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/workingshift" class="px-4"><img src="/img/icon/shift.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Jam Kerja</a>
        </li>
        @else

        @endif
        @if(Auth::user()->role->manage_staff_shift != 4)
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managestaff" class="px-4"><img src="/img/icon/manageuser.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Atur Shift Karyawan</a>
        </li>
        @else

        @endif

        @if(Auth::user()->role->manage_staff_shift != 4)
        {{-- <li style="cursor: pointer" class="{{ ($title === "Manage Day Off") ? 'active' : '' }}">
            <a id="locationslist" href="/attendance/managedayoff" class="px-4"><img src="/img/icon/holiday.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Manage Day Off</a>
        </li> --}}
        @else

        @endif
    </ul>
</nav>