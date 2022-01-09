<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class EditController extends Controller
{
    public function index($modelName, $id) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $data = $model::find($id);
        $configs = $model->creatingConfigs();
        
        $dataOrther = '';
        foreach ($configs as $config) {
            if($config['type'] == 'relationship'|| $config['type'] == 'count') {
                $modelOrther = '\App\Models\\' . $config['model'];
                $modelOrther = new $modelOrther;
                $dataOrther =  $modelOrther->getRelaRecord($id);
                break;
            }
        }

        return view('admin.creating', [
            'user' => $adminUser,
            'modelName' => $modelName,
            'data' => $data,
            'dataOrther' => $dataOrther,
            'configs' => $configs,
            'title' => $model->title,
            'descript' => 'Thay đổi',
        ]);
    }

    public function update(Request $request, $modelName, $id) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $configs = $model->creatingConfigs();
        
        $validator = Validator::make($request->all(), $model->rulesUpdate($id), $model->messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dataStore = [];
        $dataRela = [];
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
                    case "count":                       
                        break;
                    case "show_table": 
                        $dataRela =  explode(",", substr($request->input($config['field']), 0, -1));
                        $dataStoreOrther = $model->updateData($dataRela, $id);         
                        break;    
                    case "relationship": 
                        $modelOrther = '\App\Models\\' . $config['model'];
                        $modelOrther = new $modelOrther;
                        foreach ($request->except('_token') as $req) {
                            if(!in_array($req, $config['field']))
                            {
                                foreach ($config['field'] as $field) {
                                    $dataRela[$field] = $request->input($field);
                                }
                            }
                        } 
                        $dataStoreOrther = $modelOrther->updateData($dataRela, $id);
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
        
        $model::where('id', $id)->update($dataStore);
        
        return redirect()->route('listing.index',['model' => $modelName])->with('success','Thay đổi thành công');
    }
}
