<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;
class Records extends Model
{
    protected $table = "records";
    protected $fillable = [
        'user_code',
        'room_id',
        'machine_id',
        'card_id',
        'body',
        'uploaded_by'
    ];
    public function CreatedLastDay(){
        $records = DB::table("records")::where('created_at', '>=', $date)->get();
    }

}
