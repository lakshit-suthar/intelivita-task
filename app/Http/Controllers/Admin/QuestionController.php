<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |  Admin Question Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles question related information functionality for the applications.
    |
     */

    /**
     * Show Questions List
     *
     * @return view
     */
    public function index()
    {
        $questions = Question::with('answers')->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.form');
    }


     /**
     * Store the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'time_limit' => 'required|integer|min:1',
            'answers.*.answer_text' => 'required|string|max:255',
            'answers.*.is_correct' => 'boolean'
        ]);

        $question = Question::create([
            'question_text' => $request->question_text,
            'time_limit' => $request->time_limit
        ]);

        foreach ($request->answers as $answer) {
            $question->answers()->create([
                'answer_text' => $answer['answer_text'],
                'is_correct' => $answer['is_correct'] ?? false
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return view
     */
    public function edit(Question $question)
    {
        $question->load('answers');
        return view('admin.questions.form', compact('question'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'time_limit' => 'required|integer|min:1',
            'answers.*.answer_text' => 'required|string|max:255',
            'answers.*.is_correct' => 'boolean'
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'time_limit' => $request->time_limit
        ]);

        $question->answers()->delete();

        foreach ($request->answers as $answer) {
            $question->answers()->create([
                'answer_text' => $answer['answer_text'],
                'is_correct' => $answer['is_correct'] ?? false
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
    }
}
