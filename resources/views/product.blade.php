@extends('layout')

@section('title', $product->name)

@section('content')

<x-breadcrumbs link1="{{ route('shop.index') }}|Shop" link2="{{ $product->name }}" />

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <x-session-feedback />
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="product-image">
                    <img class="img-responsive img-fluid" src="{{ $product->image }}" alt="" />
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2>{{ $product->formatted_price }}</h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Category</span> : Household</a></li>
                        <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                    </ul>
                    <p>{{ $product->details }}</p>
                    <add-to-cart text="Add to Cart" :id="{{ $product->id }}" />
                    <div class="card_area d-flex align-items-center">
                        <a class="icon_btn" href="#"><i class="fa fa-diamond"></i></a>
                        <a class="icon_btn" href="#"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
@include('partials.product-review')
<!--================End Product Description Area =================-->

@include('partials.might-like')

@endsection