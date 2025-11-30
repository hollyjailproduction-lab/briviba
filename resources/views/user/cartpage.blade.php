@extends('layouts.user', ['title'=>'Cart - BRIVIBA'])

@section('content')
<section style="flex: 1; padding: 60px 50px; background: #fafafa;">
        <div style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 28px; color: #555; text-align: center; margin-bottom: 40px; font-weight: 600; margin: 0 0 40px 0;">Your Cart</h2>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="position: relative; background: #fff; border: 1px solid #ddd; border-radius: 4px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                    <button style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 24px; color: #666; cursor: pointer; transition: color 0.3s; padding: 0; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        <i class='bx bx-x'></i>
                    </button>
                    <div style="width: 80px; height: 80px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; flex-shrink: 0;">
                    </div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 16px; color: #333; margin-bottom: 8px; font-weight: 600; margin: 0 0 8px 0;">H3 Heading Title</h3>
                        <p style="font-size: 14px; color: #666; margin: 0;">Rp. 1000</p>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px; position: relative; top: 15px;">
                        <label style="font-size: 12px; color: #666;">Stock: 100</label>
                        <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                            <button style="background: #fff; border: none; padding: 8px 12px; font-size: 16px; cursor: pointer; color: #333; transition: background 0.3s;">-</button>
                            <input type="number" value="1" min="1" class="qty-input" style="width: 50px; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; text-align: center; padding: 8px 5px; font-size: 14px;">
                            <button style="background: #fff; border: none; padding: 8px 12px; font-size: 16px; cursor: pointer; color: #333; transition: background 0.3s;">+</button>
                        </div>
                    </div>
                </div>

                <div style="position: relative; background: #fff; border: 1px solid #ddd; border-radius: 4px; padding: 20px; display: flex; align-items: center; gap: 20px;">
                    <button style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 24px; color: #666; cursor: pointer; transition: color 0.3s; padding: 0; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        <i class='bx bx-x'></i>
                    </button>
                    <div style="width: 80px; height: 80px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px; flex-shrink: 0;">
                    </div>
                    <div style="flex: 1;">
                        <h3 style="font-size: 16px; color: #333; margin-bottom: 8px; font-weight: 600; margin: 0 0 8px 0;">H3 Heading Title</h3>
                        <p style="font-size: 14px; color: #666; margin: 0;">Rp. 1000</p>
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px; position: relative; top: 15px;">
                        <label style="font-size: 12px; color: #666;">Stock: 100</label>
                        <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                            <button style="background: #fff; border: none; padding: 8px 12px; font-size: 16px; cursor: pointer; color: #333; transition: background 0.3s;">-</button>
                            <input type="number" value="20" min="1" class="qty-input" style="width: 50px; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; text-align: center; padding: 8px 5px; font-size: 14px;">
                            <button style="background: #fff; border: none; padding: 8px 12px; font-size: 16px; cursor: pointer; color: #333; transition: background 0.3s;">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection