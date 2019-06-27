<?php 	
	$city 			= (isset($mitra_info->city)) ? $mitra_info->city : ""; 
	$sub_district 	= (isset($mitra_info->sub_district)) ? $mitra_info->sub_district : ""; 
?>
<script>
	//image preview function
	function readURL(input) {

	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#preview').attr('src', e.target.result);
	    }

	    	reader.readAsDataURL(input.files[0]);
	  	}
	}

	//image read
	$("#imgInp").change(function() {
	  	readURL(this);
	});

	//image preview function
	function readURLMitra(input) {

	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#preview_mitra').attr('src', e.target.result);
	    }

	    	reader.readAsDataURL(input.files[0]);
	  	}
	}

	//image read
	$("#img_mitra").change(function() {
	  	readURLMitra(this);
	});
	
	//btn seller
	$('.btn-seller').click(function() {
        $("#seller-form").show(); 
    });

    //select  type buyer
    $('.buyer-tipe-select').on('change', function() {
        // alert( this.value );
        if(this.value == 1) {
            $('#form-api').show();    
            $('#form-white-label').hide();
            $('#form-ta').hide();
        } else if(this.value == 2) {
            $('#form-white-label').show();
            $('#form-api').hide();   
            $('#form-ta').hide();
        } else {
            $('#form-ta').show();
            $('#form-white-label').hide();
            $('#form-api').hide();   
        }
    });

    //choose request
    $("input[name='change_request']").change(function(){
	    // Do something interesting here
	    var id = $(this).val();
	    console.log(id);
	    if( id == 2 ) {
	    	$('.temporary').show();
	    } else {
	    	$('.temporary').hide();
	    }
	});

	// validate buyer
	// form validate for request seller
	function validate() {
	
		var form = $("#forms");	
		var submit = $("#forms .btn-submit");

		$(form).validate({
			errorClass      : 'invalid',
	        errorElement    : 'em',

	        highlight: function(element) {
	            $(element).parent().removeClass('state-success').addClass("state-error");
	            $(element).removeClass('valid');
	        },

	        unhighlight: function(element) {
	            $(element).parent().removeClass("state-error").addClass('state-success');
	            $(element).addClass('valid');
	        },
			//rules form validation
			rules:
			{
				'agree_nda_check':
				{
					required: true,
				},
				'buyer_type':
				{
					required: true,
				},
				'ip_dev_1':
				{
					required: true,
				},
				'ip_production' : {
					required: true,
				},
				'protocols' : {
					required: true,
				},
				'ports' : {
					required: true,
				},
				'agree_ip_whitelist' : {
					required: true
				},
				agree_policy_check_buyer: {
					required : true
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: "Request success!",
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
			},
		});
	}

	// validate_seller
	// form validate for request seller
	function validate_seller() {
	
		var form = $("#forms_seller");	
		var submit = $("#forms_seller .btn-submit-seller");

		$(form).validate({
			errorClass      : 'invalid',
	        errorElement    : 'em',

	        highlight: function(element) {
	            $(element).parent().removeClass('state-success').addClass("state-error");
	            $(element).removeClass('valid');
	        },

	        unhighlight: function(element) {
	            $(element).parent().removeClass("state-error").addClass('state-success');
	            $(element).addClass('valid');
	        },
			//rules form validation
			rules:
			{
				'agree_policy_check_seller':
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: "Request success!",
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
			},
		});
	}

	// validate_dokumen
	// form validate upload document
	function validate_dokumen() {
	
		var form = $("#forms_dokumen");	
		var submit = $("#forms_dokumen .btn-submit-dokumen");

		$(form).validate({
			errorClass      : 'invalid',
	        errorElement    : 'em',

	        highlight: function(element) {
	            $(element).parent().removeClass('state-success').addClass("state-error");
	            $(element).removeClass('valid');
	        },

	        unhighlight: function(element) {
	            $(element).parent().removeClass("state-error").addClass('state-success');
	            $(element).addClass('valid');
	        },
			//rules form validation
			rules:
			{},
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: data['success_msg'],
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
			    element.closest("div").removeClass('has-success').addClass('has-error');
			},
			success: function(error, element) {
			    $(element).closest("div").addClass('has-success').removeClass('has-error');
			}
		});
	}

	// validate buyer
	// form validate for request seller
	function validate_mitra() {
	
		var form = $("#forms_mitra");	
		var submit = $("#forms_mitra .btn-submit-mitra");

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
				brand: {
					required: true,
				},
				phone_no: {
					required: true,
					number: true
				},
				mobile_no: {
					required: true,
					number: true
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: data['success_msg'],
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
			},
		});
	}

	// function validate form
    function validate_profile() {
    
        var form = $("#forms_profile"); 
        var submit = $("#forms_profile .btn-submit");

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
                            //succes
                            swal({
                                title: 'Success',
                                text: data['success_msg'],
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

	// function validate_change_password form
    function validate_change_password() {
    
        var form = $("#change_pass_form"); 
        var submit = $("#change_pass_form .btn-submits");

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
                oldpass:
                {
                    required: true,
                    minlength: 8
                },
                newpass:
                {
                	passwordCheck: true,
                    required: true,
                    minlength: 8
                },
                'newconfirm':
                {
                    required: true,
                    equalTo: "#newpass"
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
                            //succes
                            swal({
                                title: 'Success',
                                text: data['success_msg'],
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

    // validate buyer
	// form validate for request seller
	function validate_kontak() {
	
		var form = $("#forms_kontak");	
		var submit = $("#forms_kontak .btn-submit-kontak");

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
				name: {
					required: true,
				},
				name_ops: {
					required: true,
				},
				email: {
					required: true,
					email:true,
				},
				email_ops: {
					required: true,
					email:true,
				},
				phone: {
					required: true,
					number: true
				},
				phone_ops: {
					required: true,
					number: true
				},
				mobile: {
					required: true,
					number: true
				},

				mobile_ops: {
					required: true,
					number: true
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: data['success_msg'],
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
			},
		});
	}

	// validate_rekening
	// form validate rekening
	function validate_rekening() {
	
		var form = $("#forms_rekening");	
		var submit = $("#forms_rekening .btn-submit-rekening");

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
				bank_name: {
					required: true,
				},
				bank_account: {
					required: true,
				},
				bank_user: {
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
						// $('.loading').css("display","none");
						if(data['is_error']) {
							// stopLoading();
							swal("Oops!", data['error_msg'], "error");
							$(submit).attr('disabled', false);
						} 
						else {
							//succes
							swal({
		                        title: "Success",
		                        text: data['success_msg'],
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
						stopLoading();
						$(submit).attr('disabled', false);
						swal("Oops", "Something went wrong.", "error");
					}
				});
			},
			errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
			},
		});
	}

	//load kabupaten		
    function load_kabupaten(selected)
	{
		// alert(selected);
		console.log(selected);
		var $province        = $('#province');
			get_province_id = $province.find(':selected').data('id');
		$('[name=city].select2').children().eq(0).nextAll('option').remove();

		$.post (
			'<?php echo site_url('/member/get_city'); ?>'
			, { id: get_province_id }
			, function(response) {
				$.each (response, function(key, obj) {
					var option = '<option data-id="'+obj.id+'" value="'+obj.name+'">'+obj.name+'</option>';
					$('[name=city].select2').append(option);
				});
				
				$('[name=city].select2').val(selected).trigger('change');
			}
		);
	}

	//load kecamatan
	function kecamatan () 
	{
		var $city        = $('#citys');
		// $('[name=sub_district].select2').children().eq(0).nextAll('option').remove();
		$('.selectKec').select2({
	        placeholder: '--- Select Item ---',
	        allowClear: true,
		    multiple: false,
		    delay: 250,
	        ajax: {
	          	url: "<?= site_url('member/list_kecamatan'); ?>",
	         	dataType: 'json',
	          	delay: 250,
	          	data: function(params) {
	                return {
	                    q: params.term,
	                    page: params.page,
	                    kab_id: $city.find(':selected').data('id'),
	                };
	            },
	          	processResults: function (data) {
	          		console.log(data);
	            	return {
	              		results: data
	            	};
	          	},
		        cache: true
        	}
	    });
	}

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

	
	//INIT function
	$(document).ready(function() {

		//init validate;
		validate();
		validate_seller();
		validate_dokumen();
		validate_mitra();
		validate_kontak();
		validate_rekening();
		validate_profile();
		kecamatan();

		load_kabupaten('<?php echo $city; ?>');

		// event binding
		$('[name=province].select2').change(function() {
			load_kabupaten(null);
			// $('[name="sub_district]').val('');
			// console.log($('[name="sub_district]').val());
		});

	    $('#ktp').click(function(e){
	    	e.preventDefault();
	        $('#scktp').click();
	    });

	    $('#scktp').change(function(){
	        var file = document.getElementById('scktp').files[0];
	        if(file){
	            $('#ktpid').text(file.name);
	        }
	    });

	    $('#npwp').click(function(e){
	    	e.preventDefault();
	        $('#scnpwp').click();
	    });

	    $('#scnpwp').change(function(){
	        var file = document.getElementById('scnpwp').files[0];
	        if(file){
	            $('#npwpid').text(file.name);
	        }
	    });

	    $('#siup').click(function(e){
	    	e.preventDefault();
	        $('#scsiup').click();
	    });

	    $('#scsiup').change(function(){
	        var file = document.getElementById('scsiup').files[0];
	        if(file){
	            $('#siupid').text(file.name);
	        }
	    });

	    $('#akta').click(function(e){
	    	e.preventDefault();
	        $('#scakta').click();
	    });

	    $('#scakta').change(function(){
	        var file = document.getElementById('scakta').files[0];
	        if(file){
	            $('#aktaid').text(file.name);
	        }
	    });

	    $('#sk').click(function(e){
	    	e.preventDefault();
	        $('#scsk').click();
	    });

	    $('#scsk').change(function(){
	        var file = document.getElementById('scsk').files[0];
	        if(file){
	            $('#skid').text(file.name);
	        }
	    });
	    
	    $('#selfie').click(function(e){
	    	e.preventDefault();
	        $('#scselfie').click();
	    });

	    $('#scselfie').change(function(){
	        var file = document.getElementById('scselfie').files[0];
	        if(file){
	            $('#selfieid').text(file.name);
	        }
	    });
	});

</script>