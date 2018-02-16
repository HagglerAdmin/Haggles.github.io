<h3>{{ucwords($product->product_name)}}</h3>
	@if(!is_null($product->product_sale_price) AND $product->product_sale_price != 0)
		<p><span class="item_price">PHP {{$product->product_sale_price}}</span></p>
		<p style="font-size:14px;margin-top:-3%;">before<del>- PHP {{$product->product_regular_price}}.00</del></p>
	@elseif($product->product_sale_price <= 0)
		<p><span class="item_price">PHP {{$product->product_regular_price}}.00</span></p>
	@elseif(is_null($product->product_sale_price))
		<p><span class="item_price">PHP {{$product->product_regular_price}}.00</span></p>
	@endif
    {{ $product->product_location }}<br><br>

	<span class="approved-item" style="font-size:14px;">{{$product->remarks->product_condition}}</span>


<div class="well-panel" style="background:white;padding:1px 15px 15px 15px;margin-top:5%;">
    
    <center><span style="font-weight:600;margin-top:15%;">Meet the seller</span></center>

	<div class="occasional">
	<div class="media">
		<a class="pull-left" href="#">

			@forelse($product->user->picture as $pic)

				@if($pic->photo_type == "display") 
					<img style="width:48px;height:48px" src="{{asset('storage').'/'.$pic->user_photo}}">
				@endif

				@empty
				<img src="{{asset('img/faces/proxy.png')}}" style="width:53px;height:53px;border-radius:100%">

			@endforelse
		</a>

		<div class="dropdown">
			<span class="caret pull-right" data-toggle="dropdown" style=""></span>
			<ul class="dropdown-menu" style="left: 70%;">
				<li><a href="#" style="font-weight:400;font-size:15px;"><i class="fa fa-flag" style="margin-right:10%;"></i> Report</a></li>
			</ul>
		</div>
        
		<h4 class="media-heading"><a href="/haggler/{{$product->user->name}}/user/{{$product->user->id}}" style="color:#434a54">
			{{ucwords($product->user->name)}}</a>
			<h5 style="font-size:13px;margin-top:2%;">{{$product->created_at->diffForHumans()}}</h5>
		</h4>
	<div class="media-body">
		{!! $product->product_short_desc !!}
	</div>
	</div>
		<div class="clearfix"> </div>
	</div>
    <div class="occasion-cart" style="margin-top:-3%;">

		<a class="item_add button2 btn-danger" data-toggle="modal" data-target="#buy" style="cursor: pointer;">Buy</a>
		
		@if ( count($product->bargain) > 0 )
        	<a href="/bargain/{{ $product->bargain->id }}" class="item_add button2 btn-danger">{{$product->bargain->bargain_type}} ({{$product->bargain->convo->where('convo_type', 'Buyer')->count()}})</a>
		@endif
        <a href="#" class="item_add button2 btn-danger" data-toggle="modal" data-target="#message">Message Seller</a>
    </div>
</div>