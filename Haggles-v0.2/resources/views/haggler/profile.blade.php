<!DOCTYPE html>
<html>
<head>
	<title>Haggle | Haggler's product</title>
@include('layouts.head')
</head>
<body>
@include('layouts.navigation')

<div class="container" style="margin-top:2%;margin-bottom:2%;">
	<div class="row">
		<div class="col-md-3" style="padding:0px;">

			<div class="well well-panel">
				<div class="media">
					<div class="media-left">

                        @forelse(App\User::find($user->id)->picture()->where('photo_type', 'display')->get() as $pic)

                            <img class="media-object" style="width:80px;border-radius:100%;" src="{{asset('storage').'/'.$pic->user_photo}}">

                            @empty
                            <img src="{{asset('img/faces/proxy.png')}}" class="media-object" style="width:80px;border-radius:100%;">

                        @endforelse

					</div>

						<div class="media-body">
							<h4 class="media-heading">{{ ucwords($user->name) }}</h4>
							<div class="text-muted small">
								<p>{{ $user->profile->phone_number  }}</p>
								<p>{{ $user->profile->email_address  }}</p>
								<p>{{ ucwords($user->profile->city) }}</p>
							</div>

						</div>
				</div>
			</div>

			<div class="well well-panel text-center">

				<a class="btn btn-default"><i class="fa fa-star star-icon" aria-hidden="true"></i> Follow me</a>
				<a class="btn btn-default"><i class="fa fa-envelope message-icon" aria-hidden="true"></i> Message me</a>
			</div>

			<div class="well well-panel text-center small">

				<p>orig lang ang akin binebenta message na lang sa mga tanong</p>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Overall Ratings
				</div>
				<div class="panel-body" style="max-height: 500px;overflow:auto;">

					<div class="media media-comment">
						<div class="media-left">

							<img src="{{asset('img/faces/proxy.png')}}" class="media-object media-picture" />
						</div>
						<div class="media-body">
							<h5 style="font-size:17px;" class="media-heading">Benedict Sausa</h5>
							<div class="text-muted small">
								<p>lodi po yung mga nag cocombo dito, hooo. pwetmalu</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

<div class="col-md-9">

	<div class="row" style="padding:0px;margin-left:2%;">
		<div class="col-md-3 form-group" style="margin-left: -2%;margin-bottom:-1%;">

			<span style="font-size: 14px;">CATEGORY:</span>
			<select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-haggler="category" data-id="{{$user->id}}">

				<option value="all">All</option>

				@foreach($categoryname as $cat)
					<option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
				@endforeach
			</select>
		</div>

		<div class="col-md-3 form-group" style="margin-bottom:-1%;">

			<span style="margin-right: 1%;font-size: 14px;">PRICE:</span>
			<select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-haggler="price" data-id="{{$user->id}}">
				<option value="all">All</option>
				<option value="Highest">Highest price</option>
				<option value="Average">Average price</option>
				<option value="Lowest">Lowest price</option>
			</select>
		</div>

		<div class="col-md-2 form-group" style="margin-bottom:-1%;">

			<span style="margin-right: 1%;font-size: 14px;">DATE:</span>
			<select class="form-control" style="padding:3px 5px 3px 10px;outline: none;border-radius:3px;" data-haggler="date" data-id="{{$user->id}}">
				<option value="Lastest">Latest</option>
				<option value="Oldest">Oldest</option>
			</select>
		</div>
	</div>

	<div class="row" style="padding:0px;margin-left:2%;">
		<hr>
		<div id="filter">

			@include('haggler.product')
		</div>
	</div>
</div>
</div>
</div>


@include('layouts.foot')
</body>
@include('layouts.footer')
</html>