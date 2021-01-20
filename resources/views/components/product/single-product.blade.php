<div class="card text-center card-product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <div class="card-product__img">
            <img class="card-img" src="{{ $product->image }}" alt="{{ $product->name }}" />
            <ul class="card-product__imgOverlay">
                <li>
                    <add-to-cart :id="{{ json_encode($product->id) }}" />
                </li>
                <li><button><i class="fa fa-heart"></i></button></li>
            </ul>
        </div>
    </a>
    <div class="card-body">
        <p>Accessories</p>
        <h4 class="card-product__title"><a href="#">{{ $product->name }}</a></h4>
        <p class="card-product__price">{{ $product->formatted_price }}</p>
    </div>
    <span class="item-status {{ $product->quantity == 0 ? 'bg-danger' : 'bg-info' }}">{{ $product->quantity }} left</span>
</div>