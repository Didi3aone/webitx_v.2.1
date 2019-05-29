<script>
	jQuery(document).ready(function($) {
		validate();	
	});
	// function validate form
    function validate() {
        var form 	= $("#form-login"); 
        var submit 	= $("#form-login .btn-submit");

        $(form).validate({
            errorClass      : 'invalid',
            errorElement    : 'em',

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
                param_mail_name:
                {
                    required: true,
                },
                password:
                {
                    required: true,
                },
            },

            //messages
            messages:
            {},
            
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
                            console.log(data['title_msg']);
                            console.log(data['success_msg']);
                            //success
                            swal({
                                title: data['title_msg'],
                                text: '',
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton: true
                            }).then(
                                function () {
                                    location.href = data['redirect'];
                                },
                                // handling the promise rejection
                                function (dismiss) {
                                    if (dismiss === 'timer') {
                                    //console.log('I was closed by the timer')
                                    }
                                }
                            )
                        }                   
                    },
                    error: function() {
                        stopLoading();
                        $(submit).attr('disabled', false);
                    }
                });
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            },
        });
    }
</script>