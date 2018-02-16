<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Supply and Customer demand
        </div>

    <div class="panel-body">

        <select class="form-control" id="supply-demand">

                <option disabled selected>Choose ..</option>
                <option value="all">Store supply and demand</option>
            @foreach($product as $prod)
                <option value="{{$prod->id}}">{{$prod->product_name}}</option>
            @endforeach
        </select>

        <div class="col-md-6" style="margin-top: 5%;">
            <canvas id="demand-chart" style="height:220px;"></canvas>
        </div>
        <div class="col-md-6" style="margin-top: 5%">
            <canvas id="supply-chart" style="height:220px;"></canvas>
        </div>
    </div>
</div>
</div>