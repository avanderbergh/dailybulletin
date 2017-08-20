<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'published_until'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function grades(){
        return $this->belongsToMany('App\Grade')->withTimestamps();
    }
    /**
     * Get a list of grades that this announcement is shown to.
     * @return array
     */
    public function getGradeListAttribute(){
        return $this->grades->lists('id');
    }
}
