<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hasil Tes — Patah Hati yang Kupilih</title>
  {{-- Favicon --}}
  <link rel="icon" type="image/png"
        href="{{ asset('img/SINEMAKU LOGO FULL COLOR_VERTICAL.png') }}">

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">

  {{-- Styles --}}
  <style>
    html, body { height: 100%; }
    :root {
  --brand-blue: #3B84AD;
  --light-blue: #E9F5FF;
  --text-muted: #486680;
  --footer-bg:#E9F5FF;
}

    @font-face {
      font-family: 'caxton-lt-book';
      src: url('/fonts/caxton-lt-book.woff')  format('woff');
      font-weight: 400;
      font-style: normal;
      font-display: swap;
    }

    body {
  font-family: "Roboto", sans-serif;
  background-color: #fff;
  color: var(--text-muted);
  text-align: center;
  margin: 0;
  /* hapus padding horizontal di body agar footer biru edge-to-edge */
  padding: 40px 0 0 0;
  overflow-x:hidden;
  display:flex;
  flex-direction:column;
  min-height:100vh;
}

    /* konten utama result */
.result-container {
  max-width: 680px;
  margin: 0 auto 32px auto;
  padding: 0 16px;          /* pindahkan padding ke sini */
  opacity:0;
  transform:translateY(12px);
  transition: opacity .6s ease-out, transform .6s ease-out;
}

.result-container.is-visible {
  opacity:1;
  transform:translateY(0);
}

    .greeting {
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color: var(--brand-blue);
      font-size: 1.5rem;
      margin-bottom: 20px;
      opacity:0;
      transform:translateY(8px);
      animation: greetIn .7s ease-out forwards;
      animation-delay: .1s;
    }

    .phase-box {
      background: var(--light-blue);
      border-radius: 12px;
      padding: 20px 16px 30px;
      margin-bottom: 32px;
      opacity:0;
      transform:translateY(10px) scale(.98);
      animation: phaseBoxIn .7s cubic-bezier(.16,.8,.25,1) forwards;
      animation-delay: .2s;
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
      font-size: 2rem;
      font-weight: 700;
      margin: 0;
    }

    .phase-desc {
      text-align: left;
      line-height: 1.7;
      color: var(--text-muted);
      font-size: 1rem;
      margin-bottom: 32px;
      opacity:0;
      transform:translateY(8px);
      animation: textBlockIn .7s ease-out forwards;
      animation-delay: .35s;
    }

    /* Hashtag sebagai gambar */
    .hashtag-wrap {
      margin-bottom: 40px;
      opacity:0;
      transform:translateY(6px);
      animation: tagIn .6s ease-out forwards;
      animation-delay: .4s;
    }

    .hashtag-img {
      width:min(60vw,240px);
      height:auto;
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
      opacity:0;
      transform:translateY(10px) scale(.98);
      animation: specialIn .7s cubic-bezier(.16,.8,.25,1) forwards;
      animation-delay: .45s;
    }

    .special-thumb {
      position: relative;
      flex: 0 0 180px;
      aspect-ratio: 9/16;
      border-radius: 10px;
      overflow:hidden;
    }

    .special-video {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .special-video::-webkit-media-controls-fullscreen-button {
        display: none !important;
    }

    .special-box:hover .special-thumb::before{
      opacity:1;
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

    /* Copy promo film */
    .promo-copy{
      margin: 6px auto 15px auto;
      max-width: 550px;
      font-size: .90rem;
      color: var(--text-muted);
      line-height: 1.5;
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
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
      transition:
        transform 0.22s ease-out,
        box-shadow 0.22s ease-out,
        background-color 0.22s ease-out;
      font-size: 1rem;
      position:relative;
      overflow:hidden;
      box-shadow:0 10px 24px rgba(59,132,173,.3);
      animation: btnBreath 3.2s ease-in-out 1s infinite;
    }

    .btn::before{
      content:"";
      position:absolute;
      top:0;
      left:-60%;
      width:220%;
      height:100%;
      background:linear-gradient(
        120deg,
        rgba(255,255,255,0) 0%,
        rgba(255,255,255,0.45) 45%,
        rgba(255,255,255,0) 100%
      );
      opacity:0;
      pointer-events:none;
    }

    .btn:hover {
      background: #2f6f94;
      transform:translateY(-1px) scale(1.02);
      box-shadow:0 14px 32px rgba(59,132,173,.4);
    }

    .btn:hover::before{
      opacity:1;
      animation: btnShine 0.9s ease-out forwards;
    }

    .btn:active{
      transform:translateY(1px) scale(.99);
      box-shadow:0 6px 18px rgba(59,132,173,.32);
      animation:none;
    }

    /* jarak ekstra antara buttons dan footer */
.actions-row{
  display:flex;
  justify-content:center;
  align-items:center;
  gap:16px;
  margin-top:8px;
  margin-bottom:22px;        /* tambah jarak dari footer */
}

    /* LOADING OVERLAY */
    .loading-overlay{
      position:fixed;
      inset:0;
      background:rgba(255,255,255,0.96);
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:center;
      z-index:999;
      transition:opacity .4s ease-out, visibility .4s ease-out;
    }

    .loading-overlay.is-hidden{
      opacity:0;
      visibility:hidden;
    }

    .loading-text{
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      color:var(--brand-blue);
      font-size:1.2rem;
      margin-top:18px;
    }

    .loading-sub{
      font-size:.95rem;
      color:var(--text-muted);
      margin-top:6px;
    }

    .loader-ring{
      width:72px;
      height:72px;
      border-radius:50%;
      border:4px solid rgba(59,132,173,.18);
      border-top-color:var(--brand-blue);
      animation: spin 1s linear infinite;
    }

    /* MODAL BAGIKAN HASIL */
    .modal-backdrop{
      position:fixed;
      inset:0;
      background:rgba(5,12,24,.42);
      display:flex;
      justify-content:center;
      align-items:center;
      z-index:1000;
      opacity:0;
      visibility:hidden;
      transition:opacity .22s ease-out, visibility .22s ease-out;
    }

    .modal-backdrop.is-open{
      opacity:1;
      visibility:visible;
    }

    .share-modal{
      background:#ffffff;
      border-radius:18px;
      padding:22px 20px 18px;
      width:min(92vw, 380px);
      box-shadow:0 22px 60px rgba(10,27,52,.38);
      transform:translateY(12px) scale(.96);
      opacity:0;
      transition:opacity .22s ease-out, transform .22s ease-out;
    }

    .modal-backdrop.is-open .share-modal{
      opacity:1;
      transform:translateY(0) scale(1);
    }

    .share-modal-title{
      font-family:"caxton-lt-book", Georgia, "Times New Roman", serif;
      font-size:1.3rem;
      color:var(--brand-blue);
      margin-bottom:4px;
    }

    .share-modal-sub{
      font-size:.95rem;
      color:var(--text-muted);
      margin-bottom:16px;
    }

    .share-modal-options{
      display:flex;
      flex-direction:column;
      gap:10px;
      margin-top:4px;
      margin-bottom:8px;
    }

    .share-option{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:8px;
      padding:12px 14px;
      border-radius:12px;
      background:#F5FAFF;
      border:1px solid #e0ecf8;
      cursor:pointer;
      transition:
        background-color .16s ease-out,
        border-color .16s ease-out,
        transform .12s ease-out,
        box-shadow .16s ease-out;
    }

    .share-option-label{
      text-align:left;
    }

    .share-option-label strong{
      display:block;
      font-size:.98rem;
      color:var(--brand-blue);
    }

    .share-option-icon{
      width:32px;
      height:32px;
      border-radius:999px;
      background:var(--brand-blue);
      display:flex;
      align-items:center;
      justify-content:center;
      color:#fff;
      font-size:.9rem;
      box-shadow:0 8px 18px rgba(59,132,173,.5);
    }

    .share-modal-footer{
      margin-top:8px;
      text-align:right;
    }

    .modal-close-btn{
      background:transparent;
      border:none;
      color:var(--text-muted);
      font-size:.9rem;
      cursor:pointer;
      padding:6px 10px;
    }

    .swal-spinner {
        width: 40px;
        height: 40px;
        border-radius: 999px;
        border: 4px solid #e5e5e5;
        border-top-color: #3085d6;
        animation: spin 0.8s linear infinite;
        margin: 0 auto;
    }

     /* Footer strip */
     /* Footer strip – full width */
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
      margin-top: 4px;
    }

    @media (min-width: 992px){
      .subtitle.h1{ margin-left: 170px; }
      .subtitle.h2{ margin-left: 120px; }
    }

    @media (max-width: 576px){
      .phyk-footer-top .footer-text{ font-size:.9rem;}
      .phyk-footer-hashtag img{ height:22px;}
    }
 /* Bungkus konten utama agar tidak ‘makan’ footer */
 main.container.hero{
  flex:1 0 auto; /* konten utama fleksibel */
}
@media (max-width: 576px){
      .phyk-footer-top .footer-text{ font-size:.9rem;}
      .phyk-footer-hashtag img{ height:22px;}
    }

    @keyframes spin { to{ transform:rotate(360deg); } }
    @keyframes greetIn{ to{ opacity:1; transform:translateY(0); } }
    @keyframes phaseBoxIn{
      0%{ opacity:0; transform:translateY(10px) scale(.98); }
      100%{ opacity:1; transform:translateY(0) scale(1); }
    }
    @keyframes textBlockIn{ to{ opacity:1; transform:translateY(0); } }
    @keyframes tagIn{ to{ opacity:1; transform:translateY(0); } }
    @keyframes specialIn{
      0%{ opacity:0; transform:translateY(10px) scale(.98); }
      100%{ opacity:1; transform:translateY(0) scale(1); }
    }
    @keyframes btnBreath{
      0%,100%{
        transform:translateY(0) scale(1);
        box-shadow:0 10px 24px rgba(59,132,173,.3);
      }
      50%{
        transform:translateY(-1px) scale(1.015);
        box-shadow:0 16px 36px rgba(59,132,173,.42);
      }
    }
    @keyframes btnShine{
      0%{ transform:translateX(0); opacity:0; }
      10%{ opacity:1; }
      100%{ transform:translateX(60%); opacity:0; }
    }

    @media (max-width: 600px) {
      .phase-title { font-size: 2.2rem; }
      .special-box { flex-direction: column; align-items: center; text-align: center; }
      .special-text { text-align: center; }
      .actions-row { flex-direction:column; }
      .share-modal{ width: min(92vw, 380px); }
      .promo-copy{ font-size:.9rem; padding-inline:8px; }
    }

    @media (max-width: 420px) {
      .share-modal{
        width: min(96vw, 326px);
        padding: 16px 6vw 12px;
      }
    }
  </style>
</head>
<body>

  <!-- Loading overlay sebelum hasil muncul -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loader-ring"></div>
    <div class="loading-text">Sedang merangkai patah hati kamu...</div>
    <div class="loading-sub">Tunggu sebentar, kami lagi baca isi hati kamu 💬</div>
  </div>

  <!-- Modal Bagikan Hasil -->
  <div class="modal-backdrop" id="shareModal">
    <div class="share-modal">
      <div class="share-modal-title">Bagikan hasil tes kamu</div>
      <div class="share-modal-sub">Pilih format yang mau kamu bagikan ke teman-teman.</div>

      <div class="share-modal-options">
        <button type="button" class="share-option" data-share="poster">
          <div class="share-option-label">
            <strong>Download Foto</strong>
          </div>
          <div class="share-option-icon">🖼</div>
        </button>

        <button type="button" class="share-option" data-share="video">
          <div class="share-option-label">
            <strong>Download Video</strong>
          </div>
          <div class="share-option-icon">🎬</div>
        </button>
      </div>

      <div class="share-modal-footer">
        <button type="button" class="modal-close-btn" id="shareModalClose">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <div class="result-container" id="resultContainer">
    {{-- Greeting --}}
    <h2 class="greeting">Hai, {{ ucfirst($name) }}</h2>

    {{-- Phase box --}}
    <div class="phase-box">
      <div class="phase-subtitle">Kamu sedang ada di fase</div>
      <div class="phase-title">{{ strtoupper($dominant) }}</div>
    </div>

    {{-- Description --}}
    <div class="phase-desc">
      {!! nl2br(e($desc)) !!}
    </div>

    {{-- Hashtag sebagai gambar --}}
    {{-- <div class="hashtag-wrap">
      <img 
        src="{{ asset('img/hashtag.png') }}" 
        alt="#BeraniMelepaskan"
        class="hashtag-img"
      >
    </div> --}}

    {{-- Pesan Spesial --}}
    <div class="special-box">
      <div class="special-thumb">
        @if(!empty($video))
          {{-- <video class="special-video"
                src="{{ $video }}"
                playsinline
                autoplay
                loop
                controls
                controlsList="nodownload noplaybackrate nofullscreen"
                disablepictureinpicture>
            Maaf, browser kamu tidak mendukung video tag.
          </video> --}}
          <video class="special-video"
                src="{{ $video }}"
                playsinline
                webkit-playsinline
                autoplay
                muted
                loop
                controls
                controlsList="nodownload noplaybackrate nofullscreen"
                disablepictureinpicture>
          </video>

        @else
          <div class="no-video">Video belum tersedia untuk fase ini.</div>
        @endif
      </div>
      <div class="special-text">
        <h3>Pesan Spesial dari 👀</h3>
        <p>Biar bisa move on ke fase selanjutnya, yuk lihat video pesan dari seseorang!</p>
      </div>
    </div>

    {{-- Copy promo film --}}
    <p class="promo-copy">
      Saksikan kisah cinta Ben &amp; Alya hanya di bioskop mulai 24 Desember 2025.
    </p>

    {{-- Buttons --}}
    <div class="actions-row">
      <a href="{{ route('home') }}" class="btn">Ulang Tes</a>

      <button type="button" class="btn" id="shareOpenBtn">
        Download Hasil
      </button>
    </div>
  </div>

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

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
          integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var LOADING_DURATION = 2000;

    $(window).on('load', function () {
      var $overlay = $('#loadingOverlay');
      var $result  = $('#resultContainer');

      setTimeout(function () {
        $overlay.addClass('is-hidden');
        $result.addClass('is-visible');
      }, LOADING_DURATION);
    });

    // Modal Bagikan Hasil
    (function () {
      var $modal   = $('#shareModal');
      var $openBtn = $('#shareOpenBtn');
      var $closeBtn= $('#shareModalClose');

      if (!$modal.length || !$openBtn.length || !$closeBtn.length) return;

      function openModal()  { $modal.addClass('is-open'); }
      function closeModal() { $modal.removeClass('is-open'); }

      $openBtn.on('click', openModal);
      $closeBtn.on('click', closeModal);

      $modal.on('click', function (e) {
        if ($(e.target).is($modal)) closeModal();
      });

      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
      });

      $modal.find('.share-option').on('click', function () {
        var type = $(this).data('share');

        if (type === 'poster') {
          console.log('Bagikan Poster');

          var name     = "{{ \Illuminate\Support\Str::title($name ?? session('quiz_name')) }}";
          var dominant = "{{ $dominant }}"; // fase (ACCEPTANCE, DENIAL, dll)

          Swal.fire({
              title: 'Sedang menyiapkan poster...',
              html: `
                  <div class="swal-spinner"></div>
                  <p style="margin-top:12px;font-size:14px;">
                      Mohon tunggu sebentar, kami sedang membuat poster fase kamu.
                  </p>
              `,
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
              // didOpen: () => {
              //     Swal.showLoading();
              // }
          });

          $.ajax({
              url: "{{ route('share.poster') }}",
              method: "POST",
              data: {
                  name:  name,
                  phase: dominant
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              xhrFields: {
                  responseType: 'blob'
              }
          })
          .done(function (blob, status, xhr) {
              var filename    = 'poster-' + dominant.toLowerCase() + '.jpg';
              var disposition = xhr.getResponseHeader('Content-Disposition');

              if (disposition && disposition.indexOf('filename=') !== -1) {
                  var matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                  if (matches != null && matches[1]) {
                      filename = matches[1].replace(/['"]/g, '');
                  }
              }

              var url = window.URL.createObjectURL(blob);
              var a   = document.createElement('a');
              a.href = url;
              a.download = filename;
              document.body.appendChild(a);
              a.click();
              a.remove();
              window.URL.revokeObjectURL(url);

              Swal.fire({
                  icon: 'success',
                  title: 'Poster siap di-download! 🎉',
                  html: 'Silakan cek hasil unduhan di perangkat kamu.',
                  confirmButtonText: 'Oke'
              });
          })
          .fail(function (xhr) {
              console.error(xhr);

              let msg = 'Gagal membuat poster.';
              // if (xhr && xhr.responseText) {
              //     msg += '<br><small>' + $('<div>').text(xhr.responseText).html() + '</small>';
              // }

              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  html: msg
              });
          });
        }

        if (type === 'video') {
          console.log('Bagikan Video');

          var name = "{{ \Illuminate\Support\Str::title($name ?? session('quiz_name')) }}";
          var dominant = "{{ $dominant }}";
          var video = "{{ $video }}";

          Swal.fire({
              title: 'Sedang menyiapkan video...',
              html: `
                  <div class="swal-spinner"></div>
                  <p style="margin-top:12px;font-size:14px;">
                      Mohon tunggu sebentar, kami sedang membuat video hasil psikotes kamu.
                  </p>
              `,
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
          });

          console.log('Bagikan Video');

          var name     = "{{ \Illuminate\Support\Str::title($name ?? session('quiz_name')) }}";
          var dominant = "{{ $dominant }}";
          var video    = "{{ $video }}";

          Swal.fire({
              title: 'Sedang menyiapkan video...',
              html: `
                  <div class="swal-spinner"></div>
                  <p style="margin-top:12px;font-size:14px;">
                      Mohon tunggu sebentar, kami sedang membuat video hasil psikotes kamu.
                  </p>
              `,
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });

          // --- Kirim lewat form POST biasa (tanpa AJAX) ---
          var form = document.createElement('form');
          form.method = 'POST';
          form.action = "{{ route('share.video') }}";
          form.target = '_blank'; // buka di tab baru, biar halaman result tetap

          // CSRF
          var csrf = document.createElement('input');
          csrf.type  = 'hidden';
          csrf.name  = '_token';
          csrf.value = $('meta[name="csrf-token"]').attr('content');
          form.appendChild(csrf);

          // name
          var inputName = document.createElement('input');
          inputName.type  = 'hidden';
          inputName.name  = 'name';
          inputName.value = name;
          form.appendChild(inputName);

          // phase
          var inputPhase = document.createElement('input');
          inputPhase.type  = 'hidden';
          inputPhase.name  = 'phase';
          inputPhase.value = dominant;
          form.appendChild(inputPhase);

          // video
          var inputVideo = document.createElement('input');
          inputVideo.type  = 'hidden';
          inputVideo.name  = 'video';
          inputVideo.value = video;
          form.appendChild(inputVideo);

          document.body.appendChild(form);
          form.submit();
          form.remove();

          // Setelah submit, kita ganti popup supaya user nggak bingung
          Swal.fire({
              icon: 'info',
              title: 'Video sedang di-download',
              html: 'Jika belum muncul, cek tab baru atau prompt download dari browser kamu.',
              confirmButtonText: 'Oke'
          });
        }

        closeModal();
      });
    })();

    function isSafari() {
        return /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    }

  </script>
</body>
</html>
