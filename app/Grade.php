<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function announcements(){
        return $this->belongsToMany('App\Announcement')->withTimestamps();
    }
}
