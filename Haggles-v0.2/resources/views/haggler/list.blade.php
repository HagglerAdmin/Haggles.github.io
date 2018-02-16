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

<div class="container" style="margin-top:3%;margin-bottom:3%;">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" style="display: block;text-align:-webkit-center;">
                <input type="text" id="search-haggler" class="form-control" style="width:30%;" placeholder="Search Haggler here ..." />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 text-center">
            <h3>Featured</h3>
        </div>
    </div><br>

    <div class="row" id="hagglers-list">
        @include('haggler.list-datas')
    </div>
</div>


@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>