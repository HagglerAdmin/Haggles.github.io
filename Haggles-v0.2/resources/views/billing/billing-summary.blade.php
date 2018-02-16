<!DOCTYPE html>
<html>
<head>
	<title>Haggle | Billing</title>
@include('layouts.head')
</head>
<body>
@include('layouts.navigation')

<div class="container" stlye="margin-top:3%;margin-bottom:3%;">

    <div class="row">
        <div class="col-md-8">
            <h3>Payment</h3><br>

        <!-- choose panel -->
        <div class="panel panel-default">
            <div class="panel-heading">Choose payment option</div>
            <div class="panel-body">
            <div class="colr ert">
                <img src="{{asset('img/icons/COD.png')}}" alt="" style="margin:-10% -10% -10% 10%;">
                <label class="radio"><input type="radio" name="radio" value="Cash on delivery" checked=""><i></i>Cash on delivery</label>
            </div>
            <div class="colr ert">
                <div class="text-center"><i class="fa fa-paypal" aria-hidden="true" style="padding-bottom:5%;margin-top:7.5%;font-size:50px;color:#ab2a2f;"></i></div>
                <label class="radio"><input type="radio" name="radio" value="Paypal"><i></i>Delivery with PayPal</label>
            </div>
            </div>
        </div>

        <!-- qoute panel -->
        <div class="panel panel-default">
            <div class="panel-body">
            <div id="shipment-quote">
                <p style='font-weight:600;'>Pay at your doorstep</p>
                <p style='margin-top:1%;'>You can pay in cash to our courier when you receive the goods at your doorstep</p>
                <a class='btn btn-default red-btn' id="pyo-btn" style='margin-top:10%;'>Place your order</a>
            </div>
            </div>
        </div>
        <!-- end of qoute panel -->

        </div>
        
        <div class="col-md-4">
                
            <!-- shipping and billig addres -->
            <div class="panel panel-default" style="margin-top:13%;">
                <div class="panel-heading">Shipping and Billing Address <a class="pull-right" style="cursor:default;">Edit</a></div>
                <div class="panel-body" style="font-size:14px;">
                    @foreach($selectBilling as $billing)
                        <p style="margin-bottom:5%;">{{$billing->billing_address}}</p>
                        <p style="margin-bottom:5%;"><span style="font-weight:600">City:</span> {{$billing->billing_city}}</p>
                        <p><span style="font-weight:600">Zip Code:</span> {{$billing->billing_zip}}</p>
                    @endforeach
                </div>
            </div>
                  <!--end shipping and billig addres -->
                
                  <!-- order summary -->
            <div class="panel panel-default">
                <div class="panel-heading">Order summary</div>
            <div class="panel-body" style="font-size:14px;">
                @foreach($selectBilling as $summary)
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="border-bottom:1px solid #ccc;">Product name</h5><br>
                        {{$summary->product_name}}
                    </div>
                    <div class="col-md-6">
                        <h5 style="border-bottom:1px solid #ccc;">Price</h5><br>
                        {{$summary->order_price}}
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6"><br>
                            <h5 style="border-bottom:1px solid #ccc;">Shipping fee</h5><br>
                        @foreach($rate as $rt)
                            @if($summary->city_type == $rt->shipping_city)
                
                            @if($summary->order_weight > $rt->shipping_weight)
                
                                {{$rt->shipping_city ." = " }} <span id="shippingFee">{{($summary->order_weight - $rt->shipping_weight) * 
                                $rt->extra_rate + $rt->shipping_rate}}</span>
                
                            @elseif($summary->order_weight <= 2)
                
                                {{$rt->shipping_city ." = "}} <span id="shippingFee">{{$rt->shipping_rate}}</span>
                
                            @endif
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
                <span id="products_id" style="display:block">{{$summary->product_id}}</span>
                <span id="billing_id" style="display:block">{{$summary->id}}</span>
                @endforeach
            </div>
            </div>
                  <!--end order summary -->
                
        </div>

    </div>

</div>

@include('layouts.foot')
</body>
@include('layouts.footer')
</html>