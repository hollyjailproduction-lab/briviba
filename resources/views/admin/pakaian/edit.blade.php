@extends('layouts.admin', ['title' => 'Pakaian - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT PAKAIAN</h2>
            <hr class="mt-4">

            <form action="{{ route('admin.pakaian.update', $pakaian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 mt-4">

                    {{-- GAMBAR --}}
                    <div>
                        <label class="text-gray-700" for="image">GAMBAR</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white p-3"
                        type="file" name="image">

                        {{-- PREVIEW GAMBAR SAAT INI --}}
                        @if ($pakaian->image)
                            <img src="{{ $item->image }}" class="w-20 h-20 object-cover rounded">


                        @endif

                        @error('image')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    {{-- NAMA PAKAIAN --}}
                    <div>
                        <label class="text-gray-700" for="name">NAMA PAKAIAN</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white"
                        type="text" name="name" value="{{ old('name', $pakaian->name) }}" placeholder="Nama Pakaian">

                        @error('name')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div>
                        <label class="text-gray-700">KATEGORI</label>
                        <select name="category_id" class="form-select w-full mt-2 rounded-md bg-gray-200 focus:bg-white">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $pakaian->category_id) == $category->id ? 'selected':'' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div>
                        <label class="text-gray-700" for="description">DESKRIPSI</label>
                        <textarea class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white"
                        name="description" rows="4" placeholder="Deskripsi">{{ old('description', $pakaian->description) }}</textarea>

                        @error('description')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                        UPDATE
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>
@endsection
