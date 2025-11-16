<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Psikotes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container result-container">
        <h1>Hasil Psikotes</h1>
        <div class="result-box">
            <h2>Kamu adalah seorang <span class="highlight">{{ $result }}</span></h2>
            <p>{{ $desc }}</p>
        </div>
        <a href="{{ route('home') }}" class="btn-restart">Ulangi Tes</a>
    </div>
</body>
</html>