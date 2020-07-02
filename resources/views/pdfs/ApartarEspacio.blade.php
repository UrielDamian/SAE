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
		Se ha creado una petición para que se use el espacio <strong>{{$aEnviar['espacio']}}</strong> para llevar a cavo el evento  <strong>{{$aEnviar['nombreEvento']}}</strong> para el día <strong> {{$aEnviar['Fecha']}}</strong> que empezará a las <strong>{{$aEnviar['HoraI']}}</strong> y terminará a las <strong>{{$aEnviar['HoraF']}}</strong>.
		<br>
		Para dicho evento usted necesitará los siguientes componentes:
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
		El encargado de dicho espacio analizará su petición y se le hará llegar el veredicto.

		En caso de que se autorice su solicitud se le hará llegar un correo donde se le proporcione la orden de pago para que usted pase a pagar en el área de caja de la facultad de ingeniería, en un plazo máximo de 3 días.

	</main>


</body>
</html>
