<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pakaian;
use App\Models\Keranjang;

class CartPageController extends Controller
{
    public function index()
    {
        $cart = Keranjang::with('pakaian')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.cartpage', compact('cart'));
    }

    public function addToCart(Request $request, $slug)
    {
        $request->validate([
            'size' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Pakaian::where('slug', $slug)->firstOrFail();

        // Ambil stok sesuai size
        $stock = $item->stocks->where('size', $request->size)->first();

        if (!$stock || $stock->stock < 1) {
            return back()->with('error', 'Stok sedang habis!');
        }

        if ($request->quantity > $stock->stock) {
            return back()->with('error', 'Quantity melebihi stok!');
        }

        // Jika item sudah ada
        $existing = Keranjang::where('user_id', auth()->id())
            ->where('pakaian_id', $item->id)
            ->where('size', $request->size)
            ->first();

        if ($existing) {
            // Cek stok lagi
            if ($existing->quantity + $request->quantity > $stock->stock) {
                return back()->with('error', 'Quantity melebihi stok tersedia!');
            }

            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            Keranjang::create([
                'user_id' => auth()->id(),
                'pakaian_id' => $item->id,
                'size' => $request->size,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('user.cartpage')->with('success', 'Item added to cart!');
    }

    public function delete($id)
    {
        $item = Keranjang::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = Keranjang::where('user_id', auth()->id())
                        ->where('id', $id)
                        ->firstOrFail();

        $stock = $cart->pakaian->stocks->where('size', $cart->size)->first()->stock;

        if ($request->action === 'plus' && $cart->quantity < $stock) {
            $cart->quantity++;
        } elseif ($request->action === 'minus' && $cart->quantity > 1) {
            $cart->quantity--;
        } else {
            $cart->quantity = $request->quantity;
        }

        $cart->save();

        return back()->with('success', 'Quantity updated!');
    }
    public function checkoutProcess(Request $request)
    {
        $userId = auth()->id();

        // Ambil item yang dipilih
        $selected = $request->selected_items;

        if (!$selected || count($selected) == 0) {
            return back()->with('error', 'No items selected.');
        }

        $cartItems = \App\Models\Keranjang::where('user_id', $userId)
            ->whereIn('id', $selected)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No valid cart items.');
        }

        foreach ($cartItems as $c) {

            $stock = \App\Models\Stock::where('pakaian_id', $c->pakaian_id)
                ->where('size', $c->size)
                ->first();

            if (!$stock) {
                return back()->with('error', "Stock not found.");
            }

            $total = $stock->price * $c->quantity;

            // Simpan ke history
            \App\Models\History::create([
                'user_id'     => $userId,
                'stock_id'    => $stock->id,
                'quantity'    => $c->quantity,
                'total_price' => $total,
            ]);

            // Kurangi stock
            $stock->stock -= $c->quantity;
            $stock->save();

            // Hapus dari cart
            $c->delete();
        }

        return redirect()->route('user.cartpage')
            ->with('success', 'Pembayaran berhasil! Pesanan tersimpan di history.');
    }

    public function checkoutPage(Request $request)
    {
        // Ambil ID cart yang dipilih dari GET URL
        $selected = $request->selected_items;

        if (!$selected || count($selected) == 0) {
            return redirect()->route('user.cartpage')
                ->with('error', 'Please select at least one item.');
        }

        // Ambil item yang dipilih
        $items = \App\Models\Keranjang::with('pakaian', 'pakaian.stocks')
            ->where('user_id', auth()->id())
            ->whereIn('id', $selected)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('user.cartpage')
                ->with('error', 'Selected items not found.');
        }

        return view('user.checkoutpage', compact('items'));
    }


}
