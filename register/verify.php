<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";
//	include "../include/funcsql.php";

	$sReguser['codigo'] = $_POST['rCodigo'];
	$sReguser['cod_car'] = $_POST['rCod_Car'];
	$sReguser['passwd'] = $_POST['rPasswd'];
	
//	echo "entro";
	
	if(fverifyrv())
	{
		$bExist = FALSE;
		$bEstudiante = FALSE;		
		$bDocente = FALSE;
		$bIdioma = FALSE;
		
		$bUsuario = FALSE;
		$bEstumat = FALSE;
		
		$vQuery = "select num_mat, paterno, materno, nombres, tip_doc, num_doc, sexo, fch_nac, direc, fono, celular, ";
		$vQuery .= "est_civ, cod_nac, cod_dep, cod_prv, cod_dis, passwd ";
		$vQuery .= "from unapnet.estudiante where num_mat = '".$sReguser['codigo']."' and cod_car = '".$sReguser['cod_car']."'";
		$cEstudiante = fQuery($vQuery);
		if($aEstudiante = mysql_fetch_array($cEstudiante))
		{
			$bExist = TRUE;
			if($aEstudiante['passwd'] === $sReguser['passwd'])
			{
				$sReguser['passwd'] = '';				
				$sReguser['paterno'] = $aEstudiante['paterno'];
				$sReguser['materno'] = $aEstudiante['materno'];
				$sReguser['nombres'] = $aEstudiante['nombres'];
				$sReguser['tip_doc'] = $aEstudiante['tip_doc'];	
				$sReguser['num_doc'] = $aEstudiante['num_doc'];
				$sReguser['sexo'] = $aEstudiante['sexo'];
				$sReguser['ano'] = substr($aEstudiante['fch_nac'], 2, 2);
				$sReguser['mes'] = substr($aEstudiante['fch_nac'], 5, 2);
				$sReguser['dia'] = substr($aEstudiante['fch_nac'], 8, 2);
				$sReguser['direc'] = $aEstudiante['direc'];
				$sReguser['fono'] = $aEstudiante['fono'];
				$sReguser['celular'] = $aEstudiante['celular'];
				$sReguser['est_civ'] = $aEstudiante['est_civ'];
				$sReguser['cod_nac'] = $aEstudiante['cod_nac'];
				$sReguser['cod_dep'] = $aEstudiante['cod_dep'];
				$sReguser['cod_prv'] = $aEstudiante['cod_prv'];
				$sReguser['cod_dis'] = $aEstudiante['cod_dis'];
				$sReguser['tip_usu'] = '1';
				$bEstudiante = TRUE;

				if($bEstudiante)
				{
					$vQuery = "Select num_mat from unapnet.usuest where num_mat = '".$sReguser['codigo']."' and ";
					$vQuery .= "cod_car = '".$sReguser['cod_car']."'";
					$cUsuario = fQuery($vQuery);
					if($aUsuario = mysql_fetch_array($cUsuario))
						$bUsuario = TRUE;
				}
			}
		}		
		if(!$bEstudiante)
		{
			$vQuery = "select cod_prf, paterno, materno, nombres, tip_doc, num_doc, sexo, fch_nac, direc, fono, celular, ";
			$vQuery .= "est_civ, cod_nac, cod_dep, cod_prv, cod_dis, passwd ";
			$vQuery .= "from unapnet.docente where cod_prf = '".$sReguser['codigo']."' ";
			$vQuery .= "and cod_car = '".$sReguser['cod_car']."'";
			$cDocente = fQuery($vQuery);
			if($aDocente = mysql_fetch_array($cDocente))
			{
				$bExist = TRUE;
				if($aDocente['passwd'] === $sReguser['passwd'])
				{
					$sReguser['passwd'] = '';				
					$sReguser['paterno'] = $aDocente['paterno'];
					$sReguser['materno'] = $aDocente['materno'];
					$sReguser['nombres'] = $aDocente['nombres'];
					$sReguser['nombres'] = $aDocente['nombres'];
					$sReguser['tip_doc'] = $aDocente['tip_doc'];
					$sReguser['num_doc'] = $aDocente['num_doc'];
					$sReguser['sexo'] = $aDocente['sexo'];
					$sReguser['ano'] = substr($aDocente['fch_nac'], 2, 2);
					$sReguser['mes'] = substr($aDocente['fch_nac'], 5, 2);
					$sReguser['dia'] = substr($aDocente['fch_nac'], 8, 2);
					$sReguser['direc'] = $aDocente['direc'];
					$sReguser['fono'] = $aDocente['fono'];
					$sReguser['celular'] = $aDocente['celular'];
					$sReguser['est_civ'] = $aDocente['est_civ'];
					$sReguser['cod_nac'] = $aDocente['cod_nac'];
					$sReguser['cod_dep'] = $aDocente['cod_dep'];
					$sReguser['cod_prv'] = $aDocente['cod_prv'];
					$sReguser['cod_dis'] = $aDocente['cod_dis'];										
					$sReguser['tip_usu'] = '2';
					$bDocente = TRUE;
					
					if($bDocente)
					{
						$vQuery = "Select cod_prf from unapnet.usudoc where cod_prf = '".$sReguser['codigo']."' and ";
						$vQuery .= "cod_car = '".$sReguser['cod_car']."'";
						$cUsuario = fQuery($vQuery);
						if($aUsuario = mysql_fetch_array($cUsuario))
							$bUsuario = TRUE;
					}
				}				
			}
		}
		
		if(!$bDocente)
		{
			$vQuery = "SELECT es.cod_unap, es.codigo, es.paterno, es.materno, es.nombres, es.tip_doc, es.num_doc, es.cod_sex, ";
			$vQuery .= "  es.dir_est, es.fon_est, es.email, ma.clave as passwd ";
			$vQuery .= "FROM dbcidiomas.estudiantes es left join dbcidiomas.matriculas ma on es.codigo = ma.codigo ";
			$vQuery .= "where es.cod_unap = '{$sReguser['codigo']}' and ma.anio = '2009' and ma.cod_mes = '09' ";
			$cIdioma = fQueryi($vQuery);
			if($aIdioma = mysql_fetch_array($cIdioma))
			{
				$bExist = TRUE;
				if($aIdioma['passwd'] === $sReguser['passwd'])
				{
					$sReguser['passwd'] = '';				
					$sReguser['paterno'] = $aIdioma['paterno'];
					$sReguser['materno'] = $aIdioma['materno'];
					$sReguser['nombres'] = $aIdioma['nombres'];
					$sReguser['nombres'] = $aIdioma['nombres'];
					$sReguser['tip_doc'] = $aIdioma['tip_doc'];
					$sReguser['num_doc'] = $aIdioma['num_doc'];
					$sReguser['sexo'] = $aIdioma['cod_sex'];
					$sReguser['ano'] = '';
					$sReguser['mes'] = '';
					$sReguser['dia'] = '';
					$sReguser['direc'] = $aIdioma['dir_est'];
					$sReguser['fono'] = $aIdioma['fon_est'];
					$sReguser['celular'] = $aIdioma['fon_est'];
					$sReguser['est_civ'] = '';
					$sReguser['cod_nac'] = '';
					$sReguser['cod_dep'] = '';
					$sReguser['cod_prv'] = '';
					$sReguser['cod_dis'] = '';										
					$sReguser['tip_usu'] = '3';
					$bIdioma = TRUE;
					
					if($bDocente)
					{
						$vQuery = "Select cod_prf from unapnet.usuidio where num_mat = '".$sReguser['codigo']."' and ";
						$vQuery .= "cod_car = '".$sReguser['cod_car']."'";
						$cUsuario = fQuery($vQuery);
						if($aUsuario = mysql_fetch_array($cUsuario))
							$bUsuario = TRUE;
					}
				}				
			}
		}
		if($bExist)
		{
			if($bEstudiante or $bDocente or $bIdioma)
			{
				if(!$bUsuario)
				{
					if($bEstudiante)
					{
						$vQuery = "select num_mat from unapnet.estumat".$sReguser['cod_car']."2009 ";
						$vQuery .= "where num_mat = '".$sReguser['codigo']."'";
						$cEstumat = fQuery($vQuery);
						if($aEstumat = mysql_fetch_array($cEstumat))
							$bEstumat = TRUE;
							
						if(!$bEstumat)
						{
							$vQuery = "select num_mat from unapnet.estumat".$sReguser['cod_car']."2008 ";
							$vQuery .= "where num_mat = '".$sReguser['codigo']."'";
							$cEstumat = fQuery($vQuery);
							if($aEstumat = mysql_fetch_array($cEstumat))
								$bEstumat = TRUE;
						}
					}
					if($bEstumat or $bDocente or $bIdioma)
					{
						$sReguser['safetyd'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
						header("Location:data.php");
					}
					else
					{
						$sReguser['error'] = TRUE;
						$sReguser['msnerror'] = 'ERROR, USTED NO REGISTRO MATR&Iacute;CULA EN EL AÑO 2007 y 2008';
						header("Location:index2.php");
					}					
				}
				else
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, USTED YA TIENE UNA CUENTA EN Un@p.Net2';
					header("Location:index2.php");
				}				
			}
			else
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA CONTRASEÑA INGRESADA ES INCORRECTA';
				header("Location:index2.php");
			}
		}
		else
		{
			$sReguser['error'] = TRUE;
			$sReguser['msnerror'] = 'ERROR, EL CODIGO INGRESADO NO EXISTE EN LA CARRERA PROFESIONAL';
			header("Location:index2.php");
		}		
	}
	else
		header("Location:index2.php");
?>