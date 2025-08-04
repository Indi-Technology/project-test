<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            border: 1px solid #ddd;
        }
        .welcome-message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .company-info {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat Datang!</h1>
    </div>
    
    <div class="content">
        <div class="welcome-message">
            <strong>Halo {{ $company->name }}!</strong>
        </div>
        
        <p>Selamat! Company Anda telah berhasil didaftarkan di platform kami. Kami sangat senang memiliki Anda sebagai bagian dari komunitas kami.</p>
        
        <div class="company-info">
            <h3>📋 Informasi Company Anda:</h3>
            <ul>
                <li><strong>Nama Company:</strong> {{ $company->name }}</li>
                <li><strong>Email:</strong> {{ $company->email }}</li>
                @if($company->website)
                <li><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></li>
                @endif
                <li><strong>Tanggal Bergabung:</strong> {{ $company->created_at->format('d F Y') }}</li>
            </ul>
        </div>
        
        <p><strong>Langkah Selanjutnya:</strong></p>
        <ul>
            <li>✅ Lengkapi profil company Anda</li>
            <li>✅ Tambahkan karyawan pertama Anda</li>
            <li>✅ Jelajahi fitur-fitur yang tersedia</li>
            <li>✅ Hubungi tim support jika membutuhkan bantuan</li>
        </ul>
        
        @if($company->website)
        <div style="text-align: center;">
            <a href="{{ $company->website }}" class="btn">Kunjungi Website Anda</a>
        </div>
        @endif
        
        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim support kami.</p>
        
        <p>Terima kasih telah bergabung dengan kami!</p>
        
        <p>Salam hangat,<br>
        <strong>Tim {{ config('app.name') }}</strong></p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.</p>
        <p>Email ini dikirim secara otomatis, mohon jangan membalas email ini.</p>
    </div>
</body>
</html>
