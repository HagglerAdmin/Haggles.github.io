<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="background:#AB2A2F;color:white;">
            Product Leaderboard
        </div>

    <div class="panel-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Product Img</th>
                    <th>Product name</th>
                    <th>Total Sales</th>
                    <th>Total Demand</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($leader_board as $board)
               
                @for( $a = 0; $a < count($leader_board); $a++ )
                    <tr>
                        <td style="vertical-align:middle;" class="text-center">{{ $a + 1 }}</td>
                        <td style="vertical-align:middle;"><img src="{{ asset('storage').'/'.$board->product_photo}}" style="width:120px;height:120px;"></td>
                        <td style="vertical-align:middle;">{{ $board->product_name}}</td>
                        <td style="vertical-align:middle;">{{ $board->total_sales}}</td>
                        <td style="vertical-align:middle;">{{ $board->total_demand }}</td>
                    </tr>
                @endfor

                @empty  

            @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>