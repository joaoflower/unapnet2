<?php
	session_start();
	if ($rLogin == "passderecho" && $rClave == "xhugojuridica" )
	{
                $ar_upasswd['Safety'] = '1236';

		$ar_conex["host"] = '10.1.1.138';
		$ar_conex["user"] = 'unapmatri';
		$ar_conex["passwd"] = 'master2005';
		$ar_conedb["host"] = '10.1.1.138';
		$ar_conedb["user"] = 'unapmatri';
		$ar_conedb["passwd"] = 'master2005';

                $vConexion = mysql_connect($ar_conedb['host'], $ar_conedb['user'], $ar_conedb['passwd']);
                $consulta = "select * from unapnet.carrera";
                $cr_carrera = mysql_query($consulta, $vConexion);
                while ($ar_carrera2 = mysql_fetch_array($cr_carrera) )
                        $ar_carrera[$ar_carrera2["cod_car"]] = $ar_carrera2["car_des"];
                mysql_close($vConexion);

		header('Location:main.php');
	}
	else
	{
                $ar_upasswd['Mensaje'] = 'Los Datos Ingresados son Incorrectos';
                header("Location:.");
	}
?>
