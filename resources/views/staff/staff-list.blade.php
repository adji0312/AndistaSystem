@extends('main')
@section('container')

    <div class="wrapper">

        @include('staff.menu')
    
        <div id="contents">
        <nav class="navbar navbar-expand-lg" style="height: 76px; border-bottom-style: solid; border-width: 1px; border-color: #d3d3d3; background-color: #f0f0f0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ $title }}</a>
            </div>
        </nav>

        <div id="dashboard" class="mx-3 mt-4">
            <table class="table w-100">
                <thead>
                  <tr >
                    <th scope="col" style="color: #7C7C7C; width: 15%;">Name</th>
                    <th scope="col" style="color: #7C7C7C; width: 15%;">Telephone</th>
                    <th scope="col" style="color: #7C7C7C; width: 20%;">Email</th>
                    <th scope="col" style="color: #7C7C7C; width: 40px;">Gender</th>
                    <th scope="col" style="color: #7C7C7C; width: 20px;">Job Title</th>
                    <th scope="col" style="color: #7C7C7C; width: 20px;">Status</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-primary" style="cursor: pointer;">Adji Budhi Setyawan</td>
                        <td>0895394620186</td>
                        <td>adjiemail</td>
                        <td class="text-primary" style="cursor: pointer;">Male</td>
                        <td>Front Office</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td class="text-primary" style="cursor: pointer;">Adji Budhi Setyawan</td>
                        <td>0895394620186</td>
                        <td>adjiemail</td>
                        <td class="text-primary" style="cursor: pointer;">Male</td>
                        <td>Front Office</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td class="text-primary" style="cursor: pointer;">Adji Budhi Setyawan</td>
                        <td>0895394620186</td>
                        <td>adjiemail</td>
                        <td class="text-primary" style="cursor: pointer;">Male</td>
                        <td>Front Office</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td class="text-primary" style="cursor: pointer;">Adji Budhi Setyawan</td>
                        <td>0895394620186</td>
                        <td>adjiemail</td>
                        <td class="text-primary" style="cursor: pointer;">Male</td>
                        <td>Front Office</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td class="text-primary" style="cursor: pointer;">Adji Budhi Setyawan</td>
                        <td>0895394620186</td>
                        <td>adjiemail</td>
                        <td class="text-primary" style="cursor: pointer;">Male</td>
                        <td>Front Office</td>
                        <td>Active</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection