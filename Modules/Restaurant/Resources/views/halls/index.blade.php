@extends('layouts.dashboard.app')

@section('title', __('restaurant::global.halls'))

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')

    @component('partials._breadcrumb')
        @slot('title', ['restaurant::global.halls'])
        @slot('url', ['#'])
        @slot('icon', ['cubes'])
    @endcomponent

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"> @lang('restaurant::halls.list') </h3>
            
            @permission('halls-create')
                <a href="{{ route('halls.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-right" >
                    <i class="fa fa-plus"></i> @lang('restaurant::global.add') 
                </a>
            @endpermission

        </div>
        <div class="box-body">
            <table id="halls-table" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>@lang('restaurant::global.name')</th>
                        <th>@lang('restaurant::global.manager')</th>
                        <th>@lang('restaurant::halls.count_tables')</th>
                        <th>@lang('restaurant::global.options')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($halls as $hall)
                        <tr>
                            <td>{{ $hall->name }}</td>
                            <td>{{ $hall->manager->employee->name }}</td>
                            <td>{{ $hall->number_of_tables }}</td>
                            <td>
                                @permission('halls-read')
                                    <a href="{{ route('halls.show', $hall) }}" class="btn btn-info btn-xs ">
                                        <i class="fa fa-eye">@lang('restaurant::global.show')</i>
                                    </a>
                                @endpermission
                                @permission('halls-update')
                                    <a href="{{ route('halls.edit', $hall) }}" class="btn btn-warning btn-xs ">
                                        <i class="fa fa-edit">@lang('restaurant::global.edit')</i>
                                    </a>
                                @endpermission
                                @permission('halls-delete')
                                    <a href="{{ route('halls.destroy', $hall) }}?delete=true" class="btn btn-danger btn-xs ">
                                        <i class="fa fa-trash">@lang('restaurant::global.delete')</i>
                                    </a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dashboard/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
    $(function () {
        $('#halls-table').DataTable({
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
            }
        })
    })
    </script>
@endpush