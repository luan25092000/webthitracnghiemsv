<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

use App\Models\Result;
use App\Models\Subject;
use App\Models\Theme;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class TestController extends Controller
{

    public function vertify(Subject $subject){
        return view('page.vertify',['data' => $subject]);
    }

    public function create(Request $request){
        
        $model = Subject::with('question')->find($request->id);
        
        if (!Hash::check($request->pass, $model->password)) {
            return redirect()->back()->with("invalid","Mật khẩu không đúng");
        }
        if ($model->theme_id != auth()->user()->theme_id) {
            return redirect()->back()->with("danger","Bạn không thuộc lớp học này!");
        }
       
        $data = [];
        foreach ($model->question as $value) {
            $tamp = [];
            $tamp[0] = [
                'question_id' => $value->id,
                'question' => $value->name,
                'image' => $value->image,
                'video' => $value->video,
                'is_multi' => $value->is_multiple ? true : false
            ];
            foreach ($value->answers as $answer) {
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
            'subject_id' => $model->id,
            'time' => $model->time
        ]);
    }

    public function store(Request $request) {
       
        $data = explode(",", substr($request->result, 0, -1));
        $a = new Result();
        $res = $a->excute($data, $request->subject_id);
        return response()->json([
            "status" => 200,
            "data" => view('page.includes.box', compact('res'))->render()
        ]);
    }

    public function detail($id) {
        $detail = Result::with('subject', 'student', 'questions')->find($id);
        $themes = Theme::withCount('subjects')->get();
        $anotherExamps = Subject::withCount('question')->where('id', '!=', $detail->subject->id)->inRandomOrder()->get();

        return view('page.detail',[
            'detail' => $detail,
            'themes' => $themes,
            'anotherExamps' => $anotherExamps
        ]);
       
    }

}