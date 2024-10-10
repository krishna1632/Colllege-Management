<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;


class QuestionController extends Controller
{
    /**
     * Display a listing of the questions.
     */
    public function index($quiz_id)
    {
        $questions = Question::where('quiz_id', $quiz_id)->get();
        return view('admin.questions.index', compact('questions', 'quiz_id'));
    }

    /**
     * Show the form for creating a new question.
     */
    public function create($quiz)
    {
        $quiz = Quiz::findOrFail($quiz); // Quiz ko find karna
        return view('admin.questions.create', compact('quiz')); // 'quiz' variable ko pass karna
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_text.*' => 'required',
            'options.*' => 'required|array',
            'correct_option' => 'required|string',
        ]);

        foreach ($request->question_text as $key => $question_text) {
            Question::create([
                'quiz_id' => $request->quiz_id,
                'question_text' => $question_text,
                'options' => json_encode($request->options[$key]),
                'correct_option' => $request->correct_option[$key] ?? null,
            ]);
        }

        // Redirect to Page 3 (Question list page)
        return redirect()->route('admin.questions.index', $request->quiz_id)->with('success', 'Question added successfully.');
    }

    /**
     * Display the specified question.
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified question.
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question_text' => 'required',
            'options' => 'required|array',
            'correct_option' => 'required|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question_text' => $request->question_text,
            'options' => json_encode($request->options),
            'correct_option' => $request->correct_option,
        ]);

        return redirect()->route('questions.index', $question->quiz_id)->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $quiz_id = $question->quiz_id;
        $question->delete();

        return redirect()->route('questions.index', $quiz_id)->with('success', 'Question deleted successfully.');
    }
}