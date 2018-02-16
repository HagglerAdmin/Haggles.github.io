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

    <img src="{{asset('img/background/thankyou.png')}}" style="width:100%;"><br><br>
    <h1>Thank you for Registering at Haggles</h1>
    <h3>Experience new level of buying and selling. use this for you own good. Enjoy our Cool feature and unique Market environment</h3>
    
    <center><a href="{{url('/emailVerification/account=Active&amp;user_id=').$data['id']}}">Click to verify account</a></center>

    <p></p>
</body>
</html>