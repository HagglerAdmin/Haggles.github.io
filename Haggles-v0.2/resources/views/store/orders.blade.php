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

@include('layouts.store-nav')

<div class="container" style="margin-top:3%;">
    <h1>Orders</h1><br>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="search order .." id="search-order"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <table class="table table-hover">
                <thead>
                    <th>Order #</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Date Ordered</th>
                    <th></th>
                </thead>
                <tbody id="order-body">

                    @foreach ( $orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->order_quantity }}</td>
                            <td>{{ $order->order_quantity * $order->order_price }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <center>
                                    <button class="btn btn-default"><i class="fa fa-thumbs-o-up"></i></button>
                                    <button class="btn btn-default"><i class="fa fa-thumbs-o-down"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    
    
                </tbody>
            </table>
        </div>

    </div>

</div><br>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui2.js')}}"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>