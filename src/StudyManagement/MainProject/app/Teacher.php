<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = ['id', 'fullName','birthdate', 'phone', 'mail', 'address', 'department'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $timestamp = false;
}
