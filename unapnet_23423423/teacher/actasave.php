<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyds2())
		header("Location:../.");

		//-------------------------------------------------------
	$vSendData = $_GET['rSendData'];
	$rCod_car = substr($vSendData, 20, 4);
	$rPln_est = substr($vSendData, 44, 4);
	$rCod_cur = substr($vSendData, 68, 6);
	$rSec_gru = substr($vSendData, 94, 4);
	$rMod_mat = substr($vSendData, 118, 4);
	$rIns_upd = substr($vSendData, 122, 2);	
	$rTip_not = substr($vSendData, 124, 2);
	$rOrd_not = substr($vSendData, 126, 2);

	$vQuery = "Select 0x$rCod_car as cod_car, 0x$rPln_est as pln_est, 0x$rCod_cur as cod_cur, 0x$rSec_gru as sec_gru, ";
	$vQuery .= " 0x$rMod_mat as mod_mat, 0x$rIns_upd as ins_upd, 0x$rTip_not as tip_not, 0x$rOrd_not as ord_not";
	$cDatos = fQuery($vQuery);
	if($aDatos = mysql_fetch_array($cDatos))
	{
		$vCod_car = $aDatos['cod_car'];
		$vPln_est = $aDatos['pln_est'];
		$vCod_cur = $aDatos['cod_cur'];	
		$vSec_gru = $aDatos['sec_gru'];
		$vMod_mat = $aDatos['mod_mat'];
		$vIns_upd = $aDatos['ins_upd'];
		$vTip_not = $aDatos['tip_not'];
		$vOrd_not = $aDatos['ord_not'];
	}

	if(!empty($sCarrera[$vCod_car]))
	{
		$aModnot = "";
		
		$tCurmat = "unapnet.curmat{$vCod_car}{$sUser['ano_aca']}";
		$tApla = "unapnet.apla{$sUser['ano_aca']}";
		$tNota = "unapnet.nota{$vCod_car}";
		$tNotaca = "unapnet.notaca{$vCod_car}{$sUser['ano_aca']}";

		($vTip_not == 'C'?$vMax_not=20:$vMax_not=2);
		
/*		$vQuery = "Select cm.num_mat, mm.mod_not ";
		$vQuery .= "from $tCurmat cm left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
		$vQuery .= "where cm.pln_est = '$vPln_est' and cm.per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "cm.cod_cur = '$vCod_cur' and cm.sec_gru = '$vSec_gru' and ";
		$vQuery .= "mm.mod_act = '$vMod_mat' ";
		$cModnot = fQuery($vQuery);
		while($aModnot2 = mysql_fetch_array($cModnot))
		{
			$aModnot[$aModnot2['num_mat']] = $aModnot2['mod_not'];
		}*/
		
/*		$vQuery = "Select num_mat from $tNota where cod_car = '$vCod_car' and pln_est = '$vPln_est' and ";
		$vQuery .= "cod_cur = '$vCod_cur' and mod_not = '01' and ano_aca = '{$sUser['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$sUser['per_aca']}'";
		$cNota2 = fQuery($vQuery);
		if($aNota2 = mysql_fetch_array($cNota2))
		{
			$aNota[$aNota2['num_mat']] = true;
		}*/

		if($vMod_mat == '02' or $vMod_mat == '08')
		{
			$vQuery = "Select ap.num_mat, ap.mod_mat as mod_not  ";
			$vQuery .= "from $tApla ap ";
			$vQuery .= "where ap.cod_car  = '$vCod_car' and ap.per_aca = '{$sUser['per_aca']}' and ap.pln_est = '$vPln_est' and ";
			$vQuery .= "ap.cod_cur = '$vCod_cur' and ap.sec_gru = '$vSec_gru' and ap.mod_mat = '$vMod_mat' ";
			$vQuery .= "order by num_mat ";
		}
		else
		{
			$vQuery = "Select cm.num_mat, mm.mod_not ";
			$vQuery .= "from $tCurmat cm ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '$vPln_est' and cm.cod_cur = '$vCod_cur' and cm.sec_gru = '$vSec_gru' and ";
			$vQuery .= "cm.per_aca = '{$sUser['per_aca']}' and mm.mod_act = '$vMod_mat' ";
			$vQuery .= "order by num_mat ";
		}
		$cEstumat = fQuery($vQuery);
		while($aEstumat = mysql_fetch_array($cEstumat))
		{
//			$vText = "r{$aEstumat['num_mat']}";
			$vNota = $_POST["r{$aEstumat['num_mat']}"];
			if(empty($vNota) || $vNota < 0 || $vNota > $vMax_not)
				$vNota = 0;
				
			$vMod_not = $aModnot[$aEstumat['num_mat']];
			if($vIns_upd == 'I')
			{			
				
				// falta corregir la modalidad de nota
				$vQuery = "Insert into $tNotaca (num_mat, pln_est, cod_cur, per_aca, ano_aca, mod_not, cod_car, tip_not, ";
				$vQuery .= "ord_not, not_cur) values ('{$aEstumat['num_mat']}', '$vPln_est', '$vCod_cur', '{$sUser['per_aca']}', ";
				$vQuery .= "'{$sUser['ano_aca']}', '{$aEstumat['mod_not']}', ";
				$vQuery .= "'$vCod_car', '$vTip_not', '$vOrd_not', '$vNota')";
				$cNota = fInupde($vQuery);
			}
			else
			{	
				$vQuery = "Update $tNotaca set not_cur = '$vNota' where num_mat = '{$aEstumat['num_mat']}' and ";
				$vQuery .= "pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and per_aca = '{$sUser['per_aca']}' and ";
				$vQuery .= "ano_aca = '{$sUser['ano_aca']}' and mod_not = '{$aEstumat['mod_not']}' and ";
				$vQuery .= "cod_car = '$vCod_car' and tip_not = '$vTip_not' and ord_not = '$vOrd_not'";
				$cNota = fInupde($vQuery);
				if($cNota)
				{
					$vQuery = "Insert into $tNotaca (num_mat, pln_est, cod_cur, per_aca, ano_aca, mod_not, cod_car, tip_not, ";
					$vQuery .= "ord_not, not_cur) values ('{$aEstumat['num_mat']}', '$vPln_est', '$vCod_cur', '{$sUser['per_aca']}', ";
					$vQuery .= "'{$sUser['ano_aca']}', '{$aEstumat['mod_not']}', ";
					$vQuery .= "'$vCod_car', '$vTip_not', '$vOrd_not', '$vNota')";
					$cNota = fInupde($vQuery);
				}
				
			}
			
/*			if(!$aNota[$aEstumat['num_mat']])
			{
				$vQuery2 = "Insert into $tNota (num_mat, cod_car, pln_est, cod_cur, mod_not, ano_aca, per_aca, not_cur, mod_ing) ";
				$vQuery2 .= " values ('{$aEstumat['num_mat']}', '$vCod_car', '$vPln_est', '$vCod_cur', '01', ";
				$vQuery2 .= "'{$sUser['ano_aca']}', '{$sUser['per_aca']}', 0, '01')"; 			
				$cNota = fInupde($vQuery2);
			}*/
			
		}
		header("Location:actaver.php?rSendData=".substr($vSendData, 0, 122));
	}
	else
	{
		header("Location:actas.php");
	}


/*	if($sUser['Notas'] == 'b')
		$sUser['Notas'] = 'a';
	else
		header("Location:actaver.php");
	
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
			case '1': $vDes_not = "Capacidad"; break;
			case '2': $vDes_not = "Actitud"; break;
//			case '3': $vDes_not = "Trabajo"; break;
			default: header("Location:actas.php"); break;
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
			header("Location:actas.php");
		$cPlan->close();
		
		$vQuery = "Select cod_cur from $tCarga where pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "cod_prf like '%{$sUser['codigo']}' and per_aca = '02' and sec_gru = '$vSec_gru'";
		$cCarga = $xSerdata->query($vQuery);
		if($aCarga = $cCarga->fetch_array())
			$vCod_cur = ucwords(strtolower($aCarga['cod_cur']));
		else
			header("Location:actas.php");
		$cCarga->close();

		switch($vTip_not)
		{
			case '1': $tNota = "caw{$vCod_car}.nc{$vCod_car}2004"; break;
			case '2': $tNota = "caw{$vCod_car}.na{$vCod_car}2004"; break;
//			case '3': $tNota = "caw{$vCod_car}.nt{$vCod_car}2004"; break;
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
				$vQuery = "Update $tNota set not_cac = $vNota where num_mat = '{$aEstumat['num_mat']}' and pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ord_not = '{$vOrd_not}' and per_aca = '02'";
			$cNota = $xSerdata->query($vQuery);
		}
		$cEstumat->close();
		$xSerdata->close();	
		header("Location:actaver.php?rCod_car={$vCod_car}&rPln_est={$vPln_est}&rCod_cur={$vCod_cur}&rSec_gru={$vSec_gru}");
	}
	else
	{
		header("Location:actas.php");
	}*/
?>