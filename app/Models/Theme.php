<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Base
{
    use HasFactory;
    protected $table = 'themes';
    public $title = "Quản lý lớp học";

    public function configs() {
        $defaultConfigs = parent::defaultConfigs();
        $listingConfigs = array(
            array(
                'field' => 'id',
                'name' => '#',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            ),
            array(
                'field' => 'name',
                'name' => 'Tên lớp',
                'type' => 'text',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'description',
                'name' => 'Mô tả',
                'type' => 'textarea',
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
            )           
        );
        return array_merge($listingConfigs, $defaultConfigs);
    }
    public function getRecords() {
        return self::all();
    }

    public $rules = [
        'name'    => 'required|max:255|unique:themes',
        'description' => 'max:255',
    ];

    public function rulesUpdate($id){        
        return $rules = [
            'name'    => 'required|max:255',
            'description' => 'max:255',
        ];
    }

    public $messages = [
            'name.required' => 'Tên lớp không được để trống',
            'name.unique' => 'Tên lớp này đã được sử dụng',
            'name.max' => 'Tên lớp của bạn quá dài! Tối đa 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'description.max' => 'Mô tả của bạn quá dài! Tối đa 255 ký tự'
        ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];
    public function teacher(){
        return $this->belongsTo(Admin::class, 'user_id');
    }
    public function students(){
        return $this->hasMany(User::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    //local Scope
    public function scopeSearch($query) {
        if($key = request()->key) {
            $query = $query->where('name', 'like', '%'.$key.'%');
        }
        return $query;
    }
   
}
