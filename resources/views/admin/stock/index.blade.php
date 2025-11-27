@extends('layouts.admin', ['title' => 'Stok Pakaian - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Data Stok Pakaian</h2>
            <a href="{{ route('admin.stock.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Stok
            </a>
        </div>

        <div class="p-6 bg-white rounded-md shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Gambar</th>
                            <th class="px-4 py-2 border">Nama Pakaian</th>
                            <th class="px-4 py-2 border">Ukuran</th>
                            <th class="px-4 py-2 border">Harga</th>
                            <th class="px-4 py-2 border">Stok</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $item)
                        <tr>
                            {{-- Nomor --}}
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>

                            {{-- Gambar pakaian --}}
                            <td class="px-4 py-2 border">
                                @if($item->pakaian && $item->pakaian->image)
                                    <img src="{{ $item->pakaian->image }}"
                                         class="w-20 h-20 object-cover rounded">
                                @else
                                    <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                                @endif
                            </td>

                            {{-- Nama pakaian --}}
                            <td class="px-4 py-2 border">
                                {{ $item->pakaian->name ?? '-' }}
                            </td>

                            {{-- Ukuran --}}
                            <td class="px-4 py-2 border">{{ $item->size }}</td>

                            {{-- Harga --}}
                            <td class="px-4 py-2 border">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            {{-- Stok --}}
                            <td class="px-4 py-2 border">{{ $item->stock }}</td>

                            {{-- Aksi --}}
                            <td class="px-4 py-2 border space-y-2">

                                <a href="{{ route('admin.stock.edit', $item->id) }}"
                                    class="block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-center">
                                    Edit Harga
                                </a>

                                <a href="{{ route('admin.stock.addStockForm', $item->id) }}"
                                    class="block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
                                    Tambah Stok
                                </a>

                                <form action="{{ route('admin.stock.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus stok ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-600">
                                Belum ada data stok
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</main>
@endsection
