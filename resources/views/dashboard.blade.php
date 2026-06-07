<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Gunakan panel admin ini untuk mengelola konten dan pengaturan landing page website Anda secara instan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1: Portofolio -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Kelola Portofolio</h4>
                        <p class="text-gray-600 text-sm mb-6">Tambah, edit, atau hapus karya logo terbaik yang ingin Anda pamerkan di halaman utama website.</p>
                    </div>
                    <a href="{{ route('portfolios.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                        Buka Portofolio
                    </a>
                </div>

                <!-- Card 2: Pengaturan Website -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Pengaturan Website</h4>
                        <p class="text-gray-600 text-sm mb-6">Ubah tulisan Judul Hero, deskripsi, nomor kontak WhatsApp, harga paket startup/pro, serta link media sosial.</p>
                    </div>
                    <a href="{{ route('admin.settings.edit') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-violet-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-violet-700 transition">
                        Buka Pengaturan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
