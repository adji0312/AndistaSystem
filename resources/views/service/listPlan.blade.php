@extends('main')
@section('container')

<div class="wrapper">
    @include('service.menu')

    <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Treatment Plan for {{ $plan->name }}</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/service/treatmentplan" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                    </li>
                    @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: #f28123" onclick="saveTreatment()"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
                    </li>
                    @else
                    @endif
                  </ul>
                  <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <form action="/updateTreatment/{{ $plan->id }}" method="post">
                @csrf
                <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                    <h5 class="m-3">Basic Info</h5>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Treatment Name</label>
                            <input type="text" class="form-control" id="name" name="name" style="width: 300px" value="{{ $plan->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="location_id" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="location_id" id="location_id">
                                <option value="{{ $plan->location->id }}" class="selectstatus" style="color: black;" selected>{{ $plan->location->location_name }}</option>
                                @foreach ($locations as $location)
                                    @if ($location->id == $plan->location->id)
                                        @continue
                                    @endif
                                    <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="m-3 d-flex gap-5">
                        <div class="mb-3">
                            <label for="mySelectDiagnosis" class="form-label" style="font-size: 15px; color: #7C7C7C;">Diagnosis</label>
                            <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" onchange="changeDiagnosis()" id="mySelectDiagnosis" name="diagnosis_id">
                                <option value="{{ $plan->diagnosis->id }}" selected class="selectstatus" style="color: black;">{{ $plan->diagnosis->diagnosis_name }}</option>
                                @foreach ($diagnosis as $diagno)
                                    @if ($diagno->id == $plan->diagnosis->id)
                                        @continue
                                    @endif
                                    <option value="{{ $diagno->id }}" class="selectstatus" style="color: black;">{{ $diagno->diagnosis_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration Treatment (days)</label>
                            <input type="number" class="form-control" id="duration" name="duration" style="width: 300px" value="{{ $plan->duration }}">
                        </div>
                    </div>
                </div>

                <button type="submit" hidden id="submitTreatment"></button>
            </form>
        </div>

        <div id="dashboard" class="mx-3 mt-4">
            <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <div class="d-flex">
                    <h5 class="m-3">Treatment List</h5>
                    @if(Auth::user()->role->service_policy === 1|Auth::user()->role->service_policy === 2)
                    <a class="nav-link active m-3" aria-current="page" data-bs-toggle="offcanvas" data-bs-target="#addItemCanvas" aria-controls="addItemCanvas" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> Item</a>
                    @else
                    @endif
                </div>
                <div class="m-3">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Item Name</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_plans as $list)
                                @if ($list->temp == 1)
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <div class="d-flex gap-3">
                                                    @if ($list->service_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateServiceCanvas{{ $list->id }}" aria-controls="updateServiceCanvas">
                                                            {{ $list->service->service_name }}
                                                        </small>
                                                    @elseif ($list->product_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateProductCanvas{{ $list->id }}" aria-controls="updateProductCanvas">
                                                            {{ $list->products->product_name }}
                                                        </small>
                                                    @elseif ($list->task_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateTaskCanvas{{ $list->id }}" aria-controls="updateTaskCanvas">
                                                            {{ $list->task->task_name }}
                                                        </small>
                                                    @endif
                                                    @if(Auth::user()->role->service_treatment_plan === 1)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteList{{ $list->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    @else
                                                    @endif
                                                </div>
                                                @if ($list->duration == 0 && $list->frequency_id == 0)
                                                    <small style="font-weight: 500; font-size: 15px;">Frequency : 0</small> <br>
                                                @else
                                                    <small style="font-weight: 500; font-size: 15px;">{{ $list->frequency->frequency_name }} for {{ $list->duration }} days</small> <br> 
                                                @endif
                                                <small style="font-weight: 500; font-size: 15px;">
                                                    @if ($list->start_day == 0)
                                                        Start Day : 0
                                                    @else
                                                        Start Day : {{ $list->start_day }}
                                                    @endif
                                                </small> <br>
                                                <small style="font-weight: 500; font-size: 15px;">
                                                    @if ($list->duration == 0)
                                                        Duration : 0
                                                    @else
                                                        Duration : {{ $list->duration }}
                                                    @endif
                                                </small> <br>
                                                @if ($list->product_id != 0)
                                                    <small style="font-weight: 500; font-size: 15px;">
                                                        Quantity : {{ $list->quantity }}
                                                    </small> <br>
                                                @endif
                                                @if ($list->service_id != 0)
                                                    <small style="font-weight: 500; font-size: 15px;">Price : 0</small> <br>
                                                @endif
                                                @if ($list->product_id != 0)
                                                    <small style="font-weight: 500; font-size: 15px;">Price : Rp {{ number_format($list->products->price * $list->quantity) }}</small> <br>
                                                @endif
                                                @if ($list->notes != null || $list->notes != '')
                                                    <small style="font-weight: 500">notes : {{ $list->notes }}</small>
                                                @else
                                                    <small style="font-weight: 500">notes : - </small>
                                                @endif
                                            </div>
                                        </th>
                                    </tr>
                                @else
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <div class="d-flex gap-3">
                                                    @if ($list->service_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateServiceCanvas{{ $list->id }}" aria-controls="updateServiceCanvas">
                                                            {{ $list->service->service_name }}
                                                        </small>
                                                    @elseif ($list->product_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateProductCanvas{{ $list->id }}" aria-controls="updateProductCanvas">
                                                            {{ $list->products->product_name }}
                                                        </small>
                                                    @elseif ($list->task_id != 0)
                                                        <small style="font-size: 17px; cursor: pointer" class="text-primary" data-bs-toggle="offcanvas" data-bs-target="#updateTaskCanvas{{ $list->id }}" aria-controls="updateTaskCanvas">
                                                            {{ $list->task->task_name }}
                                                        </small>
                                                    @endif
                                                    @if(Auth::user()->role->service_treatment_plan === 1)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteList{{ $list->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    @else
                                                    @endif
                                                </div>
                                                <small style="font-weight: 500; font-size: 15px;">Frequency : {{ $list->frequency->frequency_name }}</small> <br>
                                                <small style="font-weight: 500; font-size: 15px;">Start Day : {{ $list->start_day }}</small> <br>
                                                <small style="font-weight: 500; font-size: 15px;">Duration : {{ $list->duration }} days</small> <br>
                                                <small style="font-weight: 500; font-size: 15px;">Quantity : {{ $list->quantity }}</small> <br>
                                                
                                                @if ($list->service_id != 0)
                                                    <small style="font-weight: 500; font-size: 15px;">Price: {{  $list->servicePrice->price_title }} {{ $list->servicePrice->duration }} {{ $list->servicePrice->duration_type }} (Rp {{ number_format($list->servicePrice->price) }})</small> <br>
                                                @endif
                                                @if ($list->product_id != 0)
                                                    <small style="font-weight: 500; font-size: 15px;">Price : Rp {{ number_format($list->products->price * $list->quantity) }}</small> <br>
                                                @endif
                                                @if ($list->notes != null || $list->notes != '')
                                                    <small style="font-weight: 500; font-size: 15px;">Notes : {{ $list->notes }}</small>
                                                @else
                                                    <small style="font-weight: 500; font-size: 15px;">Notes : - </small>
                                                @endif
                                                
                                            </div>
                                        </th>
                                    </tr>
                                @endif
                                
                                {{-- modal delete list plan --}}
                                <div class="modal fade" id="deleteList{{ $list->id }}" value="{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                        </div>
                                        <form action="/deleteItem/{{ $list->id }}" method="GET">
                                            @csrf
                                            <div class="modal-body">
                                            <small class="fs-6" style="font-weight: 300">Are you sure delete this item?</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                                @if(Auth::user()->role->service_treatment_plan === 1)
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                                @else
                                                @endif
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                </div>

                                {{-- modal edit task list --}}
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="updateTaskCanvas{{ $list->id }}" aria-labelledby="rightCanvasId">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="rightCanvasId">Edit Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body" style="display: block;">
                                        <form action="/editTaskPlan/{{ $list->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Task</label>
                                                @if ($list->task_id != 0)
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $list->task->task_name }}" readonly>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                                                @if ($list->start_day == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->start_day)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                                                @if ($list->frequency_id == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            @if ($frequency->id == $list->frequency_id)
                                                                <option selected value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                                                @if ($list->duration == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->duration)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    @if ($list->temp == 1)
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                                                        <label for="notes">Notes</label>
                                                    @else
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes">{{ $list->notes }}</textarea>
                                                        <label for="notes">Notes</label>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                                            <div class="mb-3 float-end">
                                                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                                            </div>
                                            @else
                                            @endif
                                        </form>
                                    </div>
                                </div>

                                {{-- modal edit product list --}}
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="updateProductCanvas{{ $list->id }}" aria-labelledby="rightCanvasId">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="rightCanvasId">Edit Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body" style="display: block;">
                                        <form action="/editProductPlan/{{ $list->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Task</label>
                                                @if ($list->product_id != 0)
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $list->products->product_name }}" readonly>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                                                @if ($list->start_day == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->start_day)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                                                @if ($list->frequency_id == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            @if ($frequency->id == $list->frequency_id)
                                                                <option selected value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                                                @if ($list->duration == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->duration)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                                                <input type="number" class="form-control" name="quantity" value="{{ $list->quantity }}">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    @if ($list->temp == 1)
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                                                        <label for="notes">Notes</label>
                                                    @else
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes">{{ $list->notes }}</textarea>
                                                        <label for="notes">Notes</label>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                                            <div class="mb-3 float-end">
                                                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                                            </div>
                                            @else
                                            @endif
                                        </form>
                                    </div>
                                </div>

                                {{-- modal edit service list --}}
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="updateServiceCanvas{{ $list->id }}" aria-labelledby="rightCanvasId">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="rightCanvasId">Edit Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                
                                    <div class="offcanvas-body" style="display: block;">
                                        <form action="/editServicePlan/{{ $list->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service</label>
                                                @if ($list->service_id != 0)
                                                    <input type="text" class="form-control" value="{{ $list->service->service_name }}" readonly>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Price</label>
                                                @if ($list->service_price_id == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="service_price_id" name="service_price_id" required>
                                                        <option value="" class="selectstatus" style="color: black;" selected disabled>Select Price</option>
                                                        @foreach ($servicePrice->where('service_id', $list->service_id) as $sp)
                                                            <option value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->price_title }} {{ $sp->duration }} {{ $sp->duration_type }} (Rp {{ number_format($sp->price) }})</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="service_price_id" name="service_price_id">
                                                        @foreach ($servicePrice->where('service_id', $list->service_id) as $sp)
                                                            @if ($sp->id == $list->service_price_id)
                                                                <option selected value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->price_title }} {{ $sp->duration }} {{ $sp->duration_type }} (Rp {{ number_format($sp->price) }})</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $sp->id }}" class="selectstatus" style="color: black;">{{ $sp->price_title }} {{ $sp->duration }} {{ $sp->duration_type }} (Rp {{ number_format($sp->price) }})</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                                                @if ($list->start_day == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->start_day)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">Day {{ $index1 }}</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                                                @if ($list->frequency_id == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>                                                    
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency_id">
                                                        @foreach ($frequencies as $frequency)
                                                            @if ($frequency->id == $list->frequency_id)
                                                                <option selected value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $frequency->id }}" class="selectstatus" style="color: black;">{{ $frequency->frequency_name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                                                @if ($list->duration == 0)
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @else
                                                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                                                        @for ($index1 = 1; $index1 <= $plan->duration; $index1++)
                                                            @if ($index1 == $list->duration)
                                                                <option selected value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                                @continue;
                                                            @endif
                                                            <option value="{{ $index1 }}" class="selectstatus" style="color: black;">{{ $index1 }} Day</option>
                                                        @endfor
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    @if ($list->temp == 1)
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                                                        <label for="notes">Notes</label>
                                                    @else
                                                        <textarea class="form-control" id="notes" style="height: 100px" name="notes">{{ $list->notes }}</textarea>
                                                        <label for="notes">Notes</label>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                                            <div class="mb-3 float-end">
                                                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                                            </div>
                                            @else
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('successAddTask'))
    <button type="button" id="openCanvas" data-bs-toggle="offcanvas" data-bs-target="#addItemCanvas" aria-controls="addItemCanvas" hidden class="btn-close"></button>
@endif

<div class="offcanvas offcanvas-end" tabindex="-1" id="addItemCanvas" aria-labelledby="rightCanvasId">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="rightCanvasId">Add Item</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="mainCanvas" style="display: block;">
      <div class="d-flex flex-column gap-4">
        <button type="button" class="btn btn-outline-primary" id="serviceButton" onclick="serviceClick()">Service</button>
        <button type="button" class="btn btn-outline-primary" id="productButton" onclick="productClick()">Product</button>
        <button type="button" class="btn btn-outline-primary" id="taskButton" onclick="taskClick()">Task</button>
      </div>
    </div>

    {{-- SERVICE --}}
    <div class="offcanvas-body" id="serviceCanvas" style="display: none;">
        <label for="exampleInputEmail1" class="form-label mb-4" style="font-size: 15px; color: #000000; cursor: pointer;" onclick="backButtonInService()"><i class="fas fa-chevron-left"></i> Back</label>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service</label>
            <form action="/addServicePlan" method="POST">
                @csrf
                <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">
                <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="service_id" name="service_id">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Services</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" class="selectstatus" style="color: black;" data-bs-toggle="modal" name="service_id" id="service_id" data-bs-target="#serviceList{{ $service->id }}">{{ $service->service_name }}</option>
                    @endforeach
                </select>
                <input type="submit" hidden name="" id="submitService">
            </form>
        </div>
        <div class="mb-3 float-end">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="continueService()">Next</button>
        </div>
    </div>

    {{-- PRODUCT --}}
    <div class="offcanvas-body" id="productCanvas" style="display: none;">
        <label for="exampleInputEmail1" class="form-label mb-4" style="font-size: 15px; color: #000000; cursor: pointer;" onclick="backButtonInProduct()"><i class="fas fa-chevron-left"></i> Back</label>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Product</label>
            <form action="/addProductPlan" method="POST">
                @csrf
                <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">
                <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="product_id" name="product_id">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" class="selectstatus" style="color: black;" data-bs-toggle="modal" name="product_id" id="product_id" >{{ $product->product_name }}</option>
                    @endforeach
                </select>
                <button type="submit" hidden id="submitProduct"></button>
            </form>
        </div>
        <div class="mb-3 float-end">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="continueProduct()">Next</button>
        </div>
    </div>

    {{-- TASK --}}
    <div class="offcanvas-body" id="taskCanvas" style="display: none;">
        <label for="exampleInputEmail1" class="form-label mb-4" style="font-size: 15px; color: #000000; cursor: pointer;" onclick="backButtonInTask()"><i class="fas fa-chevron-left"></i> Back</label>
        <form action="/addTaskPlan" method="post">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            <input type="hidden" name="plan_name" value="{{ $plan->name }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Task</label>
                <input type="hidden" name="service_id" value="0">
                <input type="hidden" name="product_id" value="0">
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="taskList" onchange="taskChange()" name="task_id">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Task</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}" name="task_id" id="task_id" class="selectstatus" style="color: black;">{{ $task->task_name }}</option>
                    @endforeach
                        <option value="newtask" class="selectstatus" style="color: black;">+ Create New</option>
                </select>
            </div>
            <div class="mb-3 float-end">
                <button type="submit" class="btn btn-outline-primary btn-sm">Next</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="newtask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
        </div>
        <form action="/addTask" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-1">
                    <input type="text" class="form-control mt-1" id="task_name" name="task_name" placeholder="Task Name">
                    <input type="hidden" name="name" value="{{ $plan->name }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                @else
                @endif
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- MODAL ADD NEW DIAGNOSIS --}}
  <div class="modal fade" id="diagnosisName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Diagnosis</h1>
        </div>
        <form action="/addDiagnosis" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-1">
                    <input type="text" class="form-control mt-1" id="diagnosis_name" name="diagnosis_name" placeholder="Name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                @if(Auth::user()->role->service_treatment_plan === 1|Auth::user()->role->service_treatment_plan === 2)
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                @else
                @endif
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    function continueService(){
        document.getElementById('submitService').click();
    }
    function continueProduct(){
        document.getElementById('submitProduct').click();
    }
</script>
@endsection