@extends('layouts.user', ['title'=>'Itempage - BRIVIBA'])

@section('content')

@php
    $stocks = $item->stocks->keyBy('size'); // agar mudah diakses
@endphp
@php
    $images = [
        $item->image,                                             // utama (sudah full URL)
        $item->image_collar ? asset('storage/'.$item->image_collar) : $item->image,
        $item->image_material ? asset('storage/'.$item->image_material) : $item->image,
        $item->image_back ? asset('storage/'.$item->image_back) : $item->image,
    ];
@endphp

<!-- BREADCRUMB -->
@section('breadcrumb')
<div style="
    width: 100%;
    padding: 12px 50px;
    font-size: 12px;
    color: #666;
    background: #f9f9f9;
    border-bottom: 1px solid #e5e5e5;
    display: flex;
    align-items: center;
    gap: 6px;
    position: sticky;
    top: 80px; 
    z-index: 99;
">
    <a href="{{ route('user.homepage') }}" style="color: #666; text-decoration:none;">Collection</a>
    <span>/</span>
    <span style="color: #333; font-weight: 500;">{{ $item->name }}</span>
</div>
@endsection




<section style="flex: 1; padding: 60px 50px;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 60px;">

        
        {{-- LEFT (IMAGE GRID) --}}
        
        <div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
            @foreach ($images as $img)
                <div style="width: 100%; aspect-ratio: 1; border: 1px solid #ddd; border-radius: 4px; overflow:hidden; background:#f5f5f5;">
                    <img src="{{ $img }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
            @endforeach
        </div>

        </div>

        
        {{-- RIGHT (INFO) --}}
        
        <div style="display: flex; flex-direction: column;">

            {{-- NAME --}}
            <h1 style="font-size: 22px; color: #333; margin-bottom: 20px; font-weight: 600;">
                {{ $item->name }}
            </h1>

            {{-- PRICE --}}
            <p id="priceLabel" style="font-size: 20px; color: #333; margin-bottom: 25px; font-weight: 600;">
                IDR {{ number_format($item->stocks->first()->price, 0, ',', '.') }}
            </p>

            <div style="height: 1px; background: #e5e5e5; margin: 25px 0;"></div>

            {{-- SIZE SELECTOR --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 14px; color: #333; margin-bottom: 15px;">Size:</label>
                @php
                    $allSizes = ['S', 'M', 'L', 'XL', 'XXL'];
                @endphp

                <div style="display: flex; gap: 10px;">
                    @foreach ($allSizes as $sz)
                        @php
                            $data = $stocks->get($sz); // ambil jika ada
                            $available = !is_null($data);
                        @endphp

                        <button class="size-btn"
                                data-size="{{ $sz }}"
                                data-price="{{ $available ? $data->price : 0 }}"
                                data-stock="{{ $available ? $data->stock : 0 }}"
                                style="
                                    padding: 10px 20px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    cursor:pointer;
                                    opacity: {{ $available ? '1' : '0.4' }};
                                    background: {{ $available ? '#fff' : '#f3f3f3' }};
                                ">
                            {{ $sz }}
                        </button>
                    @endforeach
                </div>

            </div>

            {{-- STOCK LABEL --}}
            <p id="stockLabel" style="font-size: 14px; color: #22c55e; margin-bottom: 25px;">
                In Stock: {{ $item->stocks->first()->stock }}
            </p>

            {{-- QUANTITY SELECTOR --}}
            <div style="margin-bottom: 20px;">
                <label style="font-size: 14px; color: #333; margin-bottom: 10px; display:block;">
                    Quantity:
                </label>

                <div style="display: flex; align-items: center; border: 1px solid #ddd; width: 110px; border-radius: 4px;">
                    <button type="button" id="qtyMinus"
                        style="padding: 8px 12px; border: none; background:#fff; cursor:pointer;">-</button>

                    <input type="number" id="qtyInput" name="quantity" value="1" min="1"
                        style="width:60px; text-align:center; border:none;">

                    <button type="button" id="qtyPlus"
                        style="padding: 8px 0px; border: none; background:#fff; cursor:pointer;">+</button>
                </div>
            </div>


            {{-- ADD TO CART --}}
            <form action="{{ route('user.cart.add', $item->slug) }}" method="POST" id="cartForm">
                @csrf
                <input type="hidden" name="size" id="selectedSize">
                <input type="hidden" name="quantity" id="qtyInputHidden">

                <button type="submit"
                    style="width: 100%; padding: 15px; background: #1e3a8a; color: #fff;
                        border-radius: 4px; font-size: 16px;">
                    Add to Cart
                </button>
            </form>


            <div style="height: 1px; background: #e5e5e5; margin: 25px 0;"></div>

            {{-- DESCRIPTION --}}
            <div>
                <button class="accordion-header" style="width: 100%; padding: 15px 0; border:none; background:none; font-size:14px; display:flex; justify-content:space-between; cursor:pointer;">
                    Description
                    <i class="bx bx-plus" style="font-size: 20px;"></i>
                </button>

                <div class="accordion-content" style="max-height: 0; overflow: hidden; transition: 0.3s;">
                    <p style="padding: 15px 0; font-size: 14px; color: #666; line-height: 1.6;">
                        {{ $item->description ?? 'No description available.' }}
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- JAVASCRIPT --}}

<script>
document.addEventListener('DOMContentLoaded', function() {

    let sizeButtons = document.querySelectorAll('.size-btn');
    let priceLabel  = document.getElementById('priceLabel');
    let stockLabel  = document.getElementById('stockLabel');
    let selectedSizeInput = document.getElementById('selectedSize');
    let qtyInput = document.getElementById('qtyInput');
    let qtyMinus = document.getElementById('qtyMinus');
    let qtyPlus = document.getElementById('qtyPlus');
    let currentStock = {{ $item->stocks->first()->stock }}; // default sebelum pilih size

    // Update stok ketika pilih size
    sizeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            currentStock = parseInt(this.dataset.stock);
            qtyInput.value = 1;
        });
    });

    // Tombol -
    qtyMinus.addEventListener('click', function() {
        let val = parseInt(qtyInput.value);
        if (val > 1) qtyInput.value = val - 1;
    });

    // Tombol +
    qtyPlus.addEventListener('click', function() {
        let val = parseInt(qtyInput.value);
        if (val < currentStock) qtyInput.value = val + 1;
    });

    // Prevent over-typing
    qtyInput.addEventListener('input', function() {
        if (qtyInput.value < 1) qtyInput.value = 1;
        if (qtyInput.value > currentStock) qtyInput.value = currentStock;
    });

    sizeButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        selectedSizeInput.value = this.dataset.size;
        });
    });
    document.getElementById('cartForm').addEventListener('submit', function(e) {
        if (!selectedSizeInput.value) {
            alert('Please select size first');
            e.preventDefault();
        }
    });
    document.getElementById('cartForm').addEventListener('submit', function() {
    document.getElementById('qtyInputHidden').value = qtyInput.value;
    });


    sizeButtons.forEach(btn => {
        btn.addEventListener('click', function() {

            // Reset warna semua size
            sizeButtons.forEach(b => b.style.background = "#fff");

            // Warna tombol aktif
            this.style.background = "#ddd";

            let price = this.dataset.price;
            let stock = this.dataset.stock;

            // Update harga
            priceLabel.innerHTML = "IDR " + Number(price).toLocaleString('id-ID');

            // Update stock label
            if (stock == 0) {
                stockLabel.style.color = "red";
                stockLabel.innerHTML = "Out of Stock";
            } else {
                stockLabel.style.color = "#22c55e";
                stockLabel.innerHTML = "In Stock: " + stock;
            }
        });
    });

    // ACCORDION
    const accHeader = document.querySelector(".accordion-header");
    const accContent = document.querySelector(".accordion-content");
    const icon = accHeader.querySelector("i");

    accHeader.addEventListener("click", () => {
        if (accContent.style.maxHeight && accContent.style.maxHeight !== "0px") {
            accContent.style.maxHeight = "0";
            icon.classList.replace("bx-minus", "bx-plus");
        } else {
            accContent.style.maxHeight = accContent.scrollHeight + "px";
            icon.classList.replace("bx-plus", "bx-minus");
        }
    });
});
</script>


@endsection
