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
	
	$vTot_crd = 0;
	$aCurobli = $_POST['rCurobli'];
	$aCurele = $_POST['rCurele'];
	$aCuropta = $_POST['rCuropta'];		
	
	$sCurmat2 = "";
	
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
		$sUser['tot_crd'] = $vTot_crd + $sUser['tot_tut'];
		if(fMatricurso())
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