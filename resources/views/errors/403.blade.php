<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>403 - Akses Ditolak | SMWKP</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #121414;
            color: #e2e2e2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container { text-align: center; padding: 2rem; }
        .code { font-size: 6rem; font-weight: 700; color: #ffb4ab; line-height: 1; }
        .icon { font-size: 64px; color: #ffb4ab; margin: 1rem 0; }
        h1 { font-size: 1.5rem; font-weight: 700; color: #ffb3b2; margin-bottom: 0.5rem; }
        p { color: #a38b8a; font-size: 1rem; margin-bottom: 2rem; max-width: 400px; }
        a {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 24px; background: linear-gradient(to right, #5a0f16, #401015);
            color: #ffb3b2; border-radius: 999px; text-decoration: none;
            font-weight: 600; transition: all 0.2s;
        }
        a:hover { opacity: 0.85; transform: scale(1.02); }
    </style>
</head>
<body>
    <div class="container">
        <div class="code">403</div>
        <span class="material-symbols-outlined icon">lock</span>
        <h1>Akses Ditolak</h1>
        <p>Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login dengan akun yang sesuai.</p>
        <a href="{{ route('login') }}">
            <span class="material-symbols-outlined">login</span>
            Kembali ke Login
        </a>
    </div>
</body>
</html>
