<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .container {
            margin-top: 5%; 
        }
        .barcode {
            text-align: center;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .barcode-b > div{
            margin: auto;
        }
    </style>
    <style>
                @media print {
            button {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach ($subscriptions as $subscription)
                <div class="col-md-4">
                    <div class="barcode">
                        <h4>{{ $subscription->customer->name }}</h4>
                        <div class="barcode-b">
                            <p>{!! DNS1D::getBarcodeHTML(number_format($subscription->id), "C128",1.4,44, "black") !!}</p>
                            <p>{{ $subscription->id }}</p>
                        </div>
                    </div>
                </div>    
            @endforeach
            <div class="col-md-12" style="margin-top:5%">
                <button onclick="window.print()" class="btn btn-primary btn-block">طباعة</button>
            </div>
        </div>
    </div>
</body>
</html>