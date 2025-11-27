<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pencarian
        $pakaians = Pakaian::with('category')->latest()->when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.pakaian.index', compact('pakaians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.pakaian.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:pakaians',
            'category_id' => 'required',
            'description' => 'nullable',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('pakaian', $image->hashName(), 'public');

        // save to database
        Pakaian::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'       => $image->hashName(),
        ]);


        return redirect()->route('admin.pakaian.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pakaian $pakaian)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.pakaian.edit', compact('pakaian', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pakaian $pakaian)
    {
        $request->validate([
            'name'        => 'required|unique:pakaians,name,' . $pakaian->id,
            'category_id' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // jika gambar tidak diganti
        if (!$request->file('image')) {
            $pakaian->update([
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);
        } else {
            Storage::delete('public/pakaian/' . $pakaian->image);

            $image = $request->file('image');
            Storage::disk('public')->delete('pakaian/' . $pakaian->image);
            $image->storeAs('pakaian', $image->hashName(), 'public');
            
            $pakaian->update([
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image'       => $image->hashName(),
            ]);
        }


        return redirect()->route('admin.pakaian.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pakaian = Pakaian::findOrFail($id);

        Storage::disk('public')->delete('pakaian/' . $pakaian->image);
        $pakaian->delete();
        return redirect()
            ->route('admin.pakaian.index')
            ->with('success', 'Pakaian berhasil dihapus');

    }
}
