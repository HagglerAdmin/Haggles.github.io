<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Product sales
        </div>

    <div class="panel-body">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Product</th>
                    <th>Buyer</th>
                    <th>Sold price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($product_sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->product_name }}</td>
                    <td>{{ App\User::find($sale->user_id)->billing->billing_name }}</td>
                    <td>{{ $sale->order_price }}</td>
                    <td>{{ $sale->order_quantity }}</td>
                    <td>{{ $sale->order_quantity * $sale->order_price }}</td>
                    <td>{{ $sale->created_at }}</td>
                </tr>
                @empty  

            @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>