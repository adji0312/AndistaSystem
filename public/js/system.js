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
var usageSelect = document.getElementById("mySelectUsageAddress");
function changeUsageAddress(){
    var value = usageSelect.value;
    console.log(value);
    if(value == "addressusage"){
        $('#usageaddress').modal("show");
    }
}
function changePhone(){
    var value = e.value;
    console.log(value);
    if(value == "phoneusage"){
        $('#usagephone').modal("show");
    }
}
function changeEmail(){
    console.log('changeemail');
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

$("#defaultPolicy").on("click", function(e){
    const val = document.querySelector('#defaultPolicy').value;

    var x = document.getElementById("policy_id");
    x.disabled = true;
});

$("#customPolicy").on("click", function(e){
    const val = document.querySelector('#customPolicy').value;
    var x = document.getElementById("policy_id");
    x.disabled = false;
});

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
var k = 0;
var l = 0;
var m = 0;
var ori = document.getElementById('unitDuplicate');
function duplicateUnit(){
    var clone = ori.cloneNode(true);
    clone.id = "unitDuplicate" + ++j;
    let cloned = document.getElementById("afterInput").appendChild(clone);
    console.log(cloned);
    

    
    var newUnitName = document.getElementById("unit_name");
    newUnitName.name = "unit_name[" + ++k +"]";
    console.log(newUnitName);

    
    var newStatus = document.getElementById("unit_status");
    newStatus.name = "unit_status[" + ++l +"]";
    console.log(newStatus);

    
    var newNotes = document.getElementById("notes");
    newNotes.name = "notes[" + ++m +"]";
    console.log(newNotes);
}

function deleteUnit(e){
    const element = document.getElementById(e);
    element.remove();
}

function deletePrice(e){
    // console.log(e);
    const element = document.getElementById(e);
    element.remove();
}

function deletePhone(e){
    // console.log(e);
    const element = document.getElementById(e);
    element.remove();
}
function deleteEmail(e){
    // console.log(e);
    const element = document.getElementById(e);
    element.remove();
}
function deleteMessenger(e){
    // console.log(e);
    const element = document.getElementById(e);
    element.remove();
}

var n = 0;
var priceTable = document.getElementById('priceDuplicate');
function duplicatePriceService(){
    var clone = priceTable.cloneNode(true);
    clone.id = "priceDuplicate" + ++n;
    let cloned = document.getElementById("afterPrice").appendChild(clone);
    console.log(cloned);
}

var p = 0;
var phoneContent = document.getElementById('phoneDuplicate');
function duplicatePhone(){
    var clone = phoneContent.cloneNode(true);
    clone.id = "phoneDuplicate" + ++p;
    let cloned = document.getElementById("afterPhone").appendChild(clone);
    console.log(cloned);
}

var q = 0;
var emailContent = document.getElementById('emailDuplicate');
function duplicateEmail(){
    var clone = emailContent.cloneNode(true);
    clone.id = "emailDuplicate" + ++q;
    let cloned = document.getElementById("afterEmail").appendChild(clone);
    console.log(cloned);
}

var r = 0;
var messengerContent = document.getElementById('messengerDuplicate');
function duplicateMessenger(){
    var clone = messengerContent.cloneNode(true);
    clone.id = "messengerDuplicate" + ++r;
    let cloned = document.getElementById("afterMessenger").appendChild(clone);
    console.log(cloned);
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

var arrayOfIdStaff = [];
// document.cookie = "name = " + arrayOfIdStaff;
let cookieVal;
$("input[name='getIdStaff']").change(function() {
    console.log('di add staff');
    var checked = $(this).val();
    console.log(checked);
    if ($(this).is(':checked')) {
        arrayOfIdStaff.push(checked);
    }else{
        arrayOfIdStaff.splice($.inArray(checked, arrayOfIdStaff),1);
    }

    document.getElementById('idstaff').value = arrayOfIdStaff;
    document.cookie = "value = " + arrayOfIdStaff;
    cookieVal = document.cookie =  arrayOfIdStaff;
    document.cookie = "lengthStaff = " + arrayOfIdStaff.length;

    console.log(cookieVal);

    // var x = document.getElementById("deleteButton");
    // if(arrayOfIdStaff.length != 0){
    //     x.style.display = "block";
    //     console.log('tidak');
    // }else{
    //     x.style.display = "none";
    //     console.log('yes');
    // }

    console.log(arrayOfIdStaff);
});

function viewId(){
    console.log(cookieVal);
}

function saveStaff(){
    $('#staffservice').modal("hide");
    location.reload();
    console.log('save staff');
}

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
}

function saveService(){
    let a = document.getElementById('submitService').click();
}

function saveLocation(){
    let a = document.getElementById('submitLocation').click();
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

$("input[id='all_day_monday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        // document.getElementById('monday_time_on').disabled = true;
        // document.getElementById('monday_time_off').disabled = true;
        document.getElementById('monday_time_on').value = '00:00';
        document.getElementById('monday_time_off').value = '23:59';
        document.getElementById('all_day_monday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        // document.getElementById('monday_time_on').disabled = false;
        // document.getElementById('monday_time_off').disabled = false;
        document.getElementById('all_day_monday').value = 0;
    }
});

$("input[id='all_day_tuesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('tuesday_time_on').value = '00:00';
        document.getElementById('tuesday_time_off').value = '23:59';
        document.getElementById('all_day_tuesday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_tuesday').value = 0;
    }
});

$("input[id='all_day_wednesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('wednesday_time_on').value = '00:00';
        document.getElementById('wednesday_time_off').value = '23:59';
        document.getElementById('all_day_wednesday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_wednesday').value = 0;
    }
});

$("input[id='all_day_thrusday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('thrusday_time_on').value = '00:00';
        document.getElementById('thrusday_time_off').value = '23:59';
        document.getElementById('all_day_thrusday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_thrusday').value = 0;
    }
});

$("input[id='all_day_saturday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('saturday_time_on').value = '00:00';
        document.getElementById('saturday_time_off').value = '23:59';
        document.getElementById('all_day_saturday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_saturday').value = 0;
    }
});

$("input[id='all_day_sunday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('sunday_time_on').value = '00:00';
        document.getElementById('sunday_time_off').value = '23:59';
        document.getElementById('all_day_sunday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_sunday').value = 0;
    }
});

$("input[id='all_day_friday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('friday_time_on').value = '00:00';
        document.getElementById('friday_time_off').value = '23:59';
        document.getElementById('all_day_friday').value = 1;

        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('all_day_friday').value = 0;
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

// BATAS TIME ON
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
function inputMondayTimeOn(){
    let value = document.getElementById('monday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('monday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('monday_time_on').value = value;
            }
        }   
    }

}

function inputTuesdayTimeOn(){
    let value = document.getElementById('tuesday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('tuesday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('tuesday_time_on').value = value;
            }
        }   
    }

}

// ====================================================================
//BATAS TIME OFF
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

function inputMondayTimeOff(){
    let value = document.getElementById('monday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('monday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('monday_time_off').value = value;
            }
        }   
    }
}

function inputTuesdayTimeOff(){
    let value = document.getElementById('tuesday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('tuesday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('tuesday_time_off').value = value;
            }
        }   
    }
}

// =======================================================================

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

function inputPhone(evt){

    var charCode = (evt.which) ? evt.which : event.keyCode;
    console.log(charCode);
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
        return true;
}

var route = "/location/list/add/autocomplete-search";
    $('#searchcountry').typeahead({
        source: function (query, process) {
            // console.log(query);
            return $.get(route, {
                query: query
            }, function (data) {
                // console.log(data);
                return process(data);
            });
        }
    });

$('.searchcountry').on('typeahead:selected', function (e, datum) {
    console.log(datum);
    // $('#item_code').val(datum.item_code);
});
// $('#searchcountry').on('typeahead:select', function (e, datum) {
//     console.log(e);
// });

// window.onbeforeunload = function() {
//     let item = localStorage.setItem("service_name", $('#service_name').val());
//     console.log(item);
//     // localStorage.setItem("email", $('#inputEmail').val());
//     // ...
// }
