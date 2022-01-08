<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Base
{
    use HasFactory;
    protected $table = 'answers';
    protected $guard = [];

    public function createData($array, $questionId) { 
        $data = [];   
        $answers = $array['answer'];
        $isCorrectArr = $array['is_correct'];
        foreach ($answers as $key => $answer) {
            $isCorrect = !empty($isCorrectArr[$key][0]) ? 1 : 0;
            $data[$key] = [
                'description' => $answer[0],
                'is_correct' => $isCorrect,
                'question_id' => $questionId
            ];
        }
        return self::insert($data);
    }
    public function updateData($array, $questionId) { 
        $data = [];   
        $answers = $array['answer'];
        $arrayKeys = array_keys($answers);
        
        $isCorrectArr = $array['is_correct'];
        foreach ($arrayKeys as $key ) {
            
            $isCorrect = !empty($isCorrectArr[$key][0]) ? 1 : 0;
            $data = [
                'description' => $answers[$key][0],
                'is_correct' => $isCorrect,
                'question_id' => $questionId
            ];
            self::where('id', $key)->update($data);
        }      
        return true;
    }
    public function getAllRecord(){
        return self::all();
    }
    
    public function getRelaRecord($id){
        return self::where('question_id', $id)->get();
    }
    public function configs() {        
        $listingConfigs = array(
            array(
                'field' => 'id',
                'name' => '#',
                'type' => 'text',
                'creating' => false
            ),
            array(
                'field' => 'description',
                'name' => 'answer',
                'type' => 'textarea',
                'creating' => true
            ),
            array(
                'field' => 'is_correct',
                'name' => 'is_correct',
                'type' => 'text',
                'creating' => true
            ),
            array(
                'field' => 'question_id',
                'name' => 'question_id',
                'type' => 'hidden',
                'relation' => 'teacher',
                'get' => 'name',
                'creating' => true
            ),
        );
        return $listingConfigs;
    }
    public function question(){
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function isCorrect($questionId){
        return  self::select('id')
                ->where('question_id', $questionId)
                ->where('is_correct', 1)
                ->get();
    }

}
