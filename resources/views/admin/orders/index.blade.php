<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pesanan & Status Proyek') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md text-xs font-semibold">Semua</a>
                <a href="{{ route('admin.orders.index', ['status' => 'Menunggu Pembayaran']) }}" class="px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 rounded-md text-xs font-semibold">Menunggu Pembayaran</a>
                <a href="{{ route('admin.orders.index', ['status' => 'Proses Desain']) }}" class="px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-md text-xs font-semibold">Proses Desain</a>
                <a href="{{ route('admin.orders.index', ['status' => 'Revisi']) }}" class="px-3 py-1.5 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded-md text-xs font-semibold">Revisi</a>
                <a href="{{ route('admin.orders.index', ['status' => 'Selesai']) }}" class="px-3 py-1.5 bg-emerald-100 hover:bg-emerald-200 text-emerald-800 rounded-md text-xs font-semibold">Selesai</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($orders->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice / Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien / Kontak</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket / Nilai</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Bayar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Proyek</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $order->invoice_number }}</div>
                                            <div class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->client_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->client_email }}</div>
                                            <div class="text-xs text-gray-400">{{ $order->client_phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->package_type }}</div>
                                            <div class="text-xs font-bold text-emerald-600">Rp {{ number_format($order->price, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $order->payment_status == 'Paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                                {{ $order->payment_status == 'Paid' ? 'Lunas' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Tinjau Brief</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-6">Belum ada pesanan yang sesuai dengan filter.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
