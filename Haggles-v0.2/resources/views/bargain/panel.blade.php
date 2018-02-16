@if (Auth::id() == $product->user_id)
    
    <div class="form-group">
        <label>Message</label>
        <textarea type="text" id="msg" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <button class="form-control btn red-btn btn-default" data-user="Seller" data-bargain="{{$product->id}}">Post message</button>
    </div>
        <button class="btn btn-default">Close Bargain</button>
    @else

        <div class="form-group">
            <label>How much?</label>

            @if(!is_null($product->product->product_sale_price) AND $product->product->product_sale_price != 0)

                <input type="text" class="form-control" id="price" value="{{$product->product->product_sale_price}}"/>
            @elseif($product->product->product_sale_price <= 0)

                <input type="text" class="form-control" id="price" value="{{$product->product->product_regular_price}}"/>
            @elseif(is_null($product->product->product_sale_price))

                <input type="text" class="form-control" id="price" value="{{$product->product->product_regular_price}}"/>
            @endif

            <br><label>How many? only {{$product->product->productstock->stock_quantity}} left</label>
            <br><input type="number" class="form-control" id="qty" max="{{$product->product->productstock->stock_quantity}}" min="1" value="{{$product->product->productstock->stock_quantity}}"/>
        </div>
        
        
        <div class="form-group">

            <button class="pull-right btn btn-default red-btn form-control" data-user="Buyer" data-bargain="{{$product->id}}"  
            {{ $product->product->productstock->stock_quantity <= 0 ? 'Disabled' : ' ' }}>Send</button>

        </div>
        
@endif