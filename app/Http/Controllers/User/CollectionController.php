<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;

class CollectionController extends Controller
{
    public function bestSeller()
    {
        $pakaians = Pakaian::with('stocks')
            ->select('pakaians.*')
            ->selectSub(function ($query) {
                $query->from('stocks')
                    ->leftJoin('histories', 'histories.stock_id', '=', 'stocks.id')
                    ->whereColumn('stocks.pakaian_id', 'pakaians.id')
                    ->selectRaw('COALESCE(SUM(histories.quantity), 0)');
            }, 'total_sold')
            ->orderBy('total_sold', 'DESC')
            ->get();

        return view('user.best-seller', compact('pakaians'));
    }

    public function collection()
    {
        // Semua pakaian
        $pakaians = Pakaian::with('stocks')->get();

        return view('user.collection', compact('pakaians'));
    }
}
