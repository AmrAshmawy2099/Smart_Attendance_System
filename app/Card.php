<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Card extends Model
{
    use SoftDeletes;
    public function user(){
        return $this->belongsTo('App\user','user_code','code');
    }
}
