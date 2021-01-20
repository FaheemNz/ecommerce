@extends('layout')

@section('content')

<main class="container my-4">
    <section class="row">
        <article class="col-md-4">
            <ul>
                <li class="list-item"><a href="{{ route('profile') }}">Profile</a></li>
                <li class="list-item"><a href="{{ route('order.index') }}">Orders</a></li>
            </ul>
        </article>
        <article class="col-md-8">

            <user-profile profile="{{ $user }}" />

        </article>
    </section>
</main>

@endsection