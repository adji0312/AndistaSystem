$(document).ready(function () {
    // console.log('everywhere');
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

});

var e = document.getElementById("mySelectPhone");
var f = document.getElementById("mySelectEmail");
var g = document.getElementById("mySelectMessenger");
var h = document.getElementById("mySelectMessengerType");
var b = document.getElementById("mySelectDiagnosis");
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

function changeDiagnosis(){
    var value = b.value;
    // console.log(value);
    if(value == "diagnosis"){
        // console.log('asdalsd');
        $('#diagnosisName').modal("show");
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
}

var before = document.getElementById('indexUnitDup');
function duplicateUnitinEdit($id){
    // console.log($id-=1);
    // console.log(before.value);
    // $id = $id - 1;
    // console.log($id);
    var ori = document.getElementById('unitDuplicate'+before.value);
    console.log(ori);
    console.log(before.value);
    let index = parseInt(before.value);
    index += 1;
    var clone = ori.cloneNode(true);
    clone.id = "unitDuplicate" + index;
    let cloned = document.getElementById("afterInput").appendChild(clone);
    console.log(cloned);
    before.value = index;
}

function deleteUnit(e){
    console.log(e);
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
var petTable = document.getElementById('petsDuplicate');
function duplicatePetService(){
    var clone = petTable.cloneNode(true);
    clone.id = "petsDuplicate" + ++p;
    let cloned = document.getElementById("afterPets").appendChild(clone);
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
var arrayOfName = [];

$("input[name='checkBox']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        arrayOfId.push(checked);
        arrayOfName.push(checked);
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
// let cookieVal;
// $("input[name='getIdStaff']").change(function() {
//     console.log('di add staff');
//     var checked = $(this).val();
//     console.log(checked);
//     if ($(this).is(':checked')) {
//         arrayOfIdStaff.push(checked);
//     }else{
//         arrayOfIdStaff.splice($.inArray(checked, arrayOfIdStaff),1);
//     }

//     document.getElementById('idstaff').value = arrayOfIdStaff;
//     document.cookie = "value = " + arrayOfIdStaff;
//     cookieVal = document.cookie =  arrayOfIdStaff;
//     document.cookie = "lengthStaff = " + arrayOfIdStaff.length;

//     console.log(cookieVal);

//     // var x = document.getElementById("deleteButton");
//     // if(arrayOfIdStaff.length != 0){
//     //     x.style.display = "block";
//     //     console.log('tidak');
//     // }else{
//     //     x.style.display = "none";
//     //     console.log('yes');
//     // }

//     console.log(arrayOfIdStaff);
// });

// function viewId(){
//     console.log(cookieVal);
// }

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
function saveQuotation(){
    let a = document.getElementById('submitQuotation').click();
}

function saveBooking(){
    let a = document.getElementById('submitBooking').click();
}

//save customer
function saveCustomer(){
    let a = document.getElementById('submitCustomer').click();
}

function saveUpdateCustomer(){
    let a = document.getElementById('saveUpdateCustomer').click();
}

function saveUpdateAccessControl(){
    let a = document.getElementById('submitSaveUpdateAccessControl').click();
}

function savePets(){
    console.log('clicked');
    let a = document.getElementById('submitPets').click();
}

//save staff
function saveStaff(){
    let a = document.getElementById('submitStaff').click();
}

function saveUpdateStaff(){
    let a = document.getElementById('saveUpdateStaff').click();
}

function saveStaff(){
    console.log('clicked');
    let a = document.getElementById('submitStaff').click();
}

//save product
function saveProduct(){
    let a = document.getElementById('submitProduct').click();
}

//save staff
function saveStaff(){
    let a = document.getElementById('submitStaff').click();
}



//CEK FOR WORKING HOURS
$("input[id='sunday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('sunday_time_on').disabled = false;
        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('all_day_sunday').disabled = false;
        document.getElementById('all_day_sunday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('sunday_time_on').disabled = true;
        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('all_day_sunday').disabled = true;
        document.getElementById('all_day_sunday_off').disabled = true;

        document.getElementById('sunday_time_on').value = '';
        document.getElementById('sunday_time_off').value = '';
        document.getElementById('all_day_sunday').checked = false;
        document.getElementById('all_day_sunday_off').checked = false;

        sunday_time_on1.disabled = true;
        sunday_time_off1.disabled = true;
    }
});

$("input[id='monday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('monday_time_on').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('all_day_monday').disabled = false;
        document.getElementById('all_day_monday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('monday_time_on').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('monday_time_on').value = '';
        document.getElementById('monday_time_off').value = '';
        document.getElementById('all_day_monday').disabled = true;
        document.getElementById('all_day_monday_off').disabled = true;

        document.getElementById('all_day_monday').checked = false;
        document.getElementById('all_day_monday_off').checked = false;

        monday_time_on1.disabled = true;
        monday_time_off1.disabled = true;
    }
});

$("input[id='tuesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('tuesday_time_on').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('all_day_tuesday').disabled = false;
        document.getElementById('all_day_tuesday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('tuesday_time_on').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('tuesday_time_on').value = '';
        document.getElementById('tuesday_time_off').value = '';
        document.getElementById('all_day_tuesday').disabled = true;
        document.getElementById('all_day_tuesday_off').disabled = true;

        document.getElementById('all_day_tuesday').checked = false;
        document.getElementById('all_day_tuesday_off').checked = false;

        tuesday_time_on1.disabled = true;
        tuesday_time_off1.disabled = true;
    }
});

$("input[id='wednesday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('wednesday_time_on').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('all_day_wednesday').disabled = false;
        document.getElementById('all_day_wednesday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('wednesday_time_on').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('wednesday_time_on').value = '';
        document.getElementById('wednesday_time_off').value = '';
        document.getElementById('all_day_wednesday').disabled = true;
        document.getElementById('all_day_wednesday_off').disabled = true;

        document.getElementById('all_day_wednesday').checked = false;
        document.getElementById('all_day_wednesday_off').checked = false;

        wednesday_time_on1.disabled = true;
        wednesday_time_off1.disabled = true;
    }
});

$("input[id='thursday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('thursday_time_on').disabled = false;
        document.getElementById('thursday_time_off').disabled = false;
        document.getElementById('all_day_thursday').disabled = false;
        document.getElementById('all_day_thursday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('thursday_time_on').disabled = true;
        document.getElementById('thursday_time_off').disabled = true;
        document.getElementById('thursday_time_on').value = '';
        document.getElementById('thursday_time_off').value = '';
        document.getElementById('all_day_thursday').disabled = true;
        document.getElementById('all_day_thursday_off').disabled = true;

        document.getElementById('all_day_thursday').checked = false;
        document.getElementById('all_day_thursday_off').checked = false;

        thursday_time_on1.disabled = true;
        thursday_time_off1.disabled = true;
    }
});

$("input[id='friday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('all_day_friday').disabled = false;
        document.getElementById('all_day_friday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('friday_time_on').value = '';
        document.getElementById('friday_time_off').value = '';
        document.getElementById('all_day_friday').disabled = true;
        document.getElementById('all_day_friday_off').disabled = true;

        document.getElementById('all_day_friday').checked = false;
        document.getElementById('all_day_friday_off').checked = false;
        friday_time_on1.disabled = true;
        friday_time_off1.disabled = true;
    }
});

$("input[id='saturday']").change(function() {
    var checked = $(this).val();
    if ($(this).is(':checked')) {
        document.getElementById('saturday_time_on').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;
        document.getElementById('all_day_saturday').disabled = false;
        document.getElementById('all_day_saturday_off').disabled = false;
        console.log('ya');
    }else{
        console.log('tidak');
        document.getElementById('saturday_time_on').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;
        document.getElementById('saturday_time_on').value = '';
        document.getElementById('saturday_time_off').value = '';
        document.getElementById('all_day_saturday').disabled = true;
        document.getElementById('all_day_saturday_off').disabled = true;

        document.getElementById('all_day_saturday').checked = false;
        document.getElementById('all_day_saturday_off').checked = false;
        saturday_time_on1.disabled = true;
        saturday_time_off1.disabled = true;
    }
});

let sunday_time_on1 = document.getElementById('sunday_time_on1');
let monday_time_on1 = document.getElementById('monday_time_on1');
let tuesday_time_on1 = document.getElementById('tuesday_time_on1');
let wednesday_time_on1 = document.getElementById('wednesday_time_on1');
let thursday_time_on1 = document.getElementById('thursday_time_on1');
let friday_time_on1 = document.getElementById('friday_time_on1');
let staurday_time_on1 = document.getElementById('saturday_time_on1');

let sunday_time_off1 = document.getElementById('sunday_time_off1');
let monday_time_off1 = document.getElementById('monday_time_off1');
let tuesday_time_off1 = document.getElementById('tuesday_time_off1');
let wednesday_time_off1 = document.getElementById('wednesday_time_off1');
let thursday_time_off1 = document.getElementById('thursday_time_off1');
let friday_time_off1 = document.getElementById('friday_time_off1');
let saturday_time_off1 = document.getElementById('saturday_time_off1');

if(sunday_time_on1){
    sunday_time_on1.disabled = true;
}

if(monday_time_on1){
    monday_time_on1.disabled = true;
}

if(tuesday_time_on1){
    tuesday_time_on1.disabled = true;
}

if(wednesday_time_on1){
    wednesday_time_on1.disabled = true;
}

if(thursday_time_on1){
    thursday_time_on1.disabled = true;
}

if(friday_time_on1){
    friday_time_on1.disabled = true;
}

if(staurday_time_on1){
    staurday_time_on1.disabled = true;
}

// ===========
if(sunday_time_off1){
    sunday_time_off1.disabled = true;
}

if(monday_time_off1){
    monday_time_off1.disabled = true;
}

if(tuesday_time_off1){
    tuesday_time_off1.disabled = true;
}

if(wednesday_time_off1){
    wednesday_time_off1.disabled = true;
}

if(thursday_time_off1){
    thursday_time_off1.disabled = true;
}

if(friday_time_off1){
    friday_time_off1.disabled = true;
}

if(saturday_time_off1){
    saturday_time_off1.disabled = true;
}

// MONDAY ALL DAY
$("input[id='all_day_monday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('monday_time_on').value = '00:00';
            document.getElementById('monday_time_off').value = '23:59';
            document.getElementById('monday_time_on').disabled = true;
            document.getElementById('monday_time_off').disabled = true;
            
            document.getElementById('all_day_monday_off').type = 'checkbox';

            monday_time_on1.disabled = false;
            monday_time_on1.value = '00:00';
            monday_time_off1.disabled = false;
            monday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('monday_time_on').value = '';
            document.getElementById('monday_time_off').value = '';
            document.getElementById('all_day_monday_off').disabled = false;
            document.getElementById('all_day_monday_off').type = 'hidden';

            document.getElementById('monday_time_on').disabled = false;
            document.getElementById('monday_time_off').disabled = false;
            monday_time_on1.disabled = true;
            monday_time_off1.disabled = true;
        }
    // }
});

// TUESDAY ALL DAY
$("input[id='all_day_tuesday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('tuesday_time_on').value = '00:00';
            document.getElementById('tuesday_time_off').value = '23:59';
            document.getElementById('tuesday_time_on').disabled = true;
            document.getElementById('tuesday_time_off').disabled = true;
            
            document.getElementById('all_day_tuesday_off').type = 'checkbox';

            tuesday_time_on1.disabled = false;
            tuesday_time_on1.value = '00:00';
            tuesday_time_off1.disabled = false;
            tuesday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('tuesday_time_on').value = '';
            document.getElementById('tuesday_time_off').value = '';
            document.getElementById('all_day_tuesday_off').disabled = false;
            document.getElementById('all_day_tuesday_off').type = 'hidden';

            document.getElementById('tuesday_time_on').disabled = false;
            document.getElementById('tuesday_time_off').disabled = false;
            tuesday_time_on1.disabled = true;
            tuesday_time_off1.disabled = true;
        }
    // }
});

// WEDNESDAY ALL DAY
$("input[id='all_day_wednesday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('wednesday_time_on').value = '00:00';
            document.getElementById('wednesday_time_off').value = '23:59';
            document.getElementById('wednesday_time_on').disabled = true;
            document.getElementById('wednesday_time_off').disabled = true;
            
            document.getElementById('all_day_wednesday_off').type = 'checkbox';

            wednesday_time_on1.disabled = false;
            wednesday_time_on1.value = '00:00';
            wednesday_time_off1.disabled = false;
            wednesday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('wednesday_time_on').value = '';
            document.getElementById('wednesday_time_off').value = '';
            document.getElementById('all_day_wednesday_off').disabled = false;
            document.getElementById('all_day_wednesday_off').type = 'hidden';

            document.getElementById('wednesday_time_on').disabled = false;
            document.getElementById('wednesday_time_off').disabled = false;
            wednesday_time_on1.disabled = true;
            wednesday_time_off1.disabled = true;
        }
    // }
});

// THURSDAY ALL DAY
$("input[id='all_day_thursday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('thursday_time_on').value = '00:00';
            document.getElementById('thursday_time_off').value = '23:59';
            document.getElementById('thursday_time_on').disabled = true;
            document.getElementById('thursday_time_off').disabled = true;
            
            document.getElementById('all_day_thursday_off').type = 'checkbox';

            thursday_time_on1.disabled = false;
            thursday_time_on1.value = '00:00';
            thursday_time_off1.disabled = false;
            thursday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('thursday_time_on').value = '';
            document.getElementById('thursday_time_off').value = '';
            document.getElementById('all_day_thursday_off').disabled = false;
            document.getElementById('all_day_thursday_off').type = 'hidden';

            document.getElementById('thursday_time_on').disabled = false;
            document.getElementById('thursday_time_off').disabled = false;
            thursday_time_on1.disabled = true;
            thursday_time_off1.disabled = true;
        }
    // }
});

// FRIDAY ALL DAY
$("input[id='all_day_friday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('friday_time_on').value = '00:00';
            document.getElementById('friday_time_off').value = '23:59';
            document.getElementById('friday_time_on').disabled = true;
            document.getElementById('friday_time_off').disabled = true;
            
            document.getElementById('all_day_friday_off').type = 'checkbox';

            friday_time_on1.disabled = false;
            friday_time_on1.value = '00:00';
            friday_time_off1.disabled = false;
            friday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('friday_time_on').value = '';
            document.getElementById('friday_time_off').value = '';
            document.getElementById('all_day_friday_off').disabled = false;
            document.getElementById('all_day_friday_off').type = 'hidden';

            document.getElementById('friday_time_on').disabled = false;
            document.getElementById('friday_time_off').disabled = false;
            friday_time_on1.disabled = true;
            friday_time_off1.disabled = true;
        }
    // }
});

// SATURDAY ALL DAY
$("input[id='all_day_saturday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('saturday_time_on').value = '00:00';
            document.getElementById('saturday_time_off').value = '23:59';
            document.getElementById('saturday_time_on').disabled = true;
            document.getElementById('saturday_time_off').disabled = true;
            
            document.getElementById('all_day_saturday_off').type = 'checkbox';

            saturday_time_on1.disabled = false;
            saturday_time_on1.value = '00:00';
            saturday_time_off1.disabled = false;
            saturday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('saturday_time_on').value = '';
            document.getElementById('saturday_time_off').value = '';
            document.getElementById('all_day_saturday_off').disabled = false;
            document.getElementById('all_day_saturday_off').type = 'hidden';

            document.getElementById('saturday_time_on').disabled = false;
            document.getElementById('saturday_time_off').disabled = false;
            saturday_time_on1.disabled = true;
            saturday_time_off1.disabled = true;
        }
    // }
});

// SUNDAY ALL DAY
$("input[id='all_day_sunday']").change(function() {
    // var checked = $(this).val();
    // let toggleAllDay = document.getElementById('all_day');
    // if(toggleAllDay.checked == true){
    //     if ($(this).is(':checked')) {
    //         console.log('ya');
    //         document.getElementById('monday_time_on').disabled = true;
    //         document.getElementById('monday_time_off').disabled = true;

    //         document.getElementById('monday_time_on').value = document.getElementById('all_time_on').value;
    //         document.getElementById('monday_time_off').value = document.getElementById('all_time_off').value;
    //     }else{
    //         console.log('tidak');
    //         document.getElementById('monday_time_on').disabled = false;
    //         document.getElementById('monday_time_off').disabled = false;
    //     }
    // }else{
        if ($(this).is(':checked')) {
            console.log('ya');
            document.getElementById('sunday_time_on').value = '00:00';
            document.getElementById('sunday_time_off').value = '23:59';
            document.getElementById('sunday_time_on').disabled = true;
            document.getElementById('sunday_time_off').disabled = true;
            
            document.getElementById('all_day_sunday_off').type = 'checkbox';

            sunday_time_on1.disabled = false;
            sunday_time_on1.value = '00:00';
            sunday_time_off1.disabled = false;
            sunday_time_off1.value = '23:59';
        }else{
            console.log('tidak');
            document.getElementById('sunday_time_on').value = '';
            document.getElementById('sunday_time_off').value = '';
            document.getElementById('all_day_sunday_off').disabled = false;
            document.getElementById('all_day_sunday_off').type = 'hidden';

            document.getElementById('sunday_time_on').disabled = false;
            document.getElementById('sunday_time_off').disabled = false;
            sunday_time_on1.disabled = true;
            sunday_time_off1.disabled = true;
        }
    // }
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
        document.getElementById('thursday_time_on').disabled = false;
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('saturday_time_on').disabled = false;
        
        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('thursday_time_off').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;

        document.getElementById('all_day_sunday').disabled = false;
        document.getElementById('all_day_monday').disabled = false;
        document.getElementById('all_day_tuesday').disabled = false;
        document.getElementById('all_day_wednesday').disabled = false;
        document.getElementById('all_day_thursday').disabled = false;
        document.getElementById('all_day_friday').disabled = false;
        document.getElementById('all_day_saturday').disabled = false;

        document.getElementById('all_day_monday_off').disabled = false;
        document.getElementById('all_day_tuesday_off').disabled = false;
        document.getElementById('all_day_wednesday_off').disabled = false;
        document.getElementById('all_day_thursday_off').disabled = false;
        document.getElementById('all_day_friday_off').disabled = false;
        document.getElementById('all_day_saturday_off').disabled = false;
        document.getElementById('all_day_sunday_off').disabled = false;

        // $("#all_day").prop("checked", true);
        $("#sunday").prop("checked", true);
        $("#monday").prop("checked", true);
        $("#tuesday").prop("checked", true);
        $("#wednesday").prop("checked", true);
        $("#thursday").prop("checked", true);
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
        document.getElementById('thursday_time_on').disabled = true;
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('saturday_time_on').disabled = true;

        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('thursday_time_off').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;

        document.getElementById('all_day_monday_off').disabled = true;
        document.getElementById('all_day_tuesday_off').disabled = true;
        document.getElementById('all_day_wednesday_off').disabled = true;
        document.getElementById('all_day_thursday_off').disabled = true;
        document.getElementById('all_day_friday_off').disabled = true;
        document.getElementById('all_day_saturday_off').disabled = true;
        document.getElementById('all_day_sunday_off').disabled = true;

        $("#all_day").prop("checked", false);
        $("#all_day_sunday").prop("checked", false);
        $("#all_day_monday").prop("checked", false);
        $("#all_day_tuesday").prop("checked", false);
        $("#all_day_wednesday").prop("checked", false);
        $("#all_day_thursday").prop("checked", false);
        $("#all_day_friday").prop("checked", false);
        $("#all_day_saturday").prop("checked", false);

        $("#sunday").prop("checked", false);
        $("#monday").prop("checked", false);
        $("#tuesday").prop("checked", false);
        $("#wednesday").prop("checked", false);
        $("#thursday").prop("checked", false);
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

    if(document.getElementById('all_day').checked == true){
        
        document.getElementById('sunday_time_on').value = value;
        if(document.getElementById('sunday_time_on').value >= 24){
            document.getElementById('sunday_time_on').value = "00:00";
        }
        
        if(document.getElementById('all_day_monday').checked == true){
            document.getElementById('monday_time_on').value = value;
            if(document.getElementById('monday_time_on').value >= 24){
                document.getElementById('monday_time_on').value = "00:00";
            }
        }
    
        document.getElementById('tuesday_time_on').value = value;
        if(document.getElementById('tuesday_time_on').value >= 24){
            document.getElementById('tuesday_time_on').value = "00:00";
        }
    
        document.getElementById('wednesday_time_on').value = value;
        if(document.getElementById('wednesday_time_on').value >= 24){
            document.getElementById('wednesday_time_on').value = "00:00";
        }
    
        document.getElementById('thursday_time_on').value = value;
        if(document.getElementById('thursday_time_on').value >= 24){
            document.getElementById('thursday_time_on').value = "00:00";
        }
    
        document.getElementById('friday_time_on').value = value;
        if(document.getElementById('friday_time_on').value >= 24){
            document.getElementById('friday_time_on').value = "00:00";
        }
    
        document.getElementById('saturday_time_on').value = value;
        if(document.getElementById('saturday_time_on').value >= 24){
            document.getElementById('saturday_time_on').value = "00:00";
        }
    
        sunday_time_on1.disabled = false;
        sunday_time_on1.value = document.getElementById('sunday_time_on').value;
    
        monday_time_on1.disabled = false;
        monday_time_on1.value = document.getElementById('monday_time_on').value;
    
        tuesday_time_on1.disabled = false;
        tuesday_time_on1.value = document.getElementById('tuesday_time_on').value;
    
        wednesday_time_on1.disabled = false;
        wednesday_time_on1.value = document.getElementById('wednesday_time_on').value;
    
        thursday_time_on1.disabled = false;
        thursday_time_on1.value = document.getElementById('thursday_time_on').value;
    
        friday_time_on1.disabled = false;
        friday_time_on1.value = document.getElementById('friday_time_on').value;
    
        saturday_time_on1.disabled = false;
        saturday_time_on1.value = document.getElementById('saturday_time_on').value;
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

function inputWednesdayTimeOn(){
    let value = document.getElementById('wednesday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('wednesday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('wednesday_time_on').value = value;
            }
        }   
    }

}

function inputThursdayTimeOn(){
    let value = document.getElementById('thursday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('thursday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('thursday_time_on').value = value;
            }
        }   
    }

}

function inputFridayTimeOn(){
    let value = document.getElementById('friday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('friday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('friday_time_on').value = value;
            }
        }   
    }
}

function inputSaturdayTimeOn(){
    let value = document.getElementById('saturday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('saturday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('saturday_time_on').value = value;
            }
        }   
    }

}

function inputSundayTimeOn(){
    let value = document.getElementById('sunday_time_on').value;
    
    const str = value;
    const substr = ':';
    let check = str.includes(substr);


    
    if(!check){
        if(value.length >= 2){
            if(value >= 24){
                document.getElementById('sunday_time_on').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('sunday_time_on').value = value;
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

    if(document.getElementById('all_day').checked == true){
        document.getElementById('sunday_time_off').value = value;
        if(document.getElementById('sunday_time_off').value >= 24){
            document.getElementById('sunday_time_off').value = "00:00";
        }
        
        document.getElementById('monday_time_off').value = value;
        if(document.getElementById('monday_time_off').value >= 24){
            document.getElementById('monday_time_off').value = "00:00";
        }
    
        document.getElementById('tuesday_time_off').value = value;
        if(document.getElementById('tuesday_time_off').value >= 24){
            document.getElementById('tuesday_time_off').value = "00:00";
        }
    
        document.getElementById('wednesday_time_off').value = value;
        if(document.getElementById('wednesday_time_off').value >= 24){
            document.getElementById('wednesday_time_off').value = "00:00";
        }
    
        document.getElementById('thursday_time_off').value = value;
        if(document.getElementById('thursday_time_off').value >= 24){
            document.getElementById('thursday_time_off').value = "00:00";
        }
    
        document.getElementById('friday_time_off').value = value;
        if(document.getElementById('friday_time_off').value >= 24){
            document.getElementById('friday_time_off').value = "00:00";
        }
    
        document.getElementById('saturday_time_off').value = value;
        if(document.getElementById('saturday_time_off').value >= 24){
            document.getElementById('saturday_time_off').value = "00:00";
        }
    
        sunday_time_off1.disabled = false;
        sunday_time_off1.value = document.getElementById('sunday_time_off').value;
    
        monday_time_off1.disabled = false;
        monday_time_off1.value = document.getElementById('monday_time_off').value;
    
        tuesday_time_off1.disabled = false;
        tuesday_time_off1.value = document.getElementById('tuesday_time_off').value;
    
        wednesday_time_off1.disabled = false;
        wednesday_time_off1.value = document.getElementById('wednesday_time_off').value;
    
        thursday_time_off1.disabled = false;
        thursday_time_off1.value = document.getElementById('thursday_time_off').value;
    
        friday_time_off1.disabled = false;
        friday_time_off1.value = document.getElementById('friday_time_off').value;
    
        saturday_time_off1.disabled = false;
        saturday_time_off1.value = document.getElementById('saturday_time_off').value;
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

function inputWednesdayTimeOff(){
    let value = document.getElementById('wednesday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('wednesday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('wednesday_time_off').value = value;
            }
        }   
    }
}

function inputThursdayTimeOff(){
    let value = document.getElementById('thursday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('thursday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('thursday_time_off').value = value;
            }
        }   
    }
}

function inputFridayTimeOff(){
    let value = document.getElementById('friday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('friday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('friday_time_off').value = value;
            }
        }   
    }
}

function inputSaturdayTimeOff(){
    let value = document.getElementById('saturday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('saturday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('saturday_time_off').value = value;
            }
        }   
    }
}

function inputSundayTimeOff(){
    let value = document.getElementById('sunday_time_off').value;
    console.log(value);

    const str = value;
    const substr = ':';
    let check = str.includes(substr);

    
    if(!check){
        if(value.length >= 2){
            if(value > 24){
                document.getElementById('sunday_time_off').value = "00:00";
            }else{
                value = value.substring(0,2) + ":" + value.substring(2,4);
                console.log(value);
                document.getElementById('sunday_time_off').value = value;
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
        $("#all_day_thursday").prop("checked", true);
        $("#all_day_friday").prop("checked", true);
        $("#all_day_saturday").prop("checked", true);

        $("#sunday").prop("checked", true);
        $("#monday").prop("checked", true);
        $("#tuesday").prop("checked", true);
        $("#wednesday").prop("checked", true);
        $("#thursday").prop("checked", true);
        $("#friday").prop("checked", true);
        $("#saturday").prop("checked", true);

        document.getElementById('sunday_time_on').disabled = true;
        document.getElementById('monday_time_on').disabled = true;
        document.getElementById('tuesday_time_on').disabled = true;
        document.getElementById('wednesday_time_on').disabled = true;
        document.getElementById('thursday_time_on').disabled = true;
        document.getElementById('friday_time_on').disabled = true;
        document.getElementById('saturday_time_on').disabled = true;

        document.getElementById('sunday_time_off').disabled = true;
        document.getElementById('monday_time_off').disabled = true;
        document.getElementById('tuesday_time_off').disabled = true;
        document.getElementById('wednesday_time_off').disabled = true;
        document.getElementById('thursday_time_off').disabled = true;
        document.getElementById('friday_time_off').disabled = true;
        document.getElementById('saturday_time_off').disabled = true;

        document.getElementById('all_day_sunday_off').type = 'checkbox';
        document.getElementById('all_day_monday_off').type = 'checkbox';
        document.getElementById('all_day_tuesday_off').type = 'checkbox';
        document.getElementById('all_day_wednesday_off').type = 'checkbox';
        document.getElementById('all_day_thursday_off').type = 'checkbox';
        document.getElementById('all_day_friday_off').type = 'checkbox';
        document.getElementById('all_day_saturday_off').type = 'checkbox';

        let valueAllTimeOn = document.getElementById('all_time_on').value;

        document.getElementById('sunday_time_on1').disabled = false;
        document.getElementById('sunday_time_on1').value = valueAllTimeOn;
        document.getElementById('sunday_time_on').value = valueAllTimeOn;

        document.getElementById('monday_time_on1').disabled = false;
        document.getElementById('monday_time_on1').value = valueAllTimeOn;
        document.getElementById('monday_time_on').value = valueAllTimeOn;

        document.getElementById('tuesday_time_on1').disabled = false;
        document.getElementById('tuesday_time_on1').value = valueAllTimeOn;
        document.getElementById('tuesday_time_on').value = valueAllTimeOn;

        document.getElementById('wednesday_time_on1').disabled = false;
        document.getElementById('wednesday_time_on1').value = valueAllTimeOn;
        document.getElementById('wednesday_time_on').value = valueAllTimeOn;

        document.getElementById('thursday_time_on1').disabled = false;
        document.getElementById('thursday_time_on1').value = valueAllTimeOn;
        document.getElementById('thursday_time_on').value = valueAllTimeOn;

        document.getElementById('friday_time_on1').disabled = false;
        document.getElementById('friday_time_on1').value = valueAllTimeOn;
        document.getElementById('friday_time_on').value = valueAllTimeOn;

        document.getElementById('saturday_time_on1').disabled = false;
        document.getElementById('saturday_time_on1').value = valueAllTimeOn;
        document.getElementById('saturday_time_on').value = valueAllTimeOn;

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
        $("#all_day_thursday").prop("checked", false);
        $("#all_day_friday").prop("checked", false);
        $("#all_day_saturday").prop("checked", false);

        document.getElementById('sunday_time_on').disabled = false;
        document.getElementById('monday_time_on').disabled = false;
        document.getElementById('tuesday_time_on').disabled = false;
        document.getElementById('wednesday_time_on').disabled = false;
        document.getElementById('thursday_time_on').disabled = false;
        document.getElementById('friday_time_on').disabled = false;
        document.getElementById('saturday_time_on').disabled = false;

        document.getElementById('sunday_time_off').disabled = false;
        document.getElementById('monday_time_off').disabled = false;
        document.getElementById('tuesday_time_off').disabled = false;
        document.getElementById('wednesday_time_off').disabled = false;
        document.getElementById('thursday_time_off').disabled = false;
        document.getElementById('friday_time_off').disabled = false;
        document.getElementById('saturday_time_off').disabled = false;

        document.getElementById('sunday_time_on1').disabled = true;
        document.getElementById('sunday_time_on').value = '';

        document.getElementById('monday_time_on1').disabled = true;
        document.getElementById('monday_time_on').value = '';

        document.getElementById('tuesday_time_on1').disabled = true;
        document.getElementById('tuesday_time_on').value = '';

        document.getElementById('wednesday_time_on1').disabled = true;
        document.getElementById('wednesday_time_on').value = '';

        document.getElementById('thursday_time_on1').disabled = true;
        document.getElementById('thursday_time_on').value = '';

        document.getElementById('friday_time_on1').disabled = true;
        document.getElementById('friday_time_on').value = '';

        document.getElementById('saturday_time_on1').disabled = true;
        document.getElementById('saturday_time_on').value = '';
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
    // console.log('asjhasjdhgasdkjbas,djhgasjkgdhasd');
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

var route1 = "/newBooking/autocomplete-search";
    $('#searchService').typeahead({
        source: function (query, process) {
            console.log(query);
            return $.get(route1, {
                query: query
            }, function (data) {
                console.log(data);
                return process(data);
            });
        }
    });

$('.searchService').on('typeahead:selected', function (e, datum) {
    console.log(datum);
    // $('#item_code').val(datum.item_code);
});

var route2 = "/newBooking/alasan/autocomplete-search";
    $('#alasan_kunjungan').typeahead({
        source: function (query, process) {
            console.log(query);
            return $.get(route2, {
                query: query
            }, function (data) {
                console.log(data);
                return process(data);
            });
        }
    });

$('.alasan_kunjungan').on('typeahead:selected', function (e, datum) {
    console.log(datum);
    // $('#item_code').val(datum.item_code);
});

function updateUnit(e){
    let unit_name = document.getElementById('unit_name' + e);
    console.log(unit_name.value);
}

function testing(){
    let unit_name = document.getElementById('unit_name' + e);
    console.log(unit_name);
}

function createNewList(){
    console.log('129387');
}

function saveTreatment(){
    document.getElementById('submitTreatment').click();
}

function inputCategoryService(){
    let category_service_name = document.getElementById('category_name');

    let buttonSubmitCategory = document.getElementById('saveCategory');
    if(category_service_name.value == null || category_service_name.value == ''){
        buttonSubmitCategory.disabled = true;
    }else{
        buttonSubmitCategory.disabled = false;
    }
}

function inputProductBrandService(){
    let product_brand_name = document.getElementById('product_brand_name');

    let buttonSubmitProductBrand = document.getElementById('saveBrand');
    if(product_brand_name.value == null || product_brand_name.value == ''){
        buttonSubmitProductBrand.disabled = true;
    }else{
        buttonSubmitProductBrand.disabled = false;
    }
}

function inputPositionService(){
    let product_brand_name = document.getElementById('product_brand_name');

    let buttonSubmitProductBrand = document.getElementById('saveBrand');
    if(product_brand_name.value == null || product_brand_name.value == ''){
        buttonSubmitProductBrand.disabled = true;
    }else{
        buttonSubmitProductBrand.disabled = false;
    }
}

function inputProductCategoryService(){
    let product_brand_name = document.getElementById('category_name');

    let buttonSubmitProductBrand = document.getElementById('saveCategoryProduct');
    if(product_brand_name.value == null || product_brand_name.value == ''){
        buttonSubmitProductBrand.disabled = true;
    }else{
        buttonSubmitProductBrand.disabled = false;
    }
}

function inputProductSupplierService(){
    let product_brand_name = document.getElementById('suppliers_name');

    let buttonSubmitProductBrand = document.getElementById('saveSupplier');
    if(product_brand_name.value == null || product_brand_name.value == ''){
        buttonSubmitProductBrand.disabled = true;
    }else{
        buttonSubmitProductBrand.disabled = false;
    }
}


function inpuDiagnosisService(){
    let diagnosis_name = document.getElementById('diagnosis_name');

    let buttonSubmitDiagnosis = document.getElementById('saveDiagnosis');
    if(diagnosis_name.value == null || diagnosis_name.value == ''){
        buttonSubmitDiagnosis.disabled = true;
    }else{
        buttonSubmitDiagnosis.disabled = false;
    }
}





function changeLocation(e){
    if(e.value){
        document.getElementById('buttonfilter').disabled = false;
    }else{
        document.getElementById('buttonfilter').disabled = true;
    }
    let filterLocation = document.getElementById('formFilterLocation');
    if(filterLocation){
        filterLocation.action = "list/" + e.value;
    }

    let filterLocation2 = document.getElementById('formFilterLocation2');
    if(filterLocation2){
        filterLocation2.action = "managestaff/" + e.value;
    }
}

var arrayOfCategory = [];

// $("input[name='checkBox']").change(function() {
//     var checked = $(this).val();
//     if ($(this).is(':checked')) {
//         arrayOfId.push(checked);
//         arrayOfName.push(checked);
//     }else{
//         arrayOfId.splice($.inArray(checked, arrayOfId),1);
//     }

//     var x = document.getElementById("deleteButton");
//     if(arrayOfId.length != 0){
//         x.style.display = "block";
//         console.log('tidak');
//     }else{
//         x.style.display = "none";
//         console.log('yes');
//     }

//     console.log(arrayOfId);
// });

$("input[name='checkCategory']").change(function() {
    var checkedValue = $(this).val();

    if ($(this).is(':checked')) {
        arrayOfCategory.push(checkedValue);
    }else{
        arrayOfCategory.splice($.inArray(checkedValue, arrayOfCategory),1);
    }

    let category = document.getElementById('category');
    category.value = arrayOfCategory;
});

$("#rawat_inap").change(function(){
    if ($(this).is(':checked')) {
        let duration_field = document.getElementById('duration_field');
        duration_field.style.display = "block";
    }else{
        let duration_field = document.getElementById('duration_field');
        duration_field.style.display = "none";
    }
});

// $("#service_price_id").change(function(){
    
//     let price = document.getElementById('service_price2');
//     console.log(price);
// });

// function selectPrice(){
//     console.log(($(this)));
//     var e = document.getElementById("service_price_id");
//     var value = e.value;
    
//     var f = document.getElementById("selectedPrice" + value);
//     // console.log(f.value);

//     var price = document.getElementById("price");
//     price.value = f.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }

// var text = e.options[e.selectedIndex].text;
