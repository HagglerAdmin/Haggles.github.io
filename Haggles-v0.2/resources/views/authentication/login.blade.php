<!DOCTYPE html>
<html>
<head>
	<title>Haggles | login</title>
@include('layouts.head')
</head>
<body>
@include('layouts.navigation')
<div class="container" style="margin-top:3%;margin-bottom:3%;">
	<div class="row">

  	<div class="col-md-4 text-left">
        <h3>LOGIN</h3><br>
		
      	<div id="app">
    		    <login-component></login-component>
		</div>
		 
		<div class="text-left">
			<a href="/register">Create new account</a>
		</div>
  	</div>

  	<div class="col-md-8 text-center" style="background: url( {{asset('img/background/agreementcontract.jpg')}} );background-repeat: no-repeat;background-position: center;background-size:100%;height:400px;">
  	<div style="color:white;padding:50px;">
  		<h2>With an Haggles account you can. . .</h2>
  		<ul class="login-promotion">
  			<li><img src="{{asset('img/icons/checkmark.png')}}" class="check-icon">
  				Post, share your product
  			</li>
  			<li><img src="{{asset('img/icons/checkmark.png')}}" class="check-icon">
  				Create your online market free
  			</li>
  			<li><img src="{{asset('img/icons/checkmark.png')}}" class="check-icon">
  				Manage your account with real time analytics
  			</li>
  			<li><img src="{{asset('img/icons/checkmark.png')}}" class="check-icon">
  				Avail premium account and access unique features of Haggles
  			</li>
  		</ul>
  	</div>
  	</div>
	</div>
</div>
@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
</body>
@include('layouts.footer')
</html>
