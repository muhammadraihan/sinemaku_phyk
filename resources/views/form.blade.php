{{-- resources/views/patah-hati/form.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patah Hati yang Kupilih — Data Awal</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --brand: #3B84AD;
      --muted: #6b7a90;
      --card: #f6f8fb;
    }

    body {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      color: #1b2430;
      background: #fff;
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
    }

    .hero-title {
      font-family:"caxton-lt-book", "Times New Roman", serif;
      color: var(--brand);
      line-height: 0.95;
      font-weight: 200;
      font-size: clamp(26px, 3.6vw, 42px);
      letter-spacing: .2px;
      margin-top: 1.5rem;
      margin-bottom: 2rem;
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
    }

    .form-label {
      font-family: "Playfair Display", Georgia, serif;
      font-size: clamp(18px, 1.4vw, 24px);
      color: var(--brand);
      margin-bottom: .35rem;
    }

    .form-control {
      background: var(--card);
      border: 2px solid transparent;
      padding: 0.9rem 1.1rem;
      border-radius: 14px;
      font-weight: 600;
    }
    .form-control::placeholder {
      color: #7f8da3;
      font-weight: 600;
    }
    .form-control:focus {
      border-color: rgba(59,132,173,.45);
      box-shadow: 0 0 0 .2rem rgba(59,132,173,.12);
      background: #fff;
    }

    .btn-pill {
      background: var(--brand);
      border-color: var(--brand);
      border-radius: 999px;
      padding: .9rem 1.8rem;
      font-weight: 700;
      display: block;
      margin-inline: auto;
    }
    .btn-pill:hover {
      background: #5f7fa1;
      border-color: #5f7fa1;
    }

    .privacy {
      color: #8b97aa;
      font-size: .98rem;
      display: flex;
      gap: .5rem;
      align-items: center;
      margin-top: .75rem;
    }

    .hashtag {
      color: var(--brand);
      font-weight: 700;
      letter-spacing: .2px;
      margin-top: 3rem;
    }

    @media (max-width: 576px) {
      .form-card { padding: 1.5rem; }
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
                 placeholder="Nama Kamu" value="{{ old('name') }}" required>
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
          Tenang, data kamu gabakal disebar kok !
        </p>

        <button type="submit" class="btn btn-primary btn-pill">
          Mulai Tes
        </button>
      </form>
    </div>

    {{-- Hashtag --}}
    <div class="text-center">
      <img src="{{ asset('img/hashtag.png') }}" alt="#BeraniMelepaskan" style="width:min(60vw,240px);height:auto; margin-top:20px">
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
