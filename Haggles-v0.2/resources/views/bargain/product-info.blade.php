<h4>{{$product->product->product_name}}</h4>
    <p style="text-decoration:underline">{{ $product->product->remarks->product_condition }}</p>
    <h4>
        @if(!is_null($product->product->product_sale_price) AND $product->product->product_sale_price != 0)
            <p style="margin-bottom:1%;"><span class="item_price">PHP {{$product->product->product_sale_price}}.00</span></p>
            <p style="font-size:14px;margin-top:-3%;">before<del>- PHP {{$product->product->product_regular_price}}.00</del>
            </p>
        @elseif($product->product->product_sale_price <= 0)
            <p><span class="item_price">PHP {{$product->product->product_regular_price}}.00</span></p>
        @elseif(is_null($product->product->product_sale_price))
            <p><span class="item_price">PHP {{$product->product->product_regular_price}}.00</span></p>
        @endif
    </h4>
    <p>left: {{$product->product->productstock->stock_quantity}}</p><br>
{!! $product->product->product_description !!}
