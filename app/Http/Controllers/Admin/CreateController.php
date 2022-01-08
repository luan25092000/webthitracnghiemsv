<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateController extends Controller
{
    public function index($modelName) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $configs = $model->creatingConfigs();
        // $dataOrther = '';
        // foreach ($configs as $config) {
        //     if($config['type'] == 'relationship') {
        //         $modelOrther = '\App\Models\\' . $config['model'];
        //         $modelOrther = new $modelOrther;
        //         $dataOrther =  $modelOrther->getRelaRecord();
        //         break;
        //     }
        // }
        return view('admin.creating', [
            'user' => $adminUser,
            'modelName' => $modelName,
            'configs' => $configs,
            'title' => $model->title,
            'descript' => 'Thêm mới',
        ]);
    }

    public function store(Request $request, $modelName) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $configs = $model->creatingConfigs();
        
        $validator = Validator::make($request->all(), $model->rules, $model->messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dataStore = [];
        foreach ($configs as $config) {
            if (!empty($config['creating']) && $config['creating'] == true) {
                switch ($config['type']) {
                    case "file":    
                        if($request->has('file_'.$config['field'])){
                            $file = $config['field'] == 'image'?  $request->file_image : $request->file_video;
                            $extension = $file->extension();
                            $file_name = time().'-'.$config['field'].'.'.$extension;
                            $file->move(public_path('uploads/'.$config['field']),$file_name);
                            $dataStore[$config['field']] =  $file_name;
                        }                            
                        break;
                    case "show_table": 
                            $dataRela = explode(",", substr($request->input($config['field']), 0, -1));
                            $modelOrther =  $model;                    
                        break;
                    case "relationship": 
                            $modelOrther = '\App\Models\\' . $config['model'];
                            $dataRela = [];
                            $modelOrther = new $modelOrther;
                            foreach ($request->except('_token') as $req) {
                                if(!in_array($req, $config['field']))
                                {
                                    foreach ($config['field'] as $field) {
                                        $dataRela[$field] = $request->input($field);
                                    }
                                }
                            } 
                        break;
                    case "ckeditor":                       
                        break;
                    case "password": 
                            $dataStore[$config['field']] = bcrypt($request->input($config['field']));                     
                        break;
                    default:
                            $dataStore[$config['field']] = $request->input($config['field']);
                        break;
                }
            }
        }  
        dd($dataStore);
        $modelAfter = $model::create($dataStore);

        if (!empty($modelOrther)) {
            $dataStoreOrther = $modelOrther->createData($dataRela,$modelAfter->id);
        }
        // if($dataStoreOrther ) {
            return redirect()->back()->with('success','Thêm mới thành công');
        // }     else{
        //     return redirect()->back()->with('success','Dữ liệu bạn nhập vào không thoả');
        // }            
    }
}
