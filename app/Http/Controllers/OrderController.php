<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        $subtotal         = $cartItems->sum('subtotal');
        $discountSettings = DiscountService::getSettings();
        $discount         = DiscountService::calculateDiscount($subtotal);
        $shippingCost     = $subtotal >= 200000 ? 0 : 50000;
        $total            = $subtotal - $discount + $shippingCost;

        return view('orders.checkout', compact(
            'cartItems', 'subtotal', 'discount', 'shippingCost', 'total', 'discountSettings'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_name'        => 'required|string|max:255',
            'shipping_phone'       => 'required|string|max:20',
            'shipping_address'     => 'required|string',
            'shipping_city'        => 'required|string|max:255',
            'shipping_province'    => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:10',
            'payment_method'       => 'required|string',
            'notes'                => 'nullable|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', "Stok {$item->product->name} tidak mencukupi");
            }
        }

        DB::beginTransaction();
        try {
            $subtotal         = $cartItems->sum('subtotal');
            $discountSettings = DiscountService::getSettings();
            $discount         = DiscountService::calculateDiscount($subtotal);
            $shippingCost     = $subtotal >= 200000 ? 0 : 50000;
            $total            = $subtotal - $discount + $shippingCost;
            $status           = $request->payment_method === 'COD' ? 'shipped' : 'pending';

            $order = Order::create([
                'user_id'              => Auth::id(),
                'order_number'         => Order::generateOrderNumber(),
                'subtotal'             => $subtotal,
                'shipping_cost'        => $shippingCost,
                'discount'             => $discount,
                'total'                => $total,
                'status'               => $status,
                'payment_status'       => 'unpaid',
                'payment_method'       => $request->payment_method,
                'shipping_name'        => $request->shipping_name,
                'shipping_phone'       => $request->shipping_phone,
                'shipping_address'     => $request->shipping_address,
                'shipping_city'        => $request->shipping_city,
                'shipping_province'    => $request->shipping_province,
                'shipping_postal_code' => $request->shipping_postal_code,
                'notes'                => $request->notes,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'price'        => $item->price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => $item->subtotal,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            $msg = $request->payment_method === 'COD'
                ? 'Pesanan berhasil dibuat. Pesanan sedang dalam perjalanan.'
                : 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.';

            return redirect()->route('orders.show', $order)->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        if (!$order->isPending()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan');
        }

        DB::beginTransaction();
        try {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
            $order->update(['status' => 'cancelled']);
            DB::commit();

            return back()->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function complete(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        DB::beginTransaction();
        try {
            $order->update(['status' => 'delivered']);
            DB::commit();

            return back()->with('success', 'Terima kasih, pesanan telah Anda terima.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}
