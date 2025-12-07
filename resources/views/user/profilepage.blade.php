@extends('layouts.user', ['title'=>'Profile - BRIVIBA'])

@section('content')
<section style="flex: 1; padding: 80px 50px; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">

        {{-- TITLE --}}
        <h1 style="font-size: 32px; color: #555; margin-bottom: 15px; font-weight: 600;">
            Your Account
        </h1>
        <p style="color: #666; font-size: 15px; margin-bottom: 50px;">
            View all your orders and manage your account information.
        </p>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px;">

            {{-- ========================== --}}
            {{--   ORDERS / HISTORY         --}}
            {{-- ========================== --}}
            <div style="background: #fff; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">

                <h3 style="font-size: 16px; padding: 25px 30px 20px 30px; margin:0; font-weight:600; color:#333;">
                    Orders
                </h3>
                <div style="height: 1px; background: #e5e5e5;"></div>

                @if($histories->isEmpty())
                    <p style="color: #666; font-size: 14px; padding: 25px 30px;">
                        You haven't placed any orders yet.
                    </p>

                    <a href="{{ route('user.homepage') }}">
                        <button style="padding: 12px 35px; background: #1e3a8a; color:#fff; border:none; border-radius:4px;
                        margin: 0 30px 30px 30px; cursor:pointer;">
                            Continue Shopping
                        </button>
                    </a>

                @else
                    <div style="padding: 25px 30px;">
                        @foreach($histories as $h)
                            <div style="border-bottom: 1px solid #eee; padding-bottom:15px; margin-bottom:15px;">

                                {{-- ITEM NAME --}}
                                <strong style="font-size: 15px; color:#333;">
                                    {{ $h->stock->pakaian->name }}
                                </strong><br>

                                {{-- SIZE --}}
                                <span style="font-size: 14px; color:#666;">
                                    Size: {{ $h->stock->size }}
                                </span><br>

                                {{-- QTY --}}
                                <span style="font-size: 14px; color:#666;">
                                    Quantity: {{ $h->quantity }}
                                </span><br>

                                {{-- TOTAL --}}
                                <span style="font-size: 14px; font-weight:600; color:#333;">
                                    Total: IDR {{ number_format($h->total_price, 0, ',', '.') }}
                                </span><br>

                                {{-- DATE --}}
                                <small style="font-size: 12px; color:#777;">
                                    {{ $h->created_at->format('d M Y') }}
                                </small>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ========================== --}}
            {{-- PRIMARY ADDRESS            --}}
            {{-- ========================== --}}
            <div style="background: #fff; padding: 0; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 16px; color: #333; font-weight: 600; padding: 25px 30px 20px 30px; margin: 0;">
                    Primary address
                </h3>
                <div style="height: 1px; background: #e5e5e5; margin: 0;"></div>

                @if ($user->address)
                    <p style="color: #666; font-size: 14px; padding: 20px 30px; line-height: 1.5; margin: 0;">
                        {{ $user->address }} <br>
                        <span style="font-size:13px; color:#888;">Phone: {{ $user->phone ?? '-' }}</span>
                    </p>
                @else
                    <p style="color: #666; font-size: 14px; padding: 20px 30px; line-height: 1.5; margin: 0;">
                        You haven't saved any addresses yet.
                    </p>
                @endif

                {{-- ADDRESS UPDATE FORM --}}
                <form action="{{ route('user.address.update') }}" method="POST" style="padding: 20px 30px;">
                    @csrf
                    <label style="font-size: 13px; color: #333;">Address</label>
                    <textarea name="address" style="width: 100%; height: 100px; border:1px solid #ddd; border-radius:4px; padding:10px;">{{ $user->address }}</textarea>

                    <label style="font-size: 13px; color: #333; margin-top: 15px; display:block;">Phone</label>
                    <input name="phone" value="{{ $user->phone }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;">

                    <button type="submit" 
                        style="margin-top: 20px; padding: 12px 35px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">
                        Save
                    </button>
                </form>
            </div>


        </div>
    </div>
</section>
@endsection
