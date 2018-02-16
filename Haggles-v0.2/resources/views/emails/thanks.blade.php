<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style>
    
    body {
        font-family: Arial,'Helvetica Neue',Helvetica,sans-serif;
    }

    .navigation {
        border-top:5px solid #f35c57;
    }
    
    .navigation img {

        width:20%;
    }

    h1 {
        color:#f35c57;
    }

    h3 {

        color: #333;
    }

    a {
        background-color:#f35c57;
        color: white;
        border:none;
        font-size: 15px;
        padding:15px;
        border-radius: 50px;
        font-weight:600;
        text-decoration: none;
    }

    p {
        
    }
</style>
<body>

    <div class="navigation">

    	<img src="{{asset('img/logo/logo.png')}}">
    </div>

    <h1>Thank you for buying</h1>
    <p>Tracking number: {{ $data['track_num'] }}</p>
    <p>Delivery Status: {{ $data['status'] }}</p>
    
    <center><a href="{{ url('/haggler').'/'.$data['user_name'] .'/user/'. $data['user_id'] }}">Come to my shop</a></center>

    <p></p>

</body>
</html>