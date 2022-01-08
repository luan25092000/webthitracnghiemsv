<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index($modelName) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $configs = $model->listingConfigs();
        $records = $model->getRecords();
        // dd($configs[6]['records'][7]);
        
        return view('admin.listing', [
            'user' => $adminUser,
            'records' => $records,
            'configs' => $configs,
            'modelName' => $modelName,
            'title' => $model->title,
        ]);
    }

    public function destroy($modelName, $id) {
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        
        try {
            $model::find($id)->delete();
            return redirect()->route('listing.index', ['model' => $modelName])->with('success','Xoá thành công');
        } catch (\Throwable $th) {
            report($th);
        }
        return redirect()->route('listing.index', ['model' => $modelName])->with('danger','Xoá thất bại');
    }
}
