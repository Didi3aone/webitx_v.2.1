$.extend( $.fn.dataTable.defaults, {
    autoWidth: false,
    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    deferRender: true,
    scrollX: true,
    scrollY: '450px',
    scrollCollapse: true,
    paging: false,
    language: {
        search: '<span>Filter:</span> _INPUT_',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
    }
});

// Add placeholder to the datatable filter option
$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


// Enable Select2 select for the length option
$('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity,
    width: 'auto'
});