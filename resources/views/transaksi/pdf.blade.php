<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 24px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2c7a4b;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }
        .header img {
            height: 60px;
            margin-bottom: 10px;
        }
        .header h2 {
            color: #2c7a4b;
            margin: 0;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }
        .info {
            margin-bottom: 16px;
        }
        .info p {
            margin: 4px 0;
        }
        .footer {
            border-top: 1px solid #ccc;
            padding-top: 12px;
            font-size: 12px;
            text-align: center;
            color: #999;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- Ganti src dengan path logo asli jika tersedia --}}
            <img src="{{ public_path('logo_tokopedia.png') }}" alt=" PintuDagang">
            <h2>Struk Pembayaran</h2>
        </div>

        <div class="info">
            <div class="section-title">Detail Transaksi</div>
            <p><strong>Kode Produk:</strong> {{ $transaksi->kode_produk }}</p>
            <p><strong>Nama Pembeli:</strong> {{ $transaksi->nama_user }}</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</p>
        </div>

        <div class="info">
            <div class="section-title">Total Pembayaran</div>
            <p><strong>Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</strong></p>
        </div>

        <div class="footer">
            Terima kasih telah berbelanja di TokoKami.<br>
            Struk ini dicetak otomatis dan tidak memerlukan tanda tangan.
        </div>
    </div>
</body>
</html>
