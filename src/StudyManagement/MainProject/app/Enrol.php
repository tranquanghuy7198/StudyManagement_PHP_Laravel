<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrol extends Model
{
    //
    protected $table = 'enrols';
    protected $fillable = ['id', 'studentId', 'classId', 'midterm', 'endterm', 'evaluate', 'exchange'];
    protected $hidden = [];
    public $timestamp = false;
}
