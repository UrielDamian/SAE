<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponenteXEspacio extends Model
{

	protected $table = 'componente_x_evento';
	protected $fillable = [
		'id',
		'Total',
		'evento',
		'cantidadUsar',
		'categoria',
		'nombreComponente'
	];
}
