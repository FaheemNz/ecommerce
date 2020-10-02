<div class="card text-center card-product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <div class="card-product__img">
            <img class="card-img" src="{{ $product->image }}" alt="{{ $product->name }}" />
            <ul class="card-product__imgOverlay">
                <li><button><i class="fa fa-search"></i></button></li>
                <li>
                    <form method="POST" action="{{ route('cart.store', $product) }}">
                        @csrf
                        <button type="submit"><i class="fa fa-shopping-cart"></i></button>
                    </form>
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
</div>