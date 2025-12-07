<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;
use App\Models\Pakaian;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    /**
     * Menampilkan semua riwayat transaksi
     */
    public function index()
    {
        $histories = History::with(['user', 'stock.pakaian'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.history.index', compact('histories'));
    }


    /**
     * Form tambah history (admin menambahkan transaksi)
     */
    public function create()
    {
        $pakaians = Pakaian::all();
        return view('admin.history.create', compact('pakaians'));
    }

    /**
     * Simpan history transaksi
     * Mengurangi stok otomatis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'stock_id'   => 'required|exists:stocks,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($request->stock_id);

        // Cek stok cukup atau tidak
        if ($request->quantity > $stock->stock) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Hitung total harga
        $totalPrice = $stock->price * $request->quantity;

        // Simpan history
        History::create([
            'user_id'    => $request->user_id,
            'stock_id'   => $request->stock_id,
            'quantity'   => $request->quantity,
            'total_price'=> $totalPrice,
        ]);

        // Kurangi stok
        $stock->stock -= $request->quantity;
        $stock->save();

        return redirect()
            ->route('admin.history.index')
            ->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Detail history
     */
    public function show($id)
    {
        $history = History::with(['user','pakaian','stock'])->findOrFail($id);
        return view('admin.history.show', compact('history'));
    }

    /**
     * Hapus history
     * Catatan: stok TIDAK dikembalikan (sesuai SOP umum)
     */
    public function destroy($id)
    {
        History::findOrFail($id)->delete();

        return redirect()
            ->route('admin.history.index')
            ->with('success', 'History berhasil dihapus');
    }
}
