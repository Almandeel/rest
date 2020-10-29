<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->username }}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            @if (request()->segment(1) == 'management')

            <li class="{{ (request()->segment(1) == '') ? 'active' : '' }}"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i><span>  لوحة التحكم </span></a></li>
            
            @permission('stores-read')
                <li class="{{ (request()->segment(1) == 'stores') ? 'active' : '' }}"><a href="{{ route('stores.index') }}"><i class="fa fa-home"></i><span>  المخازن </span></a></li>
            @endpermission

            @permission('stores-read')
                <li class="{{ (request()->segment(1) == 'transferstores') ? 'active' : '' }}"><a href="{{ route('transferstores.index') }}"><i class="fa fa-home"></i><span>  التحويلات </span></a></li>
            @endpermission

            @permission('items-read')
                <li class="{{ (request()->segment(1) == 'items') ? 'active' : '' }}"><a href="{{ route('items.index') }}"><i class="fa fa-cubes"></i><span>  المنتجات </span></a></li>
            @endpermission

            @permission('units-read')
                <li class="{{ (request()->segment(1) == 'units') ? 'active' : '' }}"><a href="{{ route('units.index') }}"><i class="fa fa-cubes"></i><span>  الوحدات </span></a></li>
            @endpermission
            
            @permission('bills-read')
                <li class="treeview {{ (request()->segment(1) == 'bills') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-list"></i> <span>المشتريات</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">

                        @permission('bills-create')
                            <li><a href="{{ route('bills.create') }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>إضافة عملية شراء</span>
                            </a></li>
                        @endpermission

                        @permission('bills-read')
                            <li><a href="{{ route('bills.index') }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>قائمة المشتريات</span>
                            </a></li>

                            <li><a href="{{ route('bills.index', ['is_delivered' => 0]) }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>مشتريات غير مستلمة</span>
                            </a></li>

                            <li><a href="{{ route('bills.index', ['is_payed' => 0]) }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>مشتريات غير مدفوعة</span>
                            </a></li>
                        @endpermission

                    </ul>
                </li>
            @endpermission

            @permission('invoices-read')
                <li class="treeview {{ (request()->segment(1) == 'invoices') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-list"></i> <span>المبيعات</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">

                        @permission('invoices-create')
                            <li><a href="{{ route('invoices.create') }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>إضافة عملية بيع</span>
                            </a></li>
                        @endpermission

                        @permission('invoices-read')
                            <li><a href="{{ route('invoices.index') }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>قائمة المبيعات</span>
                            </a></li>

                            <li><a href="{{ route('invoices.index', ['is_delivered' => 0]) }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>مبيعات غير مسلمة</span>
                            </a></li>

                            <li><a href="{{ route('invoices.index', ['is_payed' => 0]) }}">
                                <i class="fa fa-angle-double-left"></i>
                                <span>مبيعات غير مدفوعة</span>
                            </a></li>
                        @endpermission
                    </ul>
                </li>
            @endpermission

            @permission('safes-read')
                <li class="{{ (request()->segment(1) == 'safes') ? 'active' : '' }}">
                    <a href="{{ route('safes.index') }}">
                        <i class="fa fa-money"></i> <span>الخزن</span>
                    </a>
                </li>
            @endpermission

            @permission('cheques-read')
                <li class="{{ (request()->segment(1) == 'cheques') ? 'active' : '' }}"><a href="{{ route('cheques.index') }}"><i class="fa fa-file"></i><span>الشيكات</span></a></li>
            @endpermission

            @permission('expenses-read')
                <li class="{{ (request()->segment(1) == 'expenses') ? 'active' : '' }}"><a href="{{ route('expenses.index') }}"><i class="fa fa-dollar"></i><span>  المنصرفات </span></a></li>
            @endpermission

            @permission('customers-read')
                <li class="{{ (request()->segment(1) == 'customers') ? 'active' : '' }}"><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i><span>  العملاء </span></a></li>
            @endpermission

            @permission('collaborators-read')
                <li class="{{ (request()->segment(1) == 'collaborators') ? 'active' : '' }}"><a href="{{ route('collaborators.index') }}"><i class="fa fa-users"></i><span>  المتعاونون </span></a></li>
            @endpermission

            @permission('suppliers-read')
                <li class="{{ (request()->segment(1) == 'suppliers') ? 'active' : '' }}"><a href="{{ route('suppliers.index') }}"><i class="fa fa-users"></i><span>  الموردين </span></a></li>
            @endpermission

            @permission('collaborator-read')
                <li class="{{ (request()->segment(1) == 'collaborator') ? 'active' : '' }}"><a href="{{ route('collaborator.index') }}"><i class="fa fa-users"></i><span>  العملاء </span></a></li>
            @endpermission

            @permission('employees-read')
                <li class="{{ (request()->segment(1) == 'employees') ? 'active' : '' }}"><a href="{{ route('employees.index') }}"><i class="fa fa-users"></i><span>  الموظفين </span></a></li>
            @endpermission
            
            @permission('users-read')
                <li class="{{ (request()->segment(1) == 'users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>  المستخدمين </span></a></li>
            @endpermission

            @elseif(request()->segment(1) == 'subscription')

                @permission('subscriptions-read')
                    <li class="{{ (request()->segment(1) == 'subscription') ? 'active' : '' }}"><a href="{{ route('subscription.dashboard') }}"><i class="fa fa-dashboard"></i><span>  لوحة التحكم </span></a></li>
                @endpermission

                @permission('subscriptions-read')
                    <li class="{{ (request()->segment(2) == 'subscriptions') ? 'active' : '' }}"><a href="{{ route('subscriptions.index') }}"><i class="fa fa-list"></i><span>  الاشتراكات </span></a></li>
                @endpermission

                @permission('plans-read')
                    <li class="{{ (request()->segment(2) == 'plans') ? 'active' : '' }}"><a href="{{ route('plans.index') }}"><i class="fa fa-list"></i><span>  الباقات </span></a></li>
                @endpermission

                @permission('customers-read')
                    <li class="{{ (request()->segment(2) == 'subcustomers') ? 'active' : '' }}"><a href="{{ route('subcustomers.index') }}"><i class="fa fa-users"></i><span>  العملاء </span></a></li>
                @endpermission

            @endif
        </ul>

    </section>

</aside>
