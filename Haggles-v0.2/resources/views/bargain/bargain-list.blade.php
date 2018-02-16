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
        <div class="col-md-3">
            <h3>Bargain Room</h3><br>
            <div class="form-group">
                <input class="form-control" placeholder="Search product name here.." id="bargain-list"/>
            </div>
        </div>
    </div>
    <div class="row" id="lists">
        @include('bargain.list')
    </div>
</div>


@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>