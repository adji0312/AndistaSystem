<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/location.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Location</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li style="cursor: pointer" class="{{ ($title === "Location Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/location" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Location List") ? 'active' : '' }}">
            <a id="locationslist" href="/location/list" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Locations List</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Facility") ? 'active' : '' }}">
            <a id="locationsfacilities" href="/facility" class="px-4"><img src="/img/icon/facilities.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Facilities</a>
        </li>
    </ul>
</nav>