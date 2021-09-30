<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{asset('assets/front/css/membership-pdf.css')}}">
</head>
<body>
    <div class="main">
        <table class="heading">
            <tr>
                <td>
                    @if($bs->logo)
                        <img loading="lazy"  src="{{asset('assets/front/img/'.$bs->logo)}}" height="40" class="d-inline-block">
                    @else
                        <img loading="lazy"  src="{{asset('assets/admin/img/noimage.jpg')}}" height="40" class="d-inline-block">
                    @endif
                </td>
                <td class="text-right strong invoice-heading">INVOICE</td>
            </tr>
        </table>
        <div class="header">
            <div class="ml-20">
                <table class="text-left">
                    <tr>
                        <td class="strong small gry-color">Bill to:</td>
                    </tr>
                    <tr>
                        <td class="strong">{{ucfirst($member->first_name).' '.ucfirst($member->last_name)}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Username: </strong>{{$member->username}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Email: </strong> {{$member->email}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Phone: </strong> {{$phone}}</td>
                    </tr>
                </table>
            </div>
            <div class="order-details">
                <table class="text-right">
                    <tr>
                        <td class="strong">Order Details:</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Order ID:</strong> #{{$order_id}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Order Price:</strong> {{$amount == 0 ? "Free": $amount}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Payment Method:</strong> {{$request['payment_method']}}</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Payment Status:</strong>Completed</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Order Date:</strong> {{\Illuminate\Support\Carbon::now()->format('d/m/Y')}}</td>
                    </tr>
                </table>
            </div>
        </div>
    
        <div class="package-info">
            <table class="padding text-left small border-bottom">
                <thead>
                <tr class="gry-color info-titles">
                    <th width="20%">Package Title</th>
                    <th width="20%">Start Date</th>
                    <th width="20%">Expire Date</th>
                    <th width="20%">Currency</th>
                    <th width="20%">Price</th>
                </tr>
                </thead>
                <tbody class="strong">
    
                <tr class="text-center">
                    <td>{{$package_title}}</td>
                    <td>{{$request['start_date']}}</td>
                    <td>{{$request['expire_date']}}</td>
                    <td>{{$base_currency_text}}</td>
                    <td>
                        {{$amount == 0 ? "Free": $amount}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <table class="mt-80">
            <tr>
                <td class="text-right regards">Thanks & Regards,</td>
            </tr>
            <tr>
                <td class="text-right strong regards">{{ $bs->website_title }}</td>
            </tr>
        </table>
    </div>
    
    
</body>
</html>
