{{-- resources/views/patah-hati/form.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patah Hati yang Kupilih — Data Awal</title>
  {{-- Favicon --}}
  <link rel="icon" type="image/png"
        href="{{ asset('img/SINEMAKU LOGO FULL COLOR_VERTICAL.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --brand: #3B84AD;
      --muted: #6b7a90;
      --card: #f6f8fb;
    }

    @font-face {
      font-family: 'caxton-lt-book';
      src: url('/fonts/caxton-lt-book.woff2') format('woff2'),
           url('/fonts/caxton-lt-book.woff')  format('woff');
      font-weight: 400;
      font-style: normal;
      font-display: swap;
    }

    body {
      font-family: "Roboto", system-ui, -apple-system, Segoe UI, Arial;
      color: #1b2430;
      background: #fff;
      opacity:0;
      animation: pageFadeIn 0.7s ease-out forwards;
    }

    @keyframes pageFadeIn{
      from{
        opacity:0;
        transform:translateY(8px);
      }
      to{
        opacity:1;
        transform:translateY(0);
      }
    }

    .wrap {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding-block: clamp(40px, 6vw, 80px);
      text-align: center;
    }

    .brand-mark {
      width: min(60vw, 280px);
      height: auto;
      opacity:0;
      transform:translateY(12px) scale(1.02);
      filter: drop-shadow(0 10px 24px rgba(0,0,0,.15));
      animation: logoIn 0.9s cubic-bezier(.16,.8,.25,1) 0.1s forwards;
    }

    @keyframes logoIn{
      0%{
        opacity:0;
        transform:translateY(12px) scale(1.02);
      }
      100%{
        opacity:1;
        transform:translateY(0) scale(1);
      }
    }

    .hero-title {
      font-family:"caxton-lt-book", "Times New Roman", serif;
      color: var(--brand);
      line-height: 0.95;
      font-weight: 200;
      font-size: clamp(13px, 2.8vw, 28px);
      letter-spacing: .2px;
      margin-top: 1.5rem;
      margin-bottom: 2rem;
      opacity:0;
      transform:translateY(10px);
      animation: titleIn 0.9s ease-out 0.25s forwards;
    }

    @keyframes titleIn{
      to{
        opacity:1;
        transform:translateY(0);
      }
    }

    .form-card {
      background: #fff;
      border: 1px solid #e7eef7;
      border-radius: 16px;
      padding: clamp(18px, 2.2vw, 28px);
      box-shadow: 0 10px 28px rgba(16, 37, 66, .08);
      width: min(90%, 480px);
      margin-inline: auto;
      text-align: left;
      opacity:0;
      transform:translateY(18px);
      animation: cardIn 0.9s cubic-bezier(.16,.8,.25,1) 0.3s forwards;
    }

    @keyframes cardIn{
      0%{
        opacity:0;
        transform:translateY(18px);
      }
      100%{
        opacity:1;
        transform:translateY(0);
      }
    }

    .form-label {
      font-family: "Roboto", Georgia, serif;
      font-size: clamp(12px, 1vw, 18px);
      color: var(--brand);
      margin-bottom: .35rem;
    }

    .form-control {
      background: var(--card);
      border: 2px solid transparent;
      padding: 0.9rem 1.1rem;
      border-radius: 14px;
      font-weight: 500;
      font-size: 0.95rem;
      line-height: 1.3;
      transition:
        background-color 0.2s ease-out,
        border-color 0.2s ease-out,
        box-shadow 0.2s ease-out,
        transform 0.16s ease-out;
    }

    .form-control::placeholder {
      color: #9aa6ba;
      font-weight: 400;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: rgba(59,132,173,.45);
      box-shadow: 0 0 0 .2rem rgba(59,132,173,.12);
      background: #fff;
      outline: none;
      transform:translateY(-1px);
    }

    .form-control.is-invalid {
      border-color: #dc3545;
      background:#fff;
    }

    .btn-pill {
      background: var(--brand);
      border-color: var(--brand);
      border-radius: 999px;
      padding: .9rem 1.8rem;
      font-weight: 700;
      display: block;
      margin-inline: auto;
      position:relative;
      overflow:hidden;
      box-shadow:0 10px 24px rgba(59,132,173,.28);
      transform:translateY(0) scale(1);
      transition:
        transform 0.22s ease-out,
        box-shadow 0.22s ease-out,
        background-color 0.22s ease-out,
        border-color 0.22s ease-out;
      animation: btnBreath 3s ease-in-out 1s infinite;
    }

    .btn-pill::before{
      content:"";
      position:absolute;
      top:0;
      left:-60%;
      width:220%;
      height:100%;
      background:linear-gradient(
        120deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.4) 45%,
        rgba(255,255,255,0) 100%
      );
      opacity:0;
      pointer-events:none;
    }

    .btn-pill:hover {
      background: #5f7fa1;
      border-color: #5f7fa1;
      transform:translateY(-1px) scale(1.02);
      box-shadow:0 14px 30px rgba(59,132,173,.38);
    }

    .btn-pill:hover::before{
      opacity:1;
      animation: btnShine 0.85s ease-out forwards;
    }

    .btn-pill:active{
      transform:translateY(1px) scale(.99);
      box-shadow:0 6px 16px rgba(59,132,173,.3);
      animation:none;
    }

    @keyframes btnBreath{
      0%,100%{
        transform:translateY(0) scale(1);
        box-shadow:0 10px 24px rgba(59,132,173,.28);
      }
      50%{
        transform:translateY(-1px) scale(1.015);
        box-shadow:0 16px 34px rgba(59,132,173,.40);
      }
    }

    @keyframes btnShine{
      0%{
        transform:translateX(0);
        opacity:0;
      }
      10%{
        opacity:1;
      }
      100%{
        transform:translateX(60%);
        opacity:0;
      }
    }

    .privacy {
      color:rgb(200, 205, 213);
      font-size: .92rem;
      display: flex;
      gap: .5rem;
      align-items: center;
      margin-top: .75rem;
    }

    /* hashtag: animasi sama dengan index */
    .hashtag-img{
      width:min(60vw,240px);
      height:auto;
      margin-top:20px;
      opacity:0;
      transform:translateY(6px);
      animation: hashtagIn 0.5s ease-out 0.5s forwards;
    }

    @keyframes hashtagIn{
      to{
        opacity:1;
        transform:translateY(0);
      }
    }

    @media (max-width: 576px) {
      .form-card { padding: 1.5rem; }
      .privacy { font-size: 0.85rem; }
    }

    @media (max-width: 576px) {
  .btn-pill {
    font-size: .78rem;
    padding: .58rem 0.3rem;
    min-width: 100px;
    max-width: 150px;
    width: auto;
    border-radius: 22px;
    letter-spacing: 0.03em;
  }
  .hashtag-img {
    width: 130px !important;
    min-width: 0;
    margin-top: 15px;
  }
}

  </style>
</head>
<body>

  <main class="wrap">
    {{-- Bagian atas: logo + judul --}}
    <img src="{{ asset('img/logo_phyk.png') }}" alt="Patah Hati yang Kupilih" class="brand-mark">
    <h1 class="hero-title">
      Sebelum memulai tes,<br>
      masukin nama dan email kamu ya!
    </h1>

    {{-- Bagian bawah: form --}}
    <div class="form-card">
      <form method="POST" action="{{ route('store.form') }}" novalidate>
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
          <label for="name" class="form-label">Nama</label>
          <input type="text" id="name" name="name"
                 class="form-control form-control-lg @error('name') is-invalid @enderror"
                 placeholder="Nama panggilan kamu" value="{{ old('name') }}" required>
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email"
                 class="form-control form-control-lg @error('email') is-invalid @enderror"
                 placeholder="email@xxx.com" value="{{ old('email') }}" required>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Privacy note --}}
        <p class="privacy mb-4">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="12" cy="12" r="11" stroke="#A7B3C6" stroke-width="2"/>
            <path d="M12 8.2a1.2 1.2 0 1 0 0-2.4 1.2 1.2 0 0 0 0 2.4Zm0 2.3a1 1 0 0 0-1 1v6.3a1 1 0 1 0 2 0v-6.3a1 1 0 0 0-1-1Z" fill="#A7B3C6"/>
          </svg>
          Tenang, data kamu gak bakal disebar kok !
        </p>

        <button type="submit" class="btn btn-primary btn-pill">
          Mulai Tes
        </button>
      </form>
    </div>

    {{-- Hashtag --}}
    <div class="text-center">
      <img 
        src="{{ asset('img/hashtag.png') }}" 
        alt="#BeraniMelepaskan"
        class="hashtag-img"
      >
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
