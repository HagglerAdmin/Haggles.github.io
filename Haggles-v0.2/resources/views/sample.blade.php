<html>
    <head></head>
    <body>
        <form action="/sample" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="displayphotos" id="displayfile" accept="image/x-png,image/jpeg" multiple />
            <input type="submit" class="btn btn-default red-btn" value="Submit">
        </form>
    </body>
</html>