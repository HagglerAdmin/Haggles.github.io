<div>
    {{--  <center><div class="index-loader"></div></center>  --}}
    <div class="row">

        <div class="col-md-2 category-items" style="width:20%;margin-right:5%;height:30%;">
            <img src="{{ $cat->logo }}">
            <p>{{ $cat->category_name }}</p>
            <div class="text-right" style="margin-top:5%;">
                <a href="{{ url('category').'/'. str_replace(' ','-', strtolower($cat->category_name))  }}" 
                style="color:#AB2A2F;font-size:14px;">view more</a>
            </div>
        </div>

        {{--  sad  --}}
        
        @foreach ( (new \App\Repositories\Products)->productCategory($cat->category_name) as $prod )
            @include('index.product-list')
        @endforeach

    </div>     
</div>