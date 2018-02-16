@foreach($product as $prod)

    @include('store.store-product')

@endforeach

<tr id="store-page">
    <td>{{ $product->links() }}</td>
</tr>