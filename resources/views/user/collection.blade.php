@extends('layouts.user', ['title'=>'Collection - BRIVIBA'])

@section('content')
<section style="padding: 80px 50px; text-align: center;">

    <h2 style="font-size: 32px; color: #333; margin-bottom: 10px;">
        All Collections
    </h2>
    <p style="color: #666; font-size: 14px; margin-bottom: 50px;">
        Explore our full catalog of apparel.
    </p>

    <div style="
        display: grid; 
        grid-template-columns: repeat(6, 1fr); 
        gap: 40px; 
        max-width: 1200px; 
        margin-left: auto; 
        margin-right: auto;
    ">

        @foreach ($pakaians as $p)
        <a href="{{ route('user.item', $p->slug) }}" style="text-decoration:none;">
            <div style="text-align: left; cursor:pointer;">

                {{-- IMAGE --}}
                <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; 
                    border: 1px solid #ddd; margin-bottom: 20px; border-radius: 4px; overflow:hidden;">
                    <img src="{{ asset($p->image) }}"
                        style="width:100%; height:100%; object-fit:cover;">
                </div>

                {{-- NAME --}}
                <h3 style="font-size: 14px; color: #333; margin-bottom: 10px; font-weight: bold;">
                    {{ $p->name }}
                </h3>

                {{-- PRICE --}}
                @php $minPrice = $p->stocks->min('price'); @endphp
                <p style="font-size: 14px; color: #666;">
                    Rp. {{ number_format($minPrice, 0, ',', '.') }}
                </p>

            </div>
        </a>
        @endforeach

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener("search-update", (e) => {
    const query = e.detail?.query ?? "";

    document.querySelectorAll(".product-card").forEach(card => {
        const name = card.dataset.name.toLowerCase();

        card.style.display = name.includes(query) ? "block" : "none";
    });
});
</script>
@endpush

