{{-- resources/views/patah-hati/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patah Hati yang Kupilih</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png"
        href="{{ asset('img/SINEMAKU LOGO FULL COLOR_VERTICAL.png') }}">

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Optional font (mirip feel serif elegan) --}}
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  
  <style>
    html, body { height: 100%; }
    :root{
      --brand-blue:#3B84AD;
      --muted:#3B84AD;
      --card-border:#99c8ef;
      --footer-bg:#E9F5FF;
    }

    @font-face {
      font-family: 'caxton-lt-book';
      src: url('/fonts/caxton-lt-book.woff2') format('woff2'),
           url('/fonts/caxton-lt-book.woff')  format('woff');
      font-weight: 400;
      font-style: normal;
      font-display: swap;
    }

    body{
      background:#fff;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
      color:#1b2430;
      overflow-x:hidden;
      opacity:0;
      animation: bodyFadeIn 0.9s ease-out forwards;
      display:flex;
      flex-direction:column;
      min-height:100vh;
    }

    @keyframes bodyFadeIn{
      from{ opacity:0; transform:translateY(8px);}
      to{ opacity:1; transform:translateY(0);}
    }

    /* Logo Sinemaku sebagai logo web di kiri atas */
    .sinemaku-brand{
      position:fixed;
      top:24px;
      left:28px;
      z-index:40;
      display:inline-block;
    }
    .sinemaku-brand img{
      width:180px;       /* desktop */
      height:auto;
      display:block;
    }

    @media (max-width: 768px){
      .sinemaku-brand{
        top:20px;
        left:24px;
      }
      .sinemaku-brand img{
        width:100px;      /* mobile & tablet kecil */
      }
    }

    .hero{
      min-height:auto;
      display:flex;
      align-items:center;
      padding-block: clamp(32px, 6vw, 80px) clamp(48px, 8vw, 100px);
      margin-top: clamp(24px, 5vw, 60px);
    }

    .title{
      font-family:"Roboto", Georgia, serif;
      color:var(--brand-blue);
      line-height:1.05;
      letter-spacing:.3px;
      font-size: clamp(28px, 4.5vw, 44px);
    }

    .subtitle{
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color:var(--brand-blue);
      opacity:0;
      transform:translateY(12px);
      animation: subtitleIn 0.9s ease-out 0.25s forwards;
    }

    .subtitle.h1{ margin-left:0; font-size: clamp(26px, 4vw, 38px); }
    .subtitle.h2{ margin-left:0; font-size: clamp(22px, 3.5vw, 32px); }

    @keyframes subtitleIn{
      to{ opacity:1; transform:translateY(0);}
    }

    /* Area foto */
    .photo-stack{
      position:relative;
      height:520px;
    }

    .main-image{
      max-width: 680px;
      width: 100%;
      height: auto;
      object-fit: contain;
      display: block;
      margin-inline: auto;
      filter: drop-shadow(0 12px 24px rgba(0,0,0,0.18));
      transform: translate3d(0, 10px, 0);
      transition:
        transform 0.7s cubic-bezier(.16,.8,.25,1),
        filter 0.4s ease-out;
      opacity:0;
      animation: heroImageIn 1s cubic-bezier(.16,.8,.25,1) 0.15s forwards;
    }

    @keyframes heroImageIn{
      0%{ opacity:0; transform:translate3d(0, 26px, 0);}
      100%{ opacity:1; transform:translate3d(0, 10px, 0);}
    }

    /* Icon hati patah yang overlap di tengah (kalau dipakai) */
    .broken-heart{
      position:absolute;
      left:340px;
      top:360px;
      width:88px;
      height:88px;
      background: center/contain no-repeat url('{{ asset('storage/patah-hati/heart.svg') }}');
      filter: drop-shadow(0 10px 18px rgba(0,0,0,.20));
      transform: rotate(-6deg) scale(0.8);
      transform-origin:center;
      opacity:0;
      animation: heartPop 0.7s ease-out 0.9s forwards, heartBeat 1.6s ease-in-out 1.6s infinite;
    }

    @keyframes heartPop{
      0%{ opacity:0; transform:translateY(8px) rotate(-10deg) scale(0.6);}
      100%{ opacity:1; transform:translateY(0) rotate(-6deg) scale(1);}
    }

    @keyframes heartBeat{
      0%,100%{ transform:rotate(-6deg) scale(1);}
      50%{ transform:rotate(-5deg) scale(1.06);}
    }

    .lead-copy{
      color:var(--muted);
      font-size: clamp(.98rem, 1.9vw, 1.08rem);
      opacity:0;
      transform:translateY(10px);
      animation: textSoftIn 0.85s ease-out 0.4s forwards;
    }

    @keyframes textSoftIn{
      to{ opacity:1; transform:translateY(0);}
    }

    .btn-primary{
      background:#3B84AD;
      border-color:#3B84AD;
      padding:.775rem 1.6rem;
      font-weight:600;
      border-radius:10px;
      position:relative;
      overflow:hidden;
      box-shadow:0 12px 26px rgba(59,132,173,.28);
      transform:translateY(0) scale(1);
      transition:
        transform 0.22s ease-out,
        box-shadow 0.22s ease-out,
        background-color 0.22s ease-out,
        border-color 0.22s ease-out;
      animation: ctaPulse 2.8s ease-in-out 1.2s infinite;
    }

    .btn-primary::before{
      content:"";
      position:absolute;
      top:0;
      left:-60%;
      width:220%;
      height:100%;
      background: linear-gradient(
        120deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.35) 45%,
        rgba(255,255,255,0.0) 100%
      );
      opacity:0;
      transform:translateX(0);
      transition:opacity .3s ease-out;
      pointer-events:none;
    }

    .btn-primary:hover{
      background:#78bde4;
      border-color:#78bde4;
      transform:translateY(-1px) scale(1.02);
      box-shadow:0 16px 34px rgba(59,132,173,.45);
    }

    .btn-primary:hover::before{
      opacity:1;
      animation: btnShine 0.9s ease-out forwards;
    }

    .btn-primary:active{
      transform:translateY(1px) scale(.99);
      box-shadow:0 8px 18px rgba(59,132,173,.35);
      animation:none;
    }

    @keyframes ctaPulse{
      0%,100%{ transform:translateY(0) scale(1); box-shadow:0 12px 26px rgba(59,132,173,.28);}
      50%{ transform:translateY(-1px) scale(1.015); box-shadow:0 18px 40px rgba(59,132,173,.40);}
    }

    @keyframes btnShine{
      0%{ transform:translateX(0); opacity:0;}
      10%{ opacity:1;}
      100%{ transform:translateX(60%); opacity:0;}
    }

    .hashtag{
      color:#3B84AD;
      font-weight:700;
      letter-spacing:.2px;
    }

    .logo-img{
      width: min(80vw, 500px);
      height: auto;
      filter: drop-shadow(0 10px 20px rgba(0,0,0,0.25));
      opacity:0;
      transform:translateY(14px) scale(1.02);
      animation: logoReveal 1s cubic-bezier(.16,.8,.25,1) 0.25s forwards;
    }

    @keyframes logoReveal{
      0%{ opacity:0; transform:translateY(14px) scale(1.02);}
      100%{ opacity:1; transform:translateY(0) scale(1);}
    }

    .hashtag-img{
      width: min(60vw, 240px);
      height: auto;
      opacity:0;
      transform:translateY(6px);
      animation: hashtagIn 0.5s ease-out 0.5s forwards;
    }

    @keyframes hashtagIn{
      to{ opacity:1; transform:translateY(0);}
    }

    /* Footer strip */
    .phyk-footer{
      background:var(--footer-bg);
      padding:22px 16px 18px;
      text-align:center;
      flex-shrink:0;
      margin-top:0;
    }
    .phyk-footer-inner{
      max-width:720px;
      margin:0 auto;
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:10px;
    }
    .phyk-footer-top{
      display:flex;
      flex-wrap:wrap;
      align-items:center;
      justify-content:center;
      gap:12px;
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color:var(--brand-blue);
    }
    .phyk-footer-top .footer-title{
      display:flex;
      align-items:center;
    }
    .phyk-footer-top .footer-title img{
      height:52px;
      width:auto;
      display:block;
      margin:0;
    }
    .phyk-footer-top .footer-text{
      font-size:1.05rem;
      margin-top:6px;
    }
    .phyk-footer-top .footer-text strong{
      font-weight:600;
    }
    .phyk-footer-hashtag img{
      height:26px;
      width:auto;
      display:block;
      margin-top:4px;
    }

    @media (min-width: 992px){
      .subtitle.h1{ margin-left: 170px; }
      .subtitle.h2{ margin-left: 120px; }
    }

    @media (max-width: 576px){
      .phyk-footer-top .footer-text{ font-size:.9rem;}
      .phyk-footer-hashtag img{ height:22px;}
    }

    @media (max-width: 375px){
      .btn-primary{ width:100%; }
    }

    /* Bungkus konten utama agar tidak ‘makan’ footer */
    main.container.hero{
      flex:1 0 auto;
    }

    /* Tweak khusus mobile untuk jarak foto–judul */
    @media (max-width: 576px){
      .photo-stack{
        height: 280px;
      }
      .hero{
        padding-block: 28px 2px;
        margin-top: 18px;
      }
      .main-image{
        transform: translate3d(0, 6px, 0);
      }
    }

    /* Tweak khusus mobile */
@media (max-width: 576px){
  /* ... aturan lain yang kamu sudah punya ... */

  /* Kecilkan hashtag di atas footer */
  .hashtag-img{
    width: 46vw;      /* sebelumnya min(60vw, 240px) */
    max-width: 160px; /* batas atas biar tidak terlalu besar */
    margin-bottom: 15px;
  }

  /* Hashtag di footer juga sedikit lebih kecil (opsional, boleh di-skip) */
  .phyk-footer-hashtag img{
    height: 20px;
  }
}

  </style>
</head>
<body>

  {{-- Logo Sinemaku di pojok kiri atas halaman --}}
  <a href="javascript:void(0)" class="sinemaku-brand" aria-label="Sinemaku Pictures">
    <img src="{{ asset('img/sinemakulogo-blue.png') }}" alt="Sinemaku Pictures Logo">
  </a>

  <main class="container hero">
    <div class="row align-items-center justify-content-between g-5">

      {{-- Kolom kiri: tumpukan foto --}}
      <div class="col-12 col-lg-7 text-center mb-5 mb-lg-0">
        <div class="photo-stack">
          <img 
            src="{{ asset('img/hero.png') }}" 
            alt="Patah Hati Image"
            class="img-fluid main-image"
            id="heroImage"
          >
        </div>
      </div>

      {{-- Kolom kanan: judul dan tombol --}}
      <div class="col-12 col-lg-5 text-center text-lg-start">
        <h1 class="title display-4 mb-3">
          <img 
            src="{{ asset('img/logo_phyk.png') }}" 
            alt="Logo PHYK"
            class="logo-img"
          >
        </h1>

        <h2 class="subtitle h1 mb-1">Seberapa</h2>
        <h3 class="subtitle h2 mb-4">Patah Hati Kamu?</h3>

        <p class="lead-copy mb-4">
          Cinta selalu datang dalam bentuk yang berbeda. Kadang hangat, kadang samar, kadang menyakitkan.
          Lewat kuis ini, temukan tahapan patah hati yang paling menggambarkan dirimu.
        </p>

        <a href="{{ route('form') }}" class="btn btn-primary btn-lg">Mulai Tes</a>

        <div class="mt-4">
          <img 
            src="{{ asset('img/hashtag.png') }}" 
            alt="Hashtag"
            class="hashtag-img"
          >
        </div>
      </div>
    </div>
  </main>

  {{-- Footer strip --}}
  <footer class="phyk-footer">
    <div class="phyk-footer-inner">
      <div class="phyk-footer-top">
        <div class="footer-title">
          <img src="{{ asset('img/logo_phyk.png') }}" alt="Patah Hati yang Kupilih">
        </div>
        <div class="footer-text">
          Di Bioskop <strong>24 Desember 2025</strong>
        </div>
      </div>
      <div class="phyk-footer-hashtag">
        <img src="{{ asset('img/hashtag.png') }}" alt="#BeraniMelepaskan">
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Parallax lembut pada gambar hero (desktop saja)
    (function(){
      const img = document.getElementById('heroImage');
      if(!img) return;

      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      if(window.innerWidth < 992 || prefersReducedMotion){
        img.style.transform = 'translate3d(0, 10px, 0)';
        return;
      }

      let rect = img.getBoundingClientRect();
      let centerX = rect.left + rect.width / 2;
      let centerY = rect.top + rect.height / 2;

      window.addEventListener('resize', () => {
        rect = img.getBoundingClientRect();
        centerX = rect.left + rect.width / 2;
        centerY = rect.top + rect.height / 2;
      });

      window.addEventListener('mousemove', (e) => {
        const maxMove = 10;
        const relX = (e.clientX - centerX) / rect.width;
        const relY = (e.clientY - centerY) / rect.height;

        const moveX = (maxMove * relX) * -1;
        const moveY = 10 + (maxMove * relY);

        img.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
      });

      window.addEventListener('mouseleave', () => {
        img.style.transform = 'translate3d(0, 10px, 0)';
      });
    })();
  </script>
</body>
</html>
