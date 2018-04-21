<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dtr extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'dtr';
    protected $fillable = array(
		'role',
		'employee_id',
		'rate',
		'salary',
    );
    public $timestamps = true;
}
