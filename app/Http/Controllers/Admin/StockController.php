<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Pakaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('pakaian')->get();
        return view('admin.stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pakaians = Pakaian::all();
        return view('admin.stock.create', compact('pakaians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pakaian_id' => 'required|exists:pakaians,id',
            'sizes'      => 'required|array',
            'prices'     => 'required|array',
            'stocks'     => 'required|array',
        ]);

        foreach ($request->sizes as $size) {
            Stock::create([
                'pakaian_id' => $request->pakaian_id,
                'size'       => $size,
                'price'      => $request->prices[$size],
                'stock'      => $request->stocks[$size],
            ]);
        }

        return redirect()
            ->route('admin.stock.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }

    /**
     * Show the form for editing the resource.
     */
    // FORM EDIT HARGA
public function edit($id)
{
    $stock = Stock::with('pakaian')->findOrFail($id);
    return view('admin.stock.edit', compact('stock'));
}

// UPDATE HARGA
public function update(Request $request, $id)
{
    $request->validate([
        'price' => 'required|integer|min:1',
    ]);

    $stock = Stock::findOrFail($id);
    $stock->price = $request->price;
    $stock->save();

    return redirect()->route('admin.stock.index')->with('success', 'Harga berhasil diperbarui');
    }

    // FORM TAMBAH STOK
    public function addStockForm($id)
    {
        $stock = Stock::with('pakaian')->findOrFail($id);
        return view('admin.stock.add-stock', compact('stock'));
    }

    // PROSES TAMBAH STOK
    public function addStock(Request $request, $id)
    {
        $request->validate([
            'add_stock' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->stock += $request->add_stock;
        $stock->save();

        return redirect()->route('admin.stock.index')->with('success', 'Stok berhasil ditambahkan');
    }

    /**
     * Remove the resource.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()
            ->route('admin.stock.index')
            ->with('success', 'Stock berhasil dihapus');
    }
}
