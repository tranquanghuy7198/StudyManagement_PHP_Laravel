<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyPath extends Model
{
    protected $table = 'study_paths';
    protected $fillable = ['program', 'courseId'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamp = false;
}
