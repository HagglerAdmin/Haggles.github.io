<div class="input-group" id="adv-search">
    <input type="text" class="form-control" id="search-category" data-category="{{ request()->route('category') }}" placeholder="Search for product to this category" />
    <div class="input-group-btn">
        <div class="btn-group" role="group">
            <div class="dropdown dropdown-lg">
                <button style="margin-left:5%;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">More filter <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-right " role="menu" >
                    <form method="GET" action="{{ route('filterCategory', ['param1' => str_replace('-',' ',request()->route('category')) ]) }}" class="form-horizontal container-fluid" role="form" style="width:400px;"><br>
                        <div class="form-group col-md-12">
                            <label for="filter">View by</label>
                            <select name="sort_by" class="form-control">
                                <option value="All" selected>All</option>
                                <option value="Popular">Popular</option>
                                <option value="Featured">Featured</option>
                                <option value="Recent">Recent</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="contain">Price</label>
                            <input class="form-control" type="text" name="max_price" placeholder="Maximum price" style="margin-bottom:2%;"/>
                            <input class="form-control" type="text" name="min_price" placeholder="Minimum price"/>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="filter">Location</label>
                            <select name="located_at" class="form-control">
                                <option value="All">All</option>
                                @foreach($city as $city)
                                    <option value="{{$city->city.','.$city->province}}">{{ $city->city.', '.$city->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">

                            <button type="submit" class="btn btn-danger">Search <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>