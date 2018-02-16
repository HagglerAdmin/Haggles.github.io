@foreach($product->convo->where('convo_type', 'Seller') as $buying)
    
    <div class="media" style="padding:5px;">

        @forelse (App\User::find($buying->users_id)->picture->where('photo_type', 'display') as $picture)
                <a class="pull-left" href="#"><img style="width:70px;height:60px" src="{{ asset('storage').'/'.$picture->user_photo}}"></a>
            @empty
                <a class="pull-left" href="#"><img src="{{asset('img/faces/proxy.png')}}" style="width:70px;height:60px"></a>
        @endforelse

        <div class="media-body" style="font-size:14px;">
            <h5 class="media-heading" style="font-weight:600;">{{ ucwords(App\User::find($buying->users_id)->name) }}</h5>
            <span style="color:#333;font-size:12px;">{{$buying->created_at->diffForHumans()}}</span>
            <p style="font-size:17px;">{{ $buying->convo_message }}</p>
        </div>

    </div>

@endforeach