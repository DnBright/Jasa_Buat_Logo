<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Website') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Section: General Settings -->
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-6">
                        {{ __('Pengaturan Umum') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="site_name" :value="__('Nama Website')" />
                            <x-text-input id="site_name" name="site_name" type="text" class="mt-1 block w-full" :value="old('site_name', $settings->site_name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('site_name')" />
                        </div>
                        <div>
                            <x-input-label for="contact_whatsapp" :value="__('Nomor WhatsApp (Format: 628...)')" />
                            <x-text-input id="contact_whatsapp" name="contact_whatsapp" type="text" class="mt-1 block w-full" :value="old('contact_whatsapp', $settings->contact_whatsapp)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('contact_whatsapp')" />
                        </div>
                    </div>
                </div>

                <!-- Section: Hero Branding -->
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-6">
                        {{ __('Desain Hero Section') }}
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="hero_tagline" :value="__('Tagline Hero')" />
                            <x-text-input id="hero_tagline" name="hero_tagline" type="text" class="mt-1 block w-full" :value="old('hero_tagline', $settings->hero_tagline)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('hero_tagline')" />
                        </div>
                        <div>
                            <x-input-label for="hero_title" :value="__('Judul Hero (Mendukung HTML)')" />
                            <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full" :value="old('hero_title', $settings->hero_title)" required />
                            <p class="mt-1 text-xs text-gray-500">Anda dapat menggunakan tag HTML seperti `&lt;span class="text-gradient"&gt;kata&lt;/span&gt;` untuk gradasi warna.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('hero_title')" />
                        </div>
                        <div>
                            <x-input-label for="hero_description" :value="__('Deskripsi Hero')" />
                            <textarea id="hero_description" name="hero_description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>{{ old('hero_description', $settings->hero_description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('hero_description')" />
                        </div>
                    </div>
                </div>

                <!-- Section: Paket Harga -->
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-6">
                        {{ __('Harga Paket Layanan') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="price_startup" :value="__('Paket Startup')" />
                            <x-text-input id="price_startup" name="price_startup" type="text" class="mt-1 block w-full" :value="old('price_startup', $settings->price_startup)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price_startup')" />
                        </div>
                        <div>
                            <x-input-label for="price_professional" :value="__('Paket Professional')" />
                            <x-text-input id="price_professional" name="price_professional" type="text" class="mt-1 block w-full" :value="old('price_professional', $settings->price_professional)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price_professional')" />
                        </div>
                        <div>
                            <x-input-label for="price_enterprise" :value="__('Paket Full Identity')" />
                            <x-text-input id="price_enterprise" name="price_enterprise" type="text" class="mt-1 block w-full" :value="old('price_enterprise', $settings->price_enterprise)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price_enterprise')" />
                        </div>
                    </div>
                </div>

                <!-- Section: Media Sosial -->
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-6">
                        {{ __('Media Sosial (URL)') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="instagram_url" :value="__('Instagram URL')" />
                            <x-text-input id="instagram_url" name="instagram_url" type="text" class="mt-1 block w-full" :value="old('instagram_url', $settings->instagram_url)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('instagram_url')" />
                        </div>
                        <div>
                            <x-input-label for="dribbble_url" :value="__('Dribbble URL')" />
                            <x-text-input id="dribbble_url" name="dribbble_url" type="text" class="mt-1 block w-full" :value="old('dribbble_url', $settings->dribbble_url)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('dribbble_url')" />
                        </div>
                        <div>
                            <x-input-label for="behance_url" :value="__('Behance URL')" />
                            <x-text-input id="behance_url" name="behance_url" type="text" class="mt-1 block w-full" :value="old('behance_url', $settings->behance_url)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('behance_url')" />
                        </div>
                        <div>
                            <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                            <x-text-input id="linkedin_url" name="linkedin_url" type="text" class="mt-1 block w-full" :value="old('linkedin_url', $settings->linkedin_url)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
                        </div>
                    </div>
                </div>

                <!-- Section: Bank Transfer / Pembayaran -->
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-6">
                        {{ __('Pengaturan Invoice & Rekening Bank') }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="bank_name" :value="__('Nama Bank')" />
                            <x-text-input id="bank_name" name="bank_name" type="text" class="mt-1 block w-full" :value="old('bank_name', $settings->bank_name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                        </div>
                        <div>
                            <x-input-label for="bank_account_number" :value="__('Nomor Rekening')" />
                            <x-text-input id="bank_account_number" name="bank_account_number" type="text" class="mt-1 block w-full" :value="old('bank_account_number', $settings->bank_account_number)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_account_number')" />
                        </div>
                        <div>
                            <x-input-label for="bank_account_holder" :value="__('Nama Pemilik Rekening')" />
                            <x-text-input id="bank_account_holder" name="bank_account_holder" type="text" class="mt-1 block w-full" :value="old('bank_account_holder', $settings->bank_account_holder)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_account_holder')" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
