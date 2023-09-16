$(document).ready(function () {
    console.log('everywhere');
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    
    
    // $("#locationslist").on("click", function (event) {
    //     event.preventDefault();
    //     console.log('list');
    //     $("#dashboard").load("/location/list");
    // });

    // $("#locationsfacilities").on("click", function (event) {
    //     event.preventDefault();
    //     console.log('facility');
    //     $("#dashboard").load("/location/facility");
    // });

    // $("#locationsdashboard").on("click", function (event) {
    //     event.preventDefault();
    //     console.log('dashboard');
    //     $("#dashboard").load("/location");
    // });
});

// $(document).ready(function(){
    // $('#myselect').on("change", function() { //jQuery Change Function
        // console.log('openselect');
        // var sOptionVal =$(this).val();
        // if(sOptionVal=='openmodalusage'){
        //         $('#usagephone').modal('show');
        // }
        // var opval = $(this).val(); //Get value from select element
        // if(opval=="openmodalusage"){ //Compare it and if true
        //     $('#usagephone').modal("show"); //Open Modal
        // }
    // });
// });

var e = document.getElementById("mySelectPhone");
var f = document.getElementById("mySelectEmail");
var g = document.getElementById("mySelectMessenger");
var h = document.getElementById("mySelectMessengerType");
function changePhone(){
    var value = e.value;
    if(value == "phoneusage"){
        $('#usagephone').modal("show");
    }
}
function changeEmail(){
    var value = f.value;
    if(value == "emailusage"){
        $('#usageemail').modal("show");
    }
}
function changeMessenger(){
    var value = g.value;
    if(value == "messengerusage"){
        $('#usagemessenger').modal("show");
    }
}

function typeMessenger(){
    var value = h.value;
    if(value == "messengertype"){
        $('#typemessenger').modal("show");
    }
}