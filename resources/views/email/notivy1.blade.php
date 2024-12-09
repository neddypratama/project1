<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Revisi APAR</title>
</head>
<body>
    <h1>Notifikasi Revisi APAR</h1>
    <p>Data APAR sudah revisi dari {{ $details['user'] }}.</p>
    <ul>
        <li>APAR ID: {{ $details['apar_id'] }}</li>
        <li>Tanggal Direvisi: {{ $details['tanggal'] }}</li>
        <li>Status: {{ $details['status'] }}</li>
    </ul>
    <p>Silakan cek sistem untuk detail lebih lanjut.</p>
</body>
</html>
