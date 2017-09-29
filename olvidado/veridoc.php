<?php
	session_start();
	include "../include/function.php";
	include "../include/funcolv.php";

	$sOlvuser['codigop'] = '';
	$sOlvuser['passwdp'] = '';

	$sOlvuser['login'] = $_POST['rLogin'];
	$sOlvuser['passwdd'] = $_POST['rPasswdd'];
	$sOlvuser['dia'] = $_POST['rDia'];
	$sOlvuser['mes'] = $_POST['rMes'];
	$sOlvuser['ano'] = $_POST['rAno'];
		
	if(fverifyd())
	{
		$bUsuest = FALSE;
		$bUsudoc = FALSE;
		$bPasswd = FALSE;
		$bFec_nac = FALSE;
		$vFec_nac = "19{$sOlvuser['ano']}-{$sOlvuser['mes']}-{$sOlvuser['dia']}";

		$vQuery = "Select passwd, num_mat, cod_car from unapnet.usuest where login = '{$sOlvuser['login']}'";
		$cUsuest = fQuery($vQuery);
		if($aUsuest = $cUsuest->fetch_array())
		{			
			$sOlvuser['codigo'] = $aUsuest['num_mat'];
			$sOlvuser['cod_car'] = $aUsuest['cod_car'];
			$bUsuest = TRUE;
			
			if($aUsuest['passwd'] === fpassword($sOlvuser['passwdd']))
			{
				$bPasswd = TRUE;
				$vQuery = "Select paterno, materno, nombres, num_doc, fch_nac from unapnet.estudiante where num_mat = '{$sOlvuser['codigo']}' and cod_car = '{$sOlvuser['cod_car']}'";				
				$cEstudiante = fQuery($vQuery);				
				if($aEstudiante = $cEstudiante->fetch_array())
				{
					if($aEstudiante['fch_nac'] == $vFec_nac)
					{
						$bFec_nac = TRUE;
						$sOlvuser['paterno'] = $aEstudiante['paterno'];
						$sOlvuser['materno'] = $aEstudiante['materno'];
						$sOlvuser['nombres'] = $aEstudiante['nombres'];					
						$sOlvuser['passwd'] = 'NO DISPONIBLE';
						$sOlvuser['num_doc'] = $aEstudiante['num_doc'];
						$sOlvuser['tip_usu'] = '1';
					}
				}
				$cEstudiante->close();
			}
		}
		$cUsuest->close();		
		
		if(!$bUsuest)
		{
			$vQuery = "Select passwd, cod_prf, cod_car from unapnet.usudoc where login = '{$sOlvuser['login']}'";
			$cUsudoc = fQuery($vQuery);
			if($aUsudoc = $cUsudoc->fetch_array())
			{			
				$sOlvuser['codigo'] = $aUsudoc['cod_prf'];
				$sOlvuser['cod_car'] = $aUsudoc['cod_car'];
				$bUsudoc = TRUE;
				
				if($aUsudoc['passwd'] === fpassword($sOlvuser['passwdd']))
				{
					$bPasswd = TRUE;
					$vQuery = "Select paterno, materno, nombres, num_doc, fch_nac from unapnet.docente where cod_prf = '{$sOlvuser['codigo']}'";				
					$cDocente = fQuery($vQuery);				
					if($aDocente = $cDocente->fetch_array())
					{
						if($aDocente['fch_nac'] == $vFec_nac)
						{
							$bFec_nac = TRUE;
							$sOlvuser['paterno'] = $aDocente['paterno'];
							$sOlvuser['materno'] = $aDocente['materno'];
							$sOlvuser['nombres'] = $aDocente['nombres'];					
							$sOlvuser['passwd'] = 'NO DISPONIBLE';
							$sOlvuser['num_doc'] = $aDocente['num_doc'];
							$sOlvuser['tip_usu'] = '1';
						}
					}
					$cDocente->close();
				}
			}
			$cUsudoc->close();
		}
		
		if($bUsuest or $bUsudoc)
		{
			if($bPasswd)
			{
				if($bFec_nac)
				{
					$sOlvuser['safetyv'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
					header("Location:view.php");
				}
				else
				{
					$sOlvuser['errord'] = TRUE;
					$sOlvuser['msnerror'] = 'ERROR, LA FECHA DE NACIMIENTO ES INCORRECTA';
					header("Location:index2.php");
				}
			}
			else
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, LA CONTRASEÑA ES INCORRECTA';
				header("Location:index2.php");
			}		
		}
		else
		{
			$sOlvuser['errord'] = TRUE;
			$sOlvuser['msnerror'] = 'ERROR, EL USUARIO INGRESADO NO EXISTE';
			header("Location:index2.php");
		}
	}
	else
		header("Location:index2.php");
?>