<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	protected $fillable = [
		'id',
		'Nombre',
		'Descripcion',
		'espacio'
	];
}