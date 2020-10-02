@extends('layouts.dashboard.dashboard', [
    'skin' => 'yellow-light'
])
@push('dashboard_navbar_items')
    @stack('navbar_items')
@endpush
@push('dashboard_navbar_left_items')
    @stack('navbar_left_items')
@endpush
@push('dashboard_sidebar_items')
    @permission('menus-read')
        <li class="{{ (request()->segment(2) == 'menus') ? 'active' : '' }}"><a href="{{ route('menus.index') }}"><i class="fa fa-list-alt"></i><span>قوائم الطعام</span></a></li>
    @endpermission
    @permission('tables-read')
        <li class="{{ (request()->segment(2) == 'tables') ? 'active' : '' }}"><a href="{{ route('tables.index') }}"><i class="fa fa-list-alt"></i><span>الطاولات</span></a></li>
    @endpermission
    @permission('waiters-read')
        <li class="{{ (request()->segment(2) == 'waiters') ? 'active' : '' }}"><a href="{{ route('waiters.index') }}"><i class="fa fa-list-alt"></i><span>الكباتن</span></a></li>
    @endpermission
    @permission('drivers-read')
        <li class="{{ (request()->segment(2) == 'drivers') ? 'active' : '' }}"><a href="{{ route('drivers.index') }}"><i class="fa fa-list-alt"></i><span>السائقين</span></a></li>
    @endpermission
    @stack('sidebar_items')
@endpush
@push('dashboard_content')
    @stack('content')
@endpush