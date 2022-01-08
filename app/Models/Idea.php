<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Base
{
    use HasFactory;
    protected $guarded = [];

    public $title = "Góp ý từ sinh viên";
    public function configs() {
        $listingConfigs = array(
            array(
                'field' => 'id',
                'name' => '#',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'student_id',
                'name' => 'Tên sinh viên',
                'type' => 'hidden',
                'relation' => 'student',
                'get' => 'name',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'email',
                'name' => 'Email ',
                'type' => 'hidden',
                'relation' => 'student',
                'get' => 'email',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'title',
                'name' => 'Tiêu đề',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'content',
                'name' => 'Nội dung',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            )
        );
        return $listingConfigs;
    }
    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

}
