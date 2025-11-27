@extends('layouts.admin', ['title' => 'History'])

@section('content')
<main class="flex-1 bg-gray-300">
    <div class="container mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold mb-6">Riwayat Transaksi</h2>

        <div class="bg-white p-6 rounded shadow">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Pakaian</th>
                        <th class="border px-4 py-2">Ukuran</th>
                        <th class="border px-4 py-2">Qty</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($histories as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->user->name }}</td>
                        <td class="border px-4 py-2">{{ $item->pakaian->name }}</td>
                        <td class="border px-4 py-2">{{ $item->stock->size }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($item->total_price) }}</td>
                        <td class="border px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</main>
@endsection
