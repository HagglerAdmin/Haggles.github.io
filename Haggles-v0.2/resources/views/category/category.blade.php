<!DOCTYPE html>
<html>
<head>
	<title>Haggles | Category</title>
@include('layouts.head')
</head>
<body>
<div id="app"> 
    @include('layouts.navigation')
</div>

<div class="container" style="margin-top: 3%;margin-bottom: 3%;">

<div class="row" style="margin-bottom:-1.5%;">

    <div class="col-md-4 form-group">
        @include('category.filter-modal')
    </div>

    <div class="col-md-5 form-group">
        <h4> 
            Category: <span class="label label-info"> {{request()->route('category')}} </span>
        </h4>
    </div>

</div>

<div class="row">
    <hr>
    <div id="filter">
        @include('category.category-product')
    </div>
</div>

</div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-3.1.1.min.js') }}"></script>
</body>
@include('layouts.footer')
</html>