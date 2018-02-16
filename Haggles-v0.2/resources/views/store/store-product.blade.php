<div class="col-md-3" data-id="{{$prod->id}}" style="margin-bottom:3%;">
    <div class="well well-bargain" style="background-position:center top;background:url({{asset('storage').'/'.$prod->product_photo}});background-repeat: no-repeat;background-size: cover;">
        <div class="edit-menu">
            @if($prod->product_status != "Approve" )

                    <span class="pending-item" style="padding:7px 10px 7px 10px;">{{$prod->product_status}}</span>

                    @else
                    
                    <a data-store="{{$prod->id}}" style="cursor:default;" data-toggle="modal" data-target="#myModal">Edit</a> <a> add stock</a>
            @endif
        </div>
    </div>
    <div class="prod-info">
        <p>{{ substr($prod->product_name,0,30) }}</p>
        @if(!is_null($prod->product_sale_price) AND $prod->product_sale_price != 0)
        
            <p>PHP {{$prod->product_sale_price}}</p>

        @elseif($prod->product_sale_price <= 0)

            <p>PHP {{$prod->product_regular_price}}</p>

        @elseif(is_null($prod->product_sale_price))

            <p>PHP {{$prod->product_regular_price}}</p>
        @endif

        <span class="stock-status">{{ $prod->stock_status."(". $prod->stock_quantity .")"}}</span>
    </div>
</div>