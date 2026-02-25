@extends('layouts.app')

@section('title', 'Menyajikan Hidangan Terbaik Untukmu')

@section('content')

    <section class="relative h-96 w-full">
    <div class="swiper h-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2073" alt="Team working" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black opacity-60"></div>
                <div class="relative z-10 h-full flex flex-col items-center justify-center text-white text-center px-4">
                    <h1 class="text-5xl font-extrabold">E-Commers</h1>
                    <p class="mt-4 text-xl text-gray-200">Menyajikan Hidangan Terbaik Untukmu</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070" alt="Presentation" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black opacity-60"></div>
                <div class="relative z-10 h-full flex flex-col items-center justify-center text-white text-center px-4">
                    <h1 class="text-5xl font-extrabold">Inovasi Tiada Henti</h1>
                    <p class="mt-4 text-xl text-gray-200">Dari Magelangan hingga Es Teh Jumbo</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="absolute inset-0">
                    <img src="https://media.istockphoto.com/id/603992138/id/foto/rapat-pemegang-saham.jpg?s=612x612&w=0&k=20&c=FeRZU5srNfLnYDrB8dpvM-d0aoxQiYXrVQdQG6BDSkM=" alt="Coffee" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black opacity-60"></div>
                <div class="relative z-10 h-full flex flex-col items-center justify-center text-white text-center px-4">
                    <h1 class="text-5xl font-extrabold">Tempat Nongkrong Asik</h1>
                    <p class="mt-4 text-xl text-gray-200">Buka 24 Jam Non-Stop</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-button-next text-white"></div>
    </div>
</section>
    
    <!-- <section id="about" class="bg-white py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-4">About Us</h2>
        <div class="w-24 h-1 bg-yellow-400 mx-auto mb-12"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">What we do</h3>
                <p class="text-gray-600 leading-relaxed">
                    Kami adalah spesialis dalam menyediakan solusi kuliner yang relevan untuk mengatasi rasa lapar kapan pun. Kami membantu meningkatkan pertumbuhan semangat melalui inovasi dan teknologi memasak Indomie yang canggih.
                </p>
                <p class="text-gray-600 leading-relaxed mt-4">
                    Burjo Ngegas fokus untuk menyajikan hidangan yang relevan, cepat, namun tetap simpel.
                </p>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1974" 
                     alt="Business discussion"
                     class="rounded-lg shadow-2xl w-full">
            </div>
        </div>
    </div>
</section> -->

    <section id="menu" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Our Menu</h2>

            <div class="flex justify-center space-x-4 mb-12">
                <button class="filter-btn bg-yellow-400 text-gray-800 font-bold py-2 px-6 rounded-full" data-filter="semua">Semua</button>
                <button class="filter-btn bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-full" data-filter="makanan">Makanan</button>
                <button class="filter-btn bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-full" data-filter="minuman">Minuman</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($menus as $menu)
                <div @click="openVariantModal({
                id: {{ $menu->id }},
                name: '{{ e($menu->name) }}',
                price: {{ $menu->price }},
                image: '{{ asset('storage/' . $menu->image) }}',
                variants: {{ json_encode($menu->variants) }}
            })"
            class="menu-item bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 cursor-pointer"
            data-category="{{ $menu->category }}">

                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">{{ $menu->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $menu->description }}</p>
                    
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xl font-bold text-yellow-500">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </span>
                        <div class="bg-yellow-400 text-gray-900 font-bold w-10 h-10 rounded-full flex items-center justify-center">
                            +
            </div>
        </div>
    </div>
</div>
                @endforeach
            </div>
        </div>
    </section>

@endsection