@forelse($product as $prod)
    <a href="/p/{!!str_replace(' ','-', strtolower($prod->product_name)).'&id='.$prod->id!!}">
        <div class="col-md-3 product-ad" data-view="" style="width:24%">

            <div class="product-img">
                <img src="{{asset('storage').'/'.$prod->product_photo}}">
            </div>

            @if(!is_null($prod->product_sale_price) AND $prod->product_sale_price != 0)
                <span class="sale-rotate">SALE</span>
            @endif

            <div class="product-caption">
                <h3>{{substr($prod->product_name, 0, 20)}}</h3>
                @if(!is_null($prod->product_sale_price) AND $prod->product_sale_price != 0)

                    <p>PHP {{$prod->product_sale_price}}</p>

                @elseif($prod->product_sale_price <= 0)

                    <p>PHP {{$prod->product_regular_price}}</p>

                @elseif(is_null($prod->product_sale_price))

                    <p>PHP {{$prod->product_regular_price}}</p>

                @endif
            </div>
        </div>
    </a>
@empty
@endforelse