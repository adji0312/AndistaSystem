<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/product.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Product</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->product_dashboard != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/product/list" class="pt-3 nav-link"><img src="/img/icon/StaffList.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product List</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->product_brand != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/product/brand" class="pt-3 nav-link"><img src="/img/icon/position.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Brand</a>
                </li>
            @else
            @endif
            
            @if(Auth::user()->role->product_category != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/product/category" class="pt-3 nav-link"><img src="/img/icon/WorkingHours.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Category</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->product_suppliers != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/product/suppliers" class="pt-3 nav-link"><img src="/img/icon/AccessControl.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Suppliers</a>
                </li>
            @else
            @endif
        </div>
    </div>
</nav>