<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (Admin only).
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Order::latest();

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details (Admin only).
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified order status / payment status (Admin only).
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|string|in:Menunggu Pembayaran,Proses Desain,Revisi,Selesai',
            'payment_status' => 'nullable|string|in:Pending,Paid',
        ]);

        $order->update(array_filter($validated));

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Store a newly created order in storage (Client submission).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'package_type' => 'required|string|in:Startup,Professional,Full Identity',
            'logo_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'color_preferences' => 'nullable|string|max:255',
            'description_philosophy' => 'required|string',
        ]);

        // Map price based on package
        $priceMap = [
            'Startup' => 1500000.00,
            'Professional' => 3500000.00,
            'Full Identity' => 8500000.00,
        ];
        $validated['price'] = $priceMap[$validated['package_type']] ?? 0.00;

        // Generate Invoice Number
        do {
            $invoiceNumber = 'INV-' . strtoupper(Str::random(6));
        } while (Order::where('invoice_number', $invoiceNumber)->exists());

        $validated['invoice_number'] = $invoiceNumber;
        $validated['status'] = 'Menunggu Pembayaran';
        $validated['payment_status'] = 'Pending';

        $order = Order::create($validated);

        return redirect()->route('invoice.show', $order->invoice_number);
    }

    /**
     * Display public invoice page for clients.
     */
    public function showInvoice($invoice_number)
    {
        $order = Order::where('invoice_number', $invoice_number)->firstOrFail();
        $settings = SiteSetting::getSettings();
        return view('invoice', compact('order', 'settings'));
    }
}
}
