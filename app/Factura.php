<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
	protected $table = 'Factura';
	
	protected $fillable = array('fec_fct', 'cnp_fct');
	
}