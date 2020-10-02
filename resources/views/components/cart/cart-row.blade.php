<div class="cart-table-row">
    <div class="cart-table-row-left">
        <a href="{{ route('shop.show', $item->options['slug']) }}"><img src="{{ $item->options['image'] }}" alt="item" class="cart-table-img"></a>
        <div class="cart-item-details">
            <div class="cart-table-item"><a href="{{ route('shop.show', $item->options['slug']) }}">{{ $item->name }}</a></div>
            <div class="cart-table-description">{{ $item->options['details'] }}</div>
        </div>
    </div>
    <div class="cart-table-row-right">
        <div class="cart-table-actions">
            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="cart-options">Remove</button>
            </form>

            <form action="{{ route('saveForLater.store', $item->rowId) }}" method="POST">
                @csrf
                <button type="submit" class="cart-options">Save for Later!</button>
            </form>
        </div>
        <div>
            <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->qty }}">
                @for ($i = 1; $i < 5 + 1 ; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
            </select>
        </div>
        <div data-subtotal>{{ presentPrice($item->subtotal) }}</div>
    </div>
</div> <!-- end cart-table-row -->