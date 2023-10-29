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
                              <a class="nav-link active" aria-current="page" href="/service/list/add" style="color: #f28123"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
                <form action="">
                    <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <h5 class="m-3">Basic Info</h5>
                        <div class="m-3 d-flex gap-5">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Service Name</label>
                                
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="width: 300px">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" aria-label="Default select example">
                                    <option value="" class="selectstatus" style="color: black;" disabled selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" class="selectstatus" style="color: black;">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Diagnosis</label>
                                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 300px" aria-label="Default select example">
                                    <option value="Active" class="selectstatus" style="color: black;">Active</option>
                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                        <div class="d-flex">
                            <h5 class="m-3">Treatment List</h5>
                            <a class="nav-link active m-3" aria-current="page" data-bs-toggle="offcanvas" data-bs-target="#addItemCanvas" aria-controls="addItemCanvas" style="color: #f28123; cursor: pointer;"><img src="/img/icon/plus.png" alt="" style="width: 22px"> Item</a>
                        </div>
                        <div class="m-3 d-flex gap-5">
                            <table class="table table-bordered" style="overflow-x: auto;">
                                <thead>
                                  <tr class="text-center">
                                    <th scope="col" style="width: 300px; text-align: start">Items</th>
                                    <th scope="col" style="width: 100px;">1</th>
                                    <th scope="col" style="width: 100px;">2</th>
                                    <th scope="col" style="width: 100px;">3</th>
                                    <th scope="col" style="width: 100px;">4</th>
                                    <th scope="col" style="width: 100px;">5</th>
                                    <th scope="col" style="width: 100px;">6</th>
                                    <th scope="col" style="width: 100px;">7</th>
                                    <th scope="col" style="width: 100px;">8</th>
                                    <th scope="col" style="width: 100px;">9</th>
                                    <th scope="col" style="width: 100px;">10</th>
                                    <th scope="col" style="width: 100px;">11</th>
                                    <th scope="col" style="width: 100px;">12</th>
                                    <th scope="col" style="width: 100px;">13</th>
                                    <th scope="col" style="width: 100px;">14</th>
                                    <th scope="col" style="width: 100px;">15</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-primary" style="font-size: 15px; cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#addItemCanvas" aria-controls="addItemCanvas">Add Item</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                  {{-- <tr class="text-center">
                                    <td style="text-align: start">
                                        <div class="d-flex">
                                            <span style="font-size: 15px;" class="text-primary"><a href="">FPV Rapid Test Panle/Calici/Parvo</a></span>
                                            <i class="fas fa-ellipsis-v" style="cursor: pointer;"></i>
                                        </div> <br>
                                        <span style="font-size: 15px;">15 Menit, Rp 250,000.00</span> <br>
                                        <span style="font-size: 15px;">three times daily for 7 days</span>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td style="background-color: #FFB475">
                                        3
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                  </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session()->has('successAddTask'))
        <button type="button" id="openCanvas" data-bs-toggle="offcanvas" data-bs-target="#addItemCanvas" aria-controls="addItemCanvas" hidden class="btn-close"></button>
        {{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, fugiat? Deleniti iste ipsum doloremque et dolore accusantium voluptatibus harum pariatur possimus ducimus! Voluptatibus dolor et optio quam maxime voluptatem aliquid, tempora, quo consequuntur eligendi alias. Voluptas qui dolore, repellendus eos, nulla laboriosam porro perferendis eaque ex saepe vitae neque maxime. --}}
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
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Task</label>
                <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 100%;" id="taskList" onchange="taskChange()">
                    <option value="" class="selectstatus" style="color: black;" selected disabled>Select Task</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->task_name }}" class="selectstatus" style="color: black;">{{ $task->task_name }}</option>
                    @endforeach
                        <option value="newtask" class="selectstatus" style="color: black;">+ Create New</option>
                </select>
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

@endsection