@extends('layout')

@section('content')

<x-breadcrumbs title="Checkout" link2="Checkout" />

<div class="container">

    <x-session-feedback />

    <!--================Checkout Area =================-->
    <section class="checkout_area section-margin--small">
        <div class="container">
            <div class="billing_details shadow p-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Address</h3>
                        <form class="row contact_form" action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="email">Email Address</label>
                                @if (auth()->user())
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                @else
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="NameA" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="AddressA" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="CityA" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province" value="ProvinceA" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode" value="42000" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="03001231231" required>
                            </div>
                            <div class="form-group col-md-12">
                                <h4><i class="fa fa-money"></i> Payment</h4>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="name_on_card">Name on Card</label>
                                <input type="text" class="form-control" id="name_on_card" value="Sauban Munir" name="name_on_card" value="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="form-group mt-4 text-right col-md-12">
                                <button type="submit" id="complete-order" class="button">Complete Order</button>
                            </div>
                        </form>

                        <br />

                        <h4><i class="fa fa-shopping-cart"></i> Your Order</h4>
                        <div class="cart_inner border">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Cart::content() as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('shop.show', $item->options['slug']) }}" class="media text-dark">
                                                    <div class="d-flex">
                                                        <img class="cart-image" src="{{ $item->options['image'] }}" alt="">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="font-weight-bold">{{ $item->name }}</div>
                                                        <p>{{ $item->options['details'] }}</p>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <h5>{{ presentPrice($item->price) }}</h5>
                                            </td>
                                            <td>
                                                <div class="product_count">
                                                    {{ $item->qty }}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
</div>
@endsection

@section('extra-js')

<script src="https://js.stripe.com/v3/"></script>
<script>
    (function() {
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51HVHIhFPntJqCTcykSNqz67meGfx3VPECxD7X2Rl0niJcYShDnvdKPNFbzH5XcPjuZykASUZsdM35yspZqdiPImp00JB9IFd85');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        let submitButton = document.getElementById('complete-order');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            
            console.log('hey');
            
            submitButton.disabled = true;
            
            let stripeOptions = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
            };

            stripe.createToken(card, stripeOptions).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    submitButton.disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            let form = document.getElementById('payment-form');
            let hiddenInput = document.createElement('input');

            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);

            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    })();
</script>
@endsection