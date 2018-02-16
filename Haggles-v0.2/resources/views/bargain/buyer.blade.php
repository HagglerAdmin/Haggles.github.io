@foreach($product->convo->where('convo_type', 'Buyer') as $buying)
    
    <div class="media" style="padding:5px;">

        @forelse (App\User::find($buying->users_id)->picture->where('photo_type', 'display') as $picture)
                <a class="pull-left" href="#"><img style="width:70px;height:60px" src="{{ asset('storage').'/'.$picture->user_photo}}"></a>
            @empty
                <a class="pull-left" href="#"><img src="{{asset('img/faces/proxy.png')}}" style="width:70px;height:60px"></a>
        @endforelse

        @if (Auth::id() == $product->user_id)
            <span class="pull-right">
            {{--  <a class="btn btn-default">
                <i class="fa fa-envelope-o pull-left" aria-hidden="true"></i>
            </a>  --}}
            <a class="btn btn-default" data-target="#modalDeal" data-toggle="modal" data-deal="{{ $buying->id }}">
               Deal <i class="fa fa-handshake-o" aria-hidden="true"></i>
            </a></span>
        @endif

        <div class="media-body" style="font-size:14px;">
            <h5 class="media-heading" style="font-weight:600;">{{ ucwords(App\User::find($buying->users_id)->name) }}</h5>
            <p style="font-size:18px;">
                <span style="font-weight:600">Price: {{$buying->price_offer}}</span>
                <span style="font-weight:600;margin-left:5px;">Qauntity: {{$buying->quantity_offer}}</span>
            </p>
            <span style="color:#333;font-size:12px;">{{$buying->created_at->diffForHumans()}}</span>
        </div>

    </div>

@endforeach