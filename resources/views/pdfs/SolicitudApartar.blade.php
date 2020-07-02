<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Llamado de emergencia</title>


	<style  type="text/css">

		body{
			margin-top:    3.5cm;
            margin-bottom: 1cm;
            margin-left:   1cm;
            margin-right:  1cm;

		}
		#watermark {
			   position: fixed;
			   bottom:   55px;
			   left:     -30px;
			   /** The width and height may change
				   according to the dimensions of your letterhead
			   **/
			   width:    21cm;
			   height:   25cm;

			   /** Your watermark should be behind every content**/
			   z-index:  -500;
		   }
  </style>
</head>
<body>
	<div id="watermark">
            <img src="images/fondo.png" height="100%" width="100%" />
    </div>
	<main>
		Por este medio se le comunica que el(la) C.<strong>{{$aEnviar['usuario']}}</strong> ha solicitado usar el espacio <strong>{{$aEnviar['espacio']}}</strong> para llevar a cavo el evento  <strong>{{$aEnviar['nombreEvento']}}</strong> que tiene la siguiente descripcion:<strong>{{$aEnviar['DescEvento']}}</strong>, y requiere usarlo el día <strong> {{$aEnviar['Fecha']}}</strong>,se pretende que el evento empieze a las <strong>{{$aEnviar['HoraI']}}</strong> y termine a las <strong>{{$aEnviar['HoraF']}}</strong>.
		<br>
		Para dicho evento se necesitará los siguientes componentes:
		<br>
		<table border="1" height="100%" width="100%">
			<thead>
				<tr>
					<td>Categoría</td>
					<td>Componente</td>
					<td>Cantidad</td>
				</tr>
			</thead>
			<tbody>

				<?php
				for ($i=0; $i < count($componentes); $i+=3) {
					?>
					<tr>
						<td><?php echo $componentes[$i]; ?></td>
						<td><?php echo $componentes[$i+1]; ?></td>
						<td><?php echo $componentes[$i+2]; ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<br>
		Le pedimos de la manera mas a tenta a usted, como encargado de dicho espacio que valore la solicitud y decida si la solicitud será aceptada o denegada. Entre a la plataforma para dejar su veredicto.

		PD: El e-mail de el ususario que ha hecho la solicitud es el siguiente: <strong>{{$aEnviar['emailUs']}}</strong>

	</main>


</body>
</html>
