<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Ulasan Testimoni Klien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Column 1 & 2: Testimonials Table -->
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Ulasan Terdaftar</h3>
                    @if($testimonials->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien / Perusahaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating / Isi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tampil</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $testimonial->client_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $testimonial->company_name ?? 'Client' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-amber-400 text-xs mb-1">
                                                @for($i=1; $i<=$testimonial->rating; $i++)
                                                    <i class="fa-solid fa-star"></i>
                                                @endfor
                                                @for($i=$testimonial->rating+1; $i<=5; $i++)
                                                    <i class="fa-regular fa-star"></i>
                                                @endfor
                                            </div>
                                            <p class="text-xs text-gray-600 line-clamp-2">{{ $testimonial->content }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $testimonial->is_visible ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $testimonial->is_visible ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $testimonials->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-6">Belum ada ulasan testimoni.</p>
                    @endif
                </div>

                <!-- Column 3: Add New Testimonial -->
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Tambah Ulasan Baru</h3>
                    
                    <form method="POST" action="{{ route('testimonials.store') }}" class="space-y-4">
                        @csrf
                        
                        <div>
                            <x-input-label for="client_name" :value="__('Nama Klien')" />
                            <x-text-input id="client_name" name="client_name" type="text" class="mt-1 block w-full text-sm" required />
                            <x-input-error class="mt-2" :messages="$errors->get('client_name')" />
                        </div>

                        <div>
                            <x-input-label for="company_name" :value="__('Nama Perusahaan / Brand (Opsional)')" />
                            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full text-sm" />
                            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating Bintang</label>
                            <select id="rating" name="rating" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="5" selected>5 Bintang</option>
                                <option value="4">4 Bintang</option>
                                <option value="3">3 Bintang</option>
                                <option value="2">2 Bintang</option>
                                <option value="1">1 Bintang</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Isi Ulasan / Testimoni')" />
                            <textarea id="content" name="content" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full text-sm" required></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_visible" name="is_visible" type="checkbox" checked value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="is_visible" class="ml-2 block text-sm text-gray-900">Tampilkan langsung di halaman utama</label>
                        </div>

                        <div class="pt-4 border-t">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150">
                                Simpan Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
