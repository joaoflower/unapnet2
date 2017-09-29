<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");
		
	$vCod_cur = $_GET['rCod_cur'];	
	
	$tEstutor = "unapnet.estutut{$sUser['cod_car']}2005";
	$tCurtutor = "unapnet.curtut{$sUser['cod_car']}2005";
	$tPlan = "unapnet.curso";
	
	$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);

	$vQuery = "Select tot_crd from $tEstutor where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
	$cEstutor = mysql_query($vQuery, $xSerdata);
	if($aEstutor = mysql_fetch_array($cEstutor))
		$vTot_crd = $aEstutor['tot_crd'];
		
	$vQuery = "Select crd_cur from $tPlan where cod_car = '{$sUser['cod_car']}' and pln_est = '{$sUser['pln_est']}' and cod_cur = '$vCod_cur'";
	$cPlan = mysql_query($vQuery, $xSerdata);
	if($aPlan = mysql_fetch_array($cPlan))
		$vCrd_cur = $aPlan['crd_cur'];

	
	$vQuery = "Delete from $tCurtutor where num_mat = '{$sUser['codigo']}' and cod_cur = '$vCod_cur' and per_aca = '01' and cur_obli = ''";
	$cCurtutor = fInupde($vQuery);
	if($cCurtutor)
	{
		$vNew_crd = $vTot_crd - $vCrd_cur;
		if($vNew_crd > 0)
			$vQuery = "Update $tEstutor set tot_crd = $vNew_crd where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
		else
			echo $vQuery = "Delete from $tEstutor where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
		$cEstutor = mysql_query($vQuery, $xSerdata);
		
		if($cEstutor)
			header("Location:tutoria.php");
		else
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = "ERROR, No se puede actualizar los datos, intentelo de nuevo";
			header("Location:tutoria.php");
		}
	}
	else
	{
		$sUser['error'] = TRUE;
		$sUser['msnerror'] = "ERROR, No se puede eliminar el Curso, intentelo de nuevo";
		header("Location:tutoria.php");
	}
	
?>