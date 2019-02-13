<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['id', 'fullName', 'birthdate', 'phone', 'mail', 'address', 'studentGroup', 'program', 'fee', 'CPA', 'enrolCredit', 'completeCredit'];
    protected $hidden = [];
    public $timestamp = false;

    public function classes()
    {
        return $this->belongsToMany('App\Class_', 'enrols', 'classId');
    }
}
