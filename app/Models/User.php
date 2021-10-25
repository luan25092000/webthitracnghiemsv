<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Base implements AuthenticatableContract {

    use HasApiTokens, HasFactory, Notifiable,Authenticatable;
    public $title = "Quản lý sinh viên";

    public function getsubject() {
        return self::where('level', '!=', 0)->get();
    }
    // public function saveModel($array) {
    //     return self::create($array);
    // }
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
                'name' => 'Tên sinh viên',
                'type' => 'text',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'email',
                'name' => 'Email sinh viên',
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
                'field' => 'birthday',
                'name' => 'Ngày sinh',
                'type' => 'date',
                'listing' => true,
                'creating' => true
            ),
            array(
                'field' => 'phone',
                'name' => 'Số điện thoại',
                'type' => 'text',
                'listing' => true,
                'creating' => true
            )
        );
        return array_merge($listingConfigs, $defaultConfigs);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function class() {
        return $this->belongsTo(Room::class);
    }
    public function result() {
        return $this->hasMany(Result::class);
    }
}
