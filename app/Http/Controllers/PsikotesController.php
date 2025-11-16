<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PsikotesController extends Controller
{
    private $questions = [
        [
            'text' => 'Saat hubunganmu berakhir, apa hal pertama yang kamu rasakan?',
            'a' => 'Nggak mungkin. ini cuma salah paham.',
            'b' => 'Kenapa dia tega banget sama aku?!',
            'c' => 'Kalah aku berubah, mungkin dia bakal balik.',
            'd' => 'Kayanya aku ngga akan bisa bahagia lagi',
            'e' => 'Mungkin ini memang jalan terbaik.'
        ],
        [
            'text' => 'Ketika temanmu menasehati untuk "move on", kamu...',
            'a' => 'Aku ngga butuh nasihat, aku cuma pengen dia balik.',
            'b' => 'Mereka ngga ngerti sakitnya aku.',
            'c' => 'Oke, aku coba tapi tolong bantu aku buat hubungin dia sekali lagi.',
            'd' => 'Move on tuh susah, aku capek nangis.',
            'e' => 'Aku tahu ini proses, pelan-pelan saja'
        ],
        [
            'text' => 'Apa yang paling sering kamu lakukan belakangan ini?',
            'a' => 'Menunggu pesan darinya.',
            'b' => 'Menghapus semua foto sambil nangis marah.',
            'c' => 'Menulis chat panjang tapi ngga pernah dikirim.',
            'd' => 'Mendengarkan lagu sedih tiap malam.',
            'e' => 'Menata hidup lagi dan fokus ke diri sendiri'
        ],
        [
            'text' => 'Kalau lihat dia dengan orang baru, kamu...',
            'a' => 'Pura-pura ngga lihat.',
            'b' => 'Langsung kesal dan ingin konfrontasi.',
            'c' => 'Berpikir, "Mungkin aku masih punya kesempatan."',
            'd' => 'Ngga bisa berhenti membandingkan diri.',
            'e' => 'Ikhlas, meski masih sedikit perih.'
        ],
        [
            'text' => 'Kalimat mana yang paling menggambarkan isi hatimu sekarang?',
            'a' => 'Ini cuma mimpi buruk, kan?',
            'b' => 'Kenapa harus aku yang ditinggal?',
            'c' => 'Tuhan, kalau aku sabar, apa dia balik?',
            'd' => 'Aku udah ngga punya semangat.',
            'e' => 'Aku masih sedih, tapi aku percaya akan baik-baik aja.'
        ],
        [
            'text' => 'Saat mengingat kenangan bersamanya, kamu...',
            'a' => 'Menolak memikirkan itu, karena terlalu sakit.',
            'b' => 'Marah karena merasa dibohongi.',
            'c' => 'Berandai-andai bisa memperbaiki semuanya.',
            'd' => 'Menangis tanpa alasan jelas.',
            'e' => 'Tersenyum, tanda kamu sudah berdamai.'
        ],
        [
            'text' => 'Apa arti "patah hati" buat kamu?',
            'a' => 'Hal yang belum bisa aku terima.',
            'b' => 'Rasa sakit yang bikin aku benci.',
            'c' => 'Kesempatan buat belajar agar ngga salah lagi.',
            'd' => 'Titik terendah dalam hidupku.',
            'e' => 'Bagian dari perjalanan menjadi lebih kuat.'
        ],
        [
            'text' => 'Kalau dikasih kesempatan bicara sekali lagi, kamu bakal bilang apa?',
            'a' => 'Aku tahu kamu masih sayang, kan?',
            'b' => 'Kenapa kamu lukai aku segini dalamnya?',
            'c' => 'Bisakah kita coba sekali lagi?',
            'd' => 'Aku ngga tahu harus bilang apa.',
            'e' => 'Terima kasih, semoga kamu bahagia.'
        ],
        [
            'text' => 'Apa yang paling kamu butuhkan sekarang?',
            'a' => 'Waktu untuk menolak kenyataan.',
            'b' => 'Pelampiasan untuk kemarahan.',
            'c' => 'Kesempatan untuk memperbaiki diri.',
            'd' => 'Pelukan dan rasa aman.',
            'e' => 'Kedamaian dan penerimaan.'
        ],
        [
            'text' => 'Kalau bisa kirim pesan terakhir untuk dia, kamu akan bilang...',
            'a' => 'Aku tahu kamu masih sayang, kan?',
            'b' => 'Kenapa kamu tega ninggalin aku segini dalamnya?',
            'c' => 'Kalau aku berubah, kamu mau balik lagi ngga?',
            'd' => 'Aku ngga tahu harus bilang apa, semuanya terlalu berat.',
            'e' => 'Terima kasih, semoga kamu bahagia, aku uda ikhlas.'
        ],
    ];

    public function index()
    {
        return view('index');
    }

    public function questions()
    {
        session()->forget('answers');
        $question = $this->questions[0];
        $total = count($this->questions);
        return view('questions', compact('question', 'total'));
    }

    public function store(Request $request)
    {
        $answer = $request->input('answer');
        $answers = session('answers', []);
        $answers[] = $answer;
        session(['answers' => $answers]);

        $currentIndex = count($answers);

        if ($currentIndex >= count($this->questions)) {
            return response()->json(['redirect' => route('result')]);
        }

        $nextQuestion = $this->questions[$currentIndex];
        return response()->json([
            'question' => $nextQuestion,
            'current' => $currentIndex + 1,
        ]);
    }

    public function store_form(Request $request)
    {
        // dd($request->all());
        // $answer = $request->input('answer');
        // $answers = session('answers', []);
        // $answers[] = $answer;
        // session(['answers' => $answers]);

        // $currentIndex = count($answers);

        // if ($currentIndex >= count($this->questions)) {
        //     return response()->json(['redirect' => route('result')]);
        // }

        // $nextQuestion = $this->questions[$currentIndex];
        // return response()->json([
        //     'question' => $nextQuestion,
        //     'current' => $currentIndex + 1,
        // ]);

        session(['quiz_name' => $request->name]);
        return redirect()->route('quiz.start');
    }

    public function result()
    {
        $answers = session('answers', []);
        if (empty($answers)) {
            return redirect()->route('home');
        }

        // $a_count = array_count_values($answers)['a'] ?? 0;
        // $b_count = array_count_values($answers)['b'] ?? 0;
        // $c_count = array_count_values($answers)['c'] ?? 0;
        // $d_count = array_count_values($answers)['d'] ?? 0;
        // $e_count = array_count_values($answers)['e'] ?? 0;

        // $result = $a_count > $b_count ? 'Introvert' : 'Ekstrovert';
        // $desc = $a_count > $b_count ? 'Kamu cenderung introvert. Kamu lebih suka suasana tenang dan reflektif.' : 'Kamu cenderung ekstrovert. Kamu menikmati interaksi sosial dan energik.';

        // return view('result', compact('result', 'desc'));

        // Hitung jumlah A–E (pastikan semua key ada meski 0)
        $rawCounts = array_count_values($answers);
        $counts = array_merge(['a'=>0,'b'=>0,'c'=>0,'d'=>0,'e'=>0], $rawCounts);

        // Peta huruf → fase
        $phaseMap = [
            'a' => 'Denial',
            'b' => 'Anger',
            'c' => 'Bargaining',
            'd' => 'Depression',
            'e' => 'Acceptance',
        ];

        // Tentukan fase dominan (jika seri, ambil yang paling kiri: A>B>C>D>E)
        $maxCount   = max($counts);
        $topLetters = array_keys(array_filter($counts, fn($v) => $v === $maxCount));
        $order      = ['a','b','c','d','e'];
        usort($topLetters, fn($x,$y) => array_search($x,$order) <=> array_search($y,$order));
        $chosen     = $topLetters[0];
        $dominant   = $phaseMap[$chosen];

        // Persentase per fase
        $total = count($answers);
        $percentages = [];
        foreach ($phaseMap as $letter => $phaseName) {
            $percentages[$phaseName] = $total ? round(($counts[$letter] / $total) * 100) : 0;
        }

        $descs = [
            'Denial'      => 'Kamu mungkin masih berharap semuanya bisa kembali seperti dulu. Rasanya sulit menerima kenyataan, seolah apa yang terjadi hanyalah mimpi buruk yang segera berlalu.

Tapi ingat, menolak bukan berarti lemah - ini cara hati melindungi diri sebelum siap untuk benar-benar melepaskan.

Pelan-pelan saja. Penerimaan akan datang ketika kamu siap menemuinya.',
            'Anger'       => 'Amarah sering datang dari cinta yang pernah tulus. Kamu mungkin merasa kecewa, dikhianati, atau tak adil atas apa yang terjadi.

Tak apa untuk marah. Yang penting, jangan biarkan amarah itu melukai dirimu sendiri. Biarkan ia lewat, agar ruang di hatimu bisa terisi hal-hal yang lebih tenang nanti.

Ungkapkan perasaanmu dengan cara yang aman. Kadang, melepaskan adalah bentuk kasih sayang pada diri sendiri.',
            'Bargaining'  => 'Pikiranmu mungkin terus berputar mencari cara agar semuanya bisa diperbaiki. Kamu berharap ada sesuatu yang bisa diubah—padahal yang kamu butuhkan bukan jawaban, melainkan penerimaan.

Ini fase di mana hati sedang belajar melepaskan kendali dan mempercayai proses penyembuhan.

Kamu sudah berusaha sebaik mungkin. Sekarang, waktunya mengikhlaskan yang tak bisa diulang.',
            'Depression'  => 'Kadang, hidup cuma minta kamu untuk berhenti sebentar. Untuk bernafas, untuk merasakan semua yang sempat kamu tahan. Tapi percayalah, bahkan di dalam kesedihan, kamu sedang tumbuh menjadi lebih kuat.

Tidak apa-apa untuk berhenti sejenak. Pulih bukan tentang cepat, tapi tentang perlahan yang jujur.

Beri ruang untuk dirimu beristirahat. Kamu tidak sendirian dalam rasa ini.',
            'Acceptance'  => 'Kamu telah melewati banyak hal, dan kini kamu mulai melihat semuanya dengan mata yang baru. Tidak berarti lupa, tapi kamu sudah belajar menerima.

Penerimaan bukan akhir dari cerita, melainkan awal bab yang baru—yang kamu tulis sendiri dengan lebih tenang.

Terima kasih sudah bertahan sejauh ini. Langkah berikutnya milikmu sepenuhnya.',
        ];
        $desc = $descs[$dominant] ?? '';

        // dd($dominant, $percentages, $counts, $total, $desc, array_values($phaseMap));

        return view('result', [
            'dominant'     => $dominant,
            'percentages'  => $percentages,
            'counts'       => $counts,
            'total'        => $total,
            'desc'         => $desc,
            'phases'       => array_values($phaseMap),
            'name'         => session('quiz_name')
        ]);
    }
}