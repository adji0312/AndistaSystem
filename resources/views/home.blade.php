@extends('main')

@section('container')
    
    <div class="wrapper">
        @include('menu')

        <div id="contents">
            <div id="dashboard" class="mx-3 mt-4">
                <form action="/addFacility" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-between gap-4">
                        <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                            <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/booking.png" alt="" style="width: 30px"> Bookings</p>
                            <div class="m-3 d-flex gap-5 mb-2">
                                <h2>200</h2>
                            </div>
                        </div>
                        <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                            <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/finance.png" alt="" style="width: 30px"> Total sales value (Rp)</p>
                            <div class="m-3 d-flex gap-5 mb-2">
                                <h2>100</h2>
                            </div>
                        </div>
                        <div style="border-style: solid; border-width: 1px; border-color: #d3d3d3; width: 100%">
                            <p class="m-3" style="font-weight: 300px; font-size: 20px;"><img src="/img/icon/customer.png" alt="" style="width: 30px"> New Customers</p>
                            <div class="m-3 d-flex gap-5 mb-2">
                                <h2>100</h2>
                            </div>
                        </div>
                        
                    </div>

                    <button type="submit" id="submitFacility" hidden></button>
                </form>
            </div>
        </div>
    </div>

@endsection