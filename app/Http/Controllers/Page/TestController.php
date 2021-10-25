<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(){
        $user_id = 1;  //Auth::user()->name
        $results = Result::where('student_id', $user_id)->get();
        dd($results);
    }

    public function create(){
        $subject_id = 8;
        $a = DB::table('question_mapping')
                ->join('questions', 'questions.id', '=', 'question_mapping.question_id')
                ->inRandomOrder()
                ->where('subject_id', $subject_id)
                ->get();
        $data = [];
        foreach ($a as $key=>$value) {
            $tamp = [];
            $answers = Answer::where('question_id', $value->question_id)->get();
            $tamp[0] = [
                'question_id' => $value->id,
                'question' => $value->name,
                'is_multi' => $value->is_multiple ? true : false
            ];
            foreach ($answers as $anw => $answer) {
                $tamp[] = [
                    'answer_id' => $answer->id,
                    'answer'=> $answer->description
                ];
            }
            $data[] = ($tamp);
        }      
        $question = json_encode($data);
        return view('page.test',[
            'questions' => $question, 
            'subject_id' => $subject_id
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $data = explode(",", substr($request->input('result'), 0, -1));
        $a = new Result();
        $b = $a->excute($data, $request->input('subject_id'));
        return ;
    }

    public function show($id) {
        $results = DB::table('result_mapping')->where('result_id', $id)->get();
        $questions = Question::all();
        return view('page.history',[
            'results' => $results,
            'questions' => $questions
        ]);
    }
}