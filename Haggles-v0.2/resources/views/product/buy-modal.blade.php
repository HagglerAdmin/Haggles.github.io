
<div id="buy" class="modal" role="dialog">

        <div class="modal-dialog modal-sm" style="width: 400px;margin-top:15%;">
    
            <!-- Modal content-->
            <div class="modal-content">
    
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p><span id="stock">{{ $product->productstock->stock_quantity}}</span> Stock Remaining</p>
                </div>
    
                <div class="modal-body" >
    
                    <div class="row">
    
                        <div class="col-md-2">
                            <button class="form-control btn btn-default" id="qty-plus">+</button>
                        </div>
    
                        <div class="col-md-2" style="padding: 0px;">
                            <input type="number" name="" class="form-control" id="qty-stock" placeholder="QTY" value="1" disabled
                                   style="background:#fff;cursor:default;">
                        </div>
    
                        <div class="col-md-2">
                            <button class="form-control btn btn-default" id="qty-minus">-</button>
                        </div>
    
                        <div class="col-md-6" >
                            @if(!is_null($product->product_sale_price) AND $product->product_sale_price != 0)
    
                                <input type="text" name="" class="form-control" id="offer_price" style="background-color:#eee;cursor: default"
                                       placeholder="PRICE" disabled value="{{$product->product_sale_price}}">
                            @elseif($product->product_sale_price <= 0)
    
                                <input type="text" name="" class="form-control" id="offer_price" style="background-color:#eee;cursor: default"
                                       placeholder="PRICE" disabled value="{{$product->product_regular_price}}">
                            @elseif(is_null($product->product_sale_price))
    
                                <input type="text" name="" class="form-control" id="offer_price" style="background-color:#eee;cursor: default"
                                       placeholder="PRICE" disabled value="{{$product->product_regular_price}}">
                            @endif
    
                        </div>
    
                    </div>
    
                </div>
    
                <div class="modal-footer">
                    <a class="btn btn-default" data-buy="{{ request()->route('id') }}">Buy</a>
                </div>
            </div>
    
        </div>
    </div>

<div id="message" class="modal" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background:#AB2A2F;color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body" style="padding-bottom:-5%;">
                <div class="form-group">
                    <label style="margin-bottom:2%;">To: {{ucwords($product->user->name)}}
                        <span id="seller-id" style="display:none">{{ucwords($product->user->id)}}</span>    
                    </label><br>
                    <textarea class="form-control" id="message-body" placeholder="Write message here .." style="height:200px;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default red-btn" id="product-message">Send</button>
            </div>
        </div>

    </div>
</div>