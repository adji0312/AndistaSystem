@extends('main')
@section('container')
    <form>
        <input type="hidden" value="{{ Auth::user()->UUID }}" id="qrtoscan">
    </form>
    <div class="wrapper align-content-center ">
    {{-- Create QR Code  --}}
    <div class="d-flex flex-column justify-content-center m-auto align-items-center m-4 p-4">
        <div class="d-flex align-items-center m-auto">
            <h1>QR Code Attendance</h1>
        </div> 
        <div class="container vh-80 m-auto bg-light border-dark p-4" style="border: 1px; border-style:solid;border-color:black">
            <div id="qrcode" class="d-flex align-items-center justify-content-center m-auto p-4"></div>
        </div>
        
    </div>
    

     
    

    </div>
    <!-- (C) CREATE QR CODE ON PAGE LOAD -->
    <script>
        let src_qr = document.getElementById("qrtoscan").value;
        // console.log(src_qr);
        window.addEventListener("load", () => {
            
          var qrc = new QRCode(document.getElementById("qrcode"), src_qr);
        });
        </script>
@endsection