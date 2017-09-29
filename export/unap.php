<title>exportar unap</title>
<?
	session_start();
	session_register('ar_conex');
	
	$ar_conex["host"] = 'localhost';
	$ar_conex["user"] = 'root';
	$ar_conex["passwd"] = 'mysql';
	
	$cServer = new mysqli($ar_conex['host'], $ar_conex['user'], $ar_conex['passwd']);

//-----------------------------------------------------------------
//	Estudoc
//-----------------------------------------------------------------

	$vConsulta = "Select * from unap.unap";
	$cUser = $cServer->query($vConsulta);
	
	while ($arUser = $cUser->fetch_array())
	{
		$vInsert = "insert into unapnet.estudoc values ";
		$vInsert .= "('".$arUser['num_mat']."', '".$arUser['cod_car']."', '1', '".$arUser['paterno']."', '".$arUser['materno']."', ";
		$vInsert .= " '".$arUser['nombres']."', '".$arUser['passwd']."' )";
		
		$vInsOk = $cServer->query($vInsert);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";
	}
	$cUser->close();
	
	//-----------------------------------------------------------------
	$vQingres = "Select num_mat, paterno, materno, nombres, cod_car, passwd from unap.ingr2003";
	$cIngres = $cServer->query($vQingres);
	
	while ($aIngr = $cIngres->fetch_array())
	{
		$vIingr = "insert into unapnet.estudoc values ";
		$vIingr .= "('".$aIngr['num_mat']."', '".$aIngr['cod_car']."', '1', '".$aIngr['paterno']."', '".$aIngr['materno']."', ";
		$vIingr .= " '".$aIngr['nombres']."', '".$aIngr['passwd']."')";
		
		$vInsOk = $cServer->query($vIingr);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";
	}
	$cIngres->close();
	
	//-----------------------------------------------------------------
	$vConsulta = "Select cod_doc, num_doc, paterno, materno, nombres from unap.docen";
	$cQuery = $cServer->query($vConsulta);
	
	while ($aQuery = $cQuery->fetch_array())
	{
		$vInsert = "insert into unapnet.estudoc values ";
		$vInsert .= "('".$aQuery['cod_doc']."', '00', '2', '".$aQuery['paterno']."', '".$aQuery['materno']."', ";
		$vInsert .= " '".$aQuery['nombres']."', '".$aQuery['num_doc']."')";
		
		$vInsOk = $cServer->query($vInsert);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";
	}
	$cQuery->close();
	
/*	$vConsulta = "select * from unap.queries ";
	$crQuery = $cServer->query($vConsulta);
	
	while ($aQuery = $crQuery->fetch_array())
	{
		$vInsert = "insert into unapnet.queries values ";
		$vInsert .= "('".$aQuery['login']."', '".$aQuery['num_mat']."', '".$aQuery['cod_car']."', '".$aQuery['num_ip']."', ";
		$vInsert .= " '".$aQuery['feh_reg']."', '1')";
		
		$vInsOk = $cServer->query($vInsert);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";
		echo $aQuery['login'];
	}
	$crQuery->close();*/
	
//-----------------------------------------------------------------
//	usuario
//-----------------------------------------------------------------

	$vConsulta = "select * from unap.usuario ";
	$crQuery = $cServer->query($vConsulta);
	
	while ($aQuery = $crQuery->fetch_array())
	{
		$vFec_Nac = "'19".$aQuery['fec_ano']."-".$aQuery['fec_mes']."-".$aQuery['fec_dia']."'";
		$vInsert = "insert into unapnet.usuario values ";
		$vInsert .= "('".$aQuery['login']."', '".$aQuery['num_mat']."', '".$aQuery['paterno']."', '".$aQuery['materno']."', ";
		$vInsert .= " '".$aQuery['nombres']."', '".$aQuery['cod_car']."', password('".$aQuery['passwd']."'), "; 
		$vInsert .= " '".$aQuery['tipodoc']."', '".$aQuery['num_doc']."', '".$aQuery['sexo']."', ".$vFec_Nac.", "; 
		$vInsert .= " '".$aQuery['direcc']."', '".$aQuery['telefono']."', '".$aQuery['celular']."', '".$aQuery['ecivil']."', ";
		$vInsert .= " '".$aQuery['ciudad']."', '".$aQuery['recorda']."', '".$aQuery['oemail']."', '1', ";
		$vInsert .= " '".$aQuery['feh_reg']."', '".$aQuery['num_ip']."')";
//		echo $vInsert;
		
		$vInsOk = $cServer->query($vInsert);
		if ($vInsOk)
			echo "Inserto ok";
		else
			echo "No inserto";

	}
	$crQuery->close();
	
	//-----------------------------------------------------------------

	$vConsulta = "select * from unap.udocen ";
	$crQuery = $cServer->query($vConsulta);
	
	while ($aQuery = $crQuery->fetch_array())
	{
		$vFec_Nac = "'19".$aQuery['fec_ano']."-".$aQuery['fec_mes']."-".$aQuery['fec_dia']."'";
		$vInsert = "insert into unapnet.usuario values ";
		$vInsert .= "('".$aQuery['login']."', '".$aQuery['cod_doc']."', '".$aQuery['paterno']."', '".$aQuery['materno']."', ";
		$vInsert .= " '".$aQuery['nombres']."', '".$aQuery['cod_car']."', password('".$aQuery['passwd']."'), "; 
		$vInsert .= " '".$aQuery['tipodoc']."', '".$aQuery['num_doc']."', '".$aQuery['sexo']."', ".$vFec_Nac.", "; 
		$vInsert .= " '".$aQuery['direcc']."', '".$aQuery['telefono']."', '".$aQuery['celular']."', '".$aQuery['ecivil']."', ";
		$vInsert .= " '".$aQuery['ciudad']."', '".$aQuery['recorda']."', '".$aQuery['oemail']."', '2', ";
		$vInsert .= " '".$aQuery['feh_reg']."', '".$aQuery['num_ip']."')";
//		echo $vInsert;
		
		$vInsOk = $cServer->query($vInsert);
		if ($vInsOk)
			echo "Inserto ok doc";
		else
			echo "No inserto";
	}
	$crQuery->close();
	$cServer->close();
	
?>