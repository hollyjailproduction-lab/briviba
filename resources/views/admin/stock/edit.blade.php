@extends('layouts.admin', ['title' => 'Edit Harga'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Harga</h2>

        <div class="p-6 bg-white rounded-md shadow-md">

            {{-- Info pakaian --}}
            <div class="mb-6 flex items-center space-x-4">
                <img src="{{ $stock->pakaian->image }}" class="w-24 h-24 object-cover rounded shadow">
                <div>
                    <h3 class="font-semibold text-lg">{{ $stock->pakaian->name }}</h3>
                    <p class="text-gray-600">Ukuran: {{ $stock->size }}</p>
                    <p class="text-gray-600">Stok: {{ $stock->stock }} pcs</p>
                </div>
            </div>

            <form action="{{ route('admin.stock.update', $stock->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block mb-2 text-gray-700">Harga Baru</label>
                <input type="number" name="price" value="{{ $stock->price }}"
                       class="w-full p-2 border rounded mb-4" required>

                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Harga
                </button>

                <a href="{{ route('admin.stock.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 ml-2">
                    Kembali
                </a>
            </form>

        </div>

    </div>
</main>
@endsection
