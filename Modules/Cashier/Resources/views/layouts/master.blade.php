@extends('layouts.dashboard.dashboard', [
    'skin' => 'green'
])
@push('dashboard_navbar_items')
    @permission('orders-create')
        <li class="{{ (request()->segment(2) == 'pos') ? 'active' : '' }}"><a href="{{ route('cashier.pos') }}"><i class="icon-pos"></i><span>نافذة البيع</span></a></li>
    @endpermission
    @permission('orders-read')
        <li class="{{ (request()->segment(2) == 'orders') ? 'active' : '' }}"><a href="{{ route('cashier.orders.index') }}"><i class="icon-order"></i><span>الطلبات</span></a></li>
    @endpermission
    @stack('navbar_items')
@endpush
@push('dashboard_navbar_left_items')
    @stack('navbar_left_items')
@endpush
@push('dashboard_sidebar_items')
    @permission('menus-read')
        <li class="{{ (request()->segment(2) == 'menus') ? 'active' : '' }}"><a href="{{ route('cashier.menus.index') }}"><i class="icon-menu"></i><span>قوائم الطعام</span></a></li>
    @endpermission
    @permission('tables-read')
        <li class="{{ (request()->segment(2) == 'tables') ? 'active' : '' }}"><a href="{{ route('cashier.tables.index') }}"><i class="icon-table"></i><span>الطاولات</span></a></li>
    @endpermission
    @permission('waiters-read')
        <li class="{{ (request()->segment(2) == 'waiters') ? 'active' : '' }}"><a href="{{ route('cashier.waiters.index') }}"><i class="icon-waiter"></i><span>الكباتن</span></a></li>
    @endpermission
    @permission('drivers-read')
        <li class="{{ (request()->segment(2) == 'drivers') ? 'active' : '' }}"><a href="{{ route('cashier.drivers.index') }}"><i class="icon-driver"></i><span>السائقين</span></a></li>
    @endpermission
    @stack('sidebar_items')
@endpush
@push('dashboard_content')
    @stack('content')
@endpush