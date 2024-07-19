<?php
namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
       // dd($id);
        $id = $request->query('id');
         $exams = Exam::findOrFail($id); // Retrieve exam by ID from database

         $questions = Question::where('exam_id', $exams->id)->get();
         $data = [
        'exams' => $exams,
        'questions' => $questions
    ];

        return view('questions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        //dd($request->query('exams'));
         $exams = Exam::findOrFail($request->query('exams'));
         $data = [
            'exams' => $exams
         ];
        return view('questions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'exam_id' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
             'key' => 'required'
        ]);

        $question=Question::create($request->all());

        return redirect()->route('questions.index', ['id' => $question->exam_id])->with('success', 'Question created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question): View
    {
       // dd($question);
        $data = [
            'question' => $question ];
        return view('questions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'exam_id' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
             'key' => 'required'        ]);

        $question->update($request->all());

        return redirect()->route('questions.index', ['id' => $question->exam_id])->with('success', 'Question created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam, Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->route('exams.questions.index', $exam)->with('success', 'Question deleted successfully.');
    }
}
