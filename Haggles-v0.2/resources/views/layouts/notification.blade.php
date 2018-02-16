<li style="margin-bottom:-8%;"><a href="/billing/productid=1&bargainroom=1">
	<div class="media" style="padding:10px;">
		<a class="pull-left" href="#">

			<img style="width:60px;height:60px" src="{{asset('storage').'/'.$notif->user_photo}}">

		</a>
		<div class="media-body" style="font-size:14px;">
			<h5 class="media-heading">{{$notif->firstname ." ". $notif->lastname}}</h5>
			<p style="margin-top:-2%;padding-bottom:0">{{$notif->notif_content}}
				@if($notif->notif_type == "Bargain")
					<a href="/billing/order={{$notif->order_id}}" style="font-weight:600;margin-left:10px;">View your billing form</a>
				@elseif($notif->notification_type == "DealOffer")
					<a  style="font-weight:600;margin-left:10px;">View deal offer</a>
				@endif
			</p>
		<p style="margin-top:-4.5%;font-size:12px;color:#ccc">{{$notif->created_at->diffForHumans()}}</p>
		</div>
	</div>
	</a>
</li>