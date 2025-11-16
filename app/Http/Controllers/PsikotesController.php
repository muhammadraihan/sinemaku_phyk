<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PsikotesController extends Controller
{
    private $questions = [
        [
            'text' => 'Kamu lebih suka menghabiskan waktu sendirian atau dengan orang lain?',
            'a' => 'Sendirian',
            'b' => 'Bersama orang lain'
        ],
        [
            'text' => 'Apakah kamu merasa energik setelah berinteraksi dengan banyak orang?',
            'a' => 'Tidak, itu melelahkan',
            'b' => 'Ya, itu menyenangkan'
        ],
        [
            'text' => 'Di pesta, kamu lebih suka...',
            'a' => 'Berbicara dengan satu orang',
            'b' => 'Berbicara dengan banyak orang'
        ],
        [
            'text' => 'Kamu lebih suka bekerja...',
            'a' => 'Sendirian',
            'b' => 'Berdiskusi dalam tim'
        ],
        [
            'text' => 'Kamu merasa lebih fokus saat...',
            'a' => 'Sendirian',
            'b' => 'Ditemani orang lain'
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

        return redirect()->route('quiz.start');
    }

    public function result()
    {
        $answers = session('answers', []);
        if (empty($answers)) {
            return redirect()->route('home');
        }

        $a_count = array_count_values($answers)['a'] ?? 0;
        $b_count = array_count_values($answers)['b'] ?? 0;

        $result = $a_count > $b_count ? 'Introvert' : 'Ekstrovert';
        $desc = $a_count > $b_count ? 'Kamu cenderung introvert. Kamu lebih suka suasana tenang dan reflektif.' : 'Kamu cenderung ekstrovert. Kamu menikmati interaksi sosial dan energik.';

        return view('result', compact('result', 'desc'));
    }
}