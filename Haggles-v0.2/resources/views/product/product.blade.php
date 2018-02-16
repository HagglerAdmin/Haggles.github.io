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

<div class="container" style="margin-top:3%;margin-bottom:3%;">
    <div class="col-md-6 single-right-left" data-wow-delay=".5s">
        <div class="grid ../images_3_of_2">
            <div class="flexslider">
            <script>
            $(window).load(function() {
                    $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                    });
                });
            </script>
                <ul class="slides">
                <!-- product photos -->
                    @foreach($product->productphoto as $photo)

                        @include('product.image-slider')
                    @endforeach
                </ul>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 single-right-left simpleCart_shelfItem">
	<!-- product information -->
		@include('product.product-info')
    </div>
    <div class="clearfix"> </div>

    <div class="bootstrap-tab">
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
                <li role="presentation"><a href="#comment" id="comment-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Review ({{$product->comment()->count()}})</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                    <h5>Product Description</h5>
                    <p style="font-size:14px;"><span style="font-weight:600">Email Address:</span> {{$product->user->profile->email_address}}</p>
                    <p style="font-size:14px;"><span style="font-weight:600">Contact number:</span> {{$product->user->profile->phone_number}}</p><br>
                    {!! $product->product_description !!}

                </div>
                <div role="tabpanel" class="tab-pane fade in bootstrap-tab-text" id="comment" aria-labelledby="comment-tab">

                    <div class="bootstrap-tab-text-grids">
                        <div class="bootstrap-tab-text-grid" id="product-comments">
                            <!-- product review -->

                        </div>

                        {{--review panel here--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  suggested product  --}}

<div class="container" style="margin-bottom:3%;">
    <div class="row">
        <h4>Also try this product</h4>
        <hr>
        @foreach ( (new \App\Repositories\Products)->suggestedProduct($product->product_category) as $prod )
            @include('index.product-list')
        @endforeach
    </div>
    <div class="row">
        <a href="{{ url('category').'/'.str_replace(' ','-',strtolower($product->product_category)) }}" style="color:black;font-size:15px;text-decoration:underline;">view more</a>
    </div>
</div>


@include('product.buy-modal')

@include('layouts.foot')
    <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.flexslider.js')}}"></script>
</body>

@include('layouts.footer')
</html>
