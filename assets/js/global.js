$( function() {
    $(".datepicker" ).datepicker({
        dateFormat : 'dd-mm-yy',
        changeMonth : true,
        changeYear : true,
        maxDate : '-17Y',
        yearRange: "c-100:c",
    });

    $(".datepickers" ).datepicker({
        dateFormat : 'dd-mm-yy',
        changeMonth : true,
        changeYear : true,
        // yearRange: "-100:+0",
    });

    //submit handler from external button.
    $(".submit-form").on("click", function() {
        var formID = $(this).data("form-target");
        $("#" + formID).submit();
    });
});

$(document).ready(function() {
    $('#init-table').DataTable({
    	"bPaginate": false,
    	"bInfo": false,
    });
});

    
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
/**
 * function for popup delete with ajax
 * ==== PARAMS ====
 * @url : url untuk delete , eg : "/orang/delete"
 * @data_id : id untuk delete , eg : 1
 * @title : title dari pop up , eg : "Delete Confirmation"
 * @content : content dari pop up , eg : "want to delete ?"
 * ==== TRIGGER =====
 * delete-confirm:success => saat form submit sudah sukses.
 */
function popup_confirm (url, data_id, title = false, content = false, replace_data = false, type="warning") {
    if (title === false) title = 'Delete Confirmation';
    if (content === false) content = 'Do you really want to delete this ?';
    if (replace_data === false) replace_data = { id: data_id };

    swal({
        title: title,
        text: content,
        type: type,
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then(function () {
        $.ajax({
            type: "post",
            url: url,
            cache: false,
            data: replace_data,
            dataType: 'json',
            beforeSend: function() {
                $('.page_preloader').css('opacity', '0.8');
                $('.page_preloader').css('z-index', '9999');
                $('.page_preloader').css('display', 'block');
            },
            success: function(data) {
                stopLoading();

                if (data.is_error == true) swal("Error!", data.error_msg, "error");
                else {
                    swal({
                        title: "Success",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: true,
                        confirmButtonText: "OK"
                    }).then(function() {
                        location.reload();
                    }, function(dismiss) {
                        location.reload();
                    })
                }
            },
            error: function() {
                $('.loading-box').css("display", "none");
                swal("Error!", "Something Went wrong", "error");
            }
        });
    }).catch(swal.noop);;
}

// function popup_cancels (url, data_id, type, title = false, content = false, replace_data = false, type="warning") {
//     if (title === false) title = 'Delete Confirmation';
//     if (content === false) content = 'Do you really want to delete this ?';
//     if (replace_data === false) replace_data = { id: data_id , tipe: type};

//     swal({
//         title: title,
//         text: content,
//         type: type,
//         showCancelButton: true,
//         confirmButtonText: "Yes",
//     }).then(function () {
//         $.ajax({
//             type: "post",
//             url: url,
//             cache: false,
//             data: replace_data,
//             dataType: 'json',
//             beforeSend: function() {
//                 $('.page_preloader').css('opacity', '0.8');
//                 $('.page_preloader').css('z-index', '9999');
//                 $('.page_preloader').css('display', 'block');
//             },
//             success: function(data) {
//                 stopLoading();

//                 if (data.is_error == true) swal("Error!", data.error_msg, "error");
//                 else {
//                     swal({
//                         title: "Success",
//                         text: data.message,
//                         type: "success",
//                         allowOutsideClick: true,
//                         confirmButtonText: "OK"
//                     }).then(function() {
//                         location.reload();
//                     }, function(dismiss) {
//                         location.reload();
//                     })
//                 }
//             },
//             error: function() {
//                 $('.loading-box').css("display", "none");
//                 swal("Error!", "Something Went wrong", "error");
//             }
//         });
//     }).catch(swal.noop);;
// }

function stopLoading() {
    $('.page_preloader').fadeOut(800);

    $('body, html').css({
        'overflow' : 'auto',
        'max-width' : 'none',
        'max-height' : 'none'
    });
}
