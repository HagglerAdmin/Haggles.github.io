<!DOCTYPE html>
<html>
<head>
	<title>Haggle</title>
@include('layouts.head')
</head>
<body>

    <div id="app">
        @include('layouts.navigation')
        @include('layouts.carousel')
    </div>

    <div class="container" style="margin-bottom:3%;margin-top:3%;">

        @forelse ( $category as $cat )
            
            @if ( $cat->category_count > 0 )
                @include('index.category-list')
            @endif

            @empty
        
        @endforelse

    </div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myIndexCarousel').carousel({
            interval: false
        });
    })
</script>
@include('layouts.footer')
</html>