<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Machine extends Model
{
    use SoftDeletes;
    public function rooms(){
        return $this->belongsTo('App\Room');
    }

    protected $fillable = [
        'serial_no','room_id', 'certificate'
    ];
}
