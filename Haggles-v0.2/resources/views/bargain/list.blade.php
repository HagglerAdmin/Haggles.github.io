@forelse($lists as $list)
    <a href="/bargain/{{$list->id}}">
        <div class="col-md-3">
            <div class="well well-bargain" style="background-position:center top;background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, .5)), url({{asset('storage').'/'.$list->product_photo}});background-repeat: no-repeat;background-size: cover;">
                <span class="details-bargain">
                    <i class="fa fa-users" aria-hidden="true"></i> 
                    {{ (new \App\Repositories\Bargains)->countBuyer($list->id) }}
                </span>
                <span class="name-bargain">
                    {{ $list->product_name }}
                    <p>{{ $list->bargain_type }}</p>
                    <p>&#8369; {{ $list->product_regular_price}}</p>
                </span>
            </div>
        </div>
    </a>
    @empty 
@endforelse