<!--================ Start related Product area =================-->
<section class="related-product-area section-margin--small mt-5">
    <div class="container">
        <div class="section-intro pb-60px">
            <p>Popular Item in the market</p>
            <h2>Featured <span class="section-intro__style">Product</span></h2>
        </div>
        <div class="row mt-30">
            @foreach($mightAlsoLikeProducts as $product)
            <div class="col-md-3">
                <div class="single-search-product d-flex">
                    <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ presentImage($product->image) }}" alt=""></a>
                    <div class="desc">
                        <a href="{{ route('shop.show', $product->slug) }}" class="title">{{ $product->name }}</a>
                        <div class="price">{{ $product->formatted_price }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================ end related Product area =================-->