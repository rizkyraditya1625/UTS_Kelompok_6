<!DOCTYPE html>
<html>
<head><title>Reset Password</title></head>
<body>
    <h1>Permintaan Reset Password</h1>
    <p>Seseorang meminta untuk mereset password akun Anda.</p>
    <p>Klik link di bawah ini untuk membuat password baru:</p>
    
    <a href="{{ url('/reset-password/'.$token.'?email='.$email) }}">
        KLIK DISINI UNTUK RESET PASSWORD
    </a>

    <p>Jika ini bukan Anda, abaikan saja email ini.</p>
</body>
</html>