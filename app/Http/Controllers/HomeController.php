<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel menu
        $menus = Menu::all();

        // Kirim data menu ke view 'welcome'
        return view('welcome', ['menus' => $menus]);
    }

     public function cart()
    {
        return view('cart');
    }
}

