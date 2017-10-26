<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadosrequisicion extends Model
{
	protected $table = 'estados_requisicions';	
	
	protected $fillable = ['desc_est_req','asu_est_req'];
	
	public function requisiciones()
	{
    	return $this->hasMany('Requisicion');
	}
	
}
