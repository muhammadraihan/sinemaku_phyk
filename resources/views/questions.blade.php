{{-- resources/views/patah-hati/quiz.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pertanyaan — Patah Hati yang Kupilih</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Fonts & CSS --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/quiz-phyk.css') }}">
</head>
<body>
  <main class="quiz-wrap container">

    {{-- Header progress + logo --}}
    <header class="quiz-head">
      <div class="progress-meta" id="progressText">
        {{ $current ?? 1 }} dari {{ $total }}
      </div>
      <div class="progress-rail" aria-hidden="true">
        <div class="progress-fill" id="progressFill" style="width: {{ (($current ?? 1)/$total)*100 }}%"></div>
      </div>
      <img src="{{ asset('img/logo_phyk.png') }}" alt="Patah Hati yang Kupilih" class="brand-top">
    </header>

    {{-- Kartu pertanyaan --}}
    <section class="question-shell">
      <div class="question-card" id="qCard">
        <h2 class="q-title">
          {{ $question['text'] }}
        </h2>

        <ul class="q-options" id="qOptions">
          @php
            // dukung format lama (a,b,c,...) dan format baru (options array)
            $opts = $question['options'] ?? array_filter([
              $question['a'] ?? null,
              $question['b'] ?? null,
              $question['c'] ?? null,
              $question['d'] ?? null,
              $question['e'] ?? null,
            ]);
          @endphp

          @foreach($opts as $idx => $opt)
            @php $letter = chr(65 + $idx); @endphp
            <li class="q-option">
              <div class="opt-letter">{{ $letter }}.</div>
              <button class="opt-btn"
                      data-value="{{ strtolower($letter) }}">{{ $opt }}</button>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="hashtag-wrap">
        <img src="{{ asset('img/hashtag.png') }}" alt="#BeraniMelepaskan" class="hashtag-img">
      </div>
    </section>

  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    const totalQuestions = {{ $total }};
    let current = {{ $current ?? 1 }};

    function updateProgress(n){
      document.getElementById('progressText').textContent = `${n} dari ${totalQuestions}`;
      document.getElementById('progressFill').style.width = (n/totalQuestions*100) + '%';
    }

    $(document).on('click', '.opt-btn', function(){
      const selected = $(this).data('value');

      $.post('{{ route("store.answer") }}', {
        _token: '{{ csrf_token() }}',
        answer: selected
      }, function(res){
        if(res.redirect){
          window.location.href = res.redirect;
          return;
        }

        // update progress (res.current adalah nomor soal yang sedang ditampilkan)
        current = res.current;
        updateProgress(current);

        // animasi ganti konten
        $('#qCard').fadeOut(180, function(){
          // judul
          $('.q-title').text(res.question.text);

          // rebuild options
          const options = res.question.options ?? [res.question.a, res.question.b, res.question.c, res.question.d, res.question.e].filter(Boolean);
          let html = '';
          options.forEach((txt, i) => {
            const letter = String.fromCharCode(65 + i);
            html += `
              <li class="q-option">
                <div class="opt-letter">${letter}.</div>
                <button class="opt-btn" data-value="${letter.toLowerCase()}">${txt}</button>
              </li>`;
          });
          $('#qOptions').html(html);

          $('#qCard').fadeIn(180);
        });
      });
    });
  </script>
</body>
</html>
