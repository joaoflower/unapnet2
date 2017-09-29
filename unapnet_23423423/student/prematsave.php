<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");

	$tEstutor = "unapnet.estutut{$sUser['cod_car']}2004";
	$tCurtutor = "unapnet.curtut{$sUser['cod_car']}2004";
	$tEstuwat = "unapnet.estumat{$sUser['cod_car']}2004";
	$tCurwat = "unapnet.curmat{$sUser['cod_car']}2004";
	
	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	
	$vQuery = "Select cod_esp, pln_est, mod_mat, tot_crd from $tEstutor where num_mat = '{$sUser['codigo']}' and per_aca = '02'";
	$cEstutor = $xSerdata->query($vQuery);
	if($aEstutor = $cEstutor->fetch_array())
	{
		$vFecha = getdate(time());
		$vFch_mat = "{$vFecha['year']}-{$vFecha['mon']}-{$vFecha['mday']} {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']}";
		$vQuery = "Insert into $tEstuwat values ('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$aEstutor['pln_est']}', '', '01', '1', '2004', '02', '{$aEstutor['cod_esp']}', ";
		$vQuery .= "'{$aEstutor['mod_mat']}', '$vFch_mat', '', '', '', {$aEstutor['tot_crd']}, '01')";
		
		$cEstuwat = $xSerdata->query($vQuery);
		if($cEstuwat)
		{
			$vQuery = "Select pln_est, cod_cur, mod_mat from $tCurtutor where num_mat = '{$sUser['codigo']}' and per_aca = '02'";
			$cCurtutor = $xSerdata->query($vQuery);
			while($aCurtutor = $cCurtutor->fetch_array())
			{
				$vQuery = "Insert into $tCurwat values ('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$aCurtutor['pln_est']}', '{$aCurtutor['cod_cur']}', ";
				$vQuery .= "'2004', '02', '{$aCurtutor['mod_mat']}', '01', '1', '', '')";
				
				$cCurwat = $xSerdata->query($vQuery);
				if(!$cCurwat)
					header("Location:prematricula.php");
			}
			header("Location:prematricula.php");
		}
		else
		{
			header("Location:prematricula.php");
		}
	}
	else
	{
		header("Location:tutoria.php");
	}
	$xSerdata->close();
?>