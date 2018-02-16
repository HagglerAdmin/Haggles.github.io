<div class="row">
            <Hr>

            @forelse($product as $prod)

            <a href="/p/id={!! $prod->id.'&name='.str_replace(' ','-', strtolower($prod->product_name))!!}">
                <div class="col-md-3 product-ad" data-view="" style="width:19.8%;">

                    <div class="product-img">
                        @foreach($prod->productphoto as $photo)

                            @if($photo->photo_type == "Display")
                                <img src="{{asset('storage').'/'.$photo->product_photo}}">
                            @endif
                        @endforeach
                    </div>

                    @if(!is_null($prod->product_sale_price) AND $prod->product_sale_price != 0)
                        <span class="sale-rotate">SALE</span>
                    @endif

                    <div class="product-caption">
                        <h3>{{$prod->product_name}}</h3>
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

                <div class="alert alert-warning"  role="alert">
                    <img src="{{asset('img/icons/sad.png')}}" class="pull-left" style="width: 40px;margin-top: -1%;margin-right:1%;"><h4>Unknown key word to search product</h4>
                </div>
            @endforelse

        </div>

        <div class="row">

            <div class="text-center">
                {{ $product->links() }}
            </div>
        </div>