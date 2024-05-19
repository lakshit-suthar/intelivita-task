<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult;
use App\Models\Question;

class TestController extends Controller
{   

    /*
    |--------------------------------------------------------------------------
    |  User Test Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles Test related information functionality for the applications.
    |
     */

    /**
     * Start the Test
     *
     * @return view
     */
    public function start()
    {
        return view('test.start');
    }

    /**
     * Get Question
     *
     * @return json
     */
    Public function getQuestions()
    {
        $questions = Question::with('answers')->get();
        return response()->json($questions);
    }
    
    /**
     * Store the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function submit(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'question_id' => 'required|integer',
            'answer_id' => 'required|integer',
        ]);

        // Process the submitted answer
        $testResult = new TestResult;
        $testResult->user_id = auth()->id();
        $testResult->question_id = $validatedData['question_id'];
        $testResult->answer_id = $validatedData['answer_id'];
        $testResult->save();

        // Return a response
        return response()->json(['message' => 'Answer submitted successfully']);
    }


    /**
     * Thank You Page
     *
     * @return view
     */
    public function thankYou()
    {
        return view('test.thank-you');
    }


    /**
     * Get Test Result
     *
     * @return json
     */
    public function getResult()
    {
        $userId = auth()->id();
        $results = TestResult::with(['question', 'answer'])
            ->where('user_id', $userId)
            ->get();

        $totalQuestions = $results->count();
        $correctAnswers = $results->filter(function ($result) {
            return $result->answer->is_correct;
        })->count();

        $percentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

        $detailedResults = $results->map(function($result) {
            return [
                'question_text' => $result->question->question_text,
                'answer_text' => $result->answer->answer_text,
                'is_correct' => $result->answer->is_correct
            ];
        });

        return response()->json([
            'results' => $detailedResults,
            'percentage' => $percentage
        ]);
    }

}
