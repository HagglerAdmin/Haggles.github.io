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

        <h3>{{ $product->product->bargain->bargain_type}}</h3><br>
        <div class="row">
            <div class="col-md-7">

            <div class="row" style="padding:5px;border:1px solid #ccc;border-radius:5px;">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#photos">Photos</a></li>
                    <li><a data-toggle="tab" href="#info">Information</a></li>
                </ul>

                <div class="tab-content" style="height:300px;overflow:auto;">
                    <div id="photos" class="tab-pane active text-center">
                        @foreach($product->product->productphoto as $photo)
                            <img src="{{asset('storage').'/'.$photo->product_photo}}" style="width:90%;">
                        @endforeach
                    </div>

                    <div id="info" class="tab-pane">
                        @include('bargain.product-info')
                    </div>
                </div>
            </div>
        
                <div class="panel panel-default" style="margin-top:1%;margin-left:-2.3%;width:104.5%;">
                    <div class="panel-heading">Offers </div>
                    <div class="panel-body" id="buyer-panel" style="height:500px;padding:0px;overflow:auto">
                        @include('bargain.buyer')
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Product seller messages</div>
                    <div class="panel-body" id="seller-panel" style="height:400px;padding:0;overflow:auto;">
                        @include('bargain.seller')
                    </div>
                </div>
                 @include('bargain.panel')
            </div>
        </div>
    </div>


@include('bargain.bargain-modal')

@include('layouts.foot')
{{--  <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>  --}}
</body>
@include('layouts.footer')
</html>
