<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $table = 'country';
	public $timestamp = true;

	protected $fillable =[
		'Code',
		'Name',
		'Continent',
		'Region',
		'IndepYear',
		'Population',
		'GovernmentForm',
		'HeadOfState',
		'Code2',
		'created_at'
	];


    //
}
