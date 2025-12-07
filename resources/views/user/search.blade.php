@extends('layouts.user', ['title' => 'Search'])

@section('content')
<section style="padding: 50px 50px; text-align:center;">

    <h2 style="font-size: 28px; margin-bottom: 10px; text-align:center;">
        Search
    </h2>

    <p style="color:#666; margin-bottom:30px; text-align:center;">
        {{ $results->count() }} results for "<b>{{ $query }}</b>"
    </p>

    <div style="
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
        max-width: 1200px;
        margin: auto;
    ">
        @foreach ($results as $p)
        <a href="{{ route('user.item', $p->slug) }}" style="text-decoration:none; color:inherit;">
            <div style="text-align:left;">

                <div style="
                    width:100%; aspect-ratio:1;
                    border:1px solid #ddd; border-radius:4px;
                    overflow:hidden; margin-bottom:20px;">
                    <img src="{{ asset($p->image) }}" style="width:100%; height:100%; object-fit:cover;">
                </div>

                <h3 style="font-size:14px; font-weight:bold; margin-bottom:10px;">
                    {{ $p->name }}
                </h3>

                <p style="font-size:14px; color:#666;">
                    Rp {{ number_format($p->stocks->min('price'), 0, ',', '.') }}
                </p>

            </div>
        </a>
        @endforeach
    </div>

</section>
@endsection
