<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->invoice_number }} - {{ $settings->site_name }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-base: #09090b;
            --bg-surface: #18181b;
            --bg-card: rgba(39, 39, 42, 0.4);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --brand-color1: #f43f5e;
            --brand-color2: #8b5cf6;
            --brand-gradient: linear-gradient(135deg, var(--brand-color1), var(--brand-color2));
            --border-subtle: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
        }

        .invoice-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            position: relative;
            overflow: hidden;
        }

        .invoice-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: var(--brand-gradient);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -1px;
        }

        .logo-mark {
            width: 30px;
            height: 30px;
            background: var(--brand-gradient);
            border-radius: 8px;
            display: inline-block;
            transform: rotate(45deg);
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .invoice-meta p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .grid-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-block h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            color: var(--brand-color2);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .info-block p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .info-block strong {
            color: var(--text-primary);
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 5px;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-paid {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .brief-box {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .brief-box h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 8px;
        }

        .brief-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .brief-item span {
            display: block;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 3px;
        }

        .brief-item p {
            font-size: 0.95rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .table-invoice {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table-invoice th, .table-invoice td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-subtle);
        }

        .table-invoice th {
            font-family: 'Outfit', sans-serif;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table-invoice td {
            font-size: 1rem;
        }

        .total-row {
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            font-size: 1.2rem;
        }

        .payment-box {
            background: linear-gradient(to right, rgba(139, 92, 246, 0.1), rgba(244, 63, 94, 0.05));
            border: 1px dashed var(--brand-color2);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 35px;
            text-align: center;
        }

        .payment-box h4 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .bank-details {
            font-family: 'Outfit', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 10px 0;
            color: var(--text-primary);
        }

        .btn-whatsapp {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #25d366;
            color: white;
            padding: 16px;
            border-radius: 12px;
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
            background: #20ba56;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--text-primary);
        }

        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .invoice-meta {
                text-align: center;
            }
            .invoice-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="invoice-card">
            
            <div class="header">
                <a href="/" class="logo-text">
                    <span class="logo-mark"></span> {{ $settings->site_name }}.
                </a>
                
                <div class="invoice-meta">
                    <h1>INVOICE</h1>
                    <p>No: {{ $order->invoice_number }}</p>
                    <p>Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="grid-info">
                <div class="info-block">
                    <h3>Tagihan Kepada</h3>
                    <p><strong>{{ $order->client_name }}</strong></p>
                    <p>Email: {{ $order->client_email }}</p>
                    <p>WhatsApp: {{ $order->client_phone }}</p>
                </div>
                
                <div class="info-block">
                    <h3>Status Transaksi</h3>
                    <div>
                        <span>Pembayaran:</span>
                        <span class="badge {{ $order->payment_status == 'Paid' ? 'badge-paid' : 'badge-pending' }}">
                            {{ $order->payment_status == 'Paid' ? 'LUNAS' : 'PENDING' }}
                        </span>
                    </div>
                    <div style="margin-top: 10px;">
                        <span>Proyek:</span>
                        <span class="badge badge-info">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Brief Details -->
            <div class="brief-box">
                <h3>Brief Desain Logo</h3>
                <div class="brief-grid">
                    <div class="brief-item">
                        <span>Nama Brand</span>
                        <p>{{ $order->logo_name }}</p>
                    </div>
                    <div class="brief-item">
                        <span>Slogan / Tagline</span>
                        <p>{{ $order->tagline ?? '-' }}</p>
                    </div>
                    <div class="brief-item">
                        <span>Pilihan Warna</span>
                        <p>{{ $order->color_preferences ?? 'Bebas / Terserah desainer' }}</p>
                    </div>
                </div>
                <div class="brief-item" style="border-top: 1px solid var(--border-subtle); padding-top: 15px;">
                    <span>Konsep & Filosofi Logo</span>
                    <p style="font-weight: 400; line-height: 1.6; color: var(--text-secondary);">{{ $order->description_philosophy }}</p>
                </div>
            </div>

            <!-- Invoice Table -->
            <table class="table-invoice">
                <thead>
                    <tr>
                        <th>Deskripsi Layanan</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Desain Logo Profesional - Paket {{ $order->package_type }}</strong>
                            <p style="font-size: 0.85rem; color: var(--text-secondary); margin-top: 4px;">
                                Pembuatan logo premium berdasarkan brief yang telah dikirimkan.
                            </p>
                        </td>
                        <td style="text-align: right; vertical-align: middle;">
                            Rp {{ number_format($order->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td style="text-align: right;">Total Tagihan:</td>
                        <td style="text-align: right; color: var(--brand-color1);">
                            Rp {{ number_format($order->price, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            @if($order->payment_status != 'Paid')
                <!-- Payment Instructions -->
                <div class="payment-box">
                    <h4>Instruksi Pembayaran</h4>
                    <p style="color: var(--text-secondary); font-size: 0.95rem;">Silakan melakukan transfer ke rekening resmi kami berikut:</p>
                    <div class="bank-details">
                        {{ $settings->bank_name }} <br>
                        {{ $settings->bank_account_number }}
                    </div>
                    <p style="font-weight: 600; color: var(--text-primary);">A.N. {{ $settings->bank_account_holder }}</p>
                </div>

                <!-- WhatsApp Confirmation Button -->
                <a href="https://wa.me/{{ $settings->contact_whatsapp }}?text=Halo%20Admin%20{{ rawurlencode($settings->site_name) }},%20saya%20ingin%20mengonfirmasi%20pembayaran%20untuk%20Invoice%20{{ $order->invoice_number }}%20atas%20nama%20{{ rawurlencode($order->client_name) }}." target="_blank" class="btn-whatsapp">
                    <i class="fa-brands fa-whatsapp"></i> Konfirmasi Pembayaran via WhatsApp
                </a>
            @else
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 16px; padding: 25px; text-align: center; color: #34d399; font-weight: 600; font-size: 1.1rem;">
                    <i class="fa-solid fa-circle-check"></i> Pembayaran Anda Telah Lunas. Terima Kasih!
                </div>
            @endif

            <div style="text-align: center;">
                <a href="/" class="back-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama</a>
            </div>

        </div>

    </div>

</body>
</html>
