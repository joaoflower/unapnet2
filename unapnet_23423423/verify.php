<?php
	session_start();
	include "../include/function.php";
	include "../include/funcunap.php";

	$sUser['login'] = $_POST['rLogin'];
	$sUser['passwd'] = $_POST['rPasswd'];
	$sUser['num_doc'] = $_POST['rNum_doc'];
	
	if(fverifyld())
	{
		$bUsuest = FALSE;
		$bUsudoc = FALSE;
		$bPasswd = FALSE;
		$bOldpass = FALSE;
		$bEstudiante = FALSE;
		$bDocente = FALSE;
		$bNum_doc = FALSE;

		$vQuery = "Select passwd, num_mat, cod_car, recorda, oemail from unapnet.usuest where login = '{$sUser['login']}'";
		$cUsuest = fQuery($vQuery);
		if($aUsuest = mysql_fetch_array($cUsuest))
		{
			$bUsuest = TRUE;
			if($aUsuest['passwd'] === fpassword($sUser['passwd']))
				$bPasswd = TRUE;
			else
				$bOldpass = TRUE;

			if($bOldpass and ($aUsuest['passwd'] === fpassword(fold_password($sUser['passwd']))))
			{
				$vQuery = "Update unapnet.usuest set passwd = password('{$sUser['passwd']}') where login = '{$sUser['login']}'";
				$cUpdate = fInupde($vQuery);
				if($cUpdate)
					$bPasswd = TRUE;
			}			
			
			if($bPasswd)
			{				
				$sUser['codigo'] = $aUsuest['num_mat'];
				$sUser['cod_car'] = $aUsuest['cod_car'];
				$sUser['recorda'] = $aUsuest['recorda'];
				$sUser['oemail'] = $aUsuest['oemail'];

				$vQuery = "select paterno, materno, nombres, tip_doc, num_doc, sexo, fch_nac, direc, fono, celular, est_civ, cod_nac, cod_dep, cod_prv, cod_dis, passwd ";
				$vQuery .= "from unapnet.estudiante where num_mat = '".$sUser['codigo']."' and cod_car = '".$sUser['cod_car']."'";
				$cEstudiante = fQuery($vQuery);					
				if($aEstudiante = mysql_fetch_array($cEstudiante))
				{
					$bEstudiante = TRUE;
					if($aEstudiante['num_doc'] === $sUser['num_doc'])
					{
						$bNum_doc = TRUE;
						$sUser['paterno'] = $aEstudiante['paterno'];
						$sUser['materno'] = $aEstudiante['materno'];
						$sUser['nombres'] = $aEstudiante['nombres'];
						$sUser['tip_doc'] = $aEstudiante['tip_doc'];	
						$sUser['num_doc'] = $aEstudiante['num_doc'];
						$sUser['sexo'] = $aEstudiante['sexo'];
						$sUser['ano'] = substr($aEstudiante['fch_nac'], 2, 2);
						$sUser['mes'] = substr($aEstudiante['fch_nac'], 5, 2);
						$sUser['dia'] = substr($aEstudiante['fch_nac'], 8, 2);
						$sUser['direc'] = $aEstudiante['direc'];
						$sUser['fono'] = $aEstudiante['fono'];
						$sUser['celular'] = $aEstudiante['celular'];
						$sUser['est_civ'] = $aEstudiante['est_civ'];
						$sUser['cod_nac'] = $aEstudiante['cod_nac'];
						$sUser['cod_dep'] = $aEstudiante['cod_dep'];
						$sUser['cod_prv'] = $aEstudiante['cod_prv'];
						$sUser['cod_dis'] = $aEstudiante['cod_dis'];
						$sUser['tip_usu'] = '1';
						$sUbigeo['cod_dep'] = $aEstudiante['cod_dep'];
						$sUbigeo['cod_prv'] = $aEstudiante['cod_prv'];
						$sUbigeo['cod_dis'] = $aEstudiante['cod_dis'];
					}
				}
			}
		}

		if(!$bUsuest)
		{
			$vQuery = "Select passwd, cod_prf, cod_car, recorda, oemail from unapnet.usudoc where login = '{$sUser['login']}'";
			$cUsudoc = fQuery($vQuery);
			if($aUsudoc = mysql_fetch_array($cUsudoc))
			{
				$bUsudoc = TRUE;
				if($aUsudoc['passwd'] === fpassword($sUser['passwd']))
					$bPasswd = TRUE;
				else
					$bOldpass = TRUE;
	
				if($bOldpass and ($aUsudoc['passwd'] === fpassword(fold_password($sUser['passwd']))))
				{
					$vQuery = "Update unapnet.usudoc set passwd = password('{$sUser['passwd']}') where login = '{$sUser['login']}'";
					$cUpdate = fInupde($vQuery);
					if($cUpdate)
						$bPasswd = TRUE;
				}			
				
				if($bPasswd)
				{				
					$sUser['codigo'] = $aUsudoc['cod_prf'];
					$sUser['cod_car'] = $aUsudoc['cod_car'];
					$sUser['recorda'] = $aUsudoc['recorda'];
					$sUser['oemail'] = $aUsudoc['oemail'];
	
					$vQuery = "select paterno, materno, nombres, tip_doc, num_doc, sexo, fch_nac, direc, fono, celular, est_civ, cod_nac, cod_dep, cod_prv, cod_dis, passwd ";
					$vQuery .= "from unapnet.docente where cod_prf = '".$sUser['codigo']."' ";
					$cDocente = fQuery($vQuery);					
					if($aDocente = mysql_fetch_array($cDocente))
					{
						$bDocente = TRUE;
						if($aDocente['num_doc'] === $sUser['num_doc'])
						{
							$bNum_doc = TRUE;
							$sUser['paterno'] = $aDocente['paterno'];
							$sUser['materno'] = $aDocente['materno'];
							$sUser['nombres'] = $aDocente['nombres'];
							$sUser['nombres'] = $aDocente['nombres'];
							$sUser['tip_doc'] = $aDocente['tip_doc'];
							$sUser['num_doc'] = $aDocente['num_doc'];
							$sUser['sexo'] = $aDocente['sexo'];
							$sUser['ano'] = substr($aDocente['fch_nac'], 2, 2);
							$sUser['mes'] = substr($aDocente['fch_nac'], 5, 2);
							$sUser['dia'] = substr($aDocente['fch_nac'], 8, 2);
							$sUser['direc'] = $aDocente['direc'];
							$sUser['fono'] = $aDocente['fono'];
							$sUser['celular'] = $aDocente['celular'];
							$sUser['est_civ'] = $aDocente['est_civ'];
							$sUser['cod_nac'] = $aDocente['cod_nac'];
							$sUser['cod_dep'] = $aDocente['cod_dep'];
							$sUser['cod_prv'] = $aDocente['cod_prv'];
							$sUser['cod_dis'] = $aDocente['cod_dis'];										
							$sUser['tip_usu'] = '2';
							$sUbigeo['cod_dep'] = $sUser['cod_dep'];
							$sUbigeo['cod_prv'] = $sUser['cod_prv'];
							$sUbigeo['cod_dis'] = $sUser['cod_dis'];
						}
					}
				}
			}
		}
		
		if($bUsuest or $bUsudoc)
		{
			if($bPasswd)
			{
				if($bNum_doc)
				{
					if($sUser['tip_usu'] == '1')
					{
						$sUser['start'] = '';
						$sUser['safetyd'] = '';
						$sUser['safetys'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
						header("Location:student/.");
						
					}
					else
					{
						if($sUser['tip_usu'] == '2')
						{
							$sUser['start'] = '';
							$sUser['safetys'] = '';
							$sUser['safetyd'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
							header("Location:teacher/.");
						}
						else
							header("Location:.");
					}
				}
				else
				{
					$sUser['errorl'] = TRUE;
					$sUser['msnerror'] = 'ERROR, EL NRO. DOCUMENTO ES INCORRECTO';
					header("Location:index2.php");
				}
			}
			else
			{
				$sUser['errorl'] = TRUE;
				$sUser['msnerror'] = 'ERROR, LA CONTRASEÑA ES INCORRECTA';
				header("Location:index2.php");
			}		
		}
		else
		{
			$sUser['errorl'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL USUARIO NO EXISTE';
			header("Location:index2.php");
		}
	}
	else
		header("Location:index2.php");		
?>