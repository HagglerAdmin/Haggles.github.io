<li style="margin-bottom:-6%;"><a href="/billing/productid=1&bargainroom=1">
	<div class="media" style="padding:10px;">
		<a class="pull-left" href="#">

        @forelse ( App\User::find($notif->user_from)->picture->where('photo_type', 'display') as $picture )

			    <img style="width:60px;height:60px" src="{{asset('storage').'/'. $picture->user_photo }}">
            @empty 
                <img style="width:60px;height:60px" src="{{asset('img/faces/proxy.png')}}">
        @endforelse

		</a>
		<div class="media-body" style="font-size:14px;">
			<p  class="media-heading" style="margin-top:-2%;padding-bottom:0">
                <span style="font-weight:600;">{{ App\User::find($notif->user_from)->name }}</span>
                {{$notif->notif_content}}
    		</p>
			<p style="margin-top:-4.5%;margin-bottom:-4%;font-size:12px;color:#ccc">{{$notif->created_at->diffForHumans()}}</p>
		
		    <a href="/billing/seller/{{$notif->order_id}}">Proceed to billing</a>
		</div>
	</div>
	</a>
</li>