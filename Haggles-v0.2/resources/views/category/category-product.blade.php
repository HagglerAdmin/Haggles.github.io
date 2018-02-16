@foreach($product as $prod_key => $prod_value)

    <a href="{{ asset('p').'/id='.$prod_value->id.'&name='. str_replace(' ','-', strtolower($prod_value->product_name))  }}">

        <div class="col-md-3 product-ad" data-view="" style="width:16.4%;">
            
            <div class="product-img">
                <img src=" {{ asset('storage').'/'. $prod_value->product_photo }}">
            </div>

            @if(!is_null($prod_value->product_sale_price) AND $prod_value->product_sale_price != 0)

                <span class="sale-rotate">SALE</span>
            @endif
            <div class="product-caption">
                <h3>{{ substr($prod_value->product_name,0,18)}}</h3>
                
                @if(!is_null($prod_value->product_sale_price) AND $prod_value->product_sale_price != 0)

                    <p>PHP {{$prod_value->product_sale_price}}</p>

                @elseif($prod_value->product_sale_price <= 0)

                    <p>PHP {{$prod_value->product_regular_price}}</p>

                @elseif(is_null($prod_value->product_sale_price))

                    <p>PHP {{$prod_value->product_regular_price}}</p>

                @endif
            </div>

        </div>
    </a>
@endforeach