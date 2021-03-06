@extends('layouts.dashboard.app')

@section('title', __('restaurant::global.show'))

@section('content')

    @component('partials._breadcrumb')
        @slot('title', ['restaurant::global.tables', $table->number])
        @slot('url', [route('tables.index'), '#'])
        @slot('icon', ['cubes', 'cube'])
    @endcomponent

    <div class="box box-primary">
        <div class="box-header">
            <h3>@lang('restaurant::global.show') @lang('restaurant::global.table'): {{ $table->number }}</h3>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 200px;">@lang('restaurant::global.id')</th>
                        <td>{{ $table->id }}</td>
                    </tr>
                    <tr>
                        <th style="width: 200px;">@lang('restaurant::tables.number')</th>
                        <td>{{ $table->number }}</td>
                    </tr>
                    @if(request('delete'))
                        <tr class="alert alert-warning">
                            <td colspan="2">
                                <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <span>@lang('restaurant::global.delete_confirm')</span>
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> @lang('restaurant::global.delete') </button>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>@lang('restaurant::global.options')</th>
                            <td>
                                <a class="btn btn-warning btn-xs" href="{{ route('tables.edit', $table->id) }}"><i class="fa fa-edit"></i> @lang('restaurant::global.edit') </a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
