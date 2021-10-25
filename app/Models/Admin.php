<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class Admin extends Base implements AuthenticatableContract 
{
    use HasFactory, Notifiable,Authenticatable;
    
    protected $guard = 'admin';

    public $title = "Quản lý giáo viên";
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
                'name' => 'Tên giáo viên',
                'type' => 'text',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'email',
                'name' => 'Email giáo viên',
                'type' => 'text',
                'listing' => true,
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
                'field' => 'level',
                'name' => 'Vị trí',
                'type' => 'text',
                'listing' => true,
                'creating' => false
            )           
        );
        return array_merge($listingConfigs, $defaultConfigs);
    }
    public $rules = [
        'name'    => 'required',
        'email' => 'required|unique:admins,email',
        'password' => 'required',
    ];
    public function rulesUpdate($id){        
        return $rules = [
            'name'    => 'required',
            'email' => 'required|unique:admins,email,'.$id,
            'password' => 'required',
        ];
    }
    public $messages = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Password không được để trống'
        ];
    public function getRecords() {
        return self::where('level', '!=', 0)->get();
        // $a =self::where('level', '!=', 0)->get();
        // dd($a);
    }
    // public function saveModel($array) {
    //     return self::create($array);
    // }
    public function hasClass()
    {
        return $this->hasOne(Room::class);
    }
    public function hasSubject()
    {
        return $this->hasOne(Subject::class);
    }
    public function hasExamp()
    {
        return $this->hasOne(Room::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}