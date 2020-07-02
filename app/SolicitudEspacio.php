<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudEspacio extends Model
{

	protected $table = 'solicitud_eventos';

	protected $fillable = [
		'id',
		'usuario',
		'nombreEspacio',
		'even',
		'fecha',
		'horaInicio',
		'horaFinal'
	];

}
