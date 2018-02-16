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

<form action="/edit/{{ $product->id }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="container" style="margin-top:3%;margin-bottom:3%;">

        <input type="hidden" value="{{$product->id}}" name="product_id">
        <div class="row">
        <div class="col-md-8">
        <div class="addproduct-container">
            <div class="form-group">
                <input type="text" class="form-control" name="product_name" placeholder="Product name" value="{{$product->product_name}}">
            </div>
        
            <div class="form-group">
                <label>Product location</label><br>
                <select class="form-controll selectpicker" name="product_location" data-show-subtext="true" data-live-search="true">
                    @foreach ($city as $city)

                        <option {{$product->product_location == $city->city.','.$city->province ? "selected" : " "}} data-subtext="{{ $city->province }}" value="{{ $city->city.','.$city->province }}">{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <textarea id="desc" class="tinymce form-control" name="product_description" style="height:275px">{!! $product->product_description !!}</textarea>
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
            <div class="form-group">
                <label style="font-size:14px;">Regular price (₱)</label>
                <input type="number" class="form-control" name="product_regular_price" value="{{$product->product_regular_price}}">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Sale price (₱)</label>
                <input type="number" class="form-control" name="product_sale_price" value="{{$product->product_sale_price}}">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Sale price dates<br>From:</label>
                <input type="date" class="form-control" name="product_date_sale" value="{{$product->product_date_sale}}">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">To:</label>
                <input type="date" class="form-control" name="product_exp_sale" value="{{$product->product_exp_sale}}">
            </div>
            </div>
            <!-- end general -->

            <!-- inventory -->
            <div id="inventory" class="tab-pane fade">
            <div class="form-group">
                <label style="font-size:14px;">Stock quantity</label>
                <input type="number" class="form-control" name="stock_quantity" value="{{$product->productstock->stock_quantity}}">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Allow backorders?</label>
                <select class="form-control" name="product_backorder">
                    <option value="Do not allow"  {{$product->productstock->backorder == "Do not allow" ? "selected" : " "}}>Do not allow</option>
                    <option value="Allow, but notify customer" {{$product->productstock->backorder == "Allow, but notify customer" ? "selected" : " "}}>
                        Allow, but notify customer
                    </option>
                    <option value="Allow" {{$product->productstock->backorder == "Allow" ? "selected" : " "}}>Allow</option>
                </select>
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Stock status</label>
                <select class="form-control" name="stock_status">
                    <option value="In stock" {{$product->productstock->stock_status == "In stock" ? "selected" : " "}}>In stock</option>
                    <option value="Out of stock" {{$product->productstock->stock_status == "Out of stock" ? "selected" : " "}}>Out of stock</option>
                </select>
            </div>
            </div>
            <!-- end of inventory -->

            <!-- shipping -->
            <div id="shipping" class="tab-pane fade">
            <div class="form-group">
                <label style="font-size:14px;">Weight (kg)</label>
                <input type="number" class="form-control" name="product_weight" placeholder="0" value="{{$product->productdimension->product_weight}}">
            </div>
            <div class="form-group">
                <label style="font-size:14px;">Dimensions (cm)</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_length" placeholder="Lenght" value="{{$product->productdimension->product_length}}">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_width" placeholder="width" value="{{$product->productdimension->product_width}}">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="product_height" placeholder="height" value="{{$product->productdimension->product_height}}">
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
                        {{$product->product_short_desc}}
                    </textarea>
                </div>
            </div>

            <div class="panel panel-default">
            	<div class="panel-body" id="subImage">
            	    @forelse($product->productphoto as $photo)

                        @if($photo->photo_type == "sub")

                            <img src="{{asset('storage').'/'.$photo->product_photo}}" style="height:90px; margin:5px;">
                        @endif

                    @empty

                    @endforelse
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
                <input type="submit" class="btn btn-default red-btn" value="Save Changes">
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
                <input type="radio" name="product_category" value="{{$cat->category_name}}" {{$cat->category_name == $product->product_category ? " checked " : " "}}>
                <i></i>{{$cat->category_name}}</label></li>

                @endforeach

            </ul>
            </div>
            <!-- end of category -->

            <!-- most used -->
            <div id="most" class="tab-pane" style="height:130px;overflow:auto;">
            <ul class="category-list">
                <li><input type="checkbox" id="ec" /><label for="ec">Electronic Consumer</label></li>
                <li><input type="checkbox" id="cl" /><label for="cl">Comptuer &amp; Laptop</label></li>
                <li><input type="checkbox" id="mt" /><label for="mt">Mobiles &amp; Tablets</label></li>
                <li><input type="checkbox" id="HF" /><label for="HF">Home Furnitures</label></li>
                <li><input type="checkbox" id="bks" /><label for="bks">Books</label></li>
                <li><input type="checkbox" id="ht" /><label for="ht">Hardware Tools</label></li>
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
                    <input type="text" class="form-control" name="product_brand" placeholder="product brand" value="{{$product->product_brand}}"/>
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
                    @forelse($product->productphoto as $display)

                        @if($display->photo_type == "Display")

                            <img src="{{asset('storage').'/'.$display->product_photo}}" style="width: 100%;">
                        @endif

                    @empty

                    @endforelse
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

</html>