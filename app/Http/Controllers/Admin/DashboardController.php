<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Room;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardController extends Controller
{
    public function index(){
        $adminUser = Auth::guard('admin')->user();
        $modelName = 'result';
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
            'modelName' => $modelName,
            'title' => $model->title,
        ]);
    }
    public function rank(){
        $rooms = Room::all();
        return view('admin.rank', [
            'rooms' => $rooms
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
    public function profile(){
        return view('admin.profile');
    }
   
}
