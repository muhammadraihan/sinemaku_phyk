{{-- resources/views/patah-hati/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patah Hati yang Kupilih</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Optional font (mirip feel serif elegan) --}}
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root{
      --brand-blue:#3B84AD;    /* judul */
      --muted:#3B84AD;         /* paragraf */
      --card-border:#99c8ef;   /* outline foto */
    }

    body{
      background:#fff;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
      color:#1b2430;
      overflow-x:hidden;
    }

    .hero{
      min-height:auto;              /* biar konten tidak "ketarik" di HP */
      display:flex;
      align-items:center;
      padding-block: clamp(32px, 6vw, 80px) clamp(48px, 8vw, 100px);
      margin-top: clamp(24px, 5vw, 60px);
    }

    .title{
      font-family:"Playfair Display", Georgia, serif;
      color:var(--brand-blue);
      line-height:1.05;
      letter-spacing:.3px;
      font-size: clamp(28px, 4.5vw, 44px); /* fluid type */
    }

    .subtitle{
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color:var(--brand-blue);
    }

    .subtitle.h1{ margin-left:0; font-size: clamp(26px, 4vw, 38px); }
    .subtitle.h2{ margin-left:0; font-size: clamp(22px, 3.5vw, 32px); }

    /* Kartu foto miring dengan outline biru lembut */
    .photo-stack{
      position:relative;
      height:520px;
    }
    .main-image{
      max-width: 680px;  /* batas desktop */
      width: 100%;
      height: auto;
      object-fit: contain;
      display: block;
      margin-inline: auto;
      filter: drop-shadow(0 12px 24px rgba(0,0,0,0.18));
    }


    /* Icon hati patah yang overlap di tengah */
    .broken-heart{
      position:absolute;
      left:340px;
      top:360px;
      width:88px;
      height:88px;
      background: center/contain no-repeat url('{{ asset('storage/patah-hati/heart.svg') }}');
      filter: drop-shadow(0 10px 18px rgba(0,0,0,.20));
      transform: rotate(-6deg);
    }

    .lead-copy{
      color:var(--muted);
      font-size: clamp(.98rem, 1.9vw, 1.08rem);
    }

    .btn-primary{
      background:#3B84AD;
      border-color:#3B84AD;
      padding:.775rem 1.6rem;
      font-weight:600;
      border-radius:10px;
    }
    .btn-primary:hover{ background:#78bde4; border-color:#78bde4; }

    .hashtag{
      color:#3B84AD;
      font-weight:700;
      letter-spacing:.2px;
    }

    .logo-img{
      width: min(80vw, 500px);  /* 80% viewport di HP, max 500px di desktop */
      height: auto;
    }

    .hashtag-img{
      width: min(60vw, 240px);
      height: auto;
    }

    /* Responsif */
   /* --- Desktop tweaks (hanya aktif >= 992px) --- */
    @media (min-width: 992px){
      .subtitle.h1{ margin-left: 170px; }
      .subtitle.h2{ margin-left: 120px; }
    }

    /* --- Optional: sedikit kompak di layar sangat kecil --- */
    @media (max-width: 375px){
      .btn-primary{ width:100%; }
    }
  </style>
</head>
<body>

  <main class="container hero">
    <div class="row align-items-center justify-content-between g-5">

      {{-- Kolom kiri: tumpukan foto --}}
      <div class="col-12 col-lg-7 text-center mb-5 mb-lg-0">
        <img 
          src="{{ asset('img/hero.png') }}" 
          alt="Patah Hati Image"
          class="img-fluid main-image"
        >
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
