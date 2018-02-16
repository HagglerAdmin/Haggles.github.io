@foreach($product->convo->where('convo_type', 'Buyer') as $buyer)
    	<div class="media" style="padding:5px;">
        <a class="pull-left" href="#"><img style="width:70px;height:60px" src="{{asset('storage').'/'.$buying->user_photo}}"></a>
        @foreach($id->get() as $validate)
        
            @if($validate->users_id == session()->get('id'))
                <span class="pull-right">
                <a class="btn btn-default">
                    <i class="fa fa-envelope-o pull-left" aria-hidden="true"></i>
                </a>
                <a class="btn btn-default" data-target="#modalDeal" data-toggle="modal" data-deal="{{$buying->id}}">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>
                </a></span>
            @else
            
            @endif
		@endforeach
    <div class="media-body" style="font-size:14px;">
    	<h5 class="media-heading" style="font-weight:600;">{{ $buying->name }}</h5>
    	<span style="color:#333;font-size:12px;">{{$buying->created_at->diffForHumans()}}</span>
    	<p><span style="font-weight:600">Price: {{$buying->price_offer}}</span><span style="font-weight:600;margin-left:5px;">Qauntity: {{$buying->quantity_offer}}</span><br>
    	{{$buying->convo_message}}</p>
    </div>
    </div>
@endforeach