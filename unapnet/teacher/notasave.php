<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyds2())
		header("Location:../.");

	if($sUser['Notas'] == 'b')
		$sUser['Notas'] = 'a';
	else
		header("Location:notaver.php");
	
	$vCod_car = $_GET['rCod_car'];	
	$vPln_est = $_GET['rPln_est'];
	$vCod_cur = $_GET['rCod_cur'];
	$vSec_gru = $_GET['rSec_gru'];
	$vTip_not = $_GET['rTip_not'];
	$vOrd_not = $_GET['rOrd_not'];
	
	if(!empty($sCarrera[$vCod_car]))
	{
		switch($vTip_not)
		{
			case '1': $vDes_not = "Examen"; break;
			case '2': $vDes_not = "Práctica"; break;
			case '3': $vDes_not = "Trabajo"; break;
			default: header("Location:notas.php"); break;
		}
				
		$tEstucar = "car{$vCod_car}.estu{$vCod_car}";
		$tPlan = "car{$vCod_car}.plan{$vCod_car}";
		$tCurmat = "car{$vCod_car}.cm{$vCod_car}2004";
		$tCarga = "car{$vCod_car}.ca{$vCod_car}2004";
				
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
				
		$vQuery = "Select nom_cur from $tPlan where pln_est = '$vPln_est' and cod_cur = '$vCod_cur'";
		$cPlan = $xSerdata->query($vQuery);
		if($aPlan = $cPlan->fetch_array())
			$vNom_cur = $aPlan['nom_cur'];
		else
			header("Location:notas.php");
		$cPlan->close();
		
		$vQuery = "Select cod_cur from $tCarga where pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "cod_prf like '%{$sUser['codigo']}' and per_aca = '02' and sec_gru = '$vSec_gru'";
		$cCarga = $xSerdata->query($vQuery);
		if($aCarga = $cCarga->fetch_array())
			$vCod_cur = ucwords(strtolower($aCarga['cod_cur']));
		else
			header("Location:notas.php");
		$cCarga->close();

		switch($vTip_not)
		{
			case '1': $tNota = "caw{$vCod_car}.ne{$vCod_car}2004"; break;
			case '2': $tNota = "caw{$vCod_car}.np{$vCod_car}2004"; break;
			case '3': $tNota = "caw{$vCod_car}.nt{$vCod_car}2004"; break;
		}

		$bInsert = TRUE;
		if(!empty($vOrd_not))
			$bInsert = FALSE;
		else
		{
			$vOrd_not = '1';
			$vQuery = "Select (max(ord_not)+1) as ord_not from $tNota where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
			$vQuery .= "group by pln_est, cod_cur, per_aca";
			
			$cOrd_not = $xSerdata->query($vQuery);		
			while($aOrd_not = $cOrd_not->fetch_array())
				$vOrd_not = $aOrd_not['ord_not'];
			$cOrd_not->close();
		}		
		
		$vQuery = "Select num_mat from $tCurmat where pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and sec_gru = '$vSec_gru' and per_aca = '02' ";

		$cEstumat = $xSerdata->query($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vText = "r{$aEstumat['num_mat']}";
			$vNota = $$vText;
			if(empty($vNota))
				$vNota = 0;
			
			if($bInsert)
				$vQuery = "Insert into $tNota values ('{$aEstumat['num_mat']}', '$vPln_est', '$vCod_cur', '$vOrd_not', '02', $vNota)";
			else
				$vQuery = "Update $tNota set not_ept = $vNota where num_mat = '{$aEstumat['num_mat']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ord_not = '{$vOrd_not}' and per_aca = '02'";
			$cNota = $xSerdata->query($vQuery);
		}
		$cEstumat->close();
		$xSerdata->close();	
		header("Location:notaver.php?rCod_car={$vCod_car}&rPln_est={$vPln_est}&rCod_cur={$vCod_cur}&rSec_gru={$vSec_gru}");
	}
	else
	{
		header("Location:notas.php");
	}
?>