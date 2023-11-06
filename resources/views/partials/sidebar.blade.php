<div class="wrapper">
    <nav id="sidebar" class="">

        <nav class="navbar navbar-expand-lg text-white" style="background-color: #f0f0f0;">
            <div class="mx-3">
                <i class="fas fa-bars fs-3" id="dismiss" style="cursor: pointer; color: #7C7C7C;"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a class="navbar-brand fs-3" style="color: #7C7C7C;" href="#">ANDISTA SYSTEM</a>
            </div>
        </nav>

        <ul class="list-unstyled components mt-4" style="color: #7C7C7C;">
            <li class="{{ ($title === "Home") ? 'active' : '' }}">
                <a href="/" class="px-4">
                    <img src="/img/icon/home.png" alt="" style="width: 22px"> <span class="mx-2">Home</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/calendar.png" alt="" style="width: 22px"> <span class="mx-2">Calendar</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/customer.png" alt="" style="width: 22px"> <span class="mx-2">Customer</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/staff.png" alt="" style="width: 22px"> <span class="mx-2">Staff</span>
                </a>
            </li>
            <li class="{{ ($title === "Service Dashboard") ? 'active' : '' }}">
                <a href="/service" class="px-4">
                    <img src="/img/icon/service.png" alt="" style="width: 22px"> <span class="mx-2">Service</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/product.png" alt="" style="width: 22px"> <span class="mx-2">Product</span>
                </a>
            </li>
            <li class="{{ ($title === "Location Dashboard" || $title === "Location List" || $title === "Facility" || $title === "Service Category" || $title === "Policy") ? 'active' : '' }}">
                <a href="/location" class="px-4">
                    <img src="/img/icon/location.png" alt="" style="width: 22px"> <span class="mx-2">Location</span>
                </a>
            </li>
            <li>
                <a href="/finance" class="px-4">
                    <img src="/img/icon/finance.png" alt="" style="width: 22px"> <span class="mx-2">Finance</span>
                </a>
            </li>
            <li>
                <a href="/attendance" class="px-4">
                    <img src="/img/icon/attendance.png" alt="" style="width: 22px"> <span class="mx-2">Attendance</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/reports.png" alt="" style="width: 22px"> <span class="mx-2">Reports</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/setting.png" alt="" style="width: 22px"> <span class="mx-2">Setting</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<div id="content">
    <nav class="navbar navbar-expand-lg text-white" style="background-color: #F28123;">
        <div class="mx-3">
            <i class="fas fa-bars fs-3" id="sidebarCollapse" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <a class="navbar-brand fs-3 text-white" href="#">ANDISTA SYSTEM</a>
        </div>
    </nav>

    @yield('container')
</div>

<div class="overlay"></div>
