<title>exportar unap</title>
<?
	session_start();
	session_register('ar_conex');
	
	$ar_conex["host"] = 'localhost';
	$ar_conex["user"] = 'root';
	$ar_conex["passwd"] = 'mysql';
	
	$cServer = new mysqli($ar_conex['host'], $ar_conex['user'], $ar_conex['passwd']);
	
//	$vConsulta = "Select login, num_mat, cod_car, num_ip, feh_reg from unap.queries";
	$vQingres = "Select login, num_mat, cod_car, num_ip, feh_reg from unap.queries";
	$cIngres = $cServer->query($vQingres);
	
	while ($aIngr = $cIngres->fetch_array())
	{
		$vIingr = "insert into unapnet.queries values ";
		$vIingr .= "('".$aIngr['num_mat']."', '".$aIngr['paterno']."', '".$aIngr['materno']."', '".$aIngr['nombres']."', ";
		$vIingr .= " '".$aIngr['cod_car']."', '".$aIngr['passwd']."', '1')";
		
//		$vInsOk = $cServer->query($vIingr);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";
	}
		
	$cServer->close();
	
	
	
?>