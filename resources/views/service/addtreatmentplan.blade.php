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
                                    <option value="Active" class="selectstatus" style="color: black;">Andista Animal Care</option>
                                    <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
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
                            <a class="nav-link active m-3" aria-current="page" href="/service/treatmentplan/add" style="color: #f28123"><img src="/img/icon/plus.png" alt="" style="width: 22px"> Item</a>
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
                                        <td><a href="" class="text-primary" style="font-size: 15px;">Add Item</a></td>
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

@endsection