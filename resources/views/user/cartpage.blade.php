@extends('layouts.user', ['title' => 'Cart - BRIVIBA'])

@section('content')
<section style="flex: 1; padding: 60px 50px; background: #ffffff;">
    <div style="max-width: 800px; margin: 0 auto;">

        <h2 style="font-size: 28px; color: #555; text-align: center; margin-bottom: 40px;">
            Your Cart
        </h2>

        {{-- FORM CHECKOUT --}}
        <form action="{{ route('user.checkout.page') }}" method="GET" id="checkoutForm">
            @csrf

            @foreach ($cart as $c)
            @php
                $stockData = $c->pakaian->stocks->where('size', $c->size)->first();
                $stock = $stockData ? $stockData->stock : 0;
                $price = $stockData ? $stockData->price : 0;
            @endphp

            {{-- CART ITEM BLOCK --}}
            <div style="
                position: relative;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 20px 40px;
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom:20px;
            ">

                {{-- CHECKBOX --}}
                <input type="checkbox"
                    class="cart-check"
                    name="selected_items[]"
                    value="{{ $c->id }}"
                    style="width: 18px; height: 18px; cursor:pointer;">

                {{-- DELETE BUTTON --}}
                <button type="button"
                    onclick="submitDelete({{ $c->id }})"
                    style="position:absolute; top:15px; right:15px; background:none; border:none;">
                    <i class='bx bx-x' style="font-size:24px; color:#666;"></i>
                </button>

                {{-- IMAGE --}}
                <div style="width:80px;height:80px;overflow:hidden;border:1px solid #ddd;border-radius:4px;">
                    <img src="{{ asset($c->pakaian->image) }}" style="width:100%;height:100%;object-fit:cover;">
                </div>

                {{-- NAME + PRICE --}}
                <div style="flex:1;">
                    <h3 style="font-size:16px;margin-bottom:8px;">{{ $c->pakaian->name }} ({{ $c->size }})</h3>
                    <p style="font-size:14px;color:#666;">Rp {{ number_format($price,0,',','.') }}</p>
                </div>

                {{-- QTY BUTTON --}}
                <div style="display:flex; flex-direction:column; align-items:flex-end;">
                    <label style="font-size:12px;color:#666;margin-bottom:5px;">Stock: {{ $stock }}</label>

                    <div style="display:flex;border:1px solid #ddd;border-radius:4px;overflow:hidden;">
                        <button type="button" onclick="submitQty({{ $c->id }}, 'minus')"
                            style="padding:8px 12px;border:none;background:#fff;cursor:pointer;">-</button>

                        <input type="number" value="{{ $c->quantity }}" min="1" max="{{ $stock }}"
                            id="qty-input-{{ $c->id }}"
                            style="width:50px;text-align:center;border:none;">

                        <button type="button" onclick="submitQty({{ $c->id }}, 'plus')"
                            style="padding:8px 12px;border:none;background:#fff;cursor:pointer;">+</button>
                    </div>
                </div>

            </div>

            @endforeach

            {{-- BOTTOM CHECKOUT BUTTON --}}
            @if(!$cart->isEmpty())
            <div style="text-align:center; padding:20px; border-top:1px solid #ddd;">

                <p style="font-size:16px;margin-bottom:10px;">
                    Selected Items: <span id="selectedCount">0</span>
                </p>

                <button type="submit"
                    id="checkoutBtn"
                    disabled
                    style="padding:15px 40px;background:#ccc;color:#fff;border:none;border-radius:4px;cursor:not-allowed;">
                    Checkout
                </button>

            </div>
            @endif

        </form>

        {{-- EMPTY CART --}}
        @if($cart->isEmpty())
            <p style="text-align:center;color:#666;margin-top:30px;">
                Your cart is empty.
            </p>
        @endif

    </div>
</section>

{{-- DELETE FORMS (DI LUAR checkoutForm) --}}
@foreach($cart as $c)
<form action="{{ route('user.cart.delete', $c->id) }}" method="POST" id="delete-form-{{ $c->id }}">
    @csrf
    @method('DELETE')
</form>

<form action="{{ route('user.cart.update', $c->id) }}" method="POST" id="qty-form-{{ $c->id }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="quantity" id="qty-hidden-{{ $c->id }}">
    <input type="hidden" name="action" id="action-{{ $c->id }}">
</form>
@endforeach

{{-- JS — Checkbox counter --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const checkboxes = document.querySelectorAll(".cart-check");
    const selectedCount = document.getElementById("selectedCount");
    const checkoutBtn = document.getElementById("checkoutBtn");

    function updateCount() {
        let count = document.querySelectorAll(".cart-check:checked").length;
        selectedCount.textContent = count;

        if (count > 0) {
            checkoutBtn.disabled = false;
            checkoutBtn.style.background = "#1e3a8a";
            checkoutBtn.style.cursor = "pointer";
        } else {
            checkoutBtn.disabled = true;
            checkoutBtn.style.background = "#ccc";
            checkoutBtn.style.cursor = "not-allowed";
        }
    }

    checkboxes.forEach(cb => cb.addEventListener("change", updateCount));
});
</script>

{{-- JS — DELETE --}}
<script>
function submitDelete(id) {
    if (confirm("Remove this item?")) {
        document.getElementById("delete-form-" + id).submit();
    }
}
</script>

{{-- JS — QTY UPDATE --}}
<script>
function submitQty(id, action) {
    let qty = document.getElementById("qty-input-" + id).value;

    document.getElementById("qty-hidden-" + id).value = qty;
    document.getElementById("action-" + id).value = action;

    document.getElementById("qty-form-" + id).submit();
}
</script>

@endsection
