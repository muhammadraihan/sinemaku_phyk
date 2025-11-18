<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      padding: 40px 16px;
      overflow-x:hidden;
    }

    .result-container {
      max-width: 680px;
      margin: 0 auto;
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
      /* background: url('{{ asset('img/video-thumb.png') }}') center/cover no-repeat; */
      border-radius: 10px;
      overflow:hidden;
    }

    .special-thumb::after {
      position: absolute;
      color: white;
      font-size: 2rem;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      text-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }

    .special-thumb::before{
      content:"";
      position:absolute;
      inset:0;
      background: radial-gradient(circle at 20% 0, rgba(255,255,255,.45), transparent 60%);
      mix-blend-mode:soft-light;
      opacity:0;
      transition:opacity .3s ease-out;
    }

    .special-video {
      width: 100%;
      height: 100%;
      object-fit: cover; /* penuh & ter-crop rapi */
      display: block;
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

    .actions-row{
      display:flex;
      justify-content:center;
      align-items:center;
      gap:16px;
      margin-top:8px;
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

    .share-option-label span{
      display:block;
      font-size:.86rem;
      color:var(--text-muted);
    }

    .share-option:hover{
      background:var(--light-blue);
      border-color:#cfdff2;
      transform:translateY(-1px);
      box-shadow:0 10px 26px rgba(15,35,64,.18);
    }

    .share-option:active{
      transform:translateY(0);
      box-shadow:none;
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

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes spin{ to{ transform:rotate(360deg); } }
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
    }

    /* Responsive tweak for mobile view */
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
      <div class="share-modal-title">Bagikan hasil kamu</div>
      <div class="share-modal-sub">Pilih format yang mau kamu bagikan ke teman-teman.</div>

      <div class="share-modal-options">
        <button type="button" class="share-option" data-share="poster">
          <div class="share-option-label">
            <strong>Bagikan Poster</strong>
          </div>
          <div class="share-option-icon">🖼</div>
        </button>

        <button type="button" class="share-option" data-share="video">
          <div class="share-option-label">
            <strong>Bagikan Video</strong>
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
    <div class="hashtag-wrap">
      <img 
        src="{{ asset('img/hashtag.png') }}" 
        alt="#BeraniMelepaskan"
        class="hashtag-img"
      >
    </div>

    {{-- Pesan Spesial --}}
    <div class="special-box">
      <div class="special-thumb">
        @if(!empty($video))
          <video class="special-video"
                src="{{ $video }}"
                playsinline
                autoplay
                loop
                controls
                controlsList="nodownload noplaybackrate nofullscreen"
                disablepictureinpicture>
            Maaf, browser kamu tidak mendukung video tag.
          </video>
        @else
          {{-- Fallback jika tidak ada video --}}
          <div class="no-video">Video belum tersedia untuk fase ini.</div>
        @endif
      </div>
      <div class="special-text">
        <h3>Pesan Spesial dari 👀</h3>
        <p>Biar bisa move on ke fase selanjutnya, yuk lihat video pesan dari seseorang!</p>
      </div>
    </div>

    {{-- Buttons --}}
    <div class="actions-row">
      <a href="{{ route('home') }}" class="btn">Ulang Tes</a>

      <button type="button" class="btn" id="shareOpenBtn">
        Bagikan Hasil
      </button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
          integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var LOADING_DURATION = 2000;

    // saat window selesai load
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

      // buka/tutup
      $openBtn.on('click', openModal);
      $closeBtn.on('click', closeModal);

      // klik area gelap menutup modal
      $modal.on('click', function (e) {
        if ($(e.target).is($modal)) closeModal();
      });

      // ESC untuk menutup
      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
      });

      // Aksi pilihan share
      $modal.find('.share-option').on('click', function () {
        var type = $(this).data('share');

        if (type === 'poster') {
          console.log('Bagikan Poster');
          // TODO: logika share poster di sini
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
              // didOpen: () => {
              //     Swal.showLoading();
              // }
          });

          $.ajax({
            url: "{{ route('share.video') }}",
            method: "POST",
            data: { 
              name: name ,
              phase: dominant,
              video: video
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: { responseType: 'blob' } // penting agar terima blob
          })
          // .done(function (blob) {
          //   var url = window.URL.createObjectURL(blob);
          //   var a   = document.createElement('a');
          //   a.href = url;
          //   a.download = 'hasil-kamu.mp4';
          //   document.body.appendChild(a);
          //   a.click();
          //   a.remove();
          //   window.URL.revokeObjectURL(url);
          // })
          // .fail(function () {
          //   alert('Gagal membuat video');
          // });
          .done(function (blob, status, xhr) {

              // ambil nama file dari header kalau ada
              var filename = 'hasil-kamu.mp4';
              var disposition = xhr.getResponseHeader('Content-Disposition');
              if (disposition && disposition.indexOf('filename=') !== -1) {
                  var matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                  if (matches != null && matches[1]) {
                      filename = matches[1].replace(/['"]/g, '');
                  }
              }

              // 2) Buat URL blob dan trigger download
              var url = window.URL.createObjectURL(blob);
              var a   = document.createElement('a');
              a.href = url;
              a.download = filename;
              document.body.appendChild(a);
              a.click();
              a.remove();
              window.URL.revokeObjectURL(url);

              // 3) Ganti popup jadi sukses
              Swal.fire({
                  icon: 'success',
                  title: 'Video siap di-download! 🎉',
                  html: 'Silakan cek hasil unduhan di perangkat kamu.',
                  confirmButtonText: 'Oke'
              });
          })
          .fail(function (xhr) {
              console.error(xhr);

              let msg = 'Gagal membuat video.';
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

        closeModal();
      });
    })();
  </script>
</body>
</html>
