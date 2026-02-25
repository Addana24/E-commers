<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data baru (termasuk pelanggan)
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'customer.name' => 'required|string|max:255',
            'customer.address' => 'required|string',
            'customer.phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:cod,transfer,e-wallet',
        ]);

        try {
            DB::beginTransaction();

            // --- PERBAIKAN DIMULAI DI SINI ---

            // 1. Hitung Subtotal dari item
            $subtotal = 0;
            foreach ($validated['items'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            // 2. Tentukan Biaya Lainnya (HARUS sama dengan di frontend)
            $otherFees = 1000; 

            // 3. Hitung Total Final
            $finalTotal = $subtotal + $otherFees;

            // --- AKHIR PERBAIKAN ---
            
            // 4. Buat Pesanan (Order) dengan data pelanggan dan TOTAL YANG BENAR
            $order = Order::create([
                'customer_name'    => $validated['customer']['name'],
                'customer_address' => $validated['customer']['address'],
                'customer_phone'   => $validated['customer']['phone'],
                'payment_method'   => $validated['payment_method'],   // ← save it
                'total_price'      => $finalTotal, // Menggunakan total yang sudah benar
                'status'           => 'pending',
            ]);

            // 5. Buat Item Pesanan (OrderItems)
            foreach ($validated['items'] as $item) {
                $order->orderItems()->create([
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order_id' => $order->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}