<script> 
    $(document).on("click", ".cancel-confirm", function(e) {
        e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr("href");
        var data_id = $(this).data("id");
        var data_name = $(this).data("name");
        var type = $(this).data('tipe');
        title = 'Cancel Confirmation';
        content = 'Do you really want to cancel this ?';

        popup_confirm (url, data_id,title, content);
    });
    
</script>