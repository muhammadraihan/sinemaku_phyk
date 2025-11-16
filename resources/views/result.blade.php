<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Tes — Patah Hati yang Kupilih</title>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">

  {{-- Styles --}}
  <style>
    :root {
      --brand-blue: #3B84AD;
      --light-blue: #E9F5FF;
      --text-muted: #486680;
    }

    body {
      font-family: Inter, sans-serif;
      background-color: #fff;
      color: var(--text-muted);
      text-align: center;
      margin: 0;
      padding: 40px 16px;
    }

    .result-container {
      max-width: 680px;
      margin: 0 auto;
    }

    .greeting {
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color: var(--brand-blue);
      font-size: 1.5rem;
      margin-bottom: 20px;
    }

    .phase-box {
      background: var(--light-blue);
      border-radius: 12px;
      padding: 20px 16px 30px;
      margin-bottom: 32px;
    }

    .phase-subtitle {
      color: var(--brand-blue);
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .phase-title {
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color: var(--brand-blue);
      font-size: 3rem;
      font-weight: 700;
      margin: 0;
    }

    .phase-desc {
      text-align: left;
      line-height: 1.7;
      color: var(--text-muted);
      font-size: 1rem;
      margin-bottom: 32px;
    }

    .hashtag {
      color: var(--brand-blue);
      font-weight: 700;
      letter-spacing: .2px;
      margin-bottom: 40px;
    }

    /* Pesan spesial */
    .special-box {
      display: flex;
      align-items: center;
      background: var(--light-blue);
      border-radius: 14px;
      padding: 20px;
      gap: 20px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .special-thumb {
      position: relative;
      flex: 0 0 180px;
      aspect-ratio: 1/1;
      background: url('{{ asset('img/video-thumb.png') }}') center/cover no-repeat;
      border-radius: 10px;
    }

    .special-thumb::after {
      content: '▶';
      position: absolute;
      color: white;
      font-size: 2rem;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      text-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }

    .special-text {
      text-align: left;
      flex: 1;
      color: var(--text-muted);
    }

    .special-text h3 {
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color: var(--brand-blue);
      font-size: 1.3rem;
      margin-bottom: 6px;
    }

    /* Tombol */
    .btn {
      display: inline-block;
      background: var(--brand-blue);
      color: white;
      text-decoration: none;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      padding: 14px 32px;
      margin: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 1rem;
    }

    .btn:hover {
      background: #2f6f94;
    }

    @media (max-width: 600px) {
      .phase-title { font-size: 2.2rem; }
      .special-box { flex-direction: column; align-items: center; text-align: center; }
      .special-text { text-align: center; }
    }
  </style>
</head>
<body>

  <div class="result-container">
    {{-- Greeting --}}
    <h2 class="greeting">Hai, {{ $name ?? 'Lorem Ipsum' }}</h2>

    {{-- Phase box --}}
    <div class="phase-box">
      <div class="phase-subtitle">Kamu sedang ada di fase</div>
      <div class="phase-title">{{ strtoupper($phase ?? 'DENIAL') }}</div>
    </div>

    {{-- Description --}}
    <div class="phase-desc">
      {!! nl2br(e($description ?? "Kamu mungkin masih berharap semuanya bisa kembali seperti dulu. Rasanya sulit menerima kenyataan, seolah apa yang terjadi hanyalah mimpi buruk yang segera berlalu.

Tapi ingat, menolak bukan berarti lemah — ini cara hati melindungi diri sebelum siap untuk benar-benar melepaskan.

Pelan-pelan saja. Penerimaan akan datang ketika kamu siap menemuiya.")) !!}
    </div>

    <div class="hashtag">#BeraniMelepaskan</div>

    {{-- Pesan Spesial --}}
    <div class="special-box">
      <div class="special-thumb"></div>
      <div class="special-text">
        <h3>Pesan Spesial dari 👀</h3>
        <p>Biar bisa move on ke fase selanjutnya, yuk lihat video pesan dari seseorang!</p>
      </div>
    </div>

    {{-- Buttons --}}
    <div>
      <a href="{{ route('quiz.start') }}" class="btn">Ulang Tes</a>
      <a href="#" class="btn">Bagikan Hasil</a>
    </div>
  </div>

</body>
</html>
