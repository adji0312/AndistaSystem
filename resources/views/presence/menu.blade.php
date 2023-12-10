<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/presence.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Presence</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        {{-- @dd((Auth::user()->role->absent != 4))
        @if(Auth::user()->role->absent != 4)
        <li style="cursor: pointer" class="{{ ($title === "Absent") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/presence" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Absent</a>
        </li>
        @else
        @endif --}}
        @if(Auth::user()->role->presence_today === 1 ||Auth::user()->role->presence_today === 2 ||Auth::user()->role->absent === 3  )
        <li style="cursor: pointer" class="{{ ($title === "Presence List") ? 'active' : '' }}">
            <a id="locationslist" href="/presence/list" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Presence Today</a>
        </li>
        @else
        @endif
    </ul>
</nav>