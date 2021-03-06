<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Result extends Base
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'results';
    public $title = "Kết quả thi";
    protected $fillable = [
        'subject_id',
        'student_id',
        'result'
    ];

    public function configs() {
        $listingConfigs = array(
            array(
                'field' => 'id',
                'name' => '#ID',
                'type' => 'text',
                'listing' => true,
            ),
            array(
                'field' => 'student_id',
                'name' => 'Tên sinh viên',
                'type' => 'text',
                'relation' => 'student',
                'get' => 'name',
                'listing' => true,
            ),
            array(
                'field' => 'subject_id',
                'name' => 'Đề thi',
                'type' => 'text',
                'relation' => 'subject',
                'get' => 'name',
                'listing' => true,
            ),
            array(
                'field' => 'subject_id',
                'name' => 'Lớp',
                'type' => 'relaOfRela',
                'relation' => 'subject',
                'get' => 'theme',
                'value' => 'name',
                'listing' => true,
            ),
            array(
                'field' => 'subject_id',
                'name' => 'Level',
                'type' => 'text',
                'relation' => 'subject',
                'get' => 'level',
                'listing' => true,
            ),
            array(
                'field' => 'result',
                'name' => 'Số câu đúng/ Tổng số câu',
                'type' => 'progress',
                'listing' => true,
            ),
            array(
                'field' => 'result',
                'name' => 'Điểm số',
                'type' => 'score',
                'listing' => true,
            )
        );
        return $listingConfigs;
    }
    public function getRecords() {  
        return self::all();   
    }
    
    public function excute($arrays, $subject_id) {
        $data = [];
        foreach($arrays as $array) {
            $ansArr = explode('-', $array);
            $data[$ansArr[0]][] = $ansArr[1];
        }
       
        try {
            $userId = Auth::user()->id;
            $countFail = $this->calculate($data);
            $count = count($data);
            $score = ($count - $countFail);
            // dd(count($data));
          
            $result =  $score. '/' . $count;
            $endTest = [
                'score' => $score,
                'count' => $count,
                'result' => $result
            ];

            $resultId = $this->createResult($subject_id, $userId, $result);
            $this->insertResultQuestion($resultId, $data);
        } catch (\Exception $exception) {
            throw new \Exception();
        }
        return $endTest;
    
    }

    public function calculate($data)
    {
        $countFail = 0;
        foreach ($data as $key => $value) {
            $model = new Answer();
            $answerCorrect = $model->isCorrect($key);
            // 1 đáp án đúng.
            if (count($answerCorrect) == 1) {
                if (is_array($value) && (int)$value[0] != $answerCorrect[0]['id']) {
                    $countFail++;
                    continue;
                }
            }

            // Nhiều đáp án đúng.
            if (count($answerCorrect) > 1) {
                foreach ($answerCorrect as $item) {
                    if (is_array($value)) {
                        if (!in_array($item['id'], $value)) {
                            $countFail++;
                            break;
                        }
                    } else {
                        $countFail++;
                        break;
                    }
                }
            }
        }
        return $countFail;
    }

    // public function getCount($subject_id) {
    //     // return 
    //     $a = Subject::with('question')->find($subject_id)->count();
    //     dd($a);
    // }
    public function insertResultQuestion($resultId, $data) {
        // $model = DB::table('result_mapping');
        $model = Result::find($resultId);
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $item = implode(',', $item);
            }
            $model->questions()->attach($key, ['selected' => $item]);
        }
    }

    public function createResult($subject_id, $userId, $result) {
        $a = self::create([
            'subject_id' => $subject_id, 
            'student_id' => $userId, 
            'result' => $result
        ]);
        
        return $a->id;
    }
    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function questions(){
        return $this->belongsToMany(Question::class, 'result_mapping')->withPivot('selected')->withTimestamps();
    }
}
