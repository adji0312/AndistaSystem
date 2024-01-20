<nav id="sidebars" style="border-right-style: solid; border-right-style: solid; border-width: 1px; border-color: #d3d3d3;">
    <div class="" style="border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
        <div class="sidebars-header mx-4" style="height: 75px;">
            <h3 class="pt-4" style="color: #7C7C7C;"> <img src="/img/icon/service.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Service</h3>
        </div>
    </div>
    <ul class="list-unstyled components">
        @if(Auth::user()->role->service_dashboard != 4)
        <li style="cursor: pointer" class="{{ ($title === "Service Dashboard") ? 'active' : '' }}">
            <a id="locationsdashboard" href="/service" class="px-4"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
        </li>
        @else 

        @endif
        @if(Auth::user()->role->service_list != 4)
        <li style="cursor: pointer" class="{{ ($title === "Service List") ? 'active' : '' }}">
            <a id="locationslist" href="/service/list" class="px-4"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Services List</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->service_treatment_plan != 4)
        <li style="cursor: pointer" class="{{ ($title === "Treatment Plan") ? 'active' : '' }}">
            <a id="locationslist" href="/service/treatmentplan" class="px-4"><img src="/img/icon/treatment.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Treatment Plan</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->service_category != 4)
        <li style="cursor: pointer" class="{{ ($title === "Service Category") ? 'active' : '' }}">
            <a id="locationsfacilities" href="/service/category" class="px-4"><img src="/img/icon/category.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Category</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->service_diagnosis != 4)
        <li style="cursor: pointer" class="{{ ($title === "Service Diagnosis") ? 'active' : '' }}">
            <a id="locationsfacilities" href="/service/diagnosis" class="px-4"><img src="/img/icon/diagnosis.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Diagnosis</a>
        </li>
        @else
        @endif

        @if(Auth::user()->role->service_policy != 4)
        <li style="cursor: pointer" class="{{ ($title === "Policy") ? 'active' : '' }}">
            <a id="locationsfacilities" href="/service/policy" class="px-4"><img src="/img/icon/policy.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Policy</a>
        </li>
        @else
        @endif
    </ul>
</nav>