<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Room extends Model
{
    use SoftDeletes;
    public function machines(){
        return $this->hasMany('App\Machine');
    }

    protected $fillable = [
        'name','floor', 'building'
    ];
}
