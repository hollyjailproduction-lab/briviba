<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   // ← INI YANG WAJIB ADA
use App\Models\Pakaian;

class ProfilePageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $histories = $user->histories()
            ->with('stock.pakaian')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.profilepage', compact('user', 'histories'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone'   => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Address updated!');
    }
}
