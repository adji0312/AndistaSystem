<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/service.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Kehadiran</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->dashboard_attendance != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationsdashboard" href="/attendance" class="pt-3 nav-link"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
            </li>
            @else

            @endif
            @if(Auth::user()->role->attendance_list != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/attendance/list" class="pt-3 nav-link"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Data Kehadiran</a>
            </li>
            @else

            @endif
            @if(Auth::user()->role->working_shift != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/attendance/workingshift" class="pt-3 nav-link"><img src="/img/icon/shift.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Jam Kerja</a>
            </li>
            @else

            @endif
            @if(Auth::user()->role->manage_staff_shift != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/attendance/managestaff" class="pt-3 nav-link"><img src="/img/icon/manageuser.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Atur Shift Karyawan</a>
            </li>
            @else

            @endif

            @if(Auth::user()->role->manage_staff_shift != 4)
            {{-- <li style="cursor: pointer" class="{{ ($title === "Manage Day Off") ? 'active' : '' }}">
                <a id="locationslist" href="/attendance/managedayoff" class="pt-3 nav-link"><img src="/img/icon/holiday.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Manage Day Off</a>
            </li> --}}
            @else

            @endif
        </div>
    </div>
</nav>