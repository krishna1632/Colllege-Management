<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class QuizController extends Controller
{
    // Display a listing of the quizzes
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    // Show the form for creating a new quiz
    public function create()
    {
        return view('admin.quizzes.create');
    }

    // Store a newly created quiz in storage
    public function store(Request $request)
    {
        $request->validate([
            'test_name' => 'required',
            'test_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive',
        ]);

        // Create the quiz data array
        $quizData = [
            'test_name' => $request->test_name,
            'test_date' => $request->test_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ];

        // Store in session
        Session::put('quiz_data', $quizData);

        // Generate a unique quiz ID (temporary, for session usage)
        $quizId = uniqid(); // Use any method to generate a temporary ID
        Session::put('quiz_id', $quizId);

        // Redirect to questions index with temporary quiz ID
        return redirect()->route('admin.questions.index', ['quiz' => $quizId])->with('success', 'Quiz created successfully. Now you can add questions.');
    }

    // Display the specified quiz
    public function show(Quiz $quiz)
    {
        return view('admin.quizzes.show', compact('quiz'));
    }

    // Show the form for editing the specified quiz
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    // Update the specified quiz in storage
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'test_name' => 'required',
            'test_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive',
        ]);

        $quiz->update([
            'test_name' => $request->test_name,
            'test_date' => $request->test_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    // Remove the specified quiz from storage
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully.');
    }



    public function finalSubmit($quiz_id)
    // {
    //     // Quiz final submit logic, like marking it as complete or processing further
    //     // After processing, redirect to the quiz listing page (Page 1)
    //     return redirect()->route('admin.quizzes.index')->with('success', 'Quiz submitted successfully.');
    // }..
    {
        // Retrieve quiz data and quiz ID from session
        $quizData = Session::get('quiz_data');
        $quizId = Session::get('quiz_id');

        // Create the quiz in the database
        $quiz = Quiz::create($quizData);

        // Clear the session
        Session::forget('quiz_data');
        Session::forget('quiz_id');

        // Redirect to the quiz listing page
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz submitted successfully.');
    }
}