@extends('layouts.user', ['title'=>'Homepage - BRIVIBA'])

@section('content')
 <section style="position: relative; height: 500px; background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), #666; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: #fff;">
        <div>
            <h1 style="font-size: 48px; font-weight: 300; letter-spacing: 4px; margin-bottom: 10px; margin: 0 0 10px 0;">Ini adalah banner</h1>
        </div>
        <button style="padding: 15px 40px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; transition: background 0.3s; position: relative; top: 140px;">View Collection</button>
    </section>

    <!-- Collections-->
    <section style="padding: 80px 50px; text-align: center;">
        <h2 style="font-size: 32px; color: #333; margin-bottom: 10px; margin: 0 0 10px 0;">Shirt Collections</h2>
        <p style="color: #666; font-size: 14px; margin-bottom: 50px; margin: 0 0 50px 0;">ini adalah deskripsi bagian ini bagian ini</p>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; margin-bottom: 50px; max-width: 1200px; margin-left: auto; margin-right: auto;">
            <!-- Product 1 -->
            <div style="text-align: left;">
                <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; margin-bottom: 20px; border-radius: 4px; transition: transform 0.3s;">
                    <!-- Image placeholder -->
                </div>
                <h3 style="font-size: 14px; color: #333; margin-bottom: 10px; line-height: 1.5; margin: 0 0 10px 0; font-weight: bold;">Item #1 Collab w/ Travis Scott Burger Limited Edition 2067</h3>
                <p style="font-size: 14px; color: #666; margin: 0;">Rp. 1000</p>
            </div>

            <!-- Product 2 -->
            <div style="text-align: left;">
                <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; margin-bottom: 20px; border-radius: 4px; transition: transform 0.3s;">
                </div>
                <h3 style="font-size: 14px; color: #333; margin-bottom: 10px; line-height: 1.5; margin: 0 0 10px 0; font-weight: bold;">Gray AstroCone X NASA T-Shirt</h3>
                <p style="font-size: 14px; color: #666; margin: 0;">Rp. 1000</p>
            </div>

            <!-- Product 3 -->
            <div style="text-align: left;">
                <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; margin-bottom: 20px; border-radius: 4px; transition: transform 0.3s;">
                </div>
                <h3 style="font-size: 14px; color: #333; margin-bottom: 10px; line-height: 1.5; margin: 0 0 10px 0; font-weight: bold;">Limited Edition Rona Merah Langit T-Shirt (White)</h3>
                <p style="font-size: 14px; color: #666; margin: 0;">Rp. 1000</p>
            </div>
        </div>

        <button style="padding: 15px 40px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; transition: background 0.3s;">View All</button>
    </section>
@endsection