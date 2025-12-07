@extends('layouts.user', ['title' => 'Checkout - BRIVIBA'])

@section('content')

<section style="flex:1; padding:60px 50px; background:#ffffff;">
    <div style="max-width:1200px; margin:0 auto; display:flex; gap:40px;">

        
        {{-- LEFT: ITEMS + PAYMENT --}}
        
        <div style="flex:2;">

            <h2 style="font-size:28px; color:#555; margin-bottom:30px;">
                Checkout
            </h2>

            {{--  INFORMASI PESANAN  --}}
            @php $grandTotal = 0; @endphp

            @foreach($items as $c)
            @php
                $stock = $c->pakaian->stocks->where('size', $c->size)->first();
                $price = $stock->price * $c->quantity;
                $grandTotal += $price;
            @endphp

            <div style="
                background:#fff; border:1px solid #ddd; border-radius:4px;
                padding:20px; margin-bottom:20px; display:flex; gap:20px;
            ">

                <div style="width:80px; height:80px; border:1px solid #ddd; border-radius:4px; overflow:hidden;">
                    <img src="{{ asset($c->pakaian->image) }}" style="width:100%; height:100%; object-fit:cover;">
                </div>

                <div style="flex:1;">
                    <h3 style="font-size:16px; font-weight:600; margin-bottom:5px;">
                        {{ $c->pakaian->name }} ({{ $c->size }})
                    </h3>
                    <p style="font-size:14px; color:#666;">Qty: {{ $c->quantity }}</p>
                    <p style="font-size:14px; color:#333; margin-top:6px;">
                        Rp {{ number_format($price, 0, ',', '.') }}
                    </p>
                </div>

            </div>
            @endforeach

            {{-- METODE PEMBAYARAN --}}
            <h3 style="font-size:20px; color:#333; margin:30px 0 10px;">Metode Pembayaran</h3>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:15px;">

                @php
                    $methods = [
                        'GOPAY' => 'Gopay',
                        'DANA' => 'Dana',
                        'OVO' => 'OVO',
                        'QRIS' => 'QRIS'
                    ];
                @endphp

                @foreach($methods as $key => $text)
                <div 
                    class="pay-option"
                    data-method="{{ $key }}"
                    style="
                        padding:15px; border:1px solid #ddd; border-radius:6px;
                        background:#fff; cursor:pointer; text-align:center;
                        transition:.2s;
                    ">
                    <strong>{{ $text }}</strong>
                </div>
                @endforeach

            </div>

            {{-- INPUT HIDDEN UNTUK FORM --}}
            <form id="checkoutFinalForm" action="{{ route('user.checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="method" id="methodInput">

                {{-- Kirim ulang semua selected cart item --}}
                @foreach($items as $i)
                    <input type="hidden" name="selected_items[]" value="{{ $i->id }}">
                @endforeach

            </form>




        </div>

        
        {{-- RIGHT: PAYMENT SUMMARY --}}
        
        <div style="
            flex:1; background:#fff; padding:25px; border:1px solid #ddd;
            border-radius:8px; height:max-content;
        ">
            <h3 style="font-size:18px; margin-bottom:20px;">Detail Pembayaran</h3>

            <div style="margin-bottom:15px; font-size:14px; color:#333;">
                Metode Pembayaran: <span id="methodLabel" style="font-weight:600;">-</span>
            </div>

            <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                <span>Total Pesanan</span>
                <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                <span>Biaya Admin</span>
                <span>Rp 1.000</span>
            </div>

            {{-- TOTAL --}}
            @php $finalTotal = $grandTotal + 1000; @endphp

            <div style="display:flex; justify-content:space-between; margin-top:20px; font-size:18px; font-weight:700;">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($finalTotal, 0, ',', '.') }}</span>
            </div>

            <button onclick="submitCheckout()"
                style="
                    margin-top:25px; width:100%; padding:15px; background:#1e3a8a;
                    color:white; border:none; border-radius:5px; font-size:16px;
                ">
                Bayar
            </button>

        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('.pay-option');
    const methodInput = document.getElementById('methodInput');
    const methodLabel = document.getElementById('methodLabel');

    options.forEach(opt => {
        opt.addEventListener('click', () => {

            // reset warna semua
            options.forEach(o => o.style.border = "1px solid #ddd");
            options.forEach(o => o.style.background = "#fff");

            // highlight pilihan
            opt.style.border = "2px solid #1e3a8a";
            opt.style.background = "#EEF3FF";

            // update text di kanan
            methodLabel.textContent = opt.dataset.method;

            // update hidden input
            methodInput.value = opt.dataset.method;
        });
    });
});

function submitCheckout() {
    if (document.getElementById('methodInput').value === "") {
        alert("Pilih metode pembayaran terlebih dahulu!");
        return;
    }
    document.getElementById('checkoutFinalForm').submit();
}
</script>

@endsection
