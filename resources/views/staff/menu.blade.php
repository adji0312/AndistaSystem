<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/staff.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Staff</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li style="cursor: pointer" class="{{ ($title === "Staff Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/staff" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Staff List") ? 'active' : '' }}">
            <a id="locationslist" href="/staff/list" class="px-4"><img src="/img/icon/StaffList.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Staff List</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Position") ? 'active' : '' }}">
            <a id="locationslist" href="/staff/position" class="px-4"><img src="/img/icon/position.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Job</a>
        </li>
        {{-- <li style="cursor: pointer" class="{{ ($title === "Working Hours") ? 'active' : '' }}">
            <a id="locationslist" href="/staff/working-hours" class="px-4"><img src="/img/icon/WorkingHours.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Working Hours</a>
        </li> --}}
        <li style="cursor: pointer" class="{{ ($title === "Access Control") ? 'active' : '' }}">
            <a id="locationslist" href="/staff/access-control-new" class="px-4"><img src="/img/icon/AccessControl.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Access Control</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Security Groups") ? 'active' : '' }}">
            <a id="locationslist" href="/staff/security-groups" class="px-4"><img src="/img/icon/SecurityGroup.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Security Groups</a>
        </li>
    </ul>
</nav>