@extends('layouts.user', ['title'=>'Profile - BRIVIBA'])

@section('content')
<section style="flex: 1; padding: 80px 50px; background: #fafafa;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h1 style="font-size: 32px; color: #555; margin-bottom: 15px; font-weight: 600; margin: 0 0 15px 0;">Your Account</h1>
            <p style="color: #666; font-size: 15px; margin-bottom: 50px; margin: 0 0 50px 0;">View all your orders and manage your account information.</p>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px;">
                <div style="background: #fff; padding: 0; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 16px; color: #333; font-weight: 600; padding: 25px 30px 20px 30px; margin: 0;">Orders</h3>
                    <div style="height: 1px; background: #e5e5e5; margin: 0;"></div>
                    <p style="color: #666; font-size: 14px; padding: 25px 30px; line-height: 1.5; margin: 0;">You haven't placed any orders yet.</p>
                    <button style="padding: 12px 35px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; transition: background 0.3s; margin: 0 30px 30px 30px;">Continue Shopping</button>
                </div>

                <div style="background: #fff; padding: 0; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 16px; color: #333; font-weight: 600; padding: 25px 30px 20px 30px; margin: 0;">Primary address</h3>
                    <div style="height: 1px; background: #e5e5e5; margin: 0;"></div>
                    <p style="color: #666; font-size: 14px; padding: 25px 30px; line-height: 1.5; margin: 0;">You haven't saved any addresses yet.</p>
                    <button style="padding: 12px 35px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; transition: background 0.3s; margin: 0 30px 30px 30px;">Manage</button>
                </div>
            </div>
        </div>
    </section>
@endsection