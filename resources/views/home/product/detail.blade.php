<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #7C83FD;
            /* Lavender Purple */
            --text-dark: #333333;
            /* Abu Gelap */
            --accent: #6366F1;
            /* Soft Indigo */
        }
    </style>
</head>

<body class="bg-white text-[var(--text-dark)] min-h-screen">

    <!-- Header -->
    <div class="flex items-center px-4 py-3 bg-[var(--primary)] text-white shadow-md relative">
        <!-- Tombol Back (Ikon SVG) -->
        <a href="{{ url()->previous() }}" class="absolute left-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        <!-- Judul (Center) -->
        <h1 class="text-lg font-bold mx-auto">Detail Produk</h1>

        <!-- Tombol Keranjang -->
        <a href="#" class="absolute right-4 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l1 5h13l1-5h2M6 21a2 2 0 100-4 2 2 0 000 4zm12 0a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
            <span
                class="absolute -top-2 -right-2 bg-white text-[var(--primary)] text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full shadow">
                3
            </span>
        </a>
    </div>



    <!-- Konten -->
    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row gap-3">
            <!-- Gambar Produk -->
            <div class="w-full md:w-1/2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-100 object-cover rounded-lg shadow-md">
            </div>

            <!-- Detail Produk -->
            <div class="w-full md:w-1/2">
                <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

                <!-- Rating & Jumlah Terjual -->
                <div class="flex items-center">
                    <!-- Bintang Rating -->
                    <div class="flex text-yellow-500 text-lg">
                        ★★★★☆
                    </div>
                    <span class="text-sm text-gray-600">(120 Review)</span>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <span class="text-[var(--primary)] font-bold text-2xl">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    <span class="text-gray-600 text-sm">Stok: {{ $product->stock }}</span>
                </div>

                <div class="text-sm text-gray-500 mt-1">Terjual: <b>3.5K</b></div>

                <!-- Pilihan Varian -->
                @if ($product->variants->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Pilih Varian</h3>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach ($product->productVariants as $productVariant)
                                <button
                                    class="px-4 py-2 bg-white border border-gray-300 text-[var(--text-dark)] rounded-lg text-sm shadow-md
                            hover:border-[var(--primary)] transition duration-200
                            focus:ring-2 focus:ring-[var(--primary)] focus:border-[var(--primary)]">
                                    {{ $productVariant->variantOption->name ?? 'Tidak ada' }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Tombol Tambah ke Keranjang -->
                <div class="mt-6">
                    <button
                        class="w-full px-6 py-3 bg-[var(--primary)] text-white font-semibold rounded-lg hover:bg-purple-700 transition">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
