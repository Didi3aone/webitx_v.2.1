<script> 

// app.controller('UserRegister', function ($scope, $filter, $window, $http) {

    $(document).ready(function() {
        validate();
        $('.btn-submit').attr('disabled', true);  
        $('#terms').change(function() {
            if($(this).is(":checked")) {
                $('.btn-submit').attr('disabled', false);        
            } else {
                $('.btn-submit').attr('disabled', true);  
            }
        });
    });

    // function unique password
    jQuery.validator.addMethod("passwordCheck",
        function(value, element, param) {
            if (this.optional(element)) {
                return true;
            } else if (!/[A-Z]/.test(value)) {
                return false;
            } else if (!/[a-z]/.test(value)) {
                return false;
            } else if (!/[0-9]/.test(value)) {
                return false;
            }

            return true;
        },
        "Please enter a password with a combination of upper and lower case letters");

    // function validate form
    function validate() {
    
        var form = $("#forms"); 
        var submit = $("#forms .btn-submit");

        $(form).validate({
            errorClass      : 'invalid',
            errorElement    : 'span',

            highlight: function(element) {
                // console.log(element);
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },

            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            debug: true,

            //rules form validation
            rules:
            {
                first_name:
                {
                    required: true,
                },
                last_name:
                {
                    required: true,
                },
                username:
                {
                    required: true,
                },
                nik:
                {
                    required: true,
                    number: true,
                },
                gender:
                {
                    required: true,
                },
                birth_date:
                {
                    required: true,
                },
                email:
                {
                    required: true,
                },
                phone:
                {
                    required: true,
                    number: true,
                },
                password:
                {
                    passwordCheck: true,
                    required: true,
                    minlength: 8
                },
                'repassword':
                {
                    required: true,
                    equalTo: "#password"
                },
            },
            //messages
            messages:
            {
                // first_name: 'isi woy',
                // phone: 'isi woy',
            },
            //ajax form submition
            submitHandler: function(form)
            {
                $(form).ajaxSubmit({
                    dataType: 'json',
                    beforeSend: function()
                    {
                        $(submit).attr('disabled', true);
                        $('.page_preloader').css('opacity', '0.8');
                        $('.page_preloader').css('z-index', '9999');
                        $('.page_preloader').css('display', 'block');
                    },
                    headers: { 'X-CSRF-TOKEN': getCookiebyName('5f05193eee9e900380c12e6040e7dee9') },
                    success: function(data)
                    {
                        stopLoading();
                        //validate if error
                        if(data['is_error'] == true) {
                            // stopLoading();
                            swal("Oops!", data['error_msg'], "error");
                            $(submit).attr('disabled', false);
                        } 
                        else {
                            //succes
                            swal({
                                title: data['title_msg'],
                                text: data['success_msg'],
                                type: "success",
                                allowOutsideClick: true,
                                confirmButtonText: "OK"
                            }).then(function() {
                                location.href = data['redirect'];
                            }, function(dismiss) {
                                location.reload();
                            })
                        }                   
                    },
                    error: function() {
                        stopLoading();
                        $(submit).attr('disabled', false);
                        // swal("Oops", "Something went wrong.", "error");
                    }
                });
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
                // swal("Oops", "Something went wrong.", "error");
            },
        });
    }
// });
</script>