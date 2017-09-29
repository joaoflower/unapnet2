<?php
	session_start();	
	include "../../include/funcunap.php";
	include "../../include/funcsql.php";
	
	if(fverifyss())
	{
		$sUser['safetys2'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
		session_register("sPeriodo");
		session_register("sArea");
		session_register("sTipcur");
		session_register("sDia");
		session_register("sModnot");
		session_register("sNivel");
		session_register("sSemestre");
		session_register("sGrupo");
		session_register("sModmat");		
		session_register("sTurno");
		session_register("sTiposist");
		session_register("sPlan");
		session_register("sEspecial");
		session_register("sCodhora");
		session_register("sTutor");
		session_register("sCuramat");
		session_register("sNotapdf");
		session_register("sCursopdf");
		
		session_register("sCurso");
		session_register("sCurmat");
		session_register("sCurmat2");
		session_register("sCurapto");
		
				
		$sUser['ip'] = $REMOTE_ADDR;
		//--------------------------------
		$sPeriodo['00'] = 'Unico';
		$sPeriodo['01'] = 'Periodo I';
		$sPeriodo['02'] = 'Periodo II';
		$sPeriodo['03'] = 'Vacacional';
		
		//--------------------------------
		/*$sArea['01'] = 'Formación General';
		$sArea['02'] = 'Formación Profesional Básica';
		$sArea['03'] = 'Formación Profesional Específica';
		$sArea['04'] = 'Formación Profesional de Orientación';
		$sArea['05'] = 'Investigación';
		$sArea['06'] = 'Prácticas Pre profesionales';*/
		
		//--------------------------------
		/*$sTipcur['01'] = 'Obligatorio';
		$sTipcur['02'] = 'Electivo';
		$sTipcur['03'] = 'Optativo';*/
		
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
			$sTipcur[$aTipcur['tip_cur']] = ucwords(strtolower($aTipcur['cur_des']));
		
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
		
		//----------
		$bUltmat = FALSE;
		$vAno_ini = substr($sUser['codigo'], 0, 2);
		if($vAno_ini < '50') 
			$vAno_ini = "20$vAno_ini";
		else
			$vAno_ini = "1999";
			
		for($vAno_aca = 2004; $vAno_aca >= $vAno_ini and !$bUltmat; $vAno_aca--)
		{
			$tEstumat = "unapnet.estumat{$sUser['cod_car']}$vAno_aca";
			$vQuery = "Select pln_est, per_aca, cod_esp, mod_mat, tot_crd from $tEstumat where num_mat = '{$sUser['codigo']}' ";
			$vQuery .= "and (per_aca = '01' or per_aca = '02') order by per_aca desc";
			
			$cEstumat = fQuery($vQuery);
			while($aEstumat = mysql_fetch_array($cEstumat))
			{
				$sUser['pln_est'] = $aEstumat['pln_est'];
				$sUser['cod_esp'] = $aEstumat['cod_esp'];
				$sUser['ano_aca'] = $vAno_aca;
				$sUser['per_aca'] = $aEstumat['per_aca'];
				$sUser['mod_mat2'] = $aEstumat['mod_mat'];
				$sUser['tot_crd2'] = $aEstumat['tot_crd'];
				$bUltmat = TRUE;
				break;
			}				
		}		
		//----------
		
		$vQuery = "Select pln_est, tip_sist from unapnet.plan where cod_car = '{$sUser['cod_car']}' and pln_est = '{$sUser['pln_est']}'";
		$cPlan = fQuery($vQuery);
		while($aPlan = mysql_fetch_array($cPlan))
			$sPlan[$aPlan['pln_est']] = $aPlan['tip_sist'];
		
		$vQuery = "Select cod_esp, esp_nom from unapnet.especial where cod_car = '{$sUser['cod_car']}' and pln_est = '{$sUser['pln_est']}'";
		$cEspecial = fQuery($vQuery);
		while($aEspecial = mysql_fetch_array($cEspecial))
			$sEspecial[$aEspecial['cod_esp']] = ucwords(strtolower($aEspecial['esp_nom']));
		
		$sUser['tip_sist'] = $sPlan[$sUser['pln_est']];
		
		$sCurso = "";
		$vQuery = "select cod_cur, cod_cat, nom_cur, sem_anu, cod_esp, crd_cur, tip_pre, tip_cur, crd_prq ";
		$vQuery .= "from unapnet.curso where cod_car = '{$sUser['cod_car']}' and pln_est = '{$sUser['pln_est']}' ";
		$vQuery .= "and (cod_esp = '00' or cod_esp = '{$sUser['cod_esp']}') order by sem_anu, cod_cur";
		$cCurso = fQuery($vQuery);
		while($aCurso = mysql_fetch_array($cCurso))
		{
			$sCurso[$aCurso['cod_cur']]['cod_cat'] = $aCurso['cod_cat'];
			$sCurso[$aCurso['cod_cur']]['nom_cur'] = $aCurso['nom_cur'];
			$sCurso[$aCurso['cod_cur']]['sem_anu'] = $aCurso['sem_anu'];
			$sCurso[$aCurso['cod_cur']]['cod_esp'] = $aCurso['cod_esp'];
			$sCurso[$aCurso['cod_cur']]['crd_cur'] = $aCurso['crd_cur'];
			$sCurso[$aCurso['cod_cur']]['tip_pre'] = $aCurso['tip_pre'];
			$sCurso[$aCurso['cod_cur']]['tip_cur'] = $aCurso['tip_cur'];
			$sCurso[$aCurso['cod_cur']]['crd_prq'] = $aCurso['crd_prq'];
		}

		header("Location:index2.php");		
	}
	else
		header("Location:../.");
?>
