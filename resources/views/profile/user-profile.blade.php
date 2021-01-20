@extends('layout')

@section('content')

<main class="container my-5">
    <section class="row">
        <article class="col-md-4">
            @include('profile.partials.sidebar')
        </article>
        <article class="col-md-8">

            <div class="shadow p-4">
                <h3>Your Profile</h3>
                <hr class="mb-4" />
                <user-profile profile="{{ $user }}" />
            </div>


        </article>
    </section>
</main>

@endsection