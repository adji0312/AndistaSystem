<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/home.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Dashboard</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li style="cursor: pointer" class="{{ ($title === "Home") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/" class="px-4"><img src="/img/icon/overview.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Overview</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Upcoming Booking") ? 'active' : '' }}">
            <a id="locationslist" href="/upcoming-booking" class="px-4"><img src="/img/icon/upcoming.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Upcoming Booking</a>
        </li>
    </ul>
</nav>