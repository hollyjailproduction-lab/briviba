<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;

class ItemController extends Controller
{
    public function show($slug)
    {
        $item = Pakaian::with('stocks')->where('slug', $slug)->firstOrFail();

        return view('user.itempage', compact('item'));
    }
}
