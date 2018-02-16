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

<div class="container" style="margin-top: 3%;margin-bottom: 3%;">
  <h3>Manage Account</h3><br>

    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-body text-center" style="padding:5px 5px 0px 5px;">

          <div id="image-dp">
            @foreach($userPic as $pic)
              <img src="{{asset('storage').'/'.$pic->user_photo}}" style="width:100%;max-width:250px;">
            @endforeach
          </div>

          <div class="form-group" style="margin-top:3%;">

            <form action="{{ route('changeDp') }}" enctype="multipart/form-data" method="POST">
              <select class="form-control" id="change-dp">
              <option value="Take Photo">Take Photo</option>
              <option value="Browse photo">Browse photo</option>
              </select>
              <input type="file" id="file" name="pic_filename" style="display:none;">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
              <button class="btn btn-default red-btn upload-image" type="submit" style="width:100%;">Upload Image</button>
            </form>
          </div>

          </div>
        </div>
    </div>
            
    <div class="col-md-9">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#store">Store</a></li>
          <li><a data-toggle="tab" href="#menu1">Contact</a></li>
          <li><a data-toggle="tab" href="#menu2">Privacy settings</a></li>
        </ul>

        <div class="tab-content">
          <div id="store" class="tab-pane fade in active">
            
            <h3>Store</h3><br>
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="usr">Store description:</label>
                  <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="pwd">Store name:</label>
                  <input type="text" class="form-control">
                  <br>
                  <button type="submit" class="form-control btn btn-default" style="width:18%;">Save changes</button>
                </div>
              </div>
            </div>

          </div>
          
          <div id="menu1" class="tab-pane fade">
            
            <h3>Contact</h3><br>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pwd">Contact number:</label>
                  <input type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="pwd">Email:</label>
                  <input type="text" class="form-control">
                  <br>
                  <button type="submit" class="form-control btn btn-default" style="width:40%;">Save changes</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="usr">Address:</label>
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>

          </div>

          <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
          </div>
        </div>

    </div>

  </div>
</div>

@include('layouts.foot')
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap-3.1.1.min.js')!!}"></script>
</body>
@include('layouts.footer')
</html>