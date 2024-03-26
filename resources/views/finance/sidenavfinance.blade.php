<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/finance.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Finance</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->dashboard_finance != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/finance" class="pt-3 nav-link"><img src="/img/icon/dashboard.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Dashboard Keuangan</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->sale_list != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/sale/list/paid" class="pt-3 nav-link"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Sale List Paid</a>
                </li>
            @else
            @endif
            
            @if(Auth::user()->role->sale_list != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/sale/list/unpaid" class="pt-3 nav-link"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Sale List Unpaid</a>
                </li>
            @else
            @endif
        </div>
    </div>
</nav>