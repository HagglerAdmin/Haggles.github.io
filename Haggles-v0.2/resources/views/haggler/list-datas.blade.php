@foreach ( $lists as $list )
<div class="col-md-4 new-gd-middle" style="margin-bottom:2%;">
    <div class="well" style="background:white;">
        <div class="mid-img">
            @forelse ( App\User::find($list->id)->pictureFunction() as $picture) 
                <img src="{{asset('storage').'/'.$picture->user_photo }}" alt=" " />
               @empty
                <img src="{{asset('img/faces/proxy.png')}}">            
            @endforelse

            <a class="btn btn-default red-btn button2" href="/haggler/{{$list->name}}/user/{{$list->id}}" style="margin-top:3%;width:100%;">Shop now </a>
        </div>
        <div class="mid-text" style="padding-top:44px;">
            <p style="text-decoration:underline;">{{ $list->name }}</p><Br>
            
                <div style="font-size:14px;">
                    <p>{{ $list->phone_number }}</p>
                    <p>{{ substr($list->email_address, 0, 40) }}</p>
                    <p>{{ $list->city }}</p>
                </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endforeach