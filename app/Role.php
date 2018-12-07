<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'role'
    ];

    public function menus(){
    	return $this->hasManyThrough(Menu::class, User::class, 'role_id', 'user_id', 'id', 'id');
    }

    public function pesanans(){
    	return $this->hasManyThrough(Pesanan::class, User::class, 'role_id', 'user_id', 'id', 'id');
    }
}
