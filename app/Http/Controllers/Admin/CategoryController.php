<?php


namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function($categories) {
            $categories = $categories->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);


        return view('admin.category.index', compact('categories'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.category.create');
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories',
        ]);

        $category = Category::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Data Berhasil Disimpan!');
    }

    
    /**
     * edit
     *
     * @param  mixed $request
     * @param  mixed $category
     * @return void
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Data Berhasil Diupdate!');




        if($category){
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

}
