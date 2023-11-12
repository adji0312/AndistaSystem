@extends('main')
@section('container')

  <div class="wrapper">
    
    @include('location.menu')

    <div id="contents">
      <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">{{ $location->location_name }}</a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/location/list" style="color: #949494"><img src="/img/icon/backicon.png" alt="" style="width: 22px"> List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" onclick="saveLocation()" style="color: #f28123; cursor: pointer;"><img src="/img/icon/save.png" alt="" style="width: 22px"> Save</a>
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
          <form action="/addLocation" method="post">
            @csrf

            {{-- BASIC INFO --}}
            <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Basic Info</h5>
              <div class="d-flex">
                    @if ($location->type == "Branch")
                        <div class="form-check m-3" style="font-size: 15px;">
                            <input class="form-check-input" type="radio" name="type" id="branchType" value="Branch" checked>
                            <label class="form-check-label" for="branchType">
                                Branch
                            </label>
                        </div>
                        <div class="form-check m-3" style="font-size: 15px;">
                            <input class="form-check-input" type="radio" name="type" id="offsiteType" value="Offsite">
                            <label class="form-check-label" for="offsiteType">
                                Offsite
                            </label>
                        </div>
                    @else
                        <div class="form-check m-3" style="font-size: 15px;">
                            <input class="form-check-input" type="radio" name="type" id="branchType" value="Branch">
                            <label class="form-check-label" for="branchType">
                                Branch
                            </label>
                        </div>
                        <div class="form-check m-3" style="font-size: 15px;">
                            <input class="form-check-input" type="radio" name="type" id="offsiteType" value="Offsite" checked>
                            <label class="form-check-label" for="offsiteType">
                                Offsite
                            </label>
                        </div>
                    @endif
              </div>
              <div class="m-3 d-flex gap-5">
                  <div class="mb-3">
                      <label for="location_name" class="form-label" style="font-size: 15px; color: #7C7C7C;">Location Name</label>
                      <input type="text" class="form-control" id="location_name" name="location_name" value="{{ $location->location_name }}">
                  </div>
                  <div class="mb-3">
                    <label for="status" class="form-label" style="font-size: 15px; color: #7C7C7C;">Status</label>
                    <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" id="status" name="status">
                        @if ($location->status == "Active")
                            <option value="Active" class="selectstatus" style="color: black;" selected>Active</option>
                            <option value="Disabled" class="selectstatus" style="color: black;">Disabled</option>
                        @else
                            <option value="Active" class="selectstatus" style="color: black;">Active</option>
                            <option value="Disabled" class="selectstatus" style="color: black;" selected>Disabled</option>
                        @endif
                    </select>
                  </div>
              </div>
            </div>

            {{-- OPERATING HOURS --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Operating Hours</h5>

                <?php
                    $sunday = $location->workinghours->where('day', 'Sunday')->first();
                    $monday = $location->workinghours->where('day', 'Monday')->first();
                    $tuesday = $location->workinghours->where('day', 'Tuesday')->first();
                    $wednesday = $location->workinghours->where('day', 'Wednesday')->first();
                    $thursday = $location->workinghours->where('day', 'Thursday')->first();
                    $friday = $location->workinghours->where('day', 'Friday')->first();
                    $saturday = $location->workinghours->where('day', 'Saturday')->first();
                ?>

                @if ($monday)
                  <div class="m-3 mt-4 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="Monday" id="monday" name="day[]" checked>
                          <label class="form-check-label" for="monday" style="font-size: 15px; width: 100px">
                          Monday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="monday_time_on" placeholder="From" oninput="inputMondayTimeOn()" style="width: 150px;" value="{{ $monday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="monday_time_off" placeholder="To" oninput="inputMondayTimeOff()" style="width: 150px;" value="{{ $monday->time_off }}">
                      </div>
                      <div class="form-check">
                          @if ($monday->all_day == 0)
                              <input class="form-check-input" type="hidden" value="0" id="all_day_monday_off" name="all_day[]">
                              <input class="form-check-input" type="checkbox" value="1" id="all_day_monday" name="all_day[]"
                              >
                          @else
                              <input class="form-check-input" type="hidden" value="0" id="all_day_monday_off" name="all_day[]">
                              <input class="form-check-input" type="checkbox" value="1" id="all_day_monday" name="all_day[]" checked>
                          @endif
                          <label class="form-check-label" for="all_day_monday" style="font-size: 15px;">
                          All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Monday" id="monday" name="day[]">
                      <label class="form-check-label" for="monday" style="font-size: 15px; width: 100px">
                        Monday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="monday_time_on" placeholder="From" oninput="inputMondayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="monday_time_off" placeholder="To" oninput="inputMondayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_monday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_monday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_monday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif

                @if ($tuesday)
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($tuesday->day == "Tuesday")
                              <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday" name="day[]" checked>
                          @else
                              <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday" name="day[]">
                          @endif
                          <label class="form-check-label" for="tuesday" style="font-size: 15px; width: 100px">
                              Tuesday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="tuesday_time_on" placeholder="From" oninput="inputTuesdayTimeOn()" style="width: 150px;" value="{{ $tuesday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="tuesday_time_off" placeholder="To" oninput="inputTuesdayTimeOff()" style="width: 150px;" value="{{ $tuesday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($tuesday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_tuesday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_tuesday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_tuesday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_tuesday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_tuesday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Tuesday" id="tuesday" name="day[]">
                      <label class="form-check-label" for="tuesday" style="font-size: 15px; width: 100px">
                        Tuesday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="tuesday_time_on" placeholder="From" oninput="inputTuesdayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="tuesday_time_off" placeholder="To" oninput="inputTuesdayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_tuesday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_tuesday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_tuesday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif

                @if ($wednesday)
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($wednesday)
                              @if ($wednesday->day == "Wednesday")
                                  <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="day[]" checked>
                              @else
                                  <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="day[]">
                                  @endif
                          @else    
                              <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="day[]">
                          @endif

                          <label class="form-check-label" for="wednesday" style="font-size: 15px; width: 100px">
                              Wednesday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="wednesday_time_on" placeholder="From" oninput="inputWednesdayTimeOn()" style="width: 150px;" value="{{ $wednesday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="wednesday_time_off" placeholder="To" oninput="inputWednesdayTimeOff()" style="width: 150px;" value="{{ $wednesday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($wednesday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_wednesday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_wednesday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_wednesday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_wednesday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_wednesday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Wednesday" id="wednesday" name="day[]">
                      <label class="form-check-label" for="wednesday" style="font-size: 15px; width: 100px">
                        Wednesday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="wednesday_time_on" placeholder="From" oninput="inputWednesdayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="wednesday_time_off" placeholder="To" oninput="inputWednesdayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_wednesday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_wednesday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_wednesday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif
                
                @if ($thursday)
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($thursday)
                              @if ($thursday->day == "Thursday")
                                  <input class="form-check-input" type="checkbox" value="Thursday" id="thursday" name="day[]" checked>
                              @else
                                  <input class="form-check-input" type="checkbox" value="Thursday" id="thursday" name="day[]">
                                  @endif
                          @else    
                              <input class="form-check-input" type="checkbox" value="Thursday" id="thursday" name="day[]">
                          @endif
                          <label class="form-check-label" for="thursday" style="font-size: 15px; width: 100px">
                              Thursday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="thursday_time_on" placeholder="From" oninput="inputThursdayTimeOn()" style="width: 150px;" value="{{ $thursday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="thursday_time_off" placeholder="To" oninput="inputThursdayTimeOff()" style="width: 150px;" value="{{ $thursday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($thursday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_thursday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_thursday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_thursday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_thursday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_thursday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Thursday" id="thursday" name="day[]">
                      <label class="form-check-label" for="thursday" style="font-size: 15px; width: 100px">
                        Thursday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="thursday_time_on" placeholder="From" oninput="inputThursdayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="thursday_time_off" placeholder="To" oninput="inputThursdayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_thursday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_thursday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_thursday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif

                @if ($friday)
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($friday)
                              @if ($friday->day == "Friday")
                                  <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="day[]" checked>
                              @else
                                  <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="day[]">
                                  @endif
                          @else    
                              <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="day[]">
                          @endif
                          <label class="form-check-label" for="friday" style="font-size: 15px; width: 100px">
                              Friday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="friday_time_on" placeholder="From" oninput="inputFridayTimeOn()" style="width: 150px;" value="{{ $friday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="friday_time_off" placeholder="To" oninput="inputFridayTimeOff()" style="width: 150px;" value="{{ $friday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($friday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_friday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_friday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_friday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_friday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_friday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Friday" id="friday" name="day[]">
                      <label class="form-check-label" for="friday" style="font-size: 15px; width: 100px">
                        Friday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="friday_time_on" placeholder="From" oninput="inputFridayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="friday_time_off" placeholder="To" oninput="inputFridayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_friday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_friday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_friday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif

                @if ($saturday)
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($saturday)
                              @if ($saturday->day == "Saturday")
                                  <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="day[]" checked>
                              @else
                                  <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="day[]">
                              @endif
                          @else    
                              <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="day[]">
                          @endif
                          <label class="form-check-label" for="saturday" style="font-size: 15px; width: 100px">
                              Saturday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="saturday_time_on" placeholder="From" oninput="inputSaturdayTimeOn()" style="width: 150px;" value="{{ $saturday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="saturday_time_off" placeholder="To" oninput="inputSaturdayTimeOff()" style="width: 150px;" value="{{ $saturday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($saturday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_saturday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_saturday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_saturday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_saturday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_saturday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mb-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Saturday" id="saturday" name="day[]">
                      <label class="form-check-label" for="saturday" style="font-size: 15px; width: 100px">
                        Saturday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="saturday_time_on" placeholder="From" oninput="inputSaturdayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="saturday_time_off" placeholder="To" oninput="inputSaturdayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_saturday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_saturday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_saturday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif

                @if ($sunday)
                  <div class="m-3 mt-0 mx-5 d-flex gap-4">
                      <div class="form-check">
                          @if ($sunday)
                              @if ($sunday->day == "Sunday")
                                  <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="day[]" checked>
                              @else
                                  <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="day[]">
                              @endif
                          @else    
                              <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="day[]">
                          @endif
                          <label class="form-check-label" for="sunday" style="font-size: 15px; width: 100px">
                              Sunday
                          </label>
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_on[]" id="sunday_time_on" placeholder="From" oninput="inputSundayTimeOn()" style="width: 150px;" value="{{ $sunday->time_on }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center">
                          <i class="far fa-clock icon" style="color: #949494;">
                          </i>
                          <input type="text" class="form-control" name="time_off[]" id="sunday_time_off" placeholder="To" oninput="inputSundayTimeOff()" style="width: 150px;" value="{{ $sunday->time_off }}">
                      </div>
                      <div class="form-check">
                        @if ($sunday->all_day == 0)
                          <input class="form-check-input" type="hidden" value="0" id="all_day_sunday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_sunday" name="all_day[]">
                        @else
                          <input class="form-check-input" type="hidden" value="0" id="all_day_sunday_off" name="all_day[]">
                          <input class="form-check-input" type="checkbox" value="1" id="all_day_sunday" name="all_day[]" checked>
                        @endif
                          <label class="form-check-label" for="all_day_sunday" style="font-size: 15px;">
                              All Day
                          </label>
                      </div>
                  </div>
                @else
                  <div class="m-3 mt-0 mx-5 d-flex gap-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="Sunday" id="sunday" name="day[]">
                      <label class="form-check-label" for="sunday" style="font-size: 15px; width: 100px">
                        Sunday
                      </label>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_on[]" id="sunday_time_on" placeholder="From" oninput="inputSundayTimeOn()" style="width: 150px;" disabled>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                      <i class="far fa-clock icon" style="color: #949494;">
                      </i>
                      <input type="text" class="form-control" name="time_off[]" id="sunday_time_off" placeholder="To" oninput="inputSundayTimeOff()" style="width: 150px;" disabled>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="hidden" value="0" id="all_day_sunday_off" name="all_day[]" disabled>
                      <input class="form-check-input" type="checkbox" value="1" id="all_day_sunday" name="all_day[]" disabled>
                      <label class="form-check-label" for="all_day_sunday" style="font-size: 15px;">
                        All Day
                      </label>
                    </div>
                  </div>
                @endif
        
            </div>

            {{-- ADDRESS --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <?php
                $address = $location->locationaddresses->first();
              ?>
              <h5 class="m-3">Address</h5>
              <div class="m-3 d-flex flex-column">
                  <div class="mb-3" style="width: 70%">
                      <label for="street_address" class="form-label" style="font-size: 15px; color: #7C7C7C;">Street Address</label>
                      <input type="text" class="form-control" id="street_address" name="street_address" value="{{ $address->street_address }}">
                  </div>
                  <div class="mb-3" style="width: 70%">
                      <input type="text" class="form-control" id="addtional_info" name="addtional_info" placeholder="Additional info: Apartment, suite, unit, building, floor, etc." value="{{ $address->additional_info }}">
                  </div>
              </div>
              <div class="m-3 d-flex gap-5">
                <div class="mb-3">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $address->city }}">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $address->state }}">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="{{ $address->postal_code }}">
                </div>
              </div>
              <div class="m-3 d-flex gap-5">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Country</label>
                  <input type="text" class="form-control" id="searchcountry" name="country" placeholder="Search Country" value="{{ $address->country }}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                  <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 250px" aria-label="Default select example" id="mySelectUsageAddress" name="usage_address_id" onchange="changeUsageAddress()">
                    <option value="" disabled selected class="selectstatus" style="color: black;">Select Usage</option>
                    @foreach ($usageAddresses as $usage)
                      @if ($usage->id == $address->usage_address_id)
                        <option value="{{ $usage->id }}" class="selectstatus" style="color: black;" selected>{{ $usage->usage_name }}</option>
                        @continue
                      @endif
                        <option value="{{ $usage->id }}" class="selectstatus" style="color: black;">{{ $usage->usage_name }}</option>
                    @endforeach
                    <option value="addressusage" class="selectstatus" style="color: black;">+ Create New</option>
                  </select>
                </div>
              </div>
            </div>

          
            {{-- CONTACT --}}
            <div class="mt-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3">Contact</h5>

              <div class="mt-2 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h6 class="m-3">Phone</h6>
                @foreach ($location->phones as $phone)
                  <div id="afterPhone">
                    <div class="m-3 d-flex gap-5" id="phoneDuplicate">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" id="mySelectPhone" name="usage_phone_contact_id[]" onchange="changePhone()">
                          <option selected disabled value="" class="selectstatus" style="color: black;">Select Usage</option>
                          @foreach ($usages as $usage)
                            @if ($usage->id == $phone->usage_phone_contact_id)
                              <option value="{{ $usage->id }}" class="selectstatus" style="color: black;" selected>{{ $usage->usage_name }}</option>
                              @continue
                            @endif
                            <option value="{{ $usage->id }}" class="selectstatus" style="color: black;">{{ $usage->usage_name }}</option>
                          @endforeach
                          <option value="phoneusage" class="selectstatus" style="color: black;">+ Create New</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                        <input type="text" class="form-control" style="margin-top: 5px;"  id="phone_number" name="phone_number[]" placeholder="Phone Number" onkeypress="return inputPhone(event)" value="{{ $phone->phone_number }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" id="phone_type" name="phone_type[]">
                          <option value="Mobile" class="selectstatus" style="color: black;">Mobile</option>
                          <option value="Fax" class="selectstatus" style="color: black;">Fax</option>
                          <option value="Fixed-line phone" class="selectstatus" style="color: black;">Fixed-line phone</option>
                        </select>
                      </div>
                      <div class="mb-3 d-flex align-items-center" style="cursor: pointer" onclick="deletePhone(this.parentNode.id)">
                        <img src="/img/icon/minus.png" alt="" style="width: 20px">
                      </div>
                    </div>
                  </div>
                @endforeach
                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicatePhone()"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>

              <div class="mt-2 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h6 class="m-3">Email</h6>
                @foreach ($location->emails as $email)
                  <div id="afterEmail">
                    <div class="m-3 d-flex gap-5" id="emailDuplicate">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" id="mySelectEmail" name="usage_email_contact_id[]" onchange="changeEmail()">
                          <option selected disabled value="" class="selectstatus" style="color: black;">Select Usage</option>
                          @foreach ($usages as $usage)
                            @if ($usage->id == $email->usage_email_contact_id)
                              <option value="{{ $usage->id }}" class="selectstatus" style="color: black;" selected>{{ $usage->usage_name }}</option>
                              @continue
                            @endif
                            <option value="{{ $usage->id }}" class="selectstatus" style="color: black;">{{ $usage->usage_name }}</option>
                          @endforeach
                          <option value="emailusage" class="selectstatus" style="color: black;">+ Create New</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                        <input type="text" class="form-control" style="margin-top: 5px;" id="email_address" name="email_address[]" placeholder="Email Address" value="{{ $email->email_address }}">
                      </div>
                      <div class="mb-3 d-flex align-items-center" style="cursor: pointer" onclick="deleteEmail(this.parentNode.id)">
                        <img src="/img/icon/minus.png" alt="" style="width: 20px">
                      </div>
                    </div>
                  </div>
                @endforeach
                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicateEmail()"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>

              <div class="mt-2 m-5" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
                <h6 class="m-3">Messenger</h6>
                @foreach ($location->messengers as $messenger)
                  <div id="afterMessenger">
                    <div class="m-3 d-flex gap-5" id="messengerDuplicate">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Usage</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" id="mySelectMessenger" name="usage_messenger_contact_id[]" onchange="changeMessenger()">
                          <option selected disabled value="" class="selectstatus" style="color: black;">Select Usage</option>
                          @foreach ($usages as $usage)
                            @if ($usage->id == $messenger->usage_messenger_contact_id)
                              <option value="{{ $usage->id }}" class="selectstatus" style="color: black;" selected>{{ $usage->usage_name }}</option>
                              @continue  
                            @endif
                              <option value="{{ $usage->id }}" class="selectstatus" style="color: black;">{{ $usage->usage_name }}</option>
                          @endforeach
                          <option value="messengerusage" class="selectstatus" style="color: black;">+ Create New</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                        <input type="text" class="form-control" style="margin-top: 5px;" id="username" name="username[]" placeholder="Username" value="{{ $messenger->username }}">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;">Type</label>
                        <select class="form-select" style="font-size: 15px; color: #7C7C7C; width: 200px" aria-label="Default select example" id="mySelectMessengerType" name="messenger_type_id[]" onchange="typeMessenger()">
                          <option disabled selected value="" class="selectstatus" style="color: black;">Select Type</option>
                          @foreach ($messengerTypes as $type)
                            @if ($type->id == $messenger->messenger_type_id)
                              <option value="{{ $type->id }}" class="selectstatus" style="color: black;" selected>{{ $type->type_name }}</option>
                              @continue  
                            @endif
                            <option value="{{ $type->id }}" class="selectstatus" style="color: black;">{{ $type->type_name }}</option>
                          @endforeach
                          <option value="messengertype" class="selectstatus" style="color: black;">+ Create New</option>
                        </select>
                      </div>
                      <div class="mb-3 d-flex align-items-center" style="cursor: pointer" onclick="deleteMessenger(this.parentNode.id)">
                        <img src="/img/icon/minus.png" alt="" style="width: 20px">
                      </div>
                    </div>
                  </div>
                @endforeach
                <div class="m-3">
                  <button type="button" class="btn btn-sm btn-outline-dark" onclick="duplicateMessenger()"><i class="fas fa-plus"></i> Add</button>
                </div>
              </div>
            </div>
            
            {{-- PHOTOS --}}
            <div class="mt-4 mb-4" style="border-style: solid; border-width: 1px; border-color: #d3d3d3;">
              <h5 class="m-3 mb-0">Photos</h5>
              <div class="m-3 mt-0">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label" style="font-size: 15px; color: #7C7C7C;"></label>
                  <input type="file" class="form-control mt-1" name="image">
                </div>
              </div>
            </div>

            <button type="submit" id="submitLocation" hidden></button>
          </form>
      </div>
    </div>
  </div>


  {{-- ALL MODAL --}}

  {{-- MODAL ADD NEW USAGE ADDRESS--}}
  <div class="modal fade" id="usageaddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Address Usage</h1>
        </div>
        <form action="/addUsageAddress" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-1">
              <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" placeholder="Name">
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
  <div class="modal fade" id="usagephone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Phone Usage</h1>
        </div>
        <form action="/addUsage" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-1">
              <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" placeholder="Name">
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

  {{-- MODAL ADD NEW EMAIL USAGE --}}
  <div class="modal fade" id="usageemail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Email Usage</h1>
        </div>
        <form action="/addUsage" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-1">
              <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" placeholder="Name">
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

  {{-- MODAL ADD NEW MESSENGER USAGE --}}
  <div class="modal fade" id="usagemessenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messenger Usage</h1>
        </div>
        <form action="/addUsage" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-1">
              <input type="text" class="form-control mt-1" id="usage_name" name="usage_name" placeholder="Name">
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

  {{-- MODAL ADD NEW MESSENGER TYPE --}}
  <div class="modal fade" id="typemessenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Messenger Type</h1>
        </div>
        <form action="/addTypeMessenger" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-1">
              <input type="text" class="form-control mt-1" id="type_name" name="type_name" placeholder="Name">
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