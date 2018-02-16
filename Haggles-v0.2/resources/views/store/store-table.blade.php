<div id="sortable">

    @forelse ( App\ProductPosition::where('user_id', Auth::id())->get() as $pos)
    
        @foreach ( json_decode($pos->position) as $f_pos )
            

            @forelse($product as $prod)

                @if ( $prod->id == $f_pos )
                    @include('store.store-product')
                @endif
                
                @empty
            @endforelse

        @endforeach

        @empty

        @forelse($product as $prod)
        
                @include('store.store-product')
            @empty
            
        @endforelse

    @endforelse

</div>

{{--  <tr id="store-page">
<td>{{ $product->links() }}</td>
</tr>  --}}