<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Componente_c extends Controller
{
	public function registrar(Request $request) {
  		Post::create($request->all());
  		return redirect('componentes');
	}
}
