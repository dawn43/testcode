<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
    	'user_id', 'meja', 'nomor_pesanan', 'status'
    ];

    public function menus(){
    	return $this->belongsToMany(Menu::class);
    }
}
