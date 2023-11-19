<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/reports.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Report</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li style="cursor: pointer" class="{{ ($title === "Product Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/Product" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; All Report</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Product List") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/list" class="px-4"><img src="/img/icon/booking.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Booking</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Product List") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/list" class="px-4"><img src="/img/icon/customer.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Customer</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Working Shift") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/workingshift" class="px-4"><img src="/img/icon/staff.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Staff</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/managestaff" class="px-4"><img src="/img/icon/service.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Service</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/managestaff" class="px-4"><img src="/img/icon/product.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/managestaff" class="px-4"><img src="/img/icon/location.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Location</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/managestaff" class="px-4"><img src="/img/icon/finance.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Finance</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Manage Staff") ? 'active' : '' }}">
            <a id="locationslist" href="/Product/managestaff" class="px-4"><img src="/img/icon/Product.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product</a>
        </li>
    </ul>
</nav>