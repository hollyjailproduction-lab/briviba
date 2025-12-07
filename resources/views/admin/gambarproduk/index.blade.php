@extends('layouts.admin', ['title' => 'Gambar Produk'])

@section('content')
<main class="flex-1 p-8 bg-gray-100">

    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-semibold mb-4">Kelola Gambar Produk</h2>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Foto Utama</th>
                    <th class="px-4 py-2 border">Foto Kerah</th>
                    <th class="px-4 py-2 border">Foto Bahan</th>
                    <th class="px-4 py-2 border">Foto Belakang</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pakaians as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>

                    <td class="border px-4 py-2">{{ $item->name }}</td>

                    {{-- FOTO UTAMA --}}
                    <td class="border px-4 py-2 text-center">
                        <img src="{{ asset( $item->image) }}" class="w-20 h-20 object-cover rounded mx-auto">
                    </td>

                    {{-- FOTO KERAH --}}
                    <td class="border px-4 py-2 text-center">
                        @if($item->image_collar)
                            <img src="{{ asset('storage/' . $item->image_collar) }}" class="w-20 h-20 object-cover rounded mx-auto">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- FOTO BAHAN --}}
                    <td class="border px-4 py-2 text-center">
                        @if($item->image_material)
                            <img src="{{ asset('storage/' . $item->image_material) }}" class="w-20 h-20 object-cover rounded mx-auto">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- FOTO BELAKANG --}}
                    <td class="border px-4 py-2 text-center">
                        @if($item->image_back)
                            <img src="{{ asset('storage/' . $item->image_back) }}" class="w-20 h-20 object-cover rounded mx-auto">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.gambarproduk.edit', $item->id) }}"
                           class="px-3 py-1 bg-blue-600 text-white rounded">
                           Edit Gambar
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pakaians->links() }}

    </div>

</main>
@endsection
