<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponenteXEspacio extends Model
{
	protected $fillable = [
		'id',
		'cantidad',
		'Total',
		'evento',
		'componente'
	];
}
