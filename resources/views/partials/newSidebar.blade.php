<div class="wrapper">
    <nav id="sidebar" class="">

        <nav class="navbar navbar-expand-lg text-white" style="background-color: #f0f0f0;">
            <div class="mx-3">
                <i class="fas fa-bars fs-3" id="dismiss" style="cursor: pointer; color: #7C7C7C;"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a class="navbar-brand fs-3" style="color: #7C7C7C;" href="#">AmiTech</a>
            </div>
        </nav>

        <ul class="list-unstyled components mt-4" style="color: #7C7C7C;">
            <li class="{{ ($title === "Home") ? 'active' : '' }}">
                <a href="/" class="px-4">
                    <img src="/img/icon/home.png" alt="" style="width: 22px"> <span class="mx-2">Home</span>
                </a>
            </li>
            <li>
                <a href="/calendar" class="px-4">
                    <img src="/img/icon/calendar.png" alt="" style="width: 22px"> <span class="mx-2">Kalender</span>
                </a>
            </li>
            <li>
                <a href="/customer" class="px-4">
                    <img src="/img/icon/customer.png" alt="" style="width: 22px"> <span class="mx-2">Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="/staff" class="px-4">
                    <img src="/img/icon/staff.png" alt="" style="width: 22px"> <span class="mx-2">Karyawan</span>
                </a>
            </li>
            <li class="{{ ($title === "Service Dashboard") ? 'active' : '' }}">
                <a href="/service" class="px-4">
                    <img src="/img/icon/service.png" alt="" style="width: 22px"> <span class="mx-2">Service</span>
                </a>
            </li>
            <li>
                <a href="/product" class="px-4">
                    <img src="/img/icon/product.png" alt="" style="width: 22px"> <span class="mx-2">Product</span>
                </a>
            </li>
            <li class="{{ ($title === "Location Dashboard" || $title === "Location List" || $title === "Facility" || $title === "Service Category" || $title === "Policy") ? 'active' : '' }}">
                <a href="/location" class="px-4">
                    <img src="/img/icon/location.png" alt="" style="width: 22px"> <span class="mx-2">Lokasi</span>
                </a>
            </li>
            <li>
                <a href="/finance" class="px-4">
                    <img src="/img/icon/finance.png" alt="" style="width: 22px"> <span class="mx-2">Keuangan</span>
                </a>
            </li>
            <li>
                <a href="/attendance" class="px-4">
                    <img src="/img/icon/attendance.png" alt="" style="width: 22px"> <span class="mx-2">Kehadiran</span>
                </a>
            </li>
            {{-- ini nanti khusus admin sm super user aja --}}
            <li>
                <a href="/presence" class="px-4">
                    <img src="/img/icon/presence.png" alt="" style="width: 22px"> <span class="mx-2">Absen</span>
                </a>
            </li>
            <li>
                <a href="/report" class="px-4">
                    <img src="/img/icon/reports.png" alt="" style="width: 22px"> <span class="mx-2">Laporan</span>
                </a>
            </li>
            {{-- <li>
                <a href="#" class="px-4">
                    <img src="/img/icon/setting.png" alt="" style="width: 22px"> <span class="mx-2">Setting</span>
                </a>
            </li> --}}
        </ul>
    </nav>
</div>
<div id="content">
    <nav class="navbar navbar-expand-lg text-white d-flex justify-content-between" style="background-color: #F28123;">
        <div class="mx-3">
            <div>
                <i class="fas fa-bars fs-3" id="sidebarCollapse" style="cursor: pointer;"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a class="navbar-brand fs-3 text-white" href="#">AmiTech</a>
            </div>
        </div>
        <div class="mx-3">
            <div class="dropdown">
                <button class="btn text-white" style="background-color: transparent; outline: none;" type="button" data-bs-toggle="dropdown">
                    <img src="/img/icon/profile.png" alt="" style="width: 22px"> {{ Auth::user()->first_name }} - Profile
                </button>
                {{-- <a class="navbar-brand fs-5 text-white" href="/profile" data-bs-toggle="dropdown"><img src="/img/icon/profile.png" alt="" style="width: 22px"> Profile</a> --}}
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/profile">My Account</a></li>
                  <li><a class="dropdown-item" href="/qr-attendance">Attendace</a><li>
                  <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>
            {{-- <div>
                <a class="navbar-brand fs-5 text-white" href="/profile"><img src="/img/icon/profile.png" alt="" style="width: 22px"> Profile</a>
            </div> --}}
        </div>
    </nav>

    @yield('container')
</div>

<div class="overlay"></div>
