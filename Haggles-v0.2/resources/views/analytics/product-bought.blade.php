@if ( App\Order::where('user_id', Auth::id())->count() > 0 )
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">

                product buy
            </div>

            <div class="panel-body" style="">

                <canvas id="pie-chart" style="width:100%;height:380px;"></canvas>
            </div>
        </div>
    </div>
@endif