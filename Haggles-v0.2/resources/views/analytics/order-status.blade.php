<div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Buy History
            </div>
    
        <div class="panel-body">
    
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Seller</th>
                        <th>Offer price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Delivered Date</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($product_history as $history)
                    <tr>   
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->product_name }}</td>
                        <td>{{ App\User::find($history->p_id)->billing->billing_name }}</td>
                        <td>{{ $history->order_price }}</td>
                        <td>{{ $history->order_quantity }}</td>
                        <td>{{ $history->order_quantity * $history->order_price }}</td>
                        <td>{{ $history->created_at }}</td>
                        <td>{{ $history->date_delivered }}</td>
                        <td></td>
                    </tr>
                    @empty  
    
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>