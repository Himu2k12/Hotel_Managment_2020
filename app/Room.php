<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function roomType(){
        return $this->belongsTo(RoomType::class);
    }

    public function managementName()
    {
        return $this->hasOne(User::class,'id','management_id');
    }
}
