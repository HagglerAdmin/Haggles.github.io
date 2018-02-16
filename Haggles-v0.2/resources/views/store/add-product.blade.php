<!DOCTYPE html>
<html>
<head>
	<title>Haggle | New product</title>
@include('layouts.head')
<script type="text/javascript" src="{{asset('tinymce/tinymce.min.js')}}"></script>
</head>
<body>
@include('layouts.navigation')
<script type="text/javascript">
    tinymce.init({  selector: 'textarea#desc',
    selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
    menubar:false,
    statusbar: false })
    tinymce.init({  selector: 'textarea#shortdesc',
    selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
    menubar:false,
    statusbar: false })
</script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}" />
  
@include('layouts.success')

<form action="/product" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="container" style="margin-top:3%;margin-bottom:3%;">
        <h3><a href="#" style="color: #333;"><i class="fa fa-arrow-left"></i></a> Add new product</h3>
        <div class="row">
        <div class="col-md-8">
        <div class="addproduct-container">
            <div class="{{  $errors->has('product_name')  ? 'has-error' : 'form-group' }}">
                <input type="text" class="form-control" name="product_name" placeholder="Product name">
                {!! $errors->first('product_name', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group">
                <label>Product location</label><br>
                <select class="form-controll selectpicker" name="product_location" data-show-subtext="true" data-live-search="true">
                </select>
            </div>

            <div class="form-group">
                <label>Product Main Description</label>
                <textarea id="desc" class="tinymce form-control" name="product_description" style="height:275px"></textarea>
            </div>

            <div class="panel panel-default" style="border-radius: 0px;">
            <div class="panel-heading"><span style="font-weight:600;font-size:14px">Product Data</span></div>
            <div class="panel-body" style="padding:0px;height:320px;">
            <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-tabs nav-stacked">
                  <li style="width:100%" class="active"><a data-toggle="tab" href="#general">
                  <i class="fa fa-wrench" style="font-size:15px;margin-top:-6%;"></i>General</a></li>
                  <li style="width:100%"><a data-toggle="tab" href="#inventory">
                  <i class="fa fa-clipboard" style="font-size:15px;margin-top:-6%;"></i>Inventory</a></li>
                  <li style="width:100%"><a data-toggle="tab" href="#shipping">
                  <i class="fa fa-truck" style="font-size:15px;margin-top:-6%;"></i>Shipping</a></li>
                </ul>
            </div>
            <div class="col-md-8" style="padding:14px;">
            <div class="tab-content">
            <!-- general -->
            <div id="general" class="tab-pane active">
            <div class="{{ $errors->has('product_regular_price')  ? 'has-error' : 'form-group' }}">
                <label style="font-size:14px;">Regular price (₱)</label>
                <input type="number" class="form-control" name="product_regular_price">
                {!! $errors->first('product_regular_price', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Sale price (₱)</label>
                <input type="number" class="form-control" name="product_sale_price">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Sale price dates<br>From:</label>
                <input type="date" class="form-control" name="product_date_sale">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">To:</label>
                <input type="date" class="form-control" name="product_exp_sale">
            </div>
            </div>
            <!-- end general -->

            <!-- inventory -->
            <div id="inventory" class="tab-pane fade">
            <div class="form-group">
                <label style="font-size:14px;">Stock quantity</label>
                <input type="number" class="form-control" name="stock_quantity">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Allow backorders?</label>
                <select class="form-control" name="product_backorder">
                    <optio value="Do not allow">Do not allow</option>
                    <option value="Allow, but notify customer">Allow, but notify customer</option>
                    <option value="Allow">Allow</option>
                </select>
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Stock status</label>
                <select class="form-control" name="stock_status">
                    <option value="In stock">In stock</option>
                    <option value="Out of stock">Out of stock</option>
                </select>
            </div>
            </div>
            <!-- end of inventory -->

            <!-- shipping -->
            <div id="shipping" class="tab-pane fade">
            <div class="{{ $errors->has('product_weight')  ? 'has-error' : 'form-group' }}">
                <label style="font-size:14px;">Weight (kg)</label>
                <input type="number" class="form-control" name="product_weight" placeholder="0">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Dimensions (cm)</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_length" placeholder="Lenght">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_width" placeholder="width">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_height" placeholder="height">
                    </div>
                </div>
            </div>
            </div>
            <!-- end of shipping -->
            </div>
            </div>
            </div>
            </div>
            </div>

            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-heading"><span style="font-weight:600;font-size:14px">Short Description</span></div>
                <div class="panel-body" style="height:200px;">
                    <textarea id="shortdesc" class="tinymce form-control" name="product_short_desc" style="height:126px;">
                    </textarea>
                </div>
            </div>

            <div class="panel panel-default">
            	<div class="panel-body" id="subImage">
            	
            	</div>
            </div>

        </div>
        </div>
        <div class="col-md-4" style="padding-top:20px;">
           <!--  publish -->
            <div class="panel panel-default" style="border-radius:0px">
            <div class="panel-heading"><span style="font-weight:600;font-size:14px">Publish</span></div>
            <div class="panel-body">
                <p style="font-size:13px;"><span style="font-weight:600">Reminder:</span>
                Product is not directly posted to the market. Wait for the admins confirmation on your post</p>
            </div>
            <div class="panel-footer">
                <input type="submit" class="btn btn-default red-btn" value="Submit">
            </div>
            </div>
            <!-- end of publish -->

            <!-- product category -->
            <div class="panel panel-default" style="border-radius:0px">
            <div class="panel-heading"><span style="font-weight:600;font-size:14px">Product Category</span></div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#category">Category</a></li>
                    <li><a data-toggle="tab" href="#most">Most used</a></li>
                </ul>
            <div class="tab-content">
            <!-- category -->
            <div id="category" class="tab-pane active" style="height:130px;overflow:auto;">
                <ul class="category-list">
                    @foreach($categoryname as $cat)
                    <li><label class="radio">
                    <input type="radio" name="product_category" value="{{$cat->category_name}}">
                    <i></i>{{$cat->category_name}}</label></li>
                    @endforeach
                </ul>
            </div>
            <!-- end of category -->

            <!-- most used -->
            <div id="most" class="tab-pane" style="height:130px;overflow:auto;">
            <ul class="category-list">
                @foreach($mostUsedCategory as $most )
                    <li><label class="radio">
                    <input type="radio" name="product_category" value="{{$most->category_name}}">
                    <i></i>{{$most->category_name}}</label></li>
                @endforeach
            </ul>
            </div>
            <!-- end of most used -->
            </div>
            </div>
            </div>
            <!-- end of category -->

            <!-- product other -->
            <div class="panel panel-default" style="border-radius:0px;">
            <div class="panel-heading"><span style="font-weight:600;font-size:14px">Other</span></div>
            <div class="panel-body">
                <div class="tag-composer">
                    <input type="text" class="form-control" name="product_brand" placeholder="product brand"/>
                </div>
                <div class="form-group" style="margin-top:5%;margin-left:1%;">
                    <label style="font-size:14px;">Condition</label>
                    <select class="form-control" style="width:90%;" name="product_condition">
                        <option value="Brand new">Brand new</option>
                        <option value="Second hand">Second hand</option>
                    </select>
                </div>
            </div>
            </div>
            <!-- end of product other -->

            <!-- product image -->
            <div class="panel panel-default" style="border-radius:0px;">
            <div class="panel-heading"><span style="font-weight:600;font-size:14px">Product image</span></div>
            <div class="panel-body">
                <p class="set-product" id="openFileDisplay">set your display product image</p>
                <p class="set-product" id="openFileDialog">set your sub product image</p>
                <div class="hidden-div">
                    <input type="file" name="displayphotos" id="displayfile" accept="image/x-png,image/jpeg" multiple />
                    <input type="file" name="photos[]" id="file" accept="image/x-png,image/jpeg" multiple />
                </div>
            </div>
            </div>
            <!-- end of product image -->
            <div class="panel panel-default">
                <div class="panel-body" id="preview">

                </div>
            </div>
        </div>
        </div>
    </div>
</form>

  
@include('layouts.foot')
</body>
@include('layouts.footer')
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script>
    fetchCities();
</script>
</html>