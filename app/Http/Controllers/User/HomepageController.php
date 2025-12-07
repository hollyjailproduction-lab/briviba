<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use App\Models\Stock;

class HomepageController extends Controller
{
    public function index()
    {
        $pakaians = Pakaian::with(['stocks' => function($q){
            $q->orderBy('price', 'asc'); // urutkan stok dari harga termurah
        }])
        ->paginate(12); // ← PAGINATION

        return view('user.homepage', compact('pakaians'));
    }

    public function search()
    {
        $query = request('q'); // nama parameter ?q=

        $results = Pakaian::where('name', 'LIKE', "%{$query}%")
            ->with('stocks')
            ->get();

        return view('user.search', [
            'query' => $query,
            'results' => $results
        ]);
    }

}
