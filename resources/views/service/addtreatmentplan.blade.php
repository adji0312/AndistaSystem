@extends('main')
@section('container')

    <div class="wrapper">
        @include('service.menu')

        <div id="contents">
            <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">New Treatment Plan</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/service/treatmentplan" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="#" style="color: #f28123" onclick="saveTreatment()"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
                          </li>
                      </ul>
                      <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
                    </div>
                </div>
            </nav>

            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addTreatment" method="post">
                    @csrf
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Treatment Name</label>
                                
                                <input type="text" class="form-control" id="name" name="name" style="width: 300px">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" name="location_id">
                                    <option value="" class="selectstatus" style="color: black;" disabled selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Diagnosis</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" onchange="changeDiagnosis()" id="mySelectDiagnosis" name="diagnosis_id">
                                    <option value="" selected disabled class="selectstatus" style="color: black;">Select Diagnosis</option>
                                    @foreach ($diagnosis as $diagno)
                                        <option value="{{ $diagno->id }}" class="selectstatus" style="color: black;">{{ $diagno->diagnosis_name }}</option>
                                    @endforeach
                                    <option value="diagnosis" class="selectstatus" style="color: black;">+ Create New</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" hidden id="submitTreatment"></button>
                </form>
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
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="productList">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Services</option>
                    {{-- @foreach ($tasks as $task)
                        <option value="{{ $task->task_name }}" class="selectstatus" style="color: black;">{{ $task->task_name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="mb-3">
                {{-- <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label> --}}
                
                <input type="number" class="form-control" id="price" style="width: 100%" placeholder="Price" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">Day 1</option>
                    <option value="2" class="selectstatus" style="color: black;">Day 2</option>
                    <option value="3" class="selectstatus" style="color: black;">Day 3</option>
                    <option value="4" class="selectstatus" style="color: black;">Day 4</option>
                    <option value="5" class="selectstatus" style="color: black;">Day 5</option>
                    <option value="6" class="selectstatus" style="color: black;">Day 6</option>
                    <option value="7" class="selectstatus" style="color: black;">Day 7</option>
                    <option value="8" class="selectstatus" style="color: black;">Day 8</option>
                    <option value="9" class="selectstatus" style="color: black;">Day 9</option>
                    <option value="10" class="selectstatus" style="color: black;">Day 10</option>
                    <option value="11" class="selectstatus" style="color: black;">Day 11</option>
                    <option value="12" class="selectstatus" style="color: black;">Day 12</option>
                    <option value="13" class="selectstatus" style="color: black;">Day 13</option>
                    <option value="14" class="selectstatus" style="color: black;">Day 14</option>
                    <option value="15" class="selectstatus" style="color: black;">Day 15</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">Once per day</option>
                    <option value="2" class="selectstatus" style="color: black;">Twice per day</option>
                    <option value="3" class="selectstatus" style="color: black;">Thrice per day</option>
                    <option value="4" class="selectstatus" style="color: black;">Four times per day</option>
                    <option value="5" class="selectstatus" style="color: black;">Every 3 days</option>
                    <option value="6" class="selectstatus" style="color: black;">Once a week</option>
                    <option value="7" class="selectstatus" style="color: black;">Once every 2 weeks</option>
                    <option value="8" class="selectstatus" style="color: black;">Once every 4 weeks</option>
                    <option value="9" class="selectstatus" style="color: black;">Every 2 hours</option>
                    <option value="10" class="selectstatus" style="color: black;">Every 4 hours</option>
                    <option value="11" class="selectstatus" style="color: black;">Every 8 hours</option>
                    <option value="12" class="selectstatus" style="color: black;">Every 12 hours</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">1 Day</option>
                    <option value="2" class="selectstatus" style="color: black;">2 Day</option>
                    <option value="3" class="selectstatus" style="color: black;">3 Day</option>
                    <option value="4" class="selectstatus" style="color: black;">4 Day</option>
                    <option value="5" class="selectstatus" style="color: black;">5 Day</option>
                    <option value="6" class="selectstatus" style="color: black;">6 Day</option>
                    <option value="7" class="selectstatus" style="color: black;">7 Day</option>
                    <option value="8" class="selectstatus" style="color: black;">8 Day</option>
                    <option value="9" class="selectstatus" style="color: black;">9 Day</option>
                    <option value="10" class="selectstatus" style="color: black;">10 Day</option>
                    <option value="11" class="selectstatus" style="color: black;">11 Day</option>
                    <option value="12" class="selectstatus" style="color: black;">12 Day</option>
                    <option value="13" class="selectstatus" style="color: black;">13 Day</option>
                    <option value="14" class="selectstatus" style="color: black;">14 Day</option>
                    <option value="15" class="selectstatus" style="color: black;">15 Day</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                    <label for="notes">Notes</label>
                </div>
            </div>
            <div class="mb-3 float-end">
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>

        {{-- PRODUCT --}}
        <div class="offcanvas-body" id="productCanvas" style="display: none;">
            <label for="exampleInputEmail1" class="form-label mb-4" style="font-size: 15px; color: #000000; cursor: pointer;" onclick="backButtonInProduct()"><i class="fas fa-chevron-left"></i> Back</label>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Product</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="productList">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Product</option>
                    {{-- @foreach ($tasks as $task)
                        <option value="{{ $task->task_name }}" class="selectstatus" style="color: black;">{{ $task->task_name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label" style="font-size: 15px; color: #7C7C7C;">Quantity</label>
                
                <input type="number" class="form-control" id="quantity" style="width: 100%">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">Day 1</option>
                    <option value="2" class="selectstatus" style="color: black;">Day 2</option>
                    <option value="3" class="selectstatus" style="color: black;">Day 3</option>
                    <option value="4" class="selectstatus" style="color: black;">Day 4</option>
                    <option value="5" class="selectstatus" style="color: black;">Day 5</option>
                    <option value="6" class="selectstatus" style="color: black;">Day 6</option>
                    <option value="7" class="selectstatus" style="color: black;">Day 7</option>
                    <option value="8" class="selectstatus" style="color: black;">Day 8</option>
                    <option value="9" class="selectstatus" style="color: black;">Day 9</option>
                    <option value="10" class="selectstatus" style="color: black;">Day 10</option>
                    <option value="11" class="selectstatus" style="color: black;">Day 11</option>
                    <option value="12" class="selectstatus" style="color: black;">Day 12</option>
                    <option value="13" class="selectstatus" style="color: black;">Day 13</option>
                    <option value="14" class="selectstatus" style="color: black;">Day 14</option>
                    <option value="15" class="selectstatus" style="color: black;">Day 15</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">Once per day</option>
                    <option value="2" class="selectstatus" style="color: black;">Twice per day</option>
                    <option value="3" class="selectstatus" style="color: black;">Thrice per day</option>
                    <option value="4" class="selectstatus" style="color: black;">Four times per day</option>
                    <option value="5" class="selectstatus" style="color: black;">Every 3 days</option>
                    <option value="6" class="selectstatus" style="color: black;">Once a week</option>
                    <option value="7" class="selectstatus" style="color: black;">Once every 2 weeks</option>
                    <option value="8" class="selectstatus" style="color: black;">Once every 4 weeks</option>
                    <option value="9" class="selectstatus" style="color: black;">Every 2 hours</option>
                    <option value="10" class="selectstatus" style="color: black;">Every 4 hours</option>
                    <option value="11" class="selectstatus" style="color: black;">Every 8 hours</option>
                    <option value="12" class="selectstatus" style="color: black;">Every 12 hours</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example">
                    <option value="1" class="selectstatus" style="color: black;">1 Day</option>
                    <option value="2" class="selectstatus" style="color: black;">2 Day</option>
                    <option value="3" class="selectstatus" style="color: black;">3 Day</option>
                    <option value="4" class="selectstatus" style="color: black;">4 Day</option>
                    <option value="5" class="selectstatus" style="color: black;">5 Day</option>
                    <option value="6" class="selectstatus" style="color: black;">6 Day</option>
                    <option value="7" class="selectstatus" style="color: black;">7 Day</option>
                    <option value="8" class="selectstatus" style="color: black;">8 Day</option>
                    <option value="9" class="selectstatus" style="color: black;">9 Day</option>
                    <option value="10" class="selectstatus" style="color: black;">10 Day</option>
                    <option value="11" class="selectstatus" style="color: black;">11 Day</option>
                    <option value="12" class="selectstatus" style="color: black;">12 Day</option>
                    <option value="13" class="selectstatus" style="color: black;">13 Day</option>
                    <option value="14" class="selectstatus" style="color: black;">14 Day</option>
                    <option value="15" class="selectstatus" style="color: black;">15 Day</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                    <label for="notes">Notes</label>
                </div>
            </div>
            <div class="mb-3 float-end">
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>

        {{-- TASK --}}
        <div class="offcanvas-body" id="taskCanvas" style="display: none;">
            <label for="exampleInputEmail1" class="form-label mb-4" style="font-size: 15px; color: #000000; cursor: pointer;" onclick="backButtonInTask()"><i class="fas fa-chevron-left"></i> Back</label>
            <form action="/addPlan" method="post">
                @csrf
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
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Start Day</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="start_day">
                        <option value="1" class="selectstatus" style="color: black;">Day 1</option>
                        <option value="2" class="selectstatus" style="color: black;">Day 2</option>
                        <option value="3" class="selectstatus" style="color: black;">Day 3</option>
                        <option value="4" class="selectstatus" style="color: black;">Day 4</option>
                        <option value="5" class="selectstatus" style="color: black;">Day 5</option>
                        <option value="6" class="selectstatus" style="color: black;">Day 6</option>
                        <option value="7" class="selectstatus" style="color: black;">Day 7</option>
                        <option value="8" class="selectstatus" style="color: black;">Day 8</option>
                        <option value="9" class="selectstatus" style="color: black;">Day 9</option>
                        <option value="10" class="selectstatus" style="color: black;">Day 10</option>
                        <option value="11" class="selectstatus" style="color: black;">Day 11</option>
                        <option value="12" class="selectstatus" style="color: black;">Day 12</option>
                        <option value="13" class="selectstatus" style="color: black;">Day 13</option>
                        <option value="14" class="selectstatus" style="color: black;">Day 14</option>
                        <option value="15" class="selectstatus" style="color: black;">Day 15</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Frequency</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="frequency">
                        <option value="1" class="selectstatus" style="color: black;">Once per day</option>
                        <option value="2" class="selectstatus" style="color: black;">Twice per day</option>
                        <option value="3" class="selectstatus" style="color: black;">Thrice per day</option>
                        <option value="4" class="selectstatus" style="color: black;">Four times per day</option>
                        <option value="5" class="selectstatus" style="color: black;">Every 3 days</option>
                        <option value="6" class="selectstatus" style="color: black;">Once a week</option>
                        <option value="7" class="selectstatus" style="color: black;">Once every 2 weeks</option>
                        <option value="8" class="selectstatus" style="color: black;">Once every 4 weeks</option>
                        <option value="9" class="selectstatus" style="color: black;">Every 2 hours</option>
                        <option value="10" class="selectstatus" style="color: black;">Every 4 hours</option>
                        <option value="11" class="selectstatus" style="color: black;">Every 8 hours</option>
                        <option value="12" class="selectstatus" style="color: black;">Every 12 hours</option>
                    </select>
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Duration</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%" aria-label="Default select example" name="duration">
                        <option value="1" class="selectstatus" style="color: black;">1 Day</option>
                        <option value="2" class="selectstatus" style="color: black;">2 Day</option>
                        <option value="3" class="selectstatus" style="color: black;">3 Day</option>
                        <option value="4" class="selectstatus" style="color: black;">4 Day</option>
                        <option value="5" class="selectstatus" style="color: black;">5 Day</option>
                        <option value="6" class="selectstatus" style="color: black;">6 Day</option>
                        <option value="7" class="selectstatus" style="color: black;">7 Day</option>
                        <option value="8" class="selectstatus" style="color: black;">8 Day</option>
                        <option value="9" class="selectstatus" style="color: black;">9 Day</option>
                        <option value="10" class="selectstatus" style="color: black;">10 Day</option>
                        <option value="11" class="selectstatus" style="color: black;">11 Day</option>
                        <option value="12" class="selectstatus" style="color: black;">12 Day</option>
                        <option value="13" class="selectstatus" style="color: black;">13 Day</option>
                        <option value="14" class="selectstatus" style="color: black;">14 Day</option>
                        <option value="15" class="selectstatus" style="color: black;">15 Day</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" id="notes" style="height: 100px" name="notes"></textarea>
                        <label for="notes">Notes</label>
                    </div>
                </div>
                <div class="mb-3 float-end">
                    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Save</button>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      {{-- MODAL ADD NEW PHONE USAGE --}}
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
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection