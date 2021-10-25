<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Base
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable = [
        'name',
        'level',
        'is_multiple',
        'user_id',
        'image',
        'video',
        'level'
    ];
    public $title = "Quản lý câu hỏi";
    
    public function configs() {
        $defaultConfigs = parent::defaultConfigs();
        $defaultConfigs[1]['listing'] = 'true';
        $listingConfigs = array(
            array(
                'field' => ['answer', 'is_correct'],
                'type' => 'relationship',
                'model' => 'Answer',
                'listing' => false,
                'creating' => true
            ),
            array(
                'field' => 'id',
                'name' => '#ID',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'name',
                'name' => 'Câu hỏi',
                'type' => 'textarea',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'user_id',
                'name' => 'Giáo viên biên soạn',
                'type' => 'hidden',
                'relation' => 'teacher',
                'get' => 'name',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'image',
                'name' => 'Ảnh câu hỏi (không bắt buộc)',
                'type' => 'file',
                'listing' => false,
                'creating' => true
            ),  
            array(
                'field' => 'video',
                'name' => 'Video câu hỏi (không bắt buộc)',
                'type' => 'file',
                'listing' => false,
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
                'field' => 'is_multiple',
                'name' => 'Câu hỏi này có nhiều đáp án?',
                'type' => 'is_multiple',
                'values' => [
                    [
                        'value' => '1',
                        'name' => 'Có',
                    ],
                    [
                        'value' => '0',
                        'name' => 'Không',
                    ]
                ],
                'listing' => true,
                'creating' => true
            )     
        );
        return array_merge($listingConfigs, $defaultConfigs);
    }
    public function getRecords() {
        return self::all();
    }
    public function getRelaRecord($id){
        $array = DB::table('question_mapping')
        ->select('question_id as id')
        ->where('subject_id', $id)
        ->get();
    $data = [];
    $data['value'] = '';
    foreach ($array as $a) {
        $b = $a->id;
        $data[$b] = $a->id;           
        $data['value'] .= $a->id.',';           
    }
    return $data;
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function teacher(){
        return $this->belongsTo(Admin::class, 'user_id');
    }
    public function subject(){
        return $this->belongsToMany(Subject::class, 'question_mapping');
    }
    
}
