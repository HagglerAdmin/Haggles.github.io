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
    
    

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>