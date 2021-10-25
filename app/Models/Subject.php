<?php

namespace App\Models;
use \App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Question
{
    use HasFactory;
    protected $table = 'subjects';
    public $title = "Quản lý đề thi";
    protected $fillable = [
        'name',
        'level',
        'description',
        'user_id',
        'time',
        'password',
        'theme_id',
        'level'
    ];

    public $rules = [
        'name'    => 'required',
        'description' => 'required|max:255',
        'password' => 'required',
        'theme_id' => 'required',
        'time' => 'required',
        'question_ids' => 'required|nullable',
        'level' => 'required',
    ];
    public function rulesUpdate($id){        
        return $rules = [
            'name'    => 'required',
            'email' => 'required|unique:admins,email,'.$id,
            'password' => 'required',
        ];
    }
    public $messages = [
            'name.required' => 'Tên đề thi không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'description.max' => 'Mỏ tả quá dài! tối đa 255 ký tự',
            'password.required' => 'Password không được để trống',
            'theme_id.required' => 'Trường lớp học không được để trống',
            'time.required' => 'Thời gian làm bài không được để trống',
            'question_ids.required' => 'Vui lòng chọn câu hỏi',
            'level.required' => 'Vui lòng chọn cấp độ cho bài thi',
            'question_ids.nullable' => 'Vui lòng chọn câu hỏi',
        ];

    public function createData($dataArr, $subject_id) {  
        $data = [];      
        foreach ($dataArr as $key => $array) {           
            $data[$key] = [
                'subject_id' => $subject_id,
                'question_id' => $array
            ];
        }
        $model = self::find($subject_id);
        return  $model->question()->attach($data);
    }
    public function updateData($dataArr, $subject_id) {     
        $model = self::find($subject_id);     
        // dd($dataArr); 
        return  $model->question()->sync($dataArr);
    }
    
    public function configs() {
        $defaultConfigs = Base::defaultConfigs();
        $listingConfigs = array(
            array(
                'field' => 'id',
                'name' => '#ID',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'name',
                'name' => 'Tên đề thi',
                'type' => 'textarea',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'description',
                'name' => 'Mô tả đề thi',
                'type' => 'textarea',
                'listing' => false,
                'creating' => true
            ),
            array(
                'field' => 'password',
                'name' => 'Mật khẩu',
                'type' => 'password',
                'listing' => false,
                'creating' => true
            ),
            array(
                'field' => 'theme_id',
                'name' => 'Lớp',
                'type' => 'select_rela',
                'relation' => 'room',
                'get' => 'name',
                'model' => 'Class',
                'records' => Room::select('id', 'name')->get(),
                'listing' => true,
                'creating' => true
            ),   
            array(
                'field' => 'time',
                'name' => 'Thời gian làm bài',
                'type' => 'select',
                'values' => [
                    [
                        'value' => '15',
                        'name' => '15 phút',
                    ],[
                        'value' => '30',
                        'name' => '30 phút',
                    ],[
                        'value' => '45',
                        'name' => '45 phút',
                    ],[
                        'value' => '60',
                        'name' => '60 phút',
                    ],[
                        'value' => '90',
                        'name' => '90 phút',
                    ],[
                        'value' => '120',
                        'name' => '120 phút',
                    ],
                ],
                'listing' => true,
                'creating' => true
            ), 
            array(
                'field' => 'level',
                'name' => 'Cấp độ',
                'type' => 'select',
                'values' => [
                    [
                        'value' => '1',
                        'name' => 'Dễ',
                    ],
                    [
                        'value' => '2',
                        'name' => 'Trung bình',
                    ],
                    [
                        'value' => '3',
                        'name' => 'Khó',
                    ]
                ],
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'user_id',
                'name' => 'Giáo viên đứng lớp',
                'type' => 'hidden',
                'relation' => 'teacher',
                'get' => 'name',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'question_ids',
                'name' => '',
                'type' => 'show_table',
                'model' => 'show_table',
                'table' => 'question_mapping',
                'data' =>[
                    'configs' => $this->configsParent(),
                    'records' => Question::all(),
                ],
                'listing' => false,
                'creating' => true
            ),
            array(
                'field' => 'quest_count',
                'name' => 'Số câu hỏi',
                'type' => 'count',
                'model' => 'Question',
                'records' => $this->getSumQuestion(),
                'listing' => true,
                'creating' => true
            ),              
        );
        return array_merge($listingConfigs, $defaultConfigs);
    }
    public function getSumQuestion(){
        $array = DB::table('question_mapping')
            ->select('subject_id', DB::raw('count(*) as total'))
            ->groupBy('subject_id')
            ->get();
        $data = [];
        foreach ($array as $a) {
            $data[$a->subject_id] = $a->total;           
        }
        // dd($data);
        return $data;
    }
    public function configsParent() {
        $model = new Question();
        $configs = $model->configs();
        $configs[0]=array(
            'field' => 'exam_quest',
            'name' => 'Chọn',
            'type' => 'checkbox',
            'listing' => true,
            'creating' => true
        );
        $tamp = $configs[3];
        $configs[9]['listing'] = false;
        $configs[10]['listing'] = false;
        $configs[3] =  $configs[6];
        $configs[6] =  $configs[7];
        $configs[7] =  $tamp;
        foreach($configs as $config){
            if(!empty($config['listing']) && $config['listing'] == true){
                $result[] = $config;
            }
        }
        return $result;
    }
    public function getRecords() {  
        return self::all();   
        // $array = DB::select('select COUNT(a.id) quest_count,a.*
        //                     from subjects a, question_mapping b
        //                 where a.id=b.subject_id
        //                 GROUP BY b.subject_id
        //                 ');
                       
        // $data = [];
        // foreach ($array as $a) {
        //     $data[] = (array)$a;           
        // }
        // return $data;

        // $a=  DB::table("subjects" , "question_mapping")
        // ->select("count (subjects.id)", "subjects.*")
        // ->where("subjects.id", "=", "question_mapping.subject_id")
        // ->get();
        // $a = DB::table("subjects")
        // ->join('question_mapping', 'subjects.id', '=', 'question_mapping.subject_id')
        // ->select('subjects.*')
        // ->get();
    }
    public function question(){
        return $this->belongsToMany(Question::class, 'question_mapping');
    }
    public function teacher(){
        return $this->belongsTo(Admin::class, 'user_id');
    }
    public function room(){
        return $this->belongsTo(Room::class, 'theme_id');
    }
    public function result(){
        return $this->hasMany(Result::class);
    }
}
