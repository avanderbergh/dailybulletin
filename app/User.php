<?php

namespace App;

use Avanderbergh\Schoology\SchoologyUser;

class User extends SchoologyUser
{
    public function announcements(){
        return $this->hasMany('App\Announcement');
    }
}
