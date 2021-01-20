@extends('layout')

@section('content')

<main class="container my-4">
    <section class="row">
        <article class="col-md-4">
            @include('profile.partials.sidebar')
        </article>
        <article class="col-md-8">

            <div class="shadow p-4">
                <h3>Your Orders</h3>
                <hr class="mb-4" />

                @forelse($userOrders as $order)
                <div class="border mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <span class="font-weight-bold">Order # {{ $order->id }}</span> <span class="font-weight-bold">Total: {{ presentPrice($order->billing_total) }}</span>
                    </div>
                    <div class="card-body d-flex">
                        @foreach($order->products as $product)
                        <div>
                            <div class="font-weight-bold">{{ $product->name }}</div>
                            <img src="{{ asset($product->image) }}" style="height: 100px" alt="" />
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div>No Orders Yet...</div>
                @endforelse

                <div class="mt-4">
                    {{ $userOrders->links() }}
                </div>

            </div>

        </article>
    </section>
</main>

@endsection