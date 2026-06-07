<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesanan & Brief Logo') }} - {{ $order->invoice_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-xs font-semibold uppercase tracking-wider">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Column 1 & 2: Brief & Details -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Section: Brand Brief -->
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Brief Desain Logo</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <span class="text-xs text-gray-400 block">Nama Brand / Logo</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->logo_name }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Slogan / Tagline</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->tagline ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Pilihan Paket</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->package_type }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Preferensi Warna</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->color_preferences ?? 'Bebas' }}</span>
                            </div>
                        </div>
                        <div class="border-t pt-4">
                            <span class="text-xs text-gray-400 block mb-1">Deskripsi & Filosofi Logo</span>
                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $order->description_philosophy }}</p>
                        </div>
                    </div>

                    <!-- Section: Client Info -->
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Informasi Klien</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <span class="text-xs text-gray-400 block">Nama Lengkap</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->client_name }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Email Aktif</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->client_email }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Nomor WhatsApp</span>
                                <span class="text-sm font-bold text-gray-800">{{ $order->client_phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Status Controls -->
                <div class="space-y-6">
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Kelola Proyek & Transaksi</h3>
                        
                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Proyek</label>
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                    <option value="Proses Desain" {{ $order->status == 'Proses Desain' ? 'selected' : '' }}>Proses Desain</option>
                                    <option value="Revisi" {{ $order->status == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                                    <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div>
                                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                                <select id="payment_status" name="payment_status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Lunas (Paid)</option>
                                </select>
                            </div>

                            <div class="pt-4 border-t">
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                                    Simpan Status
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Details Summary -->
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Informasi Tambahan</h3>
                        <div class="space-y-2 text-xs text-gray-600">
                            <div class="flex justify-between">
                                <span>Tanggal Pesan</span>
                                <span class="font-bold">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total Tagihan</span>
                                <span class="font-bold text-emerald-600">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Faktur Publik</span>
                                <a href="{{ route('invoice.show', $order->invoice_number) }}" target="_blank" class="text-indigo-600 hover:underline">Buka Invoice Klien <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
