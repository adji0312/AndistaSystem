<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/customer.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Customer</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationsdashboard" href="/customer" class="pt-3 nav-link"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
            </li>
            {{-- @dd(Auth::user()->role->customer_list) --}}
            @if(Auth::user()->role->customer_list != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/customer/list" class="pt-3 nav-link"><img src="/img/icon/booking.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Customer List</a>
            </li>
            @else
    
            @endif
            @if(Auth::user()->role->customer_list != 4)
            <li style="cursor: pointer; list-style: none;" class="nav-item">
                <a id="locationslist" href="/customer/bookinghistory" class="pt-3 nav-link"><img src="/img/icon/history.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Customer Booking History</a>
            </li>
            @else
    
            @endif
        </div>
    </div>
</nav>