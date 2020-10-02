@extends('layouts.dashboard.base', [
    'title' => 'طلب رقم #' . $order->number,
])
@push('head')
    <style>
        .order{
            width: 500px;
            margin: 30px auto;
            border: 1px solid #eeeeee;
            padding: 30px;
        }
        .order-header{
            border-bottom-width: 4px;
            border-bottom-style: double;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .order-body{
            border-bottom: 1px dashed;
            margin-bottom: 30px;
        }
        .order-footer{
            border-bottom: 1px dotted;
            padding-bottom: 30px;
        }
        .order-footer strong{
            text-decoration: underline;
        }
        .order-footer p{
            text-align-last: left;
        }
        .order-footer table{
        }
        .order-footer table th, .order-footer table td{
            border: none !important;
            padding: 0 !important;
        }
        .order-buttons{
            padding: 15px;
            text-align: center;
        }
        @media print{
            .order{
                margin: 0;
                border: none;
                width: 100%;
            }
            .order-buttons{
                display: none;
            }
            .table>thead>tr>th{
                border-color: black;
            }
            .table>tbody>tr>td{
                border-top: none;
            }
        }
    </style>
@endpush
@push('body')
    <div class="order">
        <div class="order-header">
            <h3 class="text-center">
                {{ config('app.name') }}
                <br>
                {{ config('cashier.name') }}
            </h3>
            <div class="clearfix">
                <div class="pull-right">
                    <strong>التاريخ</strong>: {{ date('Y/m/d') }}
                </div>
                <div class="pull-left">
                    <strong>رقم الطلب</strong>: #{{ $order->number }}
                </div>
            </div>
        </div>
        <div class="order-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="order-footer">
            <table class="table">
                <tr>
                    <th><strong>الضريبة</strong></th>
                    <td><p>{{ $order->tax }}</p></td>
                </tr>
                <tr>
                    <th><strong>الخصم</strong></th>
                    <td><p>{{ $order->discount }}</p></td>
                </tr>
                <tr>
                    <th><strong>الإجمالي</strong></th>
                    <td><p>{{ $order->total }}</p></td>
                </tr>
                <tr>
                    <th><strong>الصافي</strong></th>
                    <td><p>{{ $order->net }}</p></td>
                </tr>
            </table>
        </div>
        <div class="order-buttons">
            <button class="btn btn-default" onclick="window.print()">
                <i class="fa fa-print"></i>
                <span>طباعة</span>
            </button>
            <a href="{{ route('cashier.orders.index', ['type' => $order->getType('name'), 'status' => $order->getStatus('name')]) }}" class="btn btn-default">
                <i class="icon-order"></i>
                <span>الطلبات</span>
            </a>
            <a href="{{ route('cashier.dashboard') }}" class="btn btn-default">
                <i class="icon-cashier"></i>
                <span>{{ config('cashier.name') }}</span>
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-default">
                <i class="fa fa-arrow-left"></i>
                <span>رجوع</span>
            </a>
        </div>
    </div>
@endpush
@push('foot')
    @if (request('view') == 'print')
        <script>
            window.print()
        </script>
    @endif
@endpush