<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commers - @yield('title', 'Company Profile')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50" x-data="cart">

   <nav id="navbar" class="fixed top-0 left-0 w-full z-40 bg-transparent text-white transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        
        <button id="hamburger-button" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
        <div class="hidden md:flex space-x-6">
            <a href="#menu" class="hover:text-yellow-400">Our Menu</a>
        </div>

        <div class="absolute left-1/2 -translate-x-1/2">
            <a href="/" class="text-2xl font-bold">
                Company Profile
            </a>
        </div>

        <div class="flex items-center space-x-6">
            <button id="search-button" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
            <button @click="isCartOpen = true" id="cart-button" class="relative">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span x-show="cartItems.length > 0" x-text="cartItems.length" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"></span>
            </button>
        </div>
    </div>
</nav>

<div id="mobile-menu" class="hidden fixed top-0 left-0 h-full w-64 bg-gray-900 p-6 shadow-lg z-50">
    <div class="flex justify-end mb-8">
        <button id="close-button" class="focus:outline-none text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    <div class="flex flex-col space-y-6 text-white">
        <a href="#menu" class="hover:text-yellow-400">Our Menu</a>
        <a href="#kontak" class="hover:text-yellow-400">Contact</a>
    </div>
</div>

 <div id="search-overlay" class="hidden fixed inset-0 bg-white z-40 overflow-y-auto">
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center space-x-4 mb-6">
            <div class="relative flex-grow">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" id="menu-search-input" class="w-full py-2 pl-10 pr-4 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:ring-yellow-400 focus:border-yellow-400" placeholder="Cari SKU produk...">
            </div>
            <button id="close-search-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">Close</button>
        </div>
        <div class="flex flex-wrap gap-2 mb-12">
            <button class="px-4 py-1.5 text-sm bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">Browse All</button>
            <button class="px-4 py-1.5 text-sm bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">Makanan</button>
            <button class="px-4 py-1.5 text-sm bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">Minuman</button>
            <button class="px-4 py-1.5 text-sm bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">Cemilan</button>
        </div>
        <div class="text-center">
            <img src="https://tse1.mm.bing.net/th/id/OIP.mzDvMTA6CcZBNzaOuCO9hwHaHa?cb=12&pid=ImgDet&w=474&h=474&rs=1&o=7&rm=3" alt="Cari Produk" class="mx-auto w-64 h-auto">
            <h3 class="mt-6 text-2xl font-bold text-gray-800">Cari Produk!</h3>
            <p class="mt-2 text-gray-500">Silahkan masukan kata kunci pencarian</p>
        </div>
    </div>
</div>

<div x-show="isCartOpen"
     class="fixed inset-0 z-50"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">

    <div @click="isCartOpen = false" class="absolute inset-0"></div>

    <div class="relative flex flex-col h-full w-full max-w-sm ml-auto bg-gray-100"
         x-show="isCartOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full">

        <div class="p-4 text-center relative bg-white shadow-sm flex-shrink-0">
            <button @click="cartStep = 1" x-show="cartStep === 2" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <h1 class="text-xl font-bold" x-text="cartStep === 1 ? 'Pesanan' : 'Detail Pengiriman'"></h1>
            <button @click="isCartOpen = false" x-show="cartStep === 1" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-800">&times;</button>
        </div>

        <div class="flex-grow overflow-y-auto p-4 space-y-4">
            
            <div x-show="cartStep === 1">
                <div class="bg-white p-4 rounded-lg">
                    <h2 class="font-bold mb-4" x-text="'Item yang dipesan (' + cartItems.length + ')'"></h2>
                    
                    <div x-show="cartItems.length > 0" class="space-y-4">
                        <template x-for="item in cartItems" :key="index">
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-start">
                                        <img :src="item.image" class="w-12 h-12 object-cover rounded-md mr-3">
                                        <div>
                                            <p class="font-bold text-sm leading-tight" x-text="item.name"></p>
                                            <p class="text-xs text-gray-500" x-text="item.customRequest ? item.customRequest : 'Tidak ada catatan'"></p>
                                            <p class="font-bold mt-1" x-text="'Rp ' + (item.price || 0).toLocaleString('id-ID')"></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center border rounded-md bg-white">
                                        <button @click="decreaseQuantity(item.cartItemId)" class="px-2 py-1 text-xs">-</button>
                                        <span x-text="item.quantity" class="px-3 py-1 text-sm border-l border-r"></span>
                                        <button @click="increaseQuantity(item.cartItemId)" class="px-2 py-1 text-xs">+</button>
                                    </div>
                                </div>
                                <button @click="openVariantModal(item)" class="text-sm text-yellow-600 font-semibold mt-2">Ubah</button>
                            </div>
                        </template>
                    </div>

                    <div x-show="cartItems.length === 0" class="text-center py-12 px-6">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-7359557-6024626.png" alt="Keranjang Kosong" class="mx-auto w-48 h-auto mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Oops, Keranjangmu Kosong!</h3>
                        <p class="mt-2 text-gray-500">Ayo, cari produk favoritmu dan tambahkan ke sini.</p>
                    </div>
                </div>
                
                <div x-show="cartItems.length > 0" class="bg-white p-4 rounded-lg mt-4">
                    <h2 class="font-bold mb-4">Rincian Pembayaran</h2>
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between text-gray-600 mt-2">
                        <span>Biaya lainnya</span>
                        <span>Rp 1.000</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg mt-4 border-t pt-4">
                        <span>Total</span>
                        <span x-text="'Rp ' + (total + 1000).toLocaleString('id-ID')"></span>
                    </div>
                </div>
            </div>

            <div x-show="cartStep === 2" class="bg-white p-4 rounded-lg">
                <h2 class="font-bold mb-4">Isi Data Anda</h2>
                <div class="space-y-4">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" x-model="customerName" id="customer_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-400 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="tel" x-model="customerPhone" id="customer_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-400 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea x-model="customerAddress" id="customer_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-400 focus:ring-yellow-400" placeholder="Jl. Pahlawan No. 123..."></textarea>
                    </div>

                    <!-- NEW: payment method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">
                            Metode Pembayaran
                        </label>
                        <select x-model="paymentMethod" id="payment_method"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-yellow-400 focus:ring-yellow-400">
                            <option value="">Pilih metode…</option>
                            <option value="cod">Bayar di Tempat</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="e-wallet">E‑Wallet</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="cartItems.length > 0" class="flex-shrink-0 bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.1)] p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Total Pembayaran</p>
                    <p class="font-bold text-xl" x-text="'Rp ' + (total + 1000).toLocaleString('id-ID')"></p>
                </div>
                <button x-show="cartStep === 1" @click="cartStep = 2" class="bg-orange-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-600">
                    Lanjut Pembayaran
                </button>
                <button x-show="cartStep === 2" @click="checkout" class="bg-green-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-600">
                    Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

<div x-show="isVariantModalOpen" x-transition class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm z-50 flex items-center justify-center px-4">
    <div @click.away="isVariantModalOpen = false" class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <button @click="isVariantModalOpen = false" class="absolute top-0 right-0 mt-4 mr-4 text-gray-400 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="flex items-center mb-6">
            <img :src="selectedProduct.image" class="w-24 h-24 object-cover rounded-md mr-4">
            <div>
                <h2 class="text-2xl font-bold" x-text="selectedProduct.name"></h2>
                <p class="text-lg text-yellow-500 font-bold" x-text="'Rp ' + (selectedProduct.price ? selectedProduct.price.toLocaleString('id-ID') : '0')"></p>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="font-bold mb-2">Pilih Varian:</h3>
            <div class="flex flex-wrap gap-2">
                <template x-for="variant in selectedProduct.variants" :key="variant.id">
                    <label class="flex items-center">
                        <input type="radio" x-model="selectedVariantId" :value="variant.id" class="form-radio text-yellow-500 focus:ring-yellow-400">
                        <span class="ml-2" x-text="variant.name + ' (Rp ' + variant.price.toLocaleString('id-ID') + ')'"></span>
                    </label>
                </template>
                <template x-if="!selectedProduct.variants || selectedProduct.variants.length === 0">
                    <p class="text-sm text-gray-500">Tidak ada varian untuk item ini.</p>
                </template>
            </div>
        </div>
        <div class="mb-6">
            <h3 class="font-bold mb-2">Request Pesanan (opsional):</h3>
            <textarea x-model="customRequest" class="w-full h-20 p-2 border rounded-md focus:ring-yellow-400 focus:border-yellow-400" placeholder="Contoh: Jangan pakai sayur"></textarea>
        </div>
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold">Jumlah:</h3>
            <div class="flex items-center border rounded-md">
                <button @click="if (modalQuantity > 1) modalQuantity--" class="px-4 py-2 text-lg">-</button>
                <span x-text="modalQuantity" class="px-4 py-2 font-bold border-l border-r"></span>
                <button @click="modalQuantity++" class="px-4 py-2 text-lg">+</button>
            </div>
        </div>
        <button @click="addToCartFromModal()" class="w-full bg-green-500 text-white py-3 rounded-lg font-bold hover:bg-green-600">
            + Tambah ke Keranjang
        </button>
    </div>
</div>

<main>
    @yield('content')
</main>

<footer id="kontak" class="bg-gray-900 text-white p-6 text-center">
    <div class="container mx-auto">
        <p>&copy; 2025 Profile Company. Dibuat dengan semangat.</p>
        <p class="mt-2">Jl. Maju Mundur No. 1, Semarang</p>
    </div>
</footer>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cart', () => ({
            isCartOpen: false,
            cartItems: JSON.parse(localStorage.getItem('cartItems') || '[]'),
            isVariantModalOpen: false,
            selectedProduct: {},
            selectedVariantId: null,
            customRequest: '',
            modalQuantity: 1,
            editingCartItemId: null,
            cartItems: [],
            cartStep: 1,
            customerName: '',
            customerAddress: '',
            customerPhone: '',
            paymentMethod: '', 
            
            init() {
                this.$watch('isCartOpen', (value) => {
                    if (value === false) {
                        setTimeout(() => { this.cartStep = 1; }, 300);
                    }
                });
            }, // <-- KOMA INI SANGAT PENTING

            get total() {
                return this.cartItems.reduce((sum, item) => {
                    const price = Number(item.price) || 0;
                    const quantity = Number(item.quantity) || 0;
                    return sum + (price * quantity);
                }, 0);
            }, // <-- KOMA INI SANGAT PENTING

            openVariantModal(menuItem) {
                if (menuItem.cartItemId) {
                    this.selectedProduct = menuItem.baseData;
                    this.editingCartItemId = menuItem.cartItemId;
                    this.selectedVariantId = menuItem.id;
                    this.customRequest = menuItem.customRequest || '';
                    this.modalQuantity = menuItem.quantity;
                } else {
                    this.selectedProduct = menuItem;
                    this.editingCartItemId = null;
                    this.selectedVariantId = (menuItem.variants && menuItem.variants.length > 0) ? menuItem.variants[0].id : null;
                    this.customRequest = '';
                    this.modalQuantity = 1;
                }
                this.isVariantModalOpen = true;
            }, // <-- KOMA INI SANGAT PENTING

            addToCartFromModal() {
                let finalName = this.selectedProduct.name;
                let finalPrice = Number(this.selectedProduct.price) || 0;
                let finalId = this.selectedProduct.id;
                
                const selectedVariant = (this.selectedProduct.variants && this.selectedProduct.variants.length > 0)
                    ? this.selectedProduct.variants.find(v => v.id === Number(this.selectedVariantId))
                    : null;

                if (selectedVariant) {
                    finalName = this.selectedProduct.name + ` (${selectedVariant.name})`;
                    finalPrice = (Number(this.selectedProduct.price) || 0) + (Number(selectedVariant.price) || 0);
                    finalId = selectedVariant.id;
                }
                
                if (this.customRequest) { finalName += ` - ${this.customRequest}`; }

                if (this.editingCartItemId) {
                    const itemIndex = this.cartItems.findIndex(item => item.cartItemId === this.editingCartItemId);
                    if (itemIndex > -1) {
                        this.cartItems[itemIndex].id = finalId;
                        this.cartItems[itemIndex].name = finalName;
                        this.cartItems[itemIndex].price = finalPrice;
                        this.cartItems[itemIndex].customRequest = this.customRequest;
                        this.cartItems[itemIndex].quantity = this.modalQuantity;
                        this.cartItems[itemIndex].baseData = this.selectedProduct;
                    }
                } else { 
                    const newItem = {
                        cartItemId: Date.now() + Math.random(),
                        id: finalId,
                        name: finalName,
                        price: finalPrice,
                        image: this.selectedProduct.image,
                        customRequest: this.customRequest,
                        quantity: this.modalQuantity,
                        baseData: this.selectedProduct,
                        variants: this.selectedProduct.variants
                    };
                    this.addToCart(newItem);
                }

                this.saveCart();
                this.isVariantModalOpen = false;
                this.editingCartItemId = null; 
            }, // <-- KOMA INI SANGAT PENTING
            
            addToCart(newItem) {
                const existingItem = this.cartItems.find(item => item.name === newItem.name);
                 if (existingItem) {
                    existingItem.quantity += newItem.quantity;
                 } else {
                    this.cartItems.push(newItem);
                 }
                 this.saveCart();
             }, // <-- KOMA INI SANGAT PENTING

            increaseQuantity(cartItemId) {
                const item = this.cartItems.find(item => item.cartItemId === cartItemId);
                if (item) item.quantity++;
                this.saveCart();
            }, // <-- KOMA INI SANGAT PENTING

            decreaseQuantity(cartItemId) {
                const item = this.cartItems.find(item => item.cartItemId === cartItemId);
                if (item && item.quantity > 1) {
                    item.quantity--;
                } else {
                    this.cartItems = this.cartItems.filter(item => item.cartItemId !== cartItemId);
                }
                this.saveCart();
            }, // <-- KOMA INI SANGAT PENTING

            saveCart() {
                localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
            }, // <-- KOMA INI SANGAT PENTING

            checkout() {
                if (this.cartItems.length === 0) {
                    alert('Keranjang Anda kosong!');
                    return;
                }
                if (!this.customerName || !this.customerAddress || !this.customerPhone) {
                    alert('Harap isi semua data pengiriman!');
                    return;
                }
                if (!this.paymentMethod) {
                    alert('Mohon pilih metode pembayaran!');
                    return;
                }

                fetch('{{ route('checkout.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        items: this.cartItems,
                        customer: {
                            name: this.customerName,
                            address: this.customerAddress,
                            phone: this.customerPhone,
                        },
                        payment_method: this.paymentMethod        // ← send it
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pesanan berhasil dibuat!');
                        this.cartItems = [];
                        this.saveCart();
                        this.isCartOpen = false;
                        // this.customerName = ''; // Dikosongkan saat init
                        // this.customerAddress = '';
                        // this.customerPhone = '';
                    } else {
                        alert('Gagal membuat pesanan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            } // <-- Tidak perlu koma di akhir
        }));
    });

    document.addEventListener('DOMContentLoaded', function () {
        const searchButton = document.getElementById('search-button');
        const searchOverlay = document.getElementById('search-overlay');
        const closeSearchButton = document.getElementById('close-search-button');
        searchButton.addEventListener('click', function() {
            searchOverlay.classList.remove('hidden', 'slide-up');
            searchOverlay.classList.add('slide-down');
        });
        closeSearchButton.addEventListener('click', function() {
            searchOverlay.classList.remove('slide-down');
            searchOverlay.classList.add('slide-up');
            setTimeout(() => { searchOverlay.classList.add('hidden'); }, 400); 

            // --- TAMBAHKAN KODE INI ---
            // Asumsi section menu Anda memiliki id="menu" (sesuai link di navbar Anda)
            const menuSection = document.getElementById('menu');
            if (menuSection) {
                menuSection.scrollIntoView({ behavior: 'smooth' });
            }
            // --- AKHIR TAMBAHAN ---
        });

        const hamburgerButton = document.getElementById('hamburger-button');
        const closeButton = document.getElementById('close-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
        hamburgerButton.addEventListener('click', () => mobileMenu.classList.remove('hidden'));
        closeButton.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => { mobileMenu.classList.add('hidden'); });
        });
        
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-gray-900', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-gray-900', 'shadow-lg');
                navbar.classList.add('bg-transparent');
            }
        });

        const searchInput = document.getElementById('menu-search-input');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const menuItems = document.querySelectorAll('.menu-item');

        // 2. Buat satu fungsi utama untuk meng-update tampilan menu
        function updateMenuVisibility() {
            // Dapatkan query pencarian saat ini (selalu lowercase)
            const query = searchInput ? searchInput.value.toLowerCase() : '';
            
            // Dapatkan kategori yang sedang aktif
            const activeButton = document.querySelector('.filter-btn.bg-yellow-400');
            // Jika tidak ada tombol aktif (saat baru load), anggap 'semua'
            const activeCategory = activeButton ? activeButton.getAttribute('data-filter') : 'semua';

            // 3. Loop setiap item menu dan putuskan untuk tampil atau sembunyi
            menuItems.forEach(item => {
                // Ambil data dari item menu
                const itemCategory = item.getAttribute('data-category');
                // Ambil nama produk (biasanya di tag <h3>)
                const itemName = item.querySelector('h3')?.textContent.toLowerCase() || '';
                // Ambil deskripsi produk (biasanya di tag <p>)
                const itemDesc = item.querySelector('p')?.textContent.toLowerCase() || '';

                // Cek kondisi
                const categoryMatch = (activeCategory === 'semua' || itemCategory === activeCategory);
                const searchMatch = (query === '' || itemName.includes(query) || itemDesc.includes(query));

                // Tampilkan item HANYA JIKA kedua kondisi (kategori DAN search) terpenuhi
                if (categoryMatch && searchMatch) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // 4. Tambahkan event listener untuk tombol filter kategori
        if (filterButtons.length > 0 && menuItems.length > 0) {
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Update tampilan tombol
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-yellow-400', 'text-gray-800');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.add('bg-yellow-400', 'text-gray-800');
                    this.classList.remove('bg-gray-200', 'text-gray-700');

                    // Panggil fungsi filter utama
                    updateMenuVisibility();
                });
            });
        }

        // 5. Tambahkan event listener untuk search input
        if (searchInput && menuItems.length > 0) {
            
            // Listener untuk memfilter saat user mengetik
            searchInput.addEventListener('input', updateMenuVisibility);

            // --- TAMBAHAN BARU: Menutup overlay saat 'Enter' ditekan ---
            searchInput.addEventListener('keydown', function(event) {
                // Cek apakah tombol yang ditekan adalah 'Enter'
                if (event.key === 'Enter') {
                    event.preventDefault(); // Mencegah aksi default (seperti submit form)
                    
                    // Ambil searchOverlay (seharusnya sudah ada dari listener di atasnya)
                    const searchOverlay = document.getElementById('search-overlay');
                    const closeSearchButton = document.getElementById('close-search-button');

                    if (searchOverlay && closeSearchButton) {
                        // Kita bisa langsung memanggil klik pada tombol close
                        // Ini cara bersih untuk menjalankan logika penutupan yang sudah ada
                        closeSearchButton.click();
                    }
                }
            });
        }

        if (menuItems.length > 0) {
            updateMenuVisibility();
        }

    });
</script>

</body>
</html>