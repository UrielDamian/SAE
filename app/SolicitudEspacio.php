<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudEspacio extends Model
{

	 protected $fillable = [ 'id',
	 						'usuario',
							'nombreEspacio',
							'espacio',
							'fecha',
							'horaInicio',
							'horaFinal'
						];
	
}
