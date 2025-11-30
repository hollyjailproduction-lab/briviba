@extends('layouts.user', ['title'=>'Itempage - BRIVIBA'])

@section('content')
 <div style="padding: 15px 50px; font-size: 12px; color: #666; background: #fafafa; border-bottom: 1px solid #eee;">
        <a href="#" style="color: #666; text-decoration: none; transition: color 0.3s;">HOME</a> / <a href="#" style="color: #666; text-decoration: none; transition: color 0.3s;">BEST SELLER</a> / <span style="color: #333;">Item #1 Collab w/ Travis Scott Burger Limited Edition 2067</span>
    </div>

    <section style="flex: 1; padding: 60px 50px;">
        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 60px;">
            <div style="width: 100%;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                    <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
                        <!-- engko isi gambar-->
                    </div>
                    <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
                        <!-- gambar2-->
                    </div>
                    <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
                        <!-- gambar3 -->
                    </div>
                    <div style="width: 100%; aspect-ratio: 1; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
                        <!-- gambar4 -->
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column;">
                <h1 style="font-size: 22px; color: #333; margin-bottom: 20px; line-height: 1.4; font-weight: 600; margin: 0 0 20px 0;">Item #1 Collab w/ Travis Scott Burger Limited Edition 2067</h1>
                <p style="font-size: 20px; color: #333; margin-bottom: 25px; font-weight: 600; margin: 0 0 25px 0;">IDR 378,811,990.00</p>
                
                <div style="height: 1px; background: #e5e5e5; margin: 25px 0;"></div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 14px; color: #333; margin-bottom: 15px; font-weight: 500;">Size:</label>
                    <div style="display: flex; gap: 10px;">
                        <button class="size-btn" style="padding: 10px 20px; background: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; cursor: pointer; transition: all 0.3s;">S</button>
                        <button class="size-btn" style="padding: 10px 20px; background: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; cursor: pointer; transition: all 0.3s;">M</button>
                        <button class="size-btn" style="padding: 10px 20px; background: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; cursor: pointer; transition: all 0.3s;">L</button>
                        <button class="size-btn" style="padding: 10px 20px; background: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; cursor: pointer; transition: all 0.3s;">XL</button>
                        <button class="size-btn" style="padding: 10px 20px; background: #fff; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; cursor: pointer; transition: all 0.3s;">XXL</button>
                    </div>
                </div>

                <p style="font-size: 14px; color: #22c55e; margin-bottom: 25px; margin: 0 0 25px 0;">In Stock</p>

                <button style="width: 100%; padding: 15px; background: #1e3a8a; color: #fff; border: none; border-radius: 4px; font-size: 16px; font-weight: 500; cursor: pointer; transition: background 0.3s;">Add to Cart</button>

                <div style="height: 1px; background: #e5e5e5; margin: 25px 0;"></div>

                <div style="margin-top: 25px;">
                    <button class="accordion-header" style="width: 100%; padding: 15px 0; background: none; border: none; font-size: 14px; color: #333; cursor: pointer; display: flex; justify-content: space-between; align-items: center; text-align: left; transition: color 0.3s;">
                        Description
                        <i class='bx bx-plus' style="font-size: 20px; transition: transform 0.3s;"></i>
                    </button>
                    <div class="accordion-content" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        <p style="padding: 15px 0; font-size: 14px; color: #666; line-height: 1.6; margin: 0;">ciluk baaaaaa :pAAAAAAA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection