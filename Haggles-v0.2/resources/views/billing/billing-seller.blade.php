<!DOCTYPE html>
<html>
<head>
	<title>Haggle</title>
@include('layouts.head')
</head>
<body>
    @include('layouts.navigation')

    <div class="container" style="margin-top:3%;margin-bottom:3%;">
            
                <!-- first row -->
                <div class="row">
            
                    <!-- left side -->
                    <div class="col-md-6">
                        <h3>BILLING DETAILS (Seller)</h3><br>
                        
                        <!-- name -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="fname">Name:</label>
                                    <input type="text" class="form-control" id="fname" placeholder="e.g Juan" 
                                    value="{{ $validate == 1 ? Auth::user()->billing->billing_name : ' ' }}">
                                </div>
            
                            </div>
                        </div>
                        <!--end of name -->
            
                        <!-- address -->
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" value="{{ $validate == 1 ? Auth::user()->billing->billing_address : ' ' }}">
                            <p style="font-size:13px;margin-top:1%;;"><span style="font-weight:600;">Note:</span> Please enter your exact address where product will be deliver</p>
                        </div>
                        <!-- end of address -->
            
                        <!-- city -->
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" placeholder="e.g Caloocan City" 
                            value="{{ $validate == 1 ? Auth::user()->billing->billing_city : ' ' }}">
                        </div>
                        <!-- end of city -->
            
                        <!-- zip code -->
                        <div class="form-group">
                            <label for="zip">Zip code:</label>
                            <input type="text" class="form-control" id="zip" placeholder="e.g 1400" 
                            value="{{ $validate == 1 ? Auth::user()->billing->billing_zip : ' ' }}">
                        </div>
                        <!-- end of zip code -->
            
                        <!-- email and phone -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email address:</label>
                                    <input type="text" class="form-control" id="email" placeholder="e.g 1234 haggle@example.com" 
                                    value="{{ $validate == 1 ? Auth::user()->billing->billing_email : ' ' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="number">Phone number:</label>
                                    <input type="text" class="form-control" id="number" placeholder="e.g 092082082" 
                                    value="{{ $validate == 1 ? Auth::user()->billing->billing_phone : ' ' }}">
                                </div>
                            </div>
                        </div>
                        <!--end email and phone -->
                    </div>
                    <!-- end left side -->
            
                    <!-- right side -->
                    <div class="col-md-6">
                        <h3>Additional information</h3><br>
                        <div class="form-group">
                            <label for="otherNote">Order notes:</label>
                            <textarea id="otherNote" class="form-control" rows="5" placeholder="Notes about your order, e.g. special notes for delivery.">{{ $validate == 1 ? Auth::user()->billing->billing_note : ' ' }}</textarea>
                        </div>
                    </div>
                    <!-- end right side -->
                </div>
                
                <div class="row" style="margin-top:5%;">
                    <div class="col-md-12">
                    <h3>Your order</h3><br>
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
                            <td>{{ App\Product::find($order->product_id)->product_name }}</td>
                            <td>{{ $order->order_price }}</td>
                            <td>{{ $order->order_quantity }}</td>
                            <td>{{ $order->order_price}}</td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>
                
                <div class="row" style="margin-top:2%;">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default red-btn" data-placeOrder="{{request()->route('id')}}" data-result="seller">Submit</button>
                    </div>
                </div>
            </div>
@include('layouts.foot')
</body>
@include('layouts.footer')
</html>
