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
        $datas = Theme::withCount('subjects')->search()->paginate(12);
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
        $levels = [
            1 => 'Dễ',
            2 => 'Trung bình',
            3 => 'Khó',
        ];
        // dd($records);
        return view('page.history', [
            'records' => $records,
            'levels' => $levels
        ]);
    }
}
