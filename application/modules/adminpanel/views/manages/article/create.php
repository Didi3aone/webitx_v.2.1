<?=$ViewHead?>
<body>
<?=$ViewPreLoader?>
<style>
    .has-error {
    color:red;
    }
    .has-success {
        color:green;
    }
    .form-horizontal .state-error input,  .state-error select,  .state-error textarea,  .radio.state-error i,  .checkbox.state-error i,  .toggle.state-error i,  .state-error .select2-selection {
        background: #fff0f0;
        border-color: #A90329;
    }
    .invalid {
        border-color: #A90329;
        color:red;
        margin-left: 27%
    }
</style>
<?php 
    $id                 = (isset($data['articleid'])) ? $data['articleid'] : 0; 
    $title              = (isset($data['title'])) ? $data['title'] : ""; 
    $seo_url            = (isset($data['seo_url'])) ? $data['seo_url'] : ""; 
    $category_id        = (isset($data['category_id'])) ? $data['category_id'] : ""; 
    $photo              = (isset($data['photo_real'])) ? $data['photo_real'] : ""; 
    $meta_keywords      = (isset($data['meta_keywords'])) ? $data['meta_keywords'] : "";
    $meta_description   = (isset($data['meta_description'])) ? $data['meta_description'] : "";
    $content            = (isset($data['content'])) ? $data['content'] : ""; 
    // print_r($data);die;
?>
<section>
	<?= $ViewLeftPanel ?>
	<div class="mainpanel">
	<?= $ViewHeaderBar ?>
        <div class="contentpanel cs_df"> 
            <form action="<?= site_url('adminpanel/manages/proses_form_article'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="forms">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="panel panel-default">
                    <!-- Header Form -->
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="#" class="minimize">&minus;</a>
                            <a class="pointer" ng-click="GoToList()"><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>| </a>
                        </div>
                        <h4 class="panel-title">Form Input</h4>
                    </div>
                    <!-- End Header Form -->

                    <!-- Body Form -->
                    <div class="panel-body">
                        <div class="panel-heading">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input name="title" type="text" id="title" class="form-control" value="<?php echo $title; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Seo URL</label>
                                <div class="col-sm-9">
                                    <input name="seo_url" type="text" id="seo" value="<?= $seo_url; ?>" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori</label>
                                <div class="col-sm-9">
                                    <?= select_type('category_id', $category_id, 'class="form-control"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Photo</label>
                                <div class="col-sm-9">
                                    <input name="photo" id="imgInp" type="file" class="form-control"/>
                                </div>
                            </div>
                            <?php if(empty($id)) : ?>
                            <div class="form-group" id="previews" style="display:none;">
                                <label class="col-sm-3 control-label">Preview</label>
                                <div class="col-sm-9">
                                    <img src="" id="preview" alt="" width=200>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="form-group" id="previews" style="display:block;">
                                <label class="col-sm-3 control-label">Preview</label>
                                <div class="col-sm-9">
                                    <img src="<?= base_url($photo); ?>" id="preview" alt="" width=200>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Contact Center 1 -->

                        <div class="panel-heading">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta Keywords</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="meta_keywords" id="" class="form-control">
                                        <?= $meta_keywords; ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta Description</label>
                                <div class="col-sm-9">
                                <textarea rows="5" name="meta_description"  id="" class="form-control">
                                    <?= $meta_description; ?>
                                </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Content</label>
                                <div class="col-sm-9">
                                    <textarea rows="5" name="content" id="Address" class="form-control ckeditorr">
                                        <?= $content; ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- End Address -->


                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary btn-submit">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Body Form -->
                </div>
            </form>
            <?=$ViewCopyRight?>
        </div>
    </div><!-- mainpanel -->

</section>

<?=$ViewFooter?>
<script src="<?=base_url('assets/adminpanel/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?=base_url('assets/adminpanel/js/ckeditor/adapters/jquery.js')?>"></script> 

<script type="text/javascript">
    
    //read url image
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
        $('#previews').show();
    });

    $( 'textarea.ckeditorr' ).ckeditor();

    function convertToSlug(Text)
	{
	    return Text
	        .toLowerCase()
	        .replace(/ /g,'-')
	        .replace(/[^\w-]+/g,'')
	        ;
    }
    
    function stopLoading() {
        $('#preloader').fadeOut(800);

        $('body, html').css({
            'overflow' : 'auto',
            'max-width' : 'none',
            'max-height' : 'none'
        });
    }

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
                'title':
                {
                    required: true,
                },
                'seo_url':
                {
                    required: true,
                },
                'category_id' : {
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
                        $('#preloader').css('opacity', '0.8');
                        $('#preloader').css('z-index', '9999');
                        $('#preloader').css('display', 'block');
                    },
                    // headers: { 'X-CSRF-TOKEN': getCookiebyName('5f05193eee9e900380c12e6040e7dee9') },
                    success: function(data)
                    {
                        // stopLoading();
                        stopLoading();
                        //validate if error
                        // $('.loading').css("display","none");
                        if(data['is_error']) {
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
                                location.href = data['redirect_to'];
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

    //on key up value from judul
    $("#title").keyup(function() {
        var titles = $("#title").val();
        $("#seo").val(convertToSlug(titles));
    });

    $(document).ready(function() {
        validate();
    });
</script>

</body>
</html>