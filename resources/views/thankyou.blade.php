@extends('layout')

@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Your Order has been processed</h1>
                <p class="my-3">An Email was sent... Please check your email</p>
                <a href="{{ url('/') }}" class="button">Go to Home Page</a>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->
@endsection