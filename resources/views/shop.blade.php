@extends('layout')

@section('content')

<x-breadcrumbs title="Shop" link2="Shop" />

<div class="container">
    <x-session-feedback />
</div>

<!-- ================ category section start ================= -->
<section class="section-margin--small mb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        <li class="common-filter">
                            <form action="#">
                                <ul>
                                    <li class="filter-list">
                                        <a class="text-dark" href="{{ route('shop.index') }}">All</a>
                                    </li>
                                    @forelse($_Categories_ as $category)
                                    <li class="filter-list">
                                        <a class="{{ request()->category === $category->slug ? 'text-primary border d-block pl-2' : 'text-dark' }}" href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                    @empty
                                    <p class="text-center">No Categories...</p>
                                    @endforelse
                                </ul>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-filter">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
                                        Leather<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
                                        with red<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="form-group px-4">
                            <input type="range" class="form-control-range" id="formControlRange">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto btn-group">
                        <a href="{{ route('shop.index', ['sort' => 'low']) }}" class="btn btn-primary btn-sm text-white">Low to High</a>
                        <a href="{{ route('shop.index', ['sort' => 'high']) }}" class="btn btn-primary btn-sm text-white">High to Low</a>
                    </div>
                    <div>
                        <div class="input-group filter-bar-search">
                            <input type="text" placeholder="Search">
                            <div class="input-group-append">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @forelse($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <x-product.single-product :product="$product" />
                        </div>
                        @empty
                        <div class="col-md-12">
                            <x-empty-icon title="No Products Found..." />
                        </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                </section>
                <!-- End Best Seller -->
            </div>
        </div>
    </div>
</section>
<!-- ================ category section end ================= -->

@endsection