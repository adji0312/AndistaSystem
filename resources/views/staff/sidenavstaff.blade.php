<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/service.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Staff List</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->staff_staff_list != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/staff/list" class="pt-3 nav-link"><img src="/img/icon/StaffList.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Staff List</a>
                </li>
            @else
            @endif
            @if(Auth::user()->role->staff_job != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/staff/position" class="pt-3 nav-link"><img src="/img/icon/position.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Job</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->staff_access_control != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/staff/access-control-new" class="pt-3 nav-link"><img src="/img/icon/AccessControl.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Access Control</a>
                </li>
            @else
            @endif
        </div>
    </div>
</nav>