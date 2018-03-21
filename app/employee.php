<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'employee';
    protected $fillable = array(
        'fname',
        'mname',
        'lname',
        'role_id'
    );

    public $timestamps = true;
}
