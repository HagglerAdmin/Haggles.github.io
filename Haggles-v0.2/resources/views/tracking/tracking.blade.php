<!DOCTYPE html>
<html>
<head>
	<title>Haggle</title>
@include('layouts.head')
</head>
<body>
<div id="app">
    @include('layouts.navigation')
</div>

<div class="container" style="margin-top: 3%;margin-bottom: 3%;">
        <div class="row">
            <div class="col-md-12 text-center">
                @foreach($track as $code)
                <h3>Tracking code: {{$code->tracking_number}}</h3><Br>
                <p>name: {{$code->billing_name}}</p><br>
                <p>address: {{$code->billing_address}}</p><br>
                <p>Phone number: {{$code->billing_phone}}</p><Br>
                <p>Email Address: {{$code->billing_email}}</p><Br><CENTER>
                <div class="panel panel-default">
                <div class="panel-body" style="padding:2px;">
                <table class="table table-hover">
                    <thead>
                    <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td>{{$code->product_name}}</td>
                       <td>{{$code->order_price}}</td>
                       <td>{{$code->order_quantity}}</td>
                       <td>{{$code->order_quantity * $code->order_price}}</td>
                     </tr>
    
                    </tbody>
                </table>
                </div>
                </div>
                </CENTER>
                @endforeach
                <br>
                <a id="con-shop" class="btn red-btn btn-default">Continue Shopping</a>
            </div>
        </div>
        
    </div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>
