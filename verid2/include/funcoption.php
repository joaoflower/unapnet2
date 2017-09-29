<?php
	function fviewtipodoc($pTip_doc)
	{
		$vQuery = "Select tip_doc, doc_des from tipodoc where tip_doc != '00' order by tip_doc";
		$cTipodoc = fQuery2($vQuery);
		while($aTipodoc = mysql_fetch_array($cTipodoc))
		{
		?>
			<option value="<?=$aTipodoc['tip_doc']?>" <?=($aTipodoc['tip_doc'] == $pTip_doc?"Selected":"")?>><?=$aTipodoc['doc_des']?></option>
		<?
		}		
	}
	function fviewsexo($pSexo)
	{
		?>
		<option value="1" <?=('1' == $pSexo?"Selected":"")?>>MASCULINO</option>
		<option value="2" <?=('2' == $pSexo?"Selected":"")?>>FEMENINO</option>
		<?

	}
	function fviewmes($pCod_mes)
	{
		?>
		<option value="01" <?=("01" == $pCod_mes?"Selected":"")?>>ENERO</option>
		<option value="02" <?=("02" == $pCod_mes?"Selected":"")?>>FEBRERO</option>
		<option value="03" <?=("03" == $pCod_mes?"Selected":"")?>>MARZO</option>
		<option value="04" <?=("04" == $pCod_mes?"Selected":"")?>>ABRIL</option>
		<option value="05" <?=("05" == $pCod_mes?"Selected":"")?>>MAYO</option>
		<option value="06" <?=("06" == $pCod_mes?"Selected":"")?>>JUNIO</option>
		<option value="07" <?=("07" == $pCod_mes?"Selected":"")?>>JULIO</option>
		<option value="08" <?=("08" == $pCod_mes?"Selected":"")?>>AGOSTO</option>
		<option value="09" <?=("09" == $pCod_mes?"Selected":"")?>>SETIEMBRE</option>
		<option value="10" <?=("10" == $pCod_mes?"Selected":"")?>>OCTUBRE</option>
		<option value="11" <?=("11" == $pCod_mes?"Selected":"")?>>NOVIEMBRE</option>
		<option value="12" <?=("12" == $pCod_mes?"Selected":"")?>>DICIEMBRE</option>
		<?
	}
	function fviewdia_nac($pDia_nac)
	{
		$vDia = "";
		for($ii = 1; $ii <= 31; $ii++)
		{
			$vDia = (strlen($ii)==1?"0":"").$ii;
		?>
			<option value="<?=$vDia?>" <?=($vDia == $pDia_nac?"Selected":"")?>><?=$vDia?></option>
		<?
		}		
	}
	function fviewano_nac($pAno_nac)
	{
		for($ii = 1930; $ii <= 1995; $ii++)
		{
		?>
			<option value="<?=$ii?>" <?=($ii == $pAno_nac?"Selected":"")?>><?=$ii?></option>
		<?
		}		
	}
	function fviewestcivil($pEst_civ)
	{
		$vQuery = "Select est_civ, est_des from estcivil order by est_civ";
		$cEstcivil = fQuery2($vQuery);
		while($aEstcivil = mysql_fetch_array($cEstcivil))
		{
		?>
			<option value="<?=$aEstcivil['est_civ']?>" <?=($aEstcivil['est_civ'] == $pEst_civ?"Selected":"")?>><?=$aEstcivil['est_des']?></option>
		<?
		}		
	}
	function fviewgrupo($pSec_gru)
	{
		$vQuery = "Select sec_gru, sec_des from grupo where sec_gru != '' and sec_gru <= '03' order by sec_gru";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['sec_gru']?>" <?=($aResult['sec_gru'] == $pSec_gru?"Selected":"")?>><?=ucwords(strtolower($aResult['sec_des']))?></option>
		<?
		}		
	}
	function fviewcarrera($pCod_car)
	{
		$vQuery = "Select cod_car, car_des from carrera where cod_car != '' and (cod_car <= '36' or cod_car = '56') and cod_car != '19' order by cod_car";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['cod_car']?>" <?=($aResult['cod_car'] == $pCod_car?"Selected":"")?>><?=$aResult['car_des']?></option>
		<?
		}		
	}
	function fviewsisemestre($pCod_car, $pPln_est, $pSem_anu)
	{
		$vQuery = "select distinct cu.sem_anu, se.sem_des from curso cu left join semestre se on cu.sem_anu = se.sem_anu ";
		$vQuery .= "where cu.cod_car = '$pCod_car' and cu.pln_est = '$pPln_est' order by cu.sem_anu";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['sem_anu']?>" <?=($aResult['sem_anu'] == $pSem_anu?"Selected":"")?>><?=$aResult['sem_des']?></option>
		<?
		}	
	}
	function fviewsicurso($pCod_car, $pPln_est, $pSem_anu, $pCod_cur)
	{
	?>
		<option value="999" <?=('999' == $pCod_cur?"Selected":"")?>>Seleccione un curso ...!</option>
	<?
		$vQuery = "select cod_cur, nom_cur from curso ";
		$vQuery .= "where cod_car = '$pCod_car' and pln_est = '$pPln_est' and sem_anu = '$pSem_anu' and con_cur = '1' order by nom_cur";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['cod_cur']?>" <?=($aResult['cod_cur'] == $pCod_cur?"Selected":"")?>><?=$aResult['nom_cur']?></option>
		<?
		}	
	}
	function fviewsigrupo($pSec_gru)
	{
		$vQuery = "Select sec_gru, sec_des from grupo where sec_gru != '' and sec_gru <= '04' order by sec_gru";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['sec_gru']?>" <?=($aResult['sec_gru'] == $pSec_gru?"Selected":"")?>><?=$aResult['sec_des']?></option>
		<?
		}		
	}
	function fviewsiplan($pCod_car, $pPln_est)
	{
		$vQuery = "select pl.pln_est, ts.sis_des, pl.des_pln from plan pl left join tiposist ts on pl.tip_sist = ts.tip_sist ";
		$vQuery .= "where pl.cod_car = '$pCod_car' and pl.con_pln = '1' ";

		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['pln_est']?>" <?=($aResult['pln_est'] == $pPln_est?"Selected":"")?>><?=$aResult['pln_est']?> - <?=$aResult['sis_des']?> - <?=$aResult['des_pln']?></option>
		<?
		}		
	}

	function fviewsemgruesp($pClave)
	{
		$tHora = "hora".$_SESSION['sUsercod_car'].$_SESSION['sFrameano_aca'];
		
		$vQuery = "select hora.sem_anu, hora.sec_gru, hora.sec_des, hora.cod_esp, esp.esp_nom, ";
		$vQuery .= "concat(hora.sem_anu, hora.sec_gru, hora.cod_esp) as clave ";
		$vQuery .= "from ( ";
		$vQuery .= "select distinct ho.cod_car, ho.pln_est, cu.sem_anu, ho.sec_gru, gr.sec_des, cu.cod_esp ";
		$vQuery .= "from $tHora ho left join curso cu on ho.cod_car = cu.cod_car and ";
		$vQuery .= "   ho.pln_est = cu.pln_est and ho.cod_cur = cu.cod_cur ";
		$vQuery .= "left join grupo gr on ho.sec_gru = gr.sec_gru ";
		$vQuery .= "where ho.per_aca = '{$_SESSION['sFrameper_aca']}' and ho.pln_est = '{$_SESSION['sEstupln_est']}' ";
		$vQuery .= "order by cu.sem_anu, ho.sec_gru, cu.cod_esp ";
		$vQuery .= ") hora ";
		$vQuery .= "left join especial esp on hora.cod_car = esp.cod_car and ";
		$vQuery .= "hora.pln_est = esp.pln_est and hora.cod_esp = esp.cod_esp ";
		$cResult = fQuery($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['clave']?>" <?=($aResult['clave'] == $pClave?"Selected":"")?>><?=$aResult['sem_anu']?>-<?=ucwords(strtolower($aResult['sec_des']))?>-<?=ucwords(strtolower($aResult['esp_nom']))?></option>
		<?
		}		
	}
	
	//--------------------------------------------------
	function fviewhoragrupo($pCod_esp, $pCod_cur, $pHra_ini, $pHra_fin, $pCod_sec)
	{
		session_start();
		$vHra_sec = $pHra_ini.$pHra_fin.$pCod_sec;
		
		$vQuery = "Select gp.cod_gpo, gp.hra_ini, gp.hra_fin, gp.cod_sec, hr1.des_hra as dhra_ini, hr2.des_hra as dhra_fin, ";
		$vQuery .= "sec.des_sec, concat(gp.hra_ini, gp.hra_fin, gp.cod_sec) as hra_sec ";
		$vQuery .= "from gruposhab gp left join seccion sec on gp.cod_sec = sec.cod_sec ";
		$vQuery .= "left join horas hr1 on gp.hra_ini = hr1.cod_hra  left join horas hr2 on gp.hra_fin = hr2.cod_hra ";
		$vQuery .= "where gp.cod_esp = '$pCod_esp' and gp.cod_cur = '$pCod_cur' and gp.anio = '{$_SESSION['sCidano']}' and ";
		$vQuery .= "gp.cod_mes = '{$_SESSION['sCidmes']}' order by gp.hra_ini, gp.hra_fin, gp.cod_sec ";
		$cGrupos = fQueryi($vQuery);
		while($aGrupos = mysql_fetch_array($cGrupos))
		{
		?>
			<option value="<?=$aGrupos['cod_gpo']?>" <?=($aGrupos['hra_sec'] == $vHra_sec?"Selected":"")?>><?=$aGrupos['dhra_ini']?> - <?=$aGrupos['dhra_fin']?> - [ <?=$aGrupos['des_sec']?> ]</option>
		<?
		}		
	}
	function fviewtipopago($pTip_pag)
	{
		$vQuery = "Select tip_pag, des_pag from tipopago ";
		$cTipopago = fQueryi($vQuery);
		while($aTipopago = mysql_fetch_array($cTipopago))
		{
		?>
			<option value="<?=$aTipopago['tip_pag']?>" <?=($aTipopago['tip_pag'] == $pTip_pag?"Selected":"")?>><?=$aTipopago['des_pag']?></option>
		<?
		}		
	}
	
	//-------------------------------------------------------------------------
	
	function fviewcondocen($pCnd_prf)
	{
		$vQuery = "select cnd_prf, cnd_des from condocen ";
		$cResult = fQuery($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['cnd_prf']?>" <?=($aResult['cnd_prf'] == $pCnd_prf?"Selected":"")?>><?=$aResult['cnd_des']?></option>
		<?
		}	
	}
	function fviewcatedocen($pCod_cat)
	{
		$vQuery = "select cod_cat, cat_des from catedocen ";
		$cResult = fQuery($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['cod_cat']?>" <?=($aResult['cod_cat'] == $pCod_cat?"Selected":"")?>><?=$aResult['cat_des']?></option>
		<?
		}	
	}
	function fviewgrudocen($pCod_gru)
	{
		$vQuery = "select cod_gru, gru_des from grudocen ";
		$cResult = fQuery($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['cod_gru']?>" <?=($aResult['cod_gru'] == $pCod_gru?"Selected":"")?>><?=$aResult['gru_des']?></option>
		<?
		}	
	}
	function fviewdepacad($pDep_aca)
	{
		$vQuery = "select dep_aca, dep_des from depacad where dep_aca != '' ";
		$cResult = fQuery($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['dep_aca']?>" <?=($aResult['dep_aca'] == $pDep_aca?"Selected":"")?>><?=$aResult['dep_des']?></option>
		<?
		}	
	}
	function fviewcompeuna($pCom_una)
	{
		session_start();
		for($ii = 1; $ii <= $_SESSION["sSilacan_com"]; $ii++)
		{
		?>
			<option value="<?=$ii?>" <?=($ii == $pCom_una?"Selected":"")?>><?=$ii?> - <?=substr($_SESSION["sSilacom".$ii], 0, 30)?> ...</option>
		<?
		}	
	}
	function fviewtipoevalua($pTip_eva)
	{
		$vQuery = "select tip_eva, eva_des from tipoeva where tip_eva != '' order by eva_des";
		$cResult = fQuery2($vQuery);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<option value="<?=$aResult['tip_eva']?>" <?=($aResult['tip_eva'] == $pTip_eva?"Selected":"")?>><?=$aResult['eva_des']?></option>
		<?
		}	
	}
	function fviewunipro($pUni_pro)
	{
		session_start();
		for($ii = 1; $ii <= $_SESSION["sSilacan_una"]; $ii++)
		{
		?>
			<option value="<?=$ii?>" <?=($ii == $pUni_pro?"Selected":"")?>><?=$ii?></option>
		<?
		}	
	}
?>