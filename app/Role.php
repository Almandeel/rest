<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = [
    'name', 'display_name', 'description',
    ];
    public function isSuper(){
        return $this->name == 'superadmin';
    }
    public function delete(){
        if(!$this->isSuper()){
            $result =  parent::delete();
            return $result;
        }

        return null;
    }
}