@extends('layouts.admin', ['title' => 'Edit Gambar Produk'])

@section('content')
<main class="flex-1 p-8 bg-gray-100">

    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-xl font-semibold mb-4">Edit Gambar: {{ $pakaian->name }}</h2>

        <form action="{{ route('admin.gambarproduk.update', $pakaian->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-4 gap-4">

                {{-- Foto Utama --}}
                <div>
                    <p class="font-semibold mb-2">Foto Utama</p>
                    <img src="{{ asset($pakaian->image) }}"
                         class="w-full h-100 object-cover border rounded">
                </div>

                {{-- Foto Kerah --}}
                <div>
                    <p class="font-semibold mb-2">Foto Kerah</p>
                    <img src="{{ asset('storage/' .$pakaian->image_collar ?? $pakaian->image) }}"
                         class="w-full h-100 object-cover border rounded mb-2">
                    <input type="file" name="image_collar" class="mb-2">
                </div>

                {{-- Foto Material --}}
                <div>
                    <p class="font-semibold mb-2">Foto Material</p>
                    <img src="{{ asset('storage/' .$pakaian->image_material ?? $pakaian->image) }}"
                         class="w-full h-100 object-cover border rounded mb-2">
                    <input type="file" name="image_material" class="mb-2">
                </div>

                {{-- Foto Belakang --}}
                <div>
                    <p class="font-semibold mb-2">Foto Belakang</p>
                    <img src="{{ asset('storage/' .$pakaian->image_back ?? $pakaian->image) }}"
                         class="w-full h-100 object-cover border rounded mb-2">
                    <input type="file" name="image_back" class="mb-2">
                </div>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded mt-6">
                Simpan Perubahan
            </button>

        </form>

    </div>

</main>
@endsection
