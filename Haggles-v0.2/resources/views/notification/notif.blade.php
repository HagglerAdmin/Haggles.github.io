@forelse($notifications as $notif)

    @if ( $notif->notif_type == "bargain-accept" )

        @include('notification.bargain-accept')
        
    @elseif ( $notif->notif_type == "buyer-bought" )

        @include('notification.buyer-bought')
    
    @elseif ( $notif->notif_type == "out-of-stock" )

        @include('notification.outOfStock')

    @elseif ( $notif->notif_type == "buying" )

        @include('notification.buying')
    @endif

    @empty
        wala kang notif
@endforelse