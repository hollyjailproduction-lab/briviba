@extends('layouts.user', ['title'=>'Homepage - BRIVIBA'])

@section('content')
<section class="homepage-banner"style="
    position: relative;
    height: 500px;
    background: 
        linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
        url('{{ asset('storage/banner.jpg') }}');
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #fff;
">
    <h1 style="font-size: 48px; font-weight: 300; letter-spacing: 4px; margin: 0 0 10px 0;">
        briviba
    </h1>

    <a href="{{ route('user.collection') }}"
        style="
            padding: 15px 40px;
            background: #1e3a8a;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 40px;
            text-decoration: none;
        ">
        View Collection
    </a>
</section>


</section>

<!-- Collections -->
<section style="padding: 80px 50px; text-align: center;">
    <h2 style="font-size: 32px; color: #333; margin-bottom: 10px;">Shirt Collections</h2>
    <p style="color: #666; font-size: 14px; margin-bottom: 50px;">ini adalah deskripsi bagian ini</p>

    <div style="
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 40px;
        max-width: 1200px;
        margin: auto;
    ">
        @foreach ($pakaians as $p)
            <div style="text-align: left; cursor:pointer;">
                <a href="{{ route('user.item', $p->slug) }}" style="text-decoration:none; color:inherit;">

                    <div style="
                        width: 100%;
                        aspect-ratio: 1;
                        background: #f5f5f5;
                        border: 1px solid #ddd;
                        margin-bottom: 20px;
                        border-radius: 4px;
                        overflow:hidden;
                    ">
                        <img src="{{ asset($p->image) }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>

                    <h3 style="font-size: 14px; color: #333; margin-bottom: 10px; font-weight: bold;">
                        {{ $p->name }}
                    </h3>

                    <p style="font-size: 14px; color: #666; margin: 0;">
                        Rp. {{ number_format($p->stocks->min('price'), 0, ',', '.') }}
                    </p>

                </a>
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div style="display:flex; justify-content:center; margin-top:40px;">
        {{ $pakaians->onEachSide(1)->links('pagination::simple-default') }}
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
