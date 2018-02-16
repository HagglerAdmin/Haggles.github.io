<div class="col-md-3" data-value="{{ request()->route('category') }}">
	<div class="sidebar-header text-left"><span>Condition</span></div>
	<div class="sidebar-body text-left">
		<ul>
			<li><input type="checkbox" id="Brand new" /><label for="Brand new">New</label></li>
			<li><input type="checkbox" id="Used" /><label for="Used">Used</label></li>
		</ul>	
	</div>
	<div class="sidebar-header text-left"><span>Sory by</span></div>
	<div class="sidebar-body text-left">
		<ul>
			<li><label class="radio">
			<input type="radio" name="sort" data-category="Popular">
			<i></i>Popular</label></li>
			<li><label class="radio">
			<input type="radio" name="sort" data-category="Recent">
			<i></i>Recent</label></li>
			<li><label class="radio">
			<input type="radio" name="sort" data-category="HL">
			<i></i>Highest-lowest price</label></li>
			<li><label class="radio">
			<input type="radio" name="sort" data-category="LH">
			<i></i>Lowest-highest price</label></li>
		</ul>	
	</div>
	<div class="sidebar-header text-left"><span>Category</span></div>
	<div class="sidebar-body text-left">
		<ul>
			@foreach($category as $cat)
				<li><label class="radio">
				<input type="radio" name="product_category" data-value="{{$cat->category_name}}">
				<i></i>{{$cat->category_name}}</label></li>
			@endforeach
		</ul>	
	</div>
	<div class="sidebar-header text-left"><span>Location</span></div>
	<div class="sidebar-body text-left" style="height:250px;overflow:auto;">
		<ul>
			@foreach($city as $city)

				@if($city->province == "Metro Manila") 
					<li><input type="checkbox" id="{{ $city->city }}" /><label for="{{ $city->city }}">{{ $city->city }}</label></li>
				@endif
			@endforeach
		</ul>	
	</div>
</div>