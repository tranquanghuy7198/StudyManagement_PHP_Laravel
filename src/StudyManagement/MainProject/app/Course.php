<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['courseId', 'courseName', 'credit'];
    protected $hidden = ['updated_at', 'created_at'];
    public $timestamp = false;
}
