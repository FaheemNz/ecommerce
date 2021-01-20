@extends('layout')

@section('content')

<div class="container py-5">
    <x-session-feedback />

    @if (Cart::count() > 0)
    <!--================Cart Area =================-->
    <div class="cart_inner">
        <h3><i class="fa fa-shopping-cart"></i> <span id="cart-qty-count">{{ Cart::count() }}</span> Cart Item(s)</h3>
        <div class="table-responsive table-bordered">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
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
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->options['totalQty'] }}">
                                    @for ($i = 1; $i < 5 + 1 ; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('saveForLater.store', $item->rowId) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">Save to Later</button>
                            </form>
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove Item</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if( ! session()->has('coupon') )
    <div class="row justify-content-end">
        <form class="col-md-5" action="{{ route('coupon.store') }}" method="POST">
            @csrf
            <div class="form-group col-md-12 my-3">
                <label for="">Have a Coupon?</label>
                <div class="input-group">
                    <input id="coupon_code" name="coupon_code" type="text" required class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
    <div class="mt-4 pr-2">
        <div class="d-flex flex-column align-items-end">
            <div class="d-flex align-items-center mb-2">
                <h6 class="mr-3">Shipping</h6>
                <h6 style="min-width: 100px; text-align: right">Free</h6>
            </div>
            @if( session()->has('coupon') )
            <div class="d-flex align-items-center mb-2">
                <div class="d-flex">
                    <form action="{{ route('coupon.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn mr-2 btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    <h6 class="mr-3">Discount ({{ session()->get('coupon')['name'] }})</h6>
                </div>
                <h6 style="min-width: 100px; text-align: right">-{{ presentPrice(session()->get('coupon')['discount']) }}</h6>
            </div>
            @endif
            <div class="d-flex align-items-center mb-2">
                <h6 class="mr-3">Tax (%)</h6>
                <h6 style="min-width: 100px; text-align: right">{{ config('cart.tax') }}%</h6>
            </div>
            <div class="d-flex align-items-center mb-2">
                <h6 class="mr-3">Tax Price</h6>
                <h6 id="cart-tax" style="min-width: 100px; text-align: right">{{ presentPrice( Cart::tax() ) }}</h6>
            </div>
            <div class="d-flex align-items-center mb-2">
                <h6 class="mr-3">Subtotal</h6>
                <h6 id="cart-subtotal" style="min-width: 100px; text-align: right">{{ presentPrice( Cart::subtotal() ) }}</h6>
            </div>
            <div class="d-flex align-items-center">
                <h6 class="mr-3">Total</h6>
                <h6 id="cart-total" style="min-width: 100px; text-align: right">{{ presentPrice( Cart::total() ) }}</h6>
            </div>
            
            <div class="d-flex mt-4 align-items-center">
                <div>
                    <a href="{{ route('shop.index') }}" class="button mr-3">Continue Shopping</a>
                </div>
                <div>
                    <a href="{{ route('checkout.index') }}" class="button">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!--================End Cart Area =================-->
    @else
    <div class="text-center">
        <div>
            <i class="fa empty-state-icon mb-4 fa-hourglass"></i>
        </div>
        <h3>No items in Cart!</h3>
        <a href="{{ route('shop.index') }}" class="button mt-3">Go Shopping</a>
    </div>
    @endif
    
    <!-- ================= Save For Later ============= -->
    @if( Cart::instance('saveForLater')->count() > 0 )
    <div class="cart_inner">
        <h3 class="mt-5"><i class="fa fa-check"></i> Saved for Later</h3>
        <div class="table-responsive table-bordered">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $item)
                    <tr>
                        <td>
                            <a href="{{ route('shop.show', $item->options['slug']) }}" class="media d-flex align-items-center text-dark">
                                <div class="d-flex">
                                    <img class="cart-image" src="{{ $item->options['image'] }}" alt="">
                                </div>
                                <div class="media-body ml-4">
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
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->options['totalQty'] }}">
                                    @for ($i = 1; $i < 5 + 1 ; $i++) 
                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('saveForLater.update', $item->rowId) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-info">Back to Cart</button>
                            </form>
                            <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove Item</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <h6 class="container text-center mt-5">You have no items saved for later...</h6>
    @endif
</div>
    
@include('partials.might-like')

@endsection

@section('extra-js')
<script>
    (function() {
        [...document.querySelectorAll('.quantity')]
        .forEach(cartItemSelect => {
            cartItemSelect.addEventListener('change', onQuantityUpdate);
        });

        function onQuantityUpdate() {
            const id = this.dataset.id,
                data = {
                    quantity: this.value,
                    totalQuantity: this.getAttribute('data-productQuantity')
                };

            axios.put(`/cart/${id}`, data)
                .then(response => response.status === 202 && updateCartUI(response.data))
                .catch(error => flash('Product cant be updated! Check in stock status.', 'alert-warning'));
        }

        function updateCartUI(responseData) {
            let doc = document;

            doc.getElementById('cart-qty-count').innerHTML = responseData.qty;
            doc.getElementById('cart-total').innerHTML = responseData.total;
            doc.getElementById('cart-subtotal').innerHTML = responseData.subtotal;
            doc.getElementById('cart-tax').innerHTML = responseData.tax;
            doc.getElementById('cart-nav-items-count').innerHTML = responseData.qty;
            
            flash('Product quantity updated...', 'alert-primary');
        }
    })();
</script>
@endsection