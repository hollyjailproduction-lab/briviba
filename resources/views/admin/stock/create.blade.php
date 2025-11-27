@extends('layouts.admin', ['title' => 'Tambah Stok'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Tambah Stok</h2>

        <form action="{{ route('admin.stock.store') }}" method="POST">
            @csrf

            {{-- Dropdown Pencarian Pakaian --}}
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Pilih Pakaian</label>

                <select id="pakaianSelect" name="pakaian_id"
                    class="w-full p-2 border rounded focus:ring focus:ring-blue-200">
                    <option value="">-- pilih pakaian --</option>

                    @foreach($pakaians as $p)
                        <option value="{{ $p->id }}" data-image="{{ $p->image }}">
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Preview gambar pakaian --}}
            <div id="previewImage" class="mb-4 hidden">
                <label class="block text-gray-700 mb-2">Preview</label>
                <img id="imgPreview" class="w-32 h-32 object-cover rounded shadow">
            </div>

            {{-- Pilihan Ukuran --}}
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Pilih Ukuran</label>

                <div class="grid grid-cols-3 gap-2">
                    @foreach(['S','M','L','XL','XXL'] as $size)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}"
                                   class="size-checkbox">
                            <span>{{ $size }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Dynamic Fields Harga & Stok --}}
            <div id="sizeFields"></div>

            <div class="mt-6">
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.stock.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
            </div>

        </form>

    </div>
</main>

{{-- Script --}}
<script>
const select = document.getElementById('pakaianSelect');
const previewBox = document.getElementById('previewImage');
const imgPreview = document.getElementById('imgPreview');

// preview gambar otomatis
select.addEventListener('change', function () {
    const image = this.options[this.selectedIndex].dataset.image;
    if (image) {
        imgPreview.src = image;
        previewBox.classList.remove('hidden');
    } else {
        previewBox.classList.add('hidden');
    }
});

// checkbox ukuran dinamis
document.querySelectorAll('.size-checkbox').forEach(chk => {
    chk.addEventListener('change', function () {
        const size = this.value;
        const container = document.getElementById('sizeFields');

        if (this.checked) {
            // tambah input harga & stok
            container.insertAdjacentHTML('beforeend', `
                <div id="field-${size}" class="p-4 mb-3 bg-white rounded shadow">
                    <h3 class="font-semibold mb-2">Ukuran ${size}</h3>

                    <label class="block">Harga</label>
                    <input type="number" name="prices[${size}]"
                           class="w-full p-2 border rounded mb-2" required>

                    <label class="block">Stok</label>
                    <input type="number" name="stocks[${size}]"
                           class="w-full p-2 border rounded" required>
                </div>
            `);
        } else {
            // hapus jika uncheck
            document.getElementById('field-' + size)?.remove();
        }
    });
});
</script>

@endsection
