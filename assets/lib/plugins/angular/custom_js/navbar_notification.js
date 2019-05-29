function getCountInvoice() {

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_count_invoice",
        dataType: 'json',
        success: function (response) {
            $("#jumlahINV").text("" + response[0].jumlahINV + "");
            timer = setTimeout("getCountInvoice()", 3000);
        }
    });
};
function getCountPV() {

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_count_pv",
        dataType: 'json',
        success: function (response) {
            $("#jumlahPV").text("" + response[0].jumlahPV + "");
            timer = setTimeout("getCountPV()", 3000);
        }
    });
};
function getCountRV() {

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_count_rv",
        dataType: 'json',
        success: function (response) {
            $("#jumlahRV").text("" + response[0].jumlahRV + "");
            timer = setTimeout("getCountRV()", 3000);
        }
    });
};
function getCountPetty() {

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_count_petty",
        dataType: 'json',
        success: function (response) {
            $("#jumlahPetty").text("" + response[0].jumlahPetty + "");
            timer = setTimeout("getCountPetty()", 3000);
        }
    });
};
function getPV() {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_pv",
        type: 'POST',
        data: $("").serialize(),
        cache: false,
        success: function (data) {
            $('#GETHeadPV').html(data);
            console.log(data);
            timer = setTimeout("getPV()", 3000);
        }
    });
};
function getRV() {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_rv",
        type: 'POST',
        data: $("").serialize(),
        cache: false,
        success: function (data) {
            $('#GETHeadRV').html(data);
            console.log(data);
            timer = setTimeout("getRV()", 3000);
        }
    });
};
function getPetty() {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_petty",
        type: 'POST',
        data: $("").serialize(),
        cache: false,
        success: function (data) {
            $('#GETHeadPetty').html(data);
            console.log(data);
            timer = setTimeout("getPetty()", 3000);
        }
    });
};
function getInvoice() {

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>c_get_notification/get_invoice",
        type: 'POST',
        data: $("").serialize(),
        cache: false,
        success: function (data) {
            $('#GETHeadINV').html(data);
            console.log(data);
            timer = setTimeout("getInvoice()", 3000);
        }
    });
};
$(document).ready(function () {
        getCountPV();
        getCountRV();
        getCountPetty();
    getCountInvoice();
        getPV();
        getRV();
        getPetty();
    getInvoice();

});



