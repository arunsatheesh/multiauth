<?php
namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $exams = Exam::all();
        //dd($exams);
        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'time' => 'required',
            'completed' => 'required'
        ]);

        Exam::create($request->all());

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam): View
    {
        return view('exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $exam): View
    {
         $exams = Exam::findOrFail($exam->exam);
         //dd($exams);
         $data = [
            'exams' => $exams ];
        return view('exam.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
      //  dd($request->id);
        $request->validate([
            'id' => 'required',
            'title' => 'required|string|max:255',
            'time' => 'required',
            'completed' => 'required'
        ]);
        $exam = Exam::findOrFail($request->id);
        $exam->update($request->all());
        //dd('hi');
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam): RedirectResponse
    {
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }

   
}