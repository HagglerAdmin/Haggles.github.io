<a  href="{{ asset('p').'/id='.$prod->id.'&name='. str_replace(' ','-', strtolower($prod->product_name))  }}">
    <div class="col-md-2 product-ad" data-view="" style="width:18%;">
        <div class="product-img">
            <img src="{{ asset('storage').'/'.$prod->product_photo }}">
        </div>
        
        @if ( $prod->product_sale_price != null )
            <span class="sale-rotate">SALE</span>
        @endif
        <div class="product-caption">
            <h3>{{ substr($prod->product_name,0,20)}}</h3>

            @if ( $prod->product_sale_price != null )

                <p>PHP {{$prod->product_sale_price}} </p>
                @else
                    <p>PHP {{$prod->product_regular_price}} </p>
            @endif
        </div>
    </div>
</a>