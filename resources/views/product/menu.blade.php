<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/finance.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp;Product</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li style="cursor: pointer" class="{{ ($title === "Product Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/customer" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Product List") ? 'active' : '' }}">
            <a id="locationslist" href="/customer/list" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Product List</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Brand") ? 'active' : '' }}">
            <a id="locationslist" href="/customer/sublist" class="px-4"><img src="/img/icon/brand.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Brand</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Category") ? 'active' : '' }}">
            <a id="locationslist" href="/customer/sublist" class="px-4"><img src="/img/icon/category.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Category</a>
        </li>
        <li style="cursor: pointer" class="{{ ($title === "Suppliers") ? 'active' : '' }}">
            <a id="locationslist" href="/customer/sublist" class="px-4"><img src="/img/icon/supplier.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Suppliers</a>
        </li>
    </ul>
</nav> 