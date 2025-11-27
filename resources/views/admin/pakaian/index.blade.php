@extends('layouts.admin', ['title' => 'Pakaian - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Data Pakaian</h2>
            <a href="{{ route('admin.pakaian.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Pakaian
            </a>
        </div>

        <div class="p-6 bg-white rounded-md shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Gambar</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Kategori</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pakaians as $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $loop->iteration }}</td>

                            {{-- gambar --}}
                            <td class="px-4 py-2 border">
                                <img src="{{ $item->image }}" class="w-20 h-20 object-cover rounded">


                            </td>

                            {{-- nama pakaian --}}
                            <td class="px-4 py-2 border">{{ $item->name }}</td>

                            {{-- kategori pakaian --}}
                            <td class="px-4 py-2 border">{{ $item->category->name ?? '-' }}</td>

                            {{-- deskripsi pakaian --}}
                            <td class="px-4 py-2 border">
                                {{ Str::limit($item->description, 40) }}
                            </td>

                            {{-- aksi --}}
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('admin.pakaian.edit', $item->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <form action="{{ route('admin.pakaian.destroy', $item->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-600">
                                Belum ada data pakaian
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pakaians->links() }}
            </div>
        </div>

    </div>
</main>
@endsection
