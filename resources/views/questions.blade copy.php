<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Psikotes Kepribadian</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Psikotes Kepribadian</h1>
        <p>Pilih jawaban yang paling sesuai dengan dirimu!</p>

        <div id="question-container">
            <div class="question-card">
                <h2>{{ $question['text'] }}</h2>
                <div class="options">
                    <button class="option-btn" data-value="a">{{ $question['a'] }}</button>
                    <button class="option-btn" data-value="b">{{ $question['b'] }}</button>
                </div>
            </div>
        </div>

        <div id="progress">
            <span id="current">1</span> / <span id="total">{{ $total }}</span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentQuestion = 0;
        const totalQuestions = {{ $total }};
        let answers = [];

        $(document).ready(function() {
            $('.option-btn').on('click', function() {
                const selected = $(this).data('value');
                $.post('{{ route("store.answer") }}', {
                    '_token': '{{ csrf_token() }}',
                    'answer': selected
                }, function(res) {
                    if (res.redirect) {
                        window.location.href = res.redirect;
                    } else {
                        currentQuestion++;
                        $('#current').text(res.current);

                        // Animasi fade out
                        $('.question-card').hide(250, function() {
                            // Ganti konten
                            $('.question-card h2').text(res.question.text);
                            $('.option-btn').eq(0).text(res.question.a).data('value', 'a');
                            $('.option-btn').eq(1).text(res.question.b).data('value', 'b');

                            // Tampilkan kembali
                            $('.question-card').show(250);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>