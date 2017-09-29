<?php
	session_start();
	include "../include/function.php";
	include "../include/funcolv.php";

	$sOlvuser['login'] = '';
	$sOlvuser['passwdd'] = '';
	$sOlvuser['dia'] = '';
	$sOlvuser['mes'] = '';
	$sOlvuser['ano'] = '';
	
	$sOlvuser['codigop'] = $_POST['rCodigop'];
	$sOlvuser['cod_car'] = $_POST['rCod_Car'];
	$sOlvuser['passwdp'] = $_POST['rPasswdp'];
		
	if(fverifyp())
	{
		$bEstudiante = FALSE;
		$bDocente = FALSE;
		$bPasswd = FALSE;
		$bUsuario = FALSE;		
		$bNewpasswd = FALSE;

		$vQuery = "select paterno, materno, nombres, num_doc, passwd from unapnet.estudiante where (con_est = '1' or con_est = '5') and num_mat = '{$sOlvuser['codigop']}' and cod_car = '{$sOlvuser['cod_car']}'";

		$cEstudiante = fQuery($vQuery);
		while($aEstudiante = mysql_fetch_array($cEstudiante))
		{
			$bEstudiante = TRUE;
			if ($aEstudiante['passwd'] === $sOlvuser['passwdp'])
			{
				$bPasswd = TRUE;
				$sOlvuser['codigo'] = $sOlvuser['codigop'];						
				$sOlvuser['paterno'] = $aEstudiante['paterno'];
				$sOlvuser['materno'] = $aEstudiante['materno'];
				$sOlvuser['nombres'] = $aEstudiante['nombres'];
				$sOlvuser['num_doc'] = $aEstudiante['num_doc'];			
				$sOlvuser['tip_usu'] = '1';				
				
				if($bPasswd)
				{
					$vQuery = "select login, passwd from unapnet.usuest where num_mat = '{$sOlvuser['codigo']}' and cod_car = '{$sOlvuser['cod_car']}' ";
					$cUsuest = fQuery($vQuery);
					if($aUsuest = mysql_fetch_array($cUsuest))
					{
						$sOlvuser['login'] = $aUsuest['login'];
						$sOlvuser['passwd'] = $aUsuest['passwd'];
						$bUsuario = TRUE;
						
						if($bUsuario)
						{
							$vQuery = "Select old_password('{$sOlvuser['passwd']}') as passwd";
							$cPasswd = fQuery($vQuery);
							if($aPasswd = mysql_fetch_array($cPasswd))
							{
								$sOlvuser['passwd'] = substr($aPasswd['passwd'], 4, 8);						
								$vQuery = "Update unapnet.usuest set passwd = password('{$sOlvuser['passwd']}') where num_mat = '{$sOlvuser['codigo']}' and cod_car = '{$sOlvuser['cod_car']}'";
								$cUpdate = fInupde($vQuery);
								if($cUpdate)
									$bNewpasswd = TRUE;
							}
						}
					}
				}
			}
		}
		
		if(!$bEstudiante)
		{
			$vQuery = "select paterno, materno, nombres, num_doc, passwd from unapnet.docente where cod_prf = '{$sOlvuser['codigop']}' and cod_car = '{$sOlvuser['cod_car']}'";
			$cDocente = fQuery($vQuery);
			while($aDocente = mysql_fetch_array($cDocente))
			{
				$bDocente = TRUE;
				if ($aDocente['passwd'] === $sOlvuser['passwdp'])
				{
					$bPasswd = TRUE;
					$sOlvuser['codigo'] = $sOlvuser['codigop'];
					$sOlvuser['paterno'] = $aDocente['paterno'];
					$sOlvuser['materno'] = $aDocente['materno'];
					$sOlvuser['nombres'] = $aDocente['nombres'];
					$sOlvuser['num_doc'] = $aDocente['num_doc'];			
					$sOlvuser['tip_usu'] = '2';				
					
					if($bPasswd)
					{
						$vQuery = "select login, passwd from unapnet.usudoc where cod_prf = '{$sOlvuser['codigo']}' and cod_car = '{$sOlvuser['cod_car']}' ";
						$cUsudoc = fQuery($vQuery);
						if($aUsudoc = mysql_fetch_array($cUsudoc))
						{
							$sOlvuser['login'] = $aUsudoc['login'];
							$sOlvuser['passwd'] = $aUsudoc['passwd'];
							$bUsuario = TRUE;
							
							if($bUsuario)
							{
								$vQuery = "Select old_password('{$sOlvuser['passwd']}') as passwd";
								$cPasswd = fQuery($vQuery);
								if($aPasswd = mysql_fetch_array($cPasswd))
								{
									$sOlvuser['passwd'] = substr($aPasswd['passwd'], 4, 8);						
									$vQuery = "Update unapnet.usudoc set passwd = password('{$sOlvuser['passwd']}') where cod_prf = '{$sOlvuser['codigo']}' and cod_car = '{$sOlvuser['cod_car']}'";
									$cUpdate = fInupde($vQuery);
									if($cUpdate)
										$bNewpasswd = TRUE;
								}
							}
						}
					}
				}
			}
		}
		
		if($bEstudiante or $bDocente)
		{
			if($bPasswd)
			{
				if($bUsuario)
				{					
					if($bNewpasswd)
					{
						$sOlvuser['safetyv'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
						header("Location:view.php");
					}
					else
					{
						$sOlvuser['errorp'] = TRUE;
						$sOlvuser['msnerror'] = 'ERROR, NO SE PUDO ACTUALIZAR LA CONTRASEÑA NUEVA, INTENTELO DE NUEVO';
						header("Location:index2.php");
					}					
				}
				else
				{
					$sOlvuser['errorp'] = TRUE;
					$sOlvuser['msnerror'] = 'ERROR, USTED NO TIENE UNA CUENTA EN Un@p.Net2';
					header("Location:index2.php");
				}
			}
			else
			{
				$sOlvuser['errorp'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, LA CONTRASEÑA INGRESADA ES INCORRECTA';
				header("Location:index2.php");
			}
		}
		else
		{
			$sOlvuser['errorp'] = TRUE;
			$sOlvuser['msnerror'] = 'ERROR, EL CÓDIGO INGRESADO NO EXISTE';
			header("Location:index2.php");
		}		
	}
	else
		header("Location:.");
?>
