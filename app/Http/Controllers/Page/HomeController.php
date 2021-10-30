<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index() {
        $datas = Theme::withCount('subjects')->get();
        return view('page.index',[
            'datas' => $datas
        ]);
    }

    public function show(Theme $theme) {     
         
        $datas = Subject::withCount('question')->where('theme_id', $theme->id)->get();
        return view('page.subject',[
            'datas' => $datas,
            'title' => $theme->name
        ]);
    }

    
    public function history() {
        $user = Auth::user()->id;
        $records = Result::with('student', 'subject')->where('student_id', $user)->get();  
        // dd(count($records));
        foreach ($records as $record) {
            switch ($record->subject->level) {
                case '1':
                    $record->subject->level = 'Dễ';
                    break;
                case '2':
                    $record->subject->level = 'Trung bình';
                    break;               
                default:
                    $record->subject->level = 'Khó';
                    break;
            }
        }

        return view('page.history', [
            'records' => $records
        ]);
    }
}
