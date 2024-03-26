<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/location.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Location List</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->dashboard_location != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationsdashboard" href="/location" class="pt-3 nav-link"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
            </li>
            @else

            @endif
            @if(Auth::user()->role->location_list != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/location/list" class="pt-3 nav-link"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Locations List</a>
            </li>
            @else

            @endif
            {{-- @if(Auth::user()->role->facilities != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationsfacilities" href="/facility" class="pt-3 nav-link"><img src="/img/icon/facilities.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Facilities</a>
            </li>
            @else
            @endif --}}
            @if(Auth::user()->role->setting_location != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationsfacilities" href="/location-setting" class="pt-3 nav-link"><img src="/img/icon/setting.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Setting Usage</a>
            </li>
            @else
            @endif
        </div>
    </div>
</nav>