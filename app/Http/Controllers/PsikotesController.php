<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\Process\Process;

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

        $data = $request->validate(
            [
                'name'  => ['required','string','min:2','max:20'],
                'email' => ['required','email:rfc,dns','max:100'],
            ],
            // custom messages (Indonesia)
            [
                'name.required'  => 'Nama tidak boleh kosong.',
                'name.min'       => 'Nama minimal 2 karakter.',
                'name.max'       => 'Nama maksimal 20 karakter.',
                'email.required' => 'Email tidak boleh kosong.',
                'email.email'    => 'Format email tidak valid.',
                'email.max'      => 'Email maksimal 100 karakter.',
            ],
            // optional: rename attribute (kalau mau)
            [
                'name'  => 'Nama',
                'email' => 'Email',
            ]
        );

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

        $phase = strtolower($dominant);

        // 1) Ambil semua file video di folder public/video/{phase}
        $dir = public_path("video/{$phase}");
        abort_unless(is_dir($dir), 404, "Folder phase tidak ditemukan: {$dir}");

        $extensions = ['mp4','mov','m4v','webm','mkv'];
        $files = collect(File::files($dir))
            ->filter(fn($f) => in_array(strtolower($f->getExtension()), $extensions))
            ->map(fn($f) => $f->getPathname())
            ->values()
            ->all();

        // 2) Pilih 1 secara acak
        $chosenPath = $files ? Arr::random($files) : null;

        // 3) Konversi absolute path → URL publik (asset)
        $videoUrl = null;
        if ($chosenPath) {
            $relative = ltrim(str_replace(public_path(), '', $chosenPath), DIRECTORY_SEPARATOR);
            $videoUrl = asset($relative);
        }

        // dd($dominant, $percentages, $counts, $total, $desc, array_values($phaseMap));

        return view('result', [
            'dominant'     => $dominant,
            'percentages'  => $percentages,
            'counts'       => $counts,
            'total'        => $total,
            'desc'         => $desc,
            'phases'       => array_values($phaseMap),
            'name'         => session('quiz_name'),
            'video'        => $videoUrl
        ]);
    }

    private function makeOverlayBadge(string $name): string
    {
        $name  = Str::title(trim($name));
        $fontFile = public_path('fonts/caxton-lt-book.TTF');

        // Gaya
        $fontSize   = 48;              // sesuaikan
        $linePadY   = 18;              // padding vertikal
        $gap        = 24;              // jarak setelah badge ke teks ekor
        $badgePadX  = 24;              // padding kiri/kanan di dalam badge
        $badgePadY  = 10;              // padding atas/bawah di dalam badge
        $tailText   = ', kamu sedang dalam fase'; // teks setelah nama
        $textColor  = '#3B84AD';       // biru teks
        $badgeBg    = '#F5A623';       // kuning badge
        $badgeText  = '#ffffff';       // putih teks badge

        // --- Hitung bounding box teks
        $bboxName = imagettfbbox($fontSize, 0, $fontFile, $name);
        $nameW = abs($bboxName[4] - $bboxName[0]);
        $nameH = abs($bboxName[5] - $bboxName[1]);

        $bboxTail = imagettfbbox($fontSize, 0, $fontFile, $tailText);
        $tailW = abs($bboxTail[4] - $bboxTail[0]);
        $tailH = abs($bboxTail[5] - $bboxTail[1]);

        // Ukuran badge + kanvas
        $badgeW = $nameW + ($badgePadX * 2);
        $badgeH = $nameH + ($badgePadY * 2);

        $lineH  = max($badgeH, $tailH) + ($linePadY * 2);
        $canvasW = $badgeW + $gap + $tailW;
        $canvasH = $lineH;

        // Buat kanvas transparan
        $img = Image::canvas($canvasW, $canvasH, [0,0,0,0]);

        // Posisi baseline (vertikal ditengah)
        $yCenter = (int) floor($canvasH / 2);

        // --- Gambar badge (rounded)
        $badgeX = 0;
        $badgeY = (int) ($yCenter - $badgeH / 2);
        // rounded rectangle manual
        $img->rectangle($badgeX, $badgeY, $badgeX + $badgeW, $badgeY + $badgeH, function($draw) use ($badgeBg) {
            $draw->background($badgeBg);
            $draw->border(0, 'transparent');
        });

        // Tulis NAMA di dalam badge
        $nameTextX = $badgeX + $badgePadX;
        // baseline teks: y = center + (height/2) - descent; approximasi gunakan + nameH/2
        $nameTextY = (int)($yCenter + ($nameH/2) - 6);
        $img->text($name, $nameTextX, $nameTextY, function($font) use ($fontFile, $fontSize, $badgeText) {
            $font->file($fontFile);
            $font->size($fontSize);
            $font->color($badgeText);
        });

        // Tulis tail di kanan badge
        $tailX = $badgeX + $badgeW + $gap;
        $tailY = (int)($yCenter + ($tailH/2) - 6);
        $img->text($tailText, $tailX, $tailY, function($font) use ($fontFile, $fontSize, $textColor) {
            $font->file($fontFile);
            $font->size($fontSize);
            $font->color($textColor);
        });

        // Simpan ke file tmp
        $outDir = storage_path('app/tmp');
        if (!is_dir($outDir)) mkdir($outDir, 0775, true);
        $overlayPath = $outDir . '/overlay_' . Str::random(6) . '.png';
        $img->save($overlayPath, 100, 'png');

        return $overlayPath;
    }

    // private function makeOverlayBadge(string $name): string
    // {
    //     $name = Str::title(trim($name) ?: 'Kamu');

    //     $fontFile = public_path('fonts/caxton-lt-book.TTF');
    //     if (!file_exists($fontFile)) {
    //         throw new \RuntimeException("Font tidak ditemukan: {$fontFile}");
    //     }

    //     // Ukuran badge tetap (cocok dengan yang sebelumnya muncul di ffmpeg log)
    //     $width  = 1026;
    //     $height = 105;

    //     // Buat canvas transparan
    //     $img = Image::canvas($width, $height, [0, 0, 0, 0]);

    //     // Warna background & teks
    //     $badgeBg   = '#F5A623';  // kuning
    //     $badgeText = '#FFFFFF';  // putih
    //     $fontSize  = 48;

    //     // Gambar rectangle penuh sebagai badge
    //     $img->rectangle(0, 0, $width, $height, function ($draw) use ($badgeBg) {
    //         $draw->background($badgeBg);
    //         $draw->border(0, 'transparent');
    //     });

    //     // Hitung posisi teks supaya benar-benar center
    //     $bbox = imagettfbbox($fontSize, 0, $fontFile, $name);
    //     $textWidth  = $bbox[2] - $bbox[0];
    //     $textHeight = $bbox[1] - $bbox[7];

    //     $x = ($width  - $textWidth) / 2;
    //     $y = ($height + $textHeight) / 2;

    //     $img->text($name, $x, $y, function ($font) use ($fontFile, $fontSize, $badgeText) {
    //         $font->file($fontFile);
    //         $font->size($fontSize);
    //         $font->color($badgeText);
    //     });

    //     // Simpan ke file tmp
    //     $outDir = storage_path('app/tmp');
    //     if (!is_dir($outDir)) {
    //         mkdir($outDir, 0775, true);
    //     }

    //     $overlayPath = $outDir . '/overlay_' . Str::random(6) . '.png';
    //     $img->save($overlayPath, 100, 'png');

    //     return $overlayPath;
    // }

    public function video(Request $request)
    {
        $name  = $request->input('name', session('quiz_name', 'Kamu'));
        $phase = strtolower($request->phase);

        // --- PATHS ---------------------------------------------------------------
        $publicPathPart = parse_url($request->video, PHP_URL_PATH);
        $template = public_path($publicPathPart);

        $overlayPng = $this->makeOverlayBadge($name);   // wajib return ABSOLUTE path
        $outDir     = public_path('tmp');

        if (!is_dir($outDir)) mkdir($outDir, 0775, true);
        if (!is_writable($outDir)) {
            abort(500, "Folder output tidak writable: {$outDir}");
        }

        $output = $outDir . '/share_' . Str::random(8) . '.mp4';

        // Validasi input
        abort_if(!file_exists($template), 404, "Template video tidak ditemukan: {$template}");
        abort_if(!file_exists($overlayPng), 500, "Overlay PNG tidak ditemukan: {$overlayPng}");

        // --- FILTER: posisi & delay 5 detik -------------------------------------
        // Catatan: Process TIDAK via shell, jadi string ini dikirim utuh ke ffmpeg.
       $filter = '[1:v]scale=1026:105[ov];[0:v][ov]overlay=(main_w-1026)/2:main_h-105-80[vout]';

        // --- PATH ABSOLUT FFMPEG -------------------------------------------------
        $ffmpeg = env('FFMPEG_PATH', '/home/u882139623/bin/ffmpeg');
        if (!is_executable($ffmpeg)) {
            abort(500, "FFmpeg tidak dapat dieksekusi: {$ffmpeg}");
        }

        // --- CMD UTAMA -----------------------------------------------------------
        $cmd = [
            $ffmpeg, '-y',
            '-i', $template,
            '-i', $overlayPng,
            '-filter_complex', $filter,
            '-map', '[vout]', '-map', '0:a?',
            '-c:v', 'libx264',
            '-preset', 'veryfast',
            '-crf', '23',
            '-pix_fmt', 'yuv420p',
            '-r', '30',
            '-c:a', 'aac',
            '-b:a', '128k',
            '-movflags', '+faststart',
            '-shortest',
            '-threads', '1',
            $output,
        ];


        // --- RUN -----------------------------------------------------------------
        $proc = new Process($cmd);
        $proc->setTimeout(300); // 5 menit
        $proc->run();

        // --- Fallback audio: kalau copy gagal (mis. input tidak cocok) ----------
        if ((!$proc->isSuccessful() || !file_exists($output)) && str_contains($proc->getErrorOutput(), 'Output file is empty')) {
            // Ulangi encode audio ke AAC
            @unlink($output);
            $cmdFallback = [
                $ffmpeg, '-y',
                '-i', $template,
                '-i', $overlayPng,
                '-filter_complex', $filter,
                '-map', '[vout]', '-map', '0:a?',
                '-c:v', 'libx264',
                '-pix_fmt', 'yuv420p',
                '-c:a', 'aac', '-b:a', '128k',
                $output,
            ];
            $proc = new Process($cmdFallback);
            $proc->setTimeout(300);
            $proc->run();
        }

        // --- DIAGNOSA ------------------------------------------------------------
        if (!$proc->isSuccessful() || !file_exists($output)) {
            \Log::error('FFmpeg failed', [
                'cmd'   => implode(' ', array_map(fn($a) => (str_contains($a, ' ') ? "\"$a\"" : $a), $cmd)),
                'out'   => $proc->getOutput(),
                'err'   => $proc->getErrorOutput(),
                'exists'=> file_exists($output) ? 'yes' : 'no',
            ]);
            // @unlink($overlayPng); // simpan sementara buat investigasi
            abort(500, "Gagal membuat video. FILTER = ". $filter . "|". $proc->getOutput() ."|". $proc->getErrorOutput());
        }

        // Cleanup overlay sementara
        @unlink($overlayPng);

        // --- KIRIM FILE ----------------------------------------------------------
        return response()->download($output, 'hasil-kamu.mp4')->deleteFileAfterSend(true);
    }

    // public function video(Request $request)
    // {
    //     $name = $request->input('name', session('quiz_name', 'Kamu'));
    //     $phase = strtolower($request->phase);

    //     // --- PATHS ---------------------------------------------------------------
    //     $publicPathPart = parse_url($request->video, PHP_URL_PATH);
    //     // dd($publicPathPart);
    //     $template = public_path($publicPathPart);
    //     // $dir = public_path("video/{$phase}");
    //     // $files = glob($dir.'/*.{mp4,mov,m4v,webm,mkv}', GLOB_BRACE);
    //     // abort_if(empty($files), 404, "Tidak ada file video valid di folder: {$dir}");
    //     // $template = $files[random_int(0, count($files)-1)];
    //     $overlayPng = $this->makeOverlayBadge($name);            // pastikan fungsi ini return ABSOLUTE path PNG
    //     $outDir = public_path('tmp');
    //     if (!is_dir($outDir)) mkdir($outDir, 0775, true);
    //     if (!is_writable($outDir)) {
    //         abort(500, "Folder output tidak writable: {$outDir}");
    //     }

    //     $output = $outDir . '/share_' . Str::random(8) . '.mp4';

    //     // Validasi input
    //     if (!file_exists($template)) {
    //         abort(404, "Template video tidak ditemukan: {$template}");
    //     }
    //     if (!file_exists($overlayPng)) {
    //         abort(500, "Overlay PNG tidak ditemukan: {$overlayPng}");
    //     }

    //     // --- FILTER: posisi & delay 5 detik -------------------------------------
    //     $filter = "[0:v][1:v]overlay=x=(main_w-overlay_w)/2+100:y=main_h*0.78:enable='gte(t,5)'[vout]";

    //     // --- JALANKAN FFMPEG -----------------------------------------------------
    //     $cmd = [
    //         'ffmpeg','-y',
    //         '-i', $template,
    //         '-i', $overlayPng,
    //         '-filter_complex', $filter,
    //         '-map', '[vout]', '-map', '0:a?',   // audio optional
    //         '-c:v', 'libx264',                  // pastikan ada encoder video
    //         '-pix_fmt', 'yuv420p',              // kompatibel player
    //         '-c:a', 'copy',                     // audio langsung copy (cepat)
    //         $output,
    //     ];

    //     $proc = new Process($cmd);
    //     // Jika ffmpeg tidak ada di PATH, set env PATH atau pakai absolute path ffmpeg, mis:
    //     // $proc = new Process(['/usr/bin/ffmpeg', ...]);
    //     $proc->setTimeout(300);
    //     $proc->run();

    //     // --- DIAGNOSA ------------------------------------------------------------
    //     if (!$proc->isSuccessful() || !file_exists($output)) {
    //         \Log::error('FFmpeg failed', [
    //             'cmd'   => implode(' ', $cmd),
    //             'out'   => $proc->getOutput(),
    //             'err'   => $proc->getErrorOutput(),
    //             'exists'=> file_exists($output) ? 'yes' : 'no',
    //         ]);
    //         // Jangan hapus overlay dulu kalau mau cek manual masalahnya
    //         // @unlink($overlayPng);
    //         abort(500, "Gagal membuat video. " . $proc->getErrorOutput());
    //     }

    //     // Cleanup overlay sementara
    //     @unlink($overlayPng);

    //     // --- KIRIM FILE ----------------------------------------------------------
    //     return response()->download($output, 'hasil-kamu.mp4')->deleteFileAfterSend(true);
    // }
}