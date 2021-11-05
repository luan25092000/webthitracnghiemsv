<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class DashboardController extends Controller
{
    public function index(){
        $adminUser = Auth::guard('admin')->user();
        $model = new Result();
        $configs = $model->listingConfigs();
        $records = $model->getRecords();        
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

        return view('admin.listing', [
            'user' => $adminUser,
            'records' => $records,
            'configs' => $configs,
            'modelName' => 'result',
            'title' => $model->title,
        ]);
    }
    public function rank(){
        $themes = Theme::all();
        return view('admin.rank', [
            'themes' => $themes
        ]);
    }

    public function showTable(Request $request){      
        // return $request->subject_id;
        $data = Result::with('student')
            ->where('subject_id', $request->subject_id)
            ->get();
        return $data;
    } 
    public function getData(Request $request){
        $data = Subject::where('theme_id', $request->id)->get();
        return $data;
    }
    public function profile(Result $result, $rank){
        return view('admin.profile',[
            'result' => $result,
            'rank'   => $rank
        ]);
    }

    public function import(Request $request) 
    {
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return redirect()->back()->with('success', 'Import thành công');
    }
   
}
