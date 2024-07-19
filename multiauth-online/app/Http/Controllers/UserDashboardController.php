<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use DB;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function examviews()
    {
       $data = ['exams' => Exam::get() ]; 
      // dd($data);
        return view('exam',$data);
    }
    public function exam( Request $request)
    {
        //dd($request->all);
        $examId = $request->exam;
        $data = ['exams' => DB::table('exams')
            ->join('questions', 'exams.id', '=', 'questions.exam_id')
            ->where('exams.id', $examId)
            ->select('exams.*', 'questions.*')
            ->get() ];
       //dd($data);
        return view('userexam',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function messageviews()
    {
                return view('message');

    }

    /**
     * Store a newly created resource in storage.
     */
  public function resultviews(Request $request)
{
    // Validate the incoming request data
  //  dd($request->exam_id[0]);
    $request->validate([
        'user_id' => 'required',
        'exam_id' => 'required|array',
        'choice' => 'required|array',
        'key' => 'required|array'
    ]);

    // Retrieve all inputs
    $choices = $request->input('choice');
    $keys = $request->input('key');
    //dd($choices);
    // Initialize score
    $score = 0;

    // Get the number of questions (assuming all arrays are the same length)
    $totalQuestions = count($choices);
   // dd($totalQuestions);
    // Loop through each question's data using a for loop
    for ($index = 0; $index < $totalQuestions; $index++) 
    {
        // Get the user's choice and the correct key for the current index
        $userChoice = $choices[$index];
        $correctKey = $keys[$index];
          //  dd($userChoice);

        // Increment the score if the user's choice matches the correct key
        if ($userChoice == $correctKey) {
            $score++;
        }

        // Uncomment this line for debugging (will show score after each iteration)
    }
             $total = ($score/$totalQuestions)*100;
    $total = round($total);
    Result::create([
        'user_id' => $request->input('user_id'),
        'exam' => $request->input('exam_id')[0],
        'score' => $total
    ]);

    // Return the score
        return redirect()->route('userdashboard.examviews')->with('success', 'Exam submitted successfully.');
}

     public function result(Request $request)
    {
             $userId  = $request->user;
             $results = DB::table('results')  // Use the correct table name
                  ->where('user_id', $userId)
                  ->get();  // Retrieve the results 
                  $data= [
                    'results' => $results
                  ];              
                   return view('result',$data);

    }

    
    
}
