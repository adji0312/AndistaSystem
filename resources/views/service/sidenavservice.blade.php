<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navside">
    <div class="container-fluid">
        <h3 class="pt-3" style="color: #7C7C7C;"> <img src="/img/icon/service.png" alt="" style="width: 32px">&nbsp;&nbsp;&nbsp; Service</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::user()->role->service_dashboard != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationsdashboard" href="/service" class="pt-3 nav-link"><img src="/img/icon/dashboard.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Dashboard</a>
                </li>
            @else
            @endif
            @if(Auth::user()->role->service_list != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/service/list" class="pt-3 nav-link"><img src="/img/icon/list.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Services List</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->service_treatment_plan != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationslist" href="/service/treatmentplan" class="pt-3 nav-link"><img src="/img/icon/treatment.png" alt="" style="width: 22px;">&nbsp;&nbsp;&nbsp; Treatment Plan</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->service_category != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationsfacilities" href="/service/category" class="pt-3 nav-link"><img src="/img/icon/category.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Category</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->service_diagnosis != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationsfacilities" href="/service/diagnosis" class="pt-3 nav-link"><img src="/img/icon/diagnosis.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Diagnosis</a>
                </li>
            @else
            @endif

            @if(Auth::user()->role->service_policy != 4)
                <li style="cursor: pointer; list-style: none;" class="nav-item">
                    <a id="locationsfacilities" href="/service/policy" class="pt-3 nav-link"><img src="/img/icon/policy.png" alt="" style="width: 22px">&nbsp;&nbsp;&nbsp; Policy</a>
                </li>
            @else
            @endif
        </div>
    </div>
</nav>