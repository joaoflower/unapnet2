<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");
		
	if(!$sUser['safetymatri'] and !$sUser['safetytutor'])
		header("Location:tutoria.php");
	
	$sUser['safetymatri'] = FALSE;
	$sUser['safetytutor'] = FALSE;
/*	$aCurso = $_POST['rCurso'];	
	$aCursoele = $_POST['rCursoele'];	
	
	$vTot_crd = 0;

	if(!empty($sCuramat))
		foreach($sCuramat as $vCod_cur => $aDetalle)
			$vTot_crd += $aDetalle['crd_cur'];

	if(!empty($aCurso))
		foreach($aCurso as $vCod_cur => $vCrd_cur)
		{
			$vTot_crd += $vCrd_cur;
			$sCuramat[$vCod_cur]['mod_mat'] = '01';
			$sCuramat[$vCod_cur]['crd_cur'] = $vCrd_cur;
			$sCuramat[$vCod_cur]['obl_cur'] = FALSE;
		}
		
	if(!empty($aCursoele))
		foreach($aCursoele as $vCrd_cur => $vCod_cur)
		{
			$vTot_crd += $vCrd_cur;
			$sCuramat[$vCod_cur]['mod_mat'] = '01';
			$sCuramat[$vCod_cur]['crd_cur'] = $vCrd_cur;
			$sCuramat[$vCod_cur]['obl_cur'] = FALSE;
		}

	if($vTot_crd <= $sTutor['crd_max'])
	{
		$vTot_crd = $sTutor['crd_maxt'] - $sTutor['crd_max'] + $vTot_crd;
		$tEstutor = "unapnet.estutut{$sUser['cod_car']}2005";
		$tCurtutor = "unapnet.curtut{$sUser['cod_car']}2005";
		
		$bEstutor = FALSE;
		$bSavetut = FALSE;
		$bSavecur = FALSE;
		
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		$vQuery = "Select num_mat from $tEstutor where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
		$cEstutor = $xSerdata->query($vQuery);
		if($aEstutor = $cEstutor->fetch_array())
			$bEstutor = TRUE;
		$cEstutor->close();
		if($bEstutor)
		{
			$vQuery = "Update $tEstutor set cod_esp = '{$sTutor['cod_esp']}', pln_est = '{$sTutor['pln_est']}', mod_mat = '{$sTutor['mod_mat']}', ";
			$vQuery .= "tot_crd = $vTot_crd, num_ip = '$REMOTE_ADDR' where num_mat = '{$sUser['codigo']}' and per_aca = '03'";
		}
		else
		{
			$vQuery = "Insert into $tEstutor values ('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$sTutor['pln_est']}', '', '01', '1', ";
			$vQuery .= " '2005', '01', '{$sTutor['cod_esp']}', '{$sTutor['mod_mat']}', '', '', '', '', $vTot_crd, '01', {$sTutor['crd_maxt']}, '$REMOTE_ADDR')";
									
		}			
		$cEstutor = fInupde($vQuery);
		if($cEstutor)
			$bSavetut = TRUE;
		
		if($bSavetut)
		{
			foreach($sCuramat as $vCod_cur => $aDetalle)
			{
				if($aDetalle['obl_cur'])	$vObliga = '1';
				else $vObliga = '2';
				
				$vQuery = "Insert into $tCurtutor values ('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$sTutor['pln_est']}', '$vCod_cur', '2005', '01','{$aDetalle['mod_mat']}', '01', '1', '', '', '$vObliga')";
				$cCurtutor = fInupde($vQuery);
				if($cCurtutor)
					$bSavecur = TRUE;
			}			
			if($bSavecur)
			{
				header("Location:tutoria.php");
			}
			else
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = "ERROR, No se pudo guardar algún curso, intentelo de nuevo";
				header("Location:tutorcur.php");
			}	
		}
		else
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = "ERROR, No se pudo guardar los datos, intentelo de nuevo";
			header("Location:tutorcur.php");
		}
	}		
	else
	{
		$sUser['error'] = TRUE;
		$sUser['msnerror'] = "ERROR, Usted selecciono $vTot_crd crédito y su máximo es {$sTutor['crd_max']} créditos.";
		header("Location:tutorcur.php");
	}*/
	
	$vTot_crd = 0;
	$aCurdes = $_POST['rCurdes'];
	$aCurobli = $_POST['rCurobli'];
	$aCurele = $_POST['rCurele'];
	$aCuropta = $_POST['rCuropta'];		
	
	$sCurmat2 = "";
	if(empty($aCurdes))
	{
		if(!empty($sCurmat)) foreach($sCurmat as $vCod_cur => $aCurmat)
		{
			$vGrupo = "rGrupo$vCod_cur";
			$vGrupo2 = $_POST[$vGrupo];
			$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
			$sCurmat2[$vCod_cur]['mod_mat'] = $aCurmat['mod_mat'];
			$sCurmat2[$vCod_cur]['tur_est'] = $aCurmat['tur_est'];
			$sCurmat2[$vCod_cur]['cur_obli'] = $aCurmat['cur_obli'];
			
			$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
		}
	}
	else
	{
		if(!empty($sCurmat)) foreach($sCurmat as $vCod_cur => $aCurmat)
		{
			$vGrupo = "rGrupo$vCod_cur";
			$vGrupo2 = $_POST[$vGrupo];	
			
			if(!empty($aCurdes[$vCod_cur]))
			{
				$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
				$sCurmat2[$vCod_cur]['mod_mat'] = $aCurmat['mod_mat'];
				$sCurmat2[$vCod_cur]['tur_est'] = $aCurmat['tur_est'];
				$sCurmat2[$vCod_cur]['cur_obli'] = $aCurmat['cur_obli'];
				$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
			}
		}
	}
	if(!empty($aCurobli)) foreach($aCurobli as $vCod_cur => $vCod_cur2)
	{
		if($sCurapto[$vCod_cur])
		{
			$vGrupo = "rGrupo$vCod_cur";
			$vGrupo2 = $_POST[$vGrupo];
			$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
			$sCurmat2[$vCod_cur]['mod_mat'] = '01';
			$sCurmat2[$vCod_cur]['tur_est'] = '1';
			$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
		}
	}		
	if(!empty($aCurele)) foreach($aCurele as $vCod_cur2 => $vCod_cur)
	{
		if($sCurapto[$vCod_cur])
		{
			$vGrupo = "rGrupo$vCod_cur";
			$vGrupo2 = $_POST[$vGrupo];
			$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
			$sCurmat2[$vCod_cur]['mod_mat'] = '01';
			$sCurmat2[$vCod_cur]['tur_est'] = '1';
			$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
		}
	}
	if(!empty($aCuropta)) foreach($aCuropta as $vCod_cur => $vCod_cur2)
	{
		if($sCurapto[$vCod_cur])
		{
			$vGrupo = "rGrupo$vCod_cur";
			$vGrupo2 = $_POST[$vGrupo];
			$sCurmat2[$vCod_cur]['sec_gru'] = $vGrupo2;
			$sCurmat2[$vCod_cur]['mod_mat'] = '01';
			$sCurmat2[$vCod_cur]['tur_est'] = '1';
			$vTot_crd += $sCurso[$vCod_cur]['crd_cur'];
		}
	}
	
	if($vTot_crd > 0 and $vTot_crd <= $sUser['max_crd'])
	{
		$sUser['tot_crd'] = $vTot_crd;
		if(fMatricular())
		{
//			$sUsercoo['safetymatri3'] = FALSE;
//			$sUsercoo['safetymatri4'] = TRUE;
				header("Location:tutoria.php");
//		echo "grabo";

		}
		else
			header("Location:tutorcur.php");
//			echo "no grabo";
	}
	else
	{
		header("Location:tutorcur.php");
	}

	
/*	$sCuramat[$aCurdes['cod_cur']]['mod_mat'] = fConcurso($aCurdes['veces']);
	$sCuramat[$aCurdes['cod_cur']]['crd_cur'] = $aCurdes['crd_cur'];*/
	
/*	$curso = $_POST['rCurso'];	
	foreach($curso as $key => $codigo)
		echo $codigo."<br>".$key."<br>";
		
	$curso = $_POST['rCursoele'];	
	foreach($curso as $key => $codigo)
		echo $codigo."<br>".$key."<br>";*/
	
?>