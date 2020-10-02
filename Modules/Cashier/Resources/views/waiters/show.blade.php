@extends('cashier::layouts.master', [
    'title' => 'الكباتن',
    'datatable' => true,
    'crumbs' => [
        ['url' => route('cashier.waiters.index'), 'title' => 'الكباتن', 'icon' => 'fa fa-user'],
        ['title' => 'كابتن: ' . $waiter->name, 'icon' => 'fa fa-list'],
    ]
])
@push('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3>كابتن: {{ $waiter->name }}</h3>
        </div>
        <div class="box-body">
            <h3 class="text-primary">الطلبات</h3>
            <table id="tables-table" class="table table-bordered table-hover text-center datatable">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>الصالة</th>
                        <th>رقم الطاولة</th>
                        <th>الحالة</th>
                        <th>الخيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($waiter->orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->hall->name }}</td>
                            <td>{{ $order->table->number }}</td>
                            <td>{{ $order->displayStatus() }}</td>
                            <td>
                                @permission('orders-read')
                                    <a class="btn btn-info btn-xs" href="{{ route('cashier.orders.show', $order->id) }}"><i class="fa fa-eye"></i> <span>@lang('restaurant::global.show')</span> </a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endpush