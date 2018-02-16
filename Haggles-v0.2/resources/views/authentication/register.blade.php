<!DOCTYPE html>
<html>
<head>
	<title>Haggles | Register</title>
@include('layouts.head')
</head>
<body>
@include('layouts.navigation')
<div class="container" style="margin-top:3%;margin-bottom:3%;">
	<div class="row">

        <div class="col-md-6">
            <h3>Fill up this form</h3><br>
            <div id="app">
                <register-component></register-component>
            </div>
            <div class="text-left">
                <a href="/login">Use my existing account</a>
            </div>
        </div>
	
        <div class="col-md-6">
            <div class="text-center">
                <h3>Register now to experience new<br> online buy and sell journey!</h3>
            </div>

            <div class="row inputs">

                <div class="col-md-12">
                {{--  carousel  --}}
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{asset('img/banner_img/1.png')}}" alt="Los Angeles" class="slider-img">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/banner_img/2.png')}}" alt="Los Angeles" class="slider-img">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/banner_img/3.png')}}" alt="Los Angeles" class="slider-img">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    </div>
                    
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
                <p class="inputs" style="color:#AB2A2F;">Just by registering to Haggle, you agree to the company terms and condition</p>
                </div>
                {{--  end of carousel  --}}
            </div>
        </div>
	</div>
</div>
@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
</body>
@include('layouts.footer')
</html>