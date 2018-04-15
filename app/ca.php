<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ca extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cash_advance';
    protected $fillable = array(
		'customer_id',
		'reason',
		'amount',
		'balance',
    );
    public $timestamps = true;
}
