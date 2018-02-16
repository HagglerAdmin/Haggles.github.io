<div class="header">
	<div class="container">
		<ul >
			<li class="pull-right" style="text-align: right">
				@if(!Auth::check())
					<a href="{{Url('login')}}" style="margin-right:10%;color:#AB2A2F;font-weight:400">Login</a>
					<a href="{{Url('register')}}" style="color:#AB2A2F;font-weight:400">Sign up</a>
				@endif
			</li>
		</ul>
	</div>
</div>

<div class="header-bot">
<div class="container">

<!-- logo -->
<div class="col-md-3 header-left">
	<a href="/"><img src="{{asset('img/logo/haggle-lr.png')}}" style="width:200px;height:auto;margin-top:-5%;margin-left:-10%;"></a>
</div>

<!-- search box -->
<div class="col-md-6 header-middle" style="height:51.5px;">

	<search-bar></search-bar>
</div>

<div class="col-md-3 header-right footer-bottom">
	<ul>
	<li><a class="fb" href="#"></a></li>
	<li><a class="twi" href="#"></a></li>
	<li><a class="insta" href="#"></a></li>
	<li><a class="you" href="#"></a></li>
	</ul>
</div>
<div class="clearfix"></div>
</div>
</div>

<div class="ban-top">
<div class="container">
<div class="top_nav_left">
	<nav class="navbar navbar-default">
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>

	<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav menu__list">
			<li class=" menu__item"><a class="menu__link" href="{{Url('/')}}">Market</a></li>
			<li class=" menu__item"><a class="menu__link" href="{{Url('/bargain-list')}}">Bargain</a></li>
			<li class=" menu__item"><a class="menu__link" href="{{Url('/haggler')}}">Hagglers</a></li>
			@if(Auth::check())
				<li class=" menu__item"><a class="menu__link" href="{{Url('/messages')}}">Messages

					@if ($msgCount > 0)
						<span style="background:#AB2A2F;border-radius:100%;color:white;padding:5px 10px 5px 10px;">{{ $msgCount }}</span>
					@endif
				</a></li>
				<li class=" menu__item"><a href="#" id="notification" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-bell-o fa-2x" aria-hidden="true" style="color: #777"></i></a>
					<ul class="dropdown-menu" style="width:450px;">
						<div class="row">
						<div class="col-md-12 multi-gd-img">
							<div style="padding:1px 1px 1px 5px;margin-bottom:-12px;"><p>Notification</p></div><hr>
							<ul class="multi-column-dropdown" style="padding-bottom:5%;height:300px;overflow:auto;margin-top:-25px;">
							<!-- notification content  -->

								{{--  <div class="loader"></div>  --}}

								@include('notification.notif')
							<!-- end of notification content -->
							</ul>
						</div>
						<div class="clearfix"></div>
						</div>
					</ul>
				</li>
				<li class=" menu__item"><a href="{{Url('/sell-product')}}" style="background:#AB2A2F;color:white;">Sell</a></li>
			@endif
		</ul>
	</div>
</div>
</nav>
</div>

@if(Auth::check())
	<div class="top_nav_right">
		<div class="cart box_1" style="display: -webkit-flex; /* Safari */display: flex;">
			<a style="color:white;flex:1;">

				@forelse($picture as $pic)

					<img src="{{asset('storage').'/'.$pic->user_photo}}" style="width:53px;height:53px;border-radius:100%">
				@empty

					<img src="{{asset('img/faces/proxy.png')}}" style="width:53px;height:53px;border-radius:100%">
				@endforelse
			</a>

			<div class="dropdown" style="flex:20;color:white;top:14px;cursor: pointer;">

				<span style="font-size:17px;margin-left:3%" id="nav-name" data-toggle="dropdown">{{ ucwords(Auth::user()->name) }}</span>
				<span class="caret" data-toggle="dropdown"></span>
				<ul class="dropdown-menu" style="left:-18px;">
					<li class="dropdown-header">Store</li>
					<li><a href="{{ Url('/store')}}" style="font-weight:400;font-size:15px;"><i class="fa fa-bars" style="margin-right:10%;"></i> My Store</a></li>
					<li><a href="#" style="font-weight:400;font-size:15px;"><i class="fa fa-users" style="margin-right:10%;"></i>Customers</a></li>
					<li><a href="#" style="font-weight:400;font-size:15px;"><i class="fa fa-history" style="margin-right:10%;"></i>History</a></li>
					<li><a href="{{ Url('manage-account') }}" style="font-weight:400;font-size:15px;"><i class="fa fa-cogs" style="margin-right:10%;"></i>Settings</a></li>
					<li class="divider"></li>
					<li><a href="{{Url('logout/user')}}" style="color:#AB2A2F;font-weight:400">logout</a></li>
				</ul>
			</div>
		</div>
	</div>
@endif

<div class="clearfix"></div>
</div>
</div>