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

$("#nostaff").on("click", function(e){
    const val = document.querySelector('#nostaff').value;

    var x = document.getElementById("addstaff");
    x.style.display = "none";
});
$("#withstaff").on("click", function(e){
    const val = document.querySelector('#withstaff').value;
    var x = document.getElementById("addstaff");
    x.style.display = "block";
});

$("#nofacility").on("click", function(e){
    const val = document.querySelector('#nofacility').value;

    var x = document.getElementById("addfacility");
    x.style.display = "none";
});
$("#withfacility").on("click", function(e){
    const val = document.querySelector('#withfacility').value;
    var x = document.getElementById("addfacility");
    x.style.display = "block";
});

// document.getElementById('button').onclick = duplicate;
var i = 0;
var original = document.getElementById('duplicater');
function duplicate(){
    var clone = original.cloneNode(true); // "deep" clone
    clone.id = "duplicater" + ++i; // there can only be one element with an ID
    console.log(clone.id);
    original.parentNode.appendChild(clone);
    console.log(clone);
}

var j = 0;
var ori = document.getElementById('unitDuplicate');
// var unitname = document.getElementById('unit_name');
// unitname.name = "unit_name[1"
// var ele = document.getElementsByTagName('div');
// var unit_name = document.getElementById('unit_name');
function duplicateUnit(){
    var clone = ori.cloneNode(true); // "deep" clone
    clone.id = "unitDuplicate" + ++j; // there can only be one element with an ID
    
    // console.log(ele.length);
    
    console.log(clone.id);
    console.log(clone);
    ori.parentNode.appendChild(clone);
    

    var k = 1;
    var newUnitName = document.getElementById("unit_name");
    newUnitName.name = "unit_name[" + ++k+"]";
    console.log(newUnitName);

    var l = 1;
    var newStatus = document.getElementById("status");
    newStatus.name = "status[" + ++l+"]";
    console.log(newStatus);

    var m = 1;
    var newNotes = document.getElementById("notes");
    newNotes.name = "notes[" + ++m +"]";
    console.log(newNotes);
}


// $(document).on('click', ".insert_unit", function() {
//     let clone = $('[data-master-insert]').clone();
//     var dup = clone.insertAfter($('.afterUnit:last'));
//     console.log(dup);
//     // console.log(clone);
// });

//   $(document).on('click', ".insert_more", function() {
//     let clone = $('[data-master-insert]').clone();
//     clone.insertAfter($('.form-group:last')).removeAttr('data-master-insert').attr('data-cloned-insert', '').find('input[type=button]').val('Remove').removeClass('insert_more').addClass('remove_clone')
//   });

function deletePhone(e){
    console.log(e);
    // $("#duplicater").hidden();
    // var x = document.getElementById("duplicater");
    // console.log(x);
    // x.style.display = "none";

        // var ids = $("#container").children().map(function(n, i) {
            
        // });
}

var arrayOfId = [];

$("input[name='checkBox']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        arrayOfId.push(checked);
    }else{
        arrayOfId.splice($.inArray(checked, arrayOfId),1);
    }

    var x = document.getElementById("deleteButton");
    if(arrayOfId.length != 0){
        x.style.display = "block";
        console.log('tidak');
    }else{
        x.style.display = "none";
        console.log('yes');
    }

    console.log(arrayOfId);
});

function clickDeleteButton(){
    document.getElementById('deleteId').value = arrayOfId;
    console.log(arrayOfId);
}

document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
});

function savePolicy(){
    let a = document.getElementById('submitPolicy').click();
    console.log(a);
}

function saveFacility(){
    let a = document.getElementById('submitFacility').click();
    console.log(a);
}

//CEK FOR WORKING HOURS
$("input[id='sunday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('sunday_time_on').disabled = false;
        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('all_day_sunday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('sunday_time_on').disabled = true;
        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('all_day_sunday').disabled = true;
    }
});

$("input[id='monday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('monday_time_on').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('all_day_monday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('monday_time_on').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('all_day_monday').disabled = true;
    }
});

$("input[id='tuesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('tuesday_time_on').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('all_day_tuesday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('tuesday_time_on').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('all_day_tuesday').disabled = true;
    }
});

$("input[id='wednesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('wednesday_time_on').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('all_day_wednesday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('wednesday_time_on').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('all_day_wednesday').disabled = true;
    }
});

$("input[id='thrusday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('thrusday_time_on').disabled = false;
        document.getElementById('thrusday_time_off').disabled = false;
        document.getElementById('all_day_thrusday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('thrusday_time_on').disabled = true;
        document.getElementById('thrusday_time_off').disabled = true;
        document.getElementById('all_day_thrusday').disabled = true;
    }
});

$("input[id='friday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('all_day_friday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('all_day_friday').disabled = true;
    }
});

$("input[id='saturday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('saturday_time_on').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;
        document.getElementById('all_day_saturday').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('saturday_time_on').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;
        document.getElementById('all_day_saturday').disabled = true;
    }
});

$("input[id='toggleAll']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('all_time_on').disabled = false;
        document.getElementById('all_time_off').disabled = false;
        document.getElementById('all_day').disabled = false;

        document.getElementById('sunday_time_on').disabled = false;
        document.getElementById('monday_time_on').disabled = false;
        document.getElementById('tuesday_time_on').disabled = false;
        document.getElementById('wednesday_time_on').disabled = false;
        document.getElementById('thrusday_time_on').disabled = false;
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('saturday_time_on').disabled = false;

        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('thrusday_time_off').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;

        document.getElementById('all_day_sunday').disabled = false;
        document.getElementById('all_day_monday').disabled = false;
        document.getElementById('all_day_tuesday').disabled = false;
        document.getElementById('all_day_wednesday').disabled = false;
        document.getElementById('all_day_thrusday').disabled = false;
        document.getElementById('all_day_friday').disabled = false;
        document.getElementById('all_day_saturday').disabled = false;

        // $("#all_day").prop("checked", true);
        $("#sunday").prop("checked", true);
        $("#monday").prop("checked", true);
        $("#tuesday").prop("checked", true);
        $("#wednesday").prop("checked", true);
        $("#thrusday").prop("checked", true);
        $("#friday").prop("checked", true);
        $("#saturday").prop("checked", true);
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_time_on').disabled = true;
        document.getElementById('all_time_off').disabled = true;
        document.getElementById('all_day').disabled = true;

        document.getElementById('sunday_time_on').disabled = true;
        document.getElementById('monday_time_on').disabled = true;
        document.getElementById('tuesday_time_on').disabled = true;
        document.getElementById('wednesday_time_on').disabled = true;
        document.getElementById('thrusday_time_on').disabled = true;
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('saturday_time_on').disabled = true;

        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('thrusday_time_off').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;

        $("#all_day").prop("checked", false);
        $("#all_day_sunday").prop("checked", false);
        $("#all_day_monday").prop("checked", false);
        $("#all_day_tuesday").prop("checked", false);
        $("#all_day_wednesday").prop("checked", false);
        $("#all_day_thrusday").prop("checked", false);
        $("#all_day_friday").prop("checked", false);
        $("#all_day_saturday").prop("checked", false);

        $("#sunday").prop("checked", false);
        $("#monday").prop("checked", false);
        $("#tuesday").prop("checked", false);
        $("#wednesday").prop("checked", false);
        $("#thrusday").prop("checked", false);
        $("#friday").prop("checked", false);
        $("#saturday").prop("checked", false);
    }
});

function inputAllDayTimeOn(){
    let value = document.getElementById('all_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('all_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('all_time_on').value = value;
            }
        }   
    }


}

function inputAllDayTimeOff(){
    let value = document.getElementById('all_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('all_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('all_time_off').value = value;
            }
        }   
    }
}

$("input[id='all_day']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        // document.getElementById('all_time_on').disabled = false;
        // document.getElementById('all_time_off').disabled = false;
        // document.getElementById('all_day').disabled = false;

        $("#all_day_sunday").prop("checked", true);
        $("#all_day_monday").prop("checked", true);
        $("#all_day_tuesday").prop("checked", true);
        $("#all_day_wednesday").prop("checked", true);
        $("#all_day_thrusday").prop("checked", true);
        $("#all_day_friday").prop("checked", true);
        $("#all_day_saturday").prop("checked", true);

        $("#sunday").prop("checked", true);
        $("#monday").prop("checked", true);
        $("#tuesday").prop("checked", true);
        $("#wednesday").prop("checked", true);
        $("#thrusday").prop("checked", true);
        $("#friday").prop("checked", true);
        $("#saturday").prop("checked", true);

        document.getElementById('sunday_time_on').disabled = true;
        document.getElementById('monday_time_on').disabled = true;
        document.getElementById('tuesday_time_on').disabled = true;
        document.getElementById('wednesday_time_on').disabled = true;
        document.getElementById('thrusday_time_on').disabled = true;
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('saturday_time_on').disabled = true;

        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('thrusday_time_off').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;

        // if($("#all_day").prop("checked")){
        //     // logic untuk sikat semua field sama kayak all_time_on dan all_time_off
        //     console.log(document.getElementById('all_day').value);
        // }

        console.log('ya1');
    }else{
        console.log('tidak1');
        // document.getElementById('all_time_on').disabled = true;
        // document.getElementById('all_time_off').disabled = true;
        // document.getElementById('all_day').disabled = true;

        $("#all_day_sunday").prop("checked", false);
        $("#all_day_monday").prop("checked", false);
        $("#all_day_tuesday").prop("checked", false);
        $("#all_day_wednesday").prop("checked", false);
        $("#all_day_thrusday").prop("checked", false);
        $("#all_day_friday").prop("checked", false);
        $("#all_day_saturday").prop("checked", false);

        document.getElementById('sunday_time_on').disabled = false;
        document.getElementById('monday_time_on').disabled = false;
        document.getElementById('tuesday_time_on').disabled = false;
        document.getElementById('wednesday_time_on').disabled = false;
        document.getElementById('thrusday_time_on').disabled = false;
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('saturday_time_on').disabled = false;

        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('thrusday_time_off').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;
        // $("#sunday").prop("checked", false);
        // $("#monday").prop("checked", false);
        // $("#tuesday").prop("checked", false);
        // $("#wednesday").prop("checked", false);
        // $("#thrusday").prop("checked", false);
        // $("#friday").prop("checked", false);
        // $("#saturday").prop("checked", false);
    }
});

function serviceClick(){
    var x = document.getElementById("mainCanvas");
    x.style.display = "none";
    
    var x = document.getElementById("serviceCanvas");
    x.style.display = "block";
}

function productClick(){
    var x = document.getElementById("mainCanvas");
    x.style.display = "none";
    
    var x = document.getElementById("productCanvas");
    x.style.display = "block";
}

function taskClick(){
    var x = document.getElementById("mainCanvas");
    x.style.display = "none";

    var x = document.getElementById("taskCanvas");
    x.style.display = "block";
}

var takslist = document.getElementById("taskList");
// console.log(taxlist);
function taskChange(){
    console.log('taskChange');
    var value = takslist.value;
    console.log(value);
    if(value == "newtask"){
        $('#newtask').modal("show");
    }
}

function backButtonInTask(){
    var x = document.getElementById("taskCanvas");
    x.style.display = "none";
    
    var x = document.getElementById("mainCanvas");
    x.style.display = "block";
}

function backButtonInProduct(){
    var x = document.getElementById("productCanvas");
    x.style.display = "none";
    
    var x = document.getElementById("mainCanvas");
    x.style.display = "block";
}

function backButtonInService(){
    var x = document.getElementById("serviceCanvas");
    x.style.display = "none";
    
    var x = document.getElementById("mainCanvas");
    x.style.display = "block";
}

// var checkCanvas = document.getElementById("addItemCanvas");

var checkSession = document.getElementById("openCanvas");
if(checkSession){
    console.log('asjhasjdhgasdkjbas,djhgasjkgdhasd');
    document.getElementById("openCanvas").click();
    taskClick();
}