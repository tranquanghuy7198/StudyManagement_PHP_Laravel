<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = ['id', 'fullName', 'birthdate', 'phone', 'mail', 'address'];
    protected $hidden = [];
    public $timestamp = false;
}
