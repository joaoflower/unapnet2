<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyds2())
		header("Location:../.");

		//-------------------------------------------------------
		
	$vOK = FALSE;
	
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

	$tNotaca = "unapnet.notaca{$vCod_car}{$sUser['ano_aca']}";
	$tCurmat = "unapnet.curmat{$vCod_car}{$sUser['ano_aca']}";
	$tApla = "unapnet.apla{$sUser['ano_aca']}";

	if($vTip_not === 'C')
	{
		//----------------------------------------------------
		$vQuery = "select max(no.ord_not) as ord_not ";
		$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
		$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and no.per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "no.ano_aca = '{$sUser['ano_aca']}' and mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and ";
		$vQuery .= "no.tip_not = 'C' and no.num_mat in ";
		$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "sec_gru = '$vSec_gru')";
		$cCan_cap = fQuery($vQuery);
		if($aCan_cap = mysql_fetch_array($cCan_cap))
			$vCan_cap = $aCan_cap['ord_not'];
		(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
	}
	elseif($vTip_not === 'A')
	{
		//----------------------------------------------------
		$vQuery = "select max(no.ord_not) as ord_not ";
		$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
		$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and no.per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "no.ano_aca = '{$sUser['ano_aca']}' and mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and ";
		$vQuery .= "no.tip_not = 'A' and no.num_mat in ";
		$vQuery .= "(Select num_mat from $tCurmat where per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "sec_gru = '$vSec_gru')";
		$cCan_act = fQuery($vQuery);
		if($aCan_act = mysql_fetch_array($cCan_act))
			$vCan_act = $aCan_act['ord_not'];
		(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
	}	
	
	if($vTip_not === 'C' and $vOrd_not == $vCan_cap)
	{
		$vOK = TRUE;
	}
	elseif($vTip_not === 'A' and $vOrd_not == $vCan_act)
	{
		$vOK = TRUE;
	}
	
	if(!empty($sCarrera[$vCod_car]) and $vOK)
	{
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
			$vQuery = "Delete from $tNotaca where num_mat = '{$aEstumat['num_mat']}' and ";
			$vQuery .= "pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and per_aca = '{$sUser['per_aca']}' and ";
			$vQuery .= "ano_aca = '{$sUser['ano_aca']}' and mod_not = '{$aEstumat['mod_not']}' and ";
			$vQuery .= "cod_car = '$vCod_car' and tip_not = '$vTip_not' and ord_not = '$vOrd_not'";
			
			$cNota = fInupde($vQuery);
		}
		header("Location:actaver.php?rSendData=".substr($vSendData, 0, 122));
	}
	else
	{
		header("Location:actas.php");
	}
?>