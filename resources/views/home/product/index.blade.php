<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                            <p class="text-gray-500 dark:text-gray-300 text-sm">{{ $product->sku }}</p>

                            <div class="flex justify-between items-center mt-2">
                                <span class="text-green-600 dark:text-green-400 font-bold text-lg">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-gray-600 dark:text-gray-300 text-sm">Stok:
                                    {{ $product->stock }}</span>
                            </div>

                            <div class="mt-4">
                                <a href="#"
                                    class="block text-center w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
