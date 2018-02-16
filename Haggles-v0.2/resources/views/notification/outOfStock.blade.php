@if ( count(App\Product::all()) > 0)
	<li style="margin-bottom:-6%;"><a href="/billing/productid=1&bargainroom=1">
		<div class="media" style="padding:10px;">
			<a class="pull-left" href="#">

			@forelse ( App\Product::find($notif->product_id)->productphoto->where('photo_type', 'Display') as $picture )
			
				<img style="width:60px;height:60px" src="{{asset('storage').'/'. $picture->product_photo }}">
			@empty 
				
			@endforelse            

			</a>
			<div class="media-body" style="font-size:14px;">
				<p  class="media-heading" style="margin-top:-2%;padding-bottom:0">
			<span style="font-weight:600;">{{ substr(App\Product::find($notif->product_id)->product_name,0,15) }}</span>
			{{$notif->notif_content}}
			</p>
			<p style="margin-top:-4.5%;margin-bottom:-4%;font-size:12px;color:#ccc">{{$notif->created_at->diffForHumans()}}</p>
			<a>Add supply here</a>
			</div>
		</div>
		</a>
	</li>
@endif