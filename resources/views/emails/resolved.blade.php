<!DOCTYPE html>
<html>
<head><title>Laporan Selesai</title></head>
<body>
    <h1>Halo, {{ $details['name'] }}</h1>
    <p>Laporan Anda tentang <strong>{{ $details['item_title'] }}</strong> telah ditandai selesai.</p>
    <p>Diselesaikan oleh: <strong>{{ $details['resolver'] }}</strong></p>
    <p><i>"Laporan sudah terselesaikan. Mohon konfirmasi jika ini kesalahan."</i></p>
    <p>Salam,<br>Admin Lost & Found</p>
</body>
</html>