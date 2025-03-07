<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                    x-data="{ varianSelected: false, selectedVariant: '', options: [], isActive: true }">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri: Info Produk -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b pb-2">
                                Informasi Produk
                            </h3>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">Nama Produk</label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">SKU (Stock Keeping Unit)</label>
                                <input type="text" name="sku" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <small class="text-gray-500">Gunakan kode unik untuk mengidentifikasi produk.</small>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">Harga</label>
                                <div class="flex items-center">
                                    <span
                                        class="px-3 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded-l-lg">Rp</span>
                                    <input type="number" name="price" required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-r-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">Stok</label>
                                <input type="number" name="stock" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Kolom Kanan: Varian & Status -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b pb-2">
                                Variasi Produk
                            </h3>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">Jenis Varian</label>
                                <select name="variant_id" x-model="selectedVariant"
                                    x-on:change="varianSelected = selectedVariant !== ''"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tanpa Varian</option>
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-gray-500">Pilih jenis varian seperti Warna, Ukuran, dll.</small>
                            </div>

                            <!-- Opsi Variasi -->
                            <div class="mt-4" x-show="varianSelected" x-transition>
                                <label class="block text-gray-700 dark:text-gray-200">Opsi Varian</label>
                                <template x-for="(option, index) in options" :key="index">
                                    <div class="flex items-center mt-2">
                                        <input type="text" :name="'variant_options[]'" x-model="options[index]"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                        <button type="button" @click="options.splice(index, 1)"
                                            class="ml-2 px-2 py-1 bg-red-500 text-white rounded-md">✕</button>
                                    </div>
                                </template>
                                <button type="button" @click="options.push('')"
                                    class="mt-2 px-3 py-1 bg-blue-500 text-white rounded-md">+ Tambah Opsi</button>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b pb-2 mt-6">
                                Gambar & Status
                            </h3>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-gray-200">Gambar Produk</label>
                                <input type="file" name="image"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Toggle Status Produk -->
                            <div class="mt-4 flex items-center justify-between">
                                <label class="block text-gray-700 dark:text-gray-200">Status Produk</label>
                                <div class="relative">
                                    <input type="hidden" name="is_active" :value="isActive ? 1 : 0">
                                    <button @click="isActive = !isActive" type="button"
                                        class="relative w-12 h-6 bg-gray-300 dark:bg-gray-600 rounded-full transition focus:outline-none"
                                        :class="isActive ? 'bg-green-500' : 'bg-gray-400'">
                                        <span
                                            class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition transform"
                                            :class="isActive ? 'translate-x-6' : 'translate-x-0'">
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Simpan Produk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
