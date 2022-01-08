<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;

    public function listingConfigs(){
        return $this->getConfigs('listing');
    }
    
    public function creatingConfigs(){
        return $this->getConfigs('creating');
    }
    
    public function getConfigs($interface){
        $configs = $this->configs();
        $result = [];
        foreach($configs as $config){
            if(!empty($config[$interface]) && $config[$interface] == true){
                $result[] = $config;
            }
        }
        return $result;
    }
    public function getRecords() {
        return self::all();
    }
    
    public function defaultConfigs() {
        return array(
            array(
                'field' => 'updated_at',
                'name' => 'Ngày cập nhật',
                'type' => 'date',
                'listing' => false,
                'creating' => false
            ),
            array(
                'field' => 'created_at',
                'name' => 'Ngày tạo',
                'type' => 'date',
                'listing' => false,
                'creating' => false
            ),
            array(
                'field' => 'action',
                'name' => 'Action',
                'type' => 'action',
                'listing' => true,
                'creating' => false
            )
        );
    }
}
