<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    @php
        // Fetch dynamic statistics directly
        $totalRevenue = \App\Models\Order::where('payment_status', 'Paid')->sum('price');
        $activeProjects = \App\Models\Order::whereIn('status', ['Proses Desain', 'Revisi'])->count();
        $totalClients = \App\Models\Order::distinct('client_email')->count('client_email');
        $completedProjects = \App\Models\Order::where('status', 'Selesai')->count();
        $recentOrders = \App\Models\Order::latest()->take(5)->get();

        // Calculate distribution by package for the custom chart
        $startupRevenue = \App\Models\Order::where('package_type', 'Startup')->where('payment_status', 'Paid')->sum('price');
        $proRevenue = \App\Models\Order::where('package_type', 'Professional')->where('payment_status', 'Paid')->sum('price');
        $enterpriseRevenue = \App\Models\Order::where('package_type', 'Full Identity')->where('payment_status', 'Paid')->sum('price');
        
        $maxRevenue = max($startupRevenue, $proRevenue, $enterpriseRevenue, 1000000);
        $startupHeight = ($startupRevenue / $maxRevenue) * 100;
        $proHeight = ($proRevenue / $maxRevenue) * 100;
        $enterpriseHeight = ($enterpriseRevenue / $maxRevenue) * 100;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-600">
                <h3 class="text-xl font-bold text-gray-900 mb-1">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 text-sm">Berikut adalah ikhtisar operasional dan finansial jasa pembuatan logo Anda secara real-time.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Stat 1: Revenue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Pendapatan (Lunas)</div>
                    <div class="text-2xl font-extrabold text-emerald-600 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i> Dari transaksi terkonfirmasi
                    </div>
                </div>

                <!-- Stat 2: Active Projects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div class="text-gray-500 text-xs uppercase font-bold tracking-wider">Proyek Aktif (Desain/Revisi)</div>
                    <div class="text-3xl font-extrabold text-indigo-600 mt-2">{{ $activeProjects }}</div>
                    <div class="text-xs text-gray-400 mt-4">Sedang dalam proses pengerjaan</div>
                </div>

                <!-- Stat 3: Total Clients -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Klien</div>
                    <div class="text-3xl font-extrabold text-violet-600 mt-2">{{ $totalClients }}</div>
                    <div class="text-xs text-gray-400 mt-4">Klien terdaftar & pemesan unik</div>
                </div>

                <!-- Stat 4: Completed Projects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div class="text-gray-500 text-xs uppercase font-bold tracking-wider">Proyek Selesai</div>
                    <div class="text-3xl font-extrabold text-blue-600 mt-2">{{ $completedProjects }}</div>
                    <div class="text-xs text-gray-400 mt-4">Logo berhasil diserahkan ke klien</div>
                </div>
            </div>

            <!-- Visual Charts & Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Column 1 & 2: Revenue Chart -->
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Grafik Distribusi Pendapatan per Paket</h4>
                        <div class="h-48 flex items-end justify-around border-b border-gray-200 pb-2 gap-4">
                            <!-- Startup Bar -->
                            <div class="w-full flex flex-col items-center">
                                <div class="bg-indigo-500 w-16 rounded-t-md transition-all duration-500" style="height: {{ max($startupHeight, 10) }}px;"></div>
                                <span class="text-xs text-gray-500 mt-2">Startup</span>
                                <span class="text-xs font-bold text-gray-800">Rp {{ number_format($startupRevenue / 1000000, 1) }}M</span>
                            </div>
                            
                            <!-- Pro Bar -->
                            <div class="w-full flex flex-col items-center">
                                <div class="bg-violet-500 w-16 rounded-t-md transition-all duration-500" style="height: {{ max($proHeight, 10) }}px;"></div>
                                <span class="text-xs text-gray-500 mt-2">Professional</span>
                                <span class="text-xs font-bold text-gray-800">Rp {{ number_format($proRevenue / 1000000, 1) }}M</span>
                            </div>

                            <!-- Enterprise Bar -->
                            <div class="w-full flex flex-col items-center">
                                <div class="bg-pink-500 w-16 rounded-t-md transition-all duration-500" style="height: {{ max($enterpriseHeight, 10) }}px;"></div>
                                <span class="text-xs text-gray-500 mt-2">Full Identity</span>
                                <span class="text-xs font-bold text-gray-800">Rp {{ number_format($enterpriseRevenue / 1000000, 1) }}M</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Quick Action Hub -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat Admin</h4>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('portfolios.index') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-briefcase text-indigo-500 mr-2"></i> Kelola Katalog Portofolio</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-cart-shopping text-emerald-500 mr-2"></i> Kelola Pesanan & Brief</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('testimonials.index') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-star text-amber-500 mr-2"></i> Kelola Ulasan Testimoni</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('posts.index') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-file-pen text-rose-500 mr-2"></i> Tulis Artikel & Blog SEO</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-users text-violet-500 mr-2"></i> Manajemen Akun Staff / Klien</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                            <a href="{{ route('admin.settings.edit') }}" class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition text-sm text-gray-700">
                                <span><i class="fa-solid fa-sliders text-blue-500 mr-2"></i> Edit Setting & Teks Landing</span>
                                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-bold text-gray-900">Pesanan Masuk Terbaru</h4>
                    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900 text-xs font-semibold uppercase tracking-wider">Melihat Semua Pesanan</a>
                </div>
                
                @if($recentOrders->isNotEmpty())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Invoice</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Klien</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bayar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proyek</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        {{ $order->invoice_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $order->client_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $order->package_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Brief</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 text-center py-6 text-sm">Belum ada pesanan masuk.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
