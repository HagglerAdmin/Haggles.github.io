<!DOCTYPE html>
<html>
<head>
	<title>Haggle</title>
@include('layouts.head')
</head>
<body>

<div id="app">
    @include('layouts.navigation')
</div>

<div class="container" style="margin-top: 3%;margin-bottom: 3%;" data-route="{{request()->route('tag')}}">

    <div class="row" style="margin-bottom:-1.5%;">

        <div class="col-md-6">
            <h3>Showing results for "{{request()->route('tag')}}"</h3>
        </div>

        <div class="col-md-2 form-group">

            <span style="margin-right:1%;font-size: 14px;">Category:</span>
            
            <select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-filter="category">

                <option value="all">All</option>

                @foreach($categoryname as $cat)
                    <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                @endforeach

            </select>
        </div>

        <div class="col-md-2 form-group">

            <span style="margin-right: 1%;font-size: 14px;">PRICE:</span>
            <select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-filter="price">
                <option value="all">All</option>
                <option value="Highest">Highest price</option>
                <option value="Average">Average price</option>
                <option value="Lowest">Lowest price</option>
            </select>
        </div>

        <div class="col-md-2 form-group">

            <span style="margin-right: 1%;font-size: 14px;">DATE:</span>
            <select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-filter="date">
                <option value="Lastest">Lastest</option>
                <option value="Oldest">Oldest</option>
            </select>
        </div>
    </div>

    <div id="filter">
        
        @include('search.search-product')
        
    </div>
</div>
@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>