<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
    	'nama', 'jenis', 'harga', 'stock'
    ];

    public function pesanans(){
    	return $this->belongsToMany(Pesanan::class);
    }
}
