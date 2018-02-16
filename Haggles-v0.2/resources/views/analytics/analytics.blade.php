<!DOCTYPE html>
<html>
<head>
	<title>Haggle | Analytics</title>
@include('layouts.head')
</head>
<body>

<div id="app">
    @include('layouts.navigation')
</div>

@include('layouts.store-nav')

<div class="container" style="margin-top: 2%;margin-bottom: 3%;">

    <h3>Store Status</h3><br>

    <div class="row">

        <div class="col-md-3" >

            <div class="well" style="background:white;">
                <h4>Store Status Summary</h4><hr>
                
                <ul style="list-style:none;">
                    
                    <h5>Category you have</h5><br>

                    @forelse( $category_count as $cat_count )

                        <li><span style="color:#AB2A2F;">{{$cat_count->product_category }}</span>: {{ $cat_count->number}}</li>
                
                        @empty

                    @endforelse

                    
                    @forelse ($total_supply as $tol_sup)

                        <br><h5>Total supply: {{ $tol_sup->stock }}</h5><br>

                        @empty

                    @endforelse
                    
                </ul>                


            </div> 
            
            @if(count($pendingOrders) > 0)
                <div class="well well-panel">
                    <h4>Delivery</h4><br>
                    @foreach ($pendingOrders as $order)
                        <div style="padding-bottom:5%;">
                            <img src="{{ asset('storage').'/'.$order->product_photo }}" style="width:30%;"/>
                            <div class="pull-right text-right" style="font-size:12px;">
                                <p>{{ substr($order->product_name,0,20) }}</p>
                                <p>order price: {{ $order->order_price }}</p>
                                <p>order qty: {{ $order->order_quantity }}</p>
                                <p>Status: {{ $order->status }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if(count($pendingOrderSeller) > 0)
                <div class="well well-panel">
                    <h4>Pending orders</h4><br>

                    @foreach ($pendingOrderSeller as $order)
                    
                        <div style="padding-bottom:5%;">
                            <img src="{{ asset('storage').'/'.$order->product_photo }}" style="width:30%;"/>
                            <div class="pull-right text-right" style="font-size:12px;">
                                <p>{{ substr($order->product_name, 0, 20) }}</p>
                                <p>order price: {{ $order->order_price }}</p>
                                <p>order qty: {{ $order->order_quantity }}</p>
                            </div>
                        </div>
                    @endforeach                   

                </div>  
            @endif
        </div>

        <div class="col-md-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#buyer">Store status</a></li>
                <li><a data-toggle="tab" href="#seller">Purchase status</a></li>
            </ul>

            <div class="tab-content">
                <div id="buyer" class="tab-pane active">

                    <div class="row">
                        {{--  @include('analytics.leaderboard')  --}}
                    </div>
                    
                    <div class="row">
                        @include('analytics.suppdemand')
                    </div>

                    <div class="row">
                        @include('analytics.sales')
                    </div>
                                        
                    <div class="row">
                        @include('analytics.product-sales')
                    </div>
        
                </div>
                <div id="seller" class="tab-pane">
                    @include('analytics.order-status')

                    @include('analytics.product-bought')
                </div>
            </div>      
        </div>

    </div>
</div>

@include('layouts.foot')
</body>
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
@include('layouts.footer')
<script type="text/javascript">
    indexSPC();
    indexSBC();
    demand();
    supply();
</script>
</html>