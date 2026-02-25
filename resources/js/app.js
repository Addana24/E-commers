import './bootstrap';

// Import Swiper
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Inisialisasi Swiper
const swiper = new Swiper('.swiper', {
  // Gunakan modul yang diimpor
  modules: [Navigation, Pagination, Autoplay],

  // Konfigurasi slider
  loop: true, // Agar slider berputar terus menerus
  autoplay: {
    delay: 4000, // Pindah slide setiap 4 detik
    disableOnInteraction: false,
  },

  // Tombol navigasi (panah kiri-kanan)
  // navigation: {
  //   nextEl: '.swiper-button-next',
  //   prevEl: '.swiper-button-prev',
  // },

  // Paginasi (titik-titik di bawah)
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();