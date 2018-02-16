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

@include('layouts.store-nav')

<div class="container" style="margin-top:3%;">
    <h1>Store</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <p class="pull-left" style="font-size:12px;color:#333;margin-top:.9%;margin-right:1%;">Sort by category:</p>
                <select class="form-control pull-left" style="width:20%;" id="search-by-category">
                    <option value="all">All</option>
                    @foreach($categoryname as $cat)
                    <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
    
                <input type="text" id="search-by-name" class="form-control pull-right" style="width:20%;" placeholder="search by name" />
                <button data-move="move" class="form-control pull-right" style="width:5%;margin-right:2%;">Move</button>
                <button data-toggle="modal" data-target="#groupModal" class="form-control pull-right" style="width:14%;margin-right:2%;">Create product group</button>
            </div>
        </div>
    </div><br>

    <br><div class="row">
    
        @forelse ($groups as $group)

            
            @include('store.store-group')

            @empty

        @endforelse    
    </div>

    <div class="row product-table">
        @include('store.store-table')
    </div>
</div><br>

<div id="store-modal">
    @include('store.store-modal')
</div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui2.js')}}"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>