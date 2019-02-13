<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_ extends Model
{
    protected $table = 'classes';
    protected $fillable = ['classId', 'courseId', 'teacherId'];
    protected $hidden = [];
    public $timestamp = false;

    public function students()
    {
        return $this->belongsToMany('App\Student', 'enrols', 'id');
    }
}
