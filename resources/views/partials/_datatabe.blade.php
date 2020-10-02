{{--  <style>
    .dt-buttons {
        float: left;
        display: inline-block;
    }
</style>  --}}
<script src="{{ asset('dashboard/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('dashboard/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
{{--  <script src="{{ asset('dashboard/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>  --}}
{{--  <script src="{{ asset('dashboard/buttons-datatables/js/datatables.min.js') }}"></script>  --}}
<script>
    $.extend( true, $.fn.dataTable.defaults, {
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'oLanguage'    : {
            "sEmptyTable":  "@lang('table.sEmptyTable')",
            "sInfo":    "@lang('table.sInfo')",
            "sInfoEmpty":   "@lang('table.sInfoEmpty')",
            "sInfoFiltered":    "@lang('table.sInfoFiltered')",
            "sInfoPostFix": "@lang('table.sInfoPostFix')",
            "sInfoThousands":   "@lang('table.sInfoThousands')",
            "sLengthMenu":  "@lang('table.sLengthMenu')",
            "sLoadingRecords":  "@lang('table.sLoadingRecords')",
            "sProcessing":  "@lang('table.sProcessing')",
            "sSearch":  "@lang('table.sSearch')",
            "sZeroRecords": "@lang('table.sZeroRecords')",
            "oPaginate": {
                "sFirst":   "@lang('table.sFirst')",
                "sLast":    "@lang('table.sLast')",
                "sNext":    "@lang('table.sNext')",
                "sPrevious":    "@lang('table.sPrevious')"
            },
            "oAria": {
                "sSortAscending":   "@lang('table.sSortAscending')",
                "sSortDescending":  "@lang('table.sSortDescending')"
            }
        },
        'dom': 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'طباعة المحتوى'
            },
            {
                extend: 'excel',
                text: 'تصدير Excel'
            },
        ]
    } );
    $(function(){
        if (!$.fn.DataTable.isDataTable( 'table.datatable' ) ) {
            $('table.datatable').dataTable();
        }
    })
</script>