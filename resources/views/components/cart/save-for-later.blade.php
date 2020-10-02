@if (Cart::instance('saveForLater')->count() > 0)

<h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>

<div class="saved-for-later cart-table">
    @foreach (Cart::instance('saveForLater')->content() as $item)
    
    @endforeach

</div> <!-- end saved-for-later -->

@else

<h3>You have no items Saved for Later.</h3>

@endif