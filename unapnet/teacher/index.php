<?php
	session_start();	
	include "../../include/funcunap.php";
	include "../../include/funcsql.php";
	
	if(fverifyds())
	{
		$sUser['safetyd2'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
		
		$sUser['ano_aca'] = '2006';
		$sUser['per_aca'] = '02';
		
		session_register("sPeriodo");
		session_register("sPeriodoa");
		session_register("sArea");
		session_register("sTipcur");
		session_register("sDia");
		session_register("sModnot");
		session_register("sNivel");
		session_register("sSemestre");
		session_register("sGrupo");
		session_register("sModmat");		
		session_register("sTurno");
		session_register("sEspecial");
		session_register("sHorario");
		session_register("sTutor");
		session_register("sCuramat");
		session_register("sEstupdf");
		session_register("sActapdf");
		
		$sUser['ip'] = $REMOTE_ADDR;
				
		//--------------------------------
		$sPeriodo['00'] = 'Unico';
		$sPeriodo['01'] = 'Periodo I';
		$sPeriodo['02'] = 'Periodo II';
		$sPeriodo['03'] = 'Vacacional';
		
		//--------------------------------
		$sPeriodoa['00'] = 'U';
		$sPeriodoa['01'] = 'I';
		$sPeriodoa['02'] = 'II';
		$sPeriodoa['03'] = 'VAC';
		
		//--------------------------------
		$sDia['1'] = 'Lunes';
		$sDia['2'] = 'Martes';
		$sDia['3'] = 'Miércoles';
		$sDia['4'] = 'Jueves';
		$sDia['5'] = 'Viernes';
		$sDia['6'] = 'Sábado';
		$sDia['7'] = 'Domingo';
		
		$vQuery = "Select tip_cur, cur_des from unapnet.tipcur";
		$cTipcur = fQuery($vQuery);
		while($aTipcur = mysql_fetch_array($cTipcur))
			$sTipcur[$aTipcur['tip_cur']] = ucwords(strtolower($aTipcur['are_des']));
		
		$vQuery = "Select cod_are, are_des from unapnet.areaca";
		$cArea = fQuery($vQuery);
		while($aArea = mysql_fetch_array($cArea))
			$sArea[$aArea['cod_are']] = ucwords(strtolower($aArea['are_des']));
		
		$vQuery = "Select mod_not, not_des from unapnet.modnot";
		$cModnot = fQuery($vQuery);
		while($aModnot = mysql_fetch_array($cModnot))
			$sModnot[$aModnot['mod_not']] = ucwords(strtolower($aModnot['not_des']));
		
		$vQuery = "Select niv_est, niv_des from unapnet.nivel";
		$cNivel = fQuery($vQuery);
		while($aNivel = mysql_fetch_array($cNivel))
			$sNivel[$aNivel['niv_est']] = ucwords(strtolower($aNivel['niv_des']));
		
		$vQuery = "Select sem_anu, sem_des from unapnet.semestre";
		$cSemestre = fQuery($vQuery);
		while($aSemestre = mysql_fetch_array($cSemestre))
			$sSemestre[$aSemestre['sem_anu']] = ucwords(strtolower($aSemestre['sem_des']));
		
		$vQuery = "Select sec_gru, sec_des from unapnet.grupo where sec_gru <> '' and sec_gru < '07'";
		$cGrupo = fQuery($vQuery);
		while($aGrupo = mysql_fetch_array($cGrupo))
			$sGrupo[$aGrupo['sec_gru']] = ucwords(strtolower($aGrupo['sec_des']));
		
		$vQuery = "Select mod_mat, mod_des from unapnet.modmat";
		$cModmat = fQuery($vQuery);
		while($aModmat = mysql_fetch_array($cModmat))
			$sModmat[$aModmat['mod_mat']] = ucwords(strtolower($aModmat['mod_des']));
		
		$vQuery = "Select tur_est, tur_des from unapnet.turno";
		$cTurno = fQuery($vQuery);
		while($aTurno = mysql_fetch_array($cTurno))
			$sTurno[$aTurno['tur_est']] = ucwords(strtolower($aTurno['tur_des']));

		$vQuery = "Select tip_sist, sis_des from unapnet.tiposist";
		$cTiposist = fQuery($vQuery);
		while($aTiposist = mysql_fetch_array($cTiposist))
			$sTiposist[$aTiposist['tip_sist']] = ucwords(strtolower($aTiposist['sis_des']));		

		$vQuery = "Select cod_hor, hrs_ini, hrs_fin from unapnet.codhora";
		$cCodhora = fQuery($vQuery);
		while($aCodhora = mysql_fetch_array($cCodhora))
		{
			$sCodhora[$aCodhora['cod_hor']] = "{$aCodhora['hrs_ini']}-{$aCodhora['hrs_fin']}";
		}

/*		$vQuery = "Select cod_esp, esp_nom from unapnet.especial where cod_car = '{$sUser['cod_car']}'";
		$cEspecial = fQuery($vQuery);
		while($aEspecial = mysql_fetch_array($cEspecial))
			$sEspecial[$aEspecial['cod_esp']] = ucwords(strtolower($aEspecial['esp_nom']));*/
		
		$vQuery = "Select cod_hor, hrs_ini, hrs_fin from unapnet.codhora";
		$cHorario = fQuery($vQuery);
		while($aHorario = mysql_fetch_array($cHorario))
			$sHorario[$aHorario['cod_hor']] = "{$aHorario['hrs_ini']}-{$aHorario['hrs_fin']}";
				
		header("Location:index2.php");		
	}
	else
		header("Location:../.");
?>
