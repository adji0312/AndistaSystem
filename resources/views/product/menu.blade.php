<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/staff.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Product</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        {{-- <li style="cursor: pointer" class="{{ ($title === "Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/product" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li> --}}
        @if(Auth::user()->role->product_dashboard != 4)
        <li style="cursor: pointer" class="{{ ($title === "Product List") ? 'active' : '' }}">
            <a id="locationslist" href="/product/list" class="px-4"><img src="/img/icon/StaffList.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product List</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->product_brand != 4)
        <li style="cursor: pointer" class="{{ ($title === "Brand") ? 'active' : '' }}">
            <a id="locationslist" href="/product/brand" class="px-4"><img src="/img/icon/position.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Brand</a>
        </li>
        @else
        @endif
        
        @if(Auth::user()->role->product_category != 4)
        <li style="cursor: pointer" class="{{ ($title === "Category") ? 'active' : '' }}">
            <a id="locationslist" href="/product/category" class="px-4"><img src="/img/icon/WorkingHours.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Category</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->product_suppliers != 4)
        <li style="cursor: pointer" class="{{ ($title === "Suppliers") ? 'active' : '' }}">
            <a id="locationslist" href="/product/suppliers" class="px-4"><img src="/img/icon/AccessControl.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Suppliers</a>
        </li>
        @else
        @endif
    </ul>
</nav> 