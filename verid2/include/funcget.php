<?php
	function fgetconnect()
	{
/*		$_SESSION["sDbHost"] = 'localhost';
		$_SESSION["sDbUser"] = 'root';
		$_SESSION["sDbPasswd"] = '';
		
		$_SESSION["sDb2Host"] = 'localhost';
		$_SESSION["sDb2User"] = 'root';
		$_SESSION["sDb2Passwd"] = '';
		
		$_SESSION["sDbiHost"] = 'localhost';
		$_SESSION["sDbiUser"] = 'root';
		$_SESSION["sDbiPasswd"] = '';*/
		
		$_SESSION["sDbHost"] = '10.1.1.134';
		$_SESSION["sDbUser"] = 'unapmatri';
		$_SESSION["sDbPasswd"] = 'master2005';
		
		$_SESSION["sDb2Host"] = '10.1.1.134';
		$_SESSION["sDb2User"] = 'unapmatri';
		$_SESSION["sDb2Passwd"] = 'master2005';
		
		$_SESSION["sDbiHost"] = '10.1.115.15';
		$_SESSION["sDbiUser"] = 'developer';
		$_SESSION["sDbiPasswd"] = 'xDeveloper2k7';
	}
	function fgetpassword($pPasswd)
	{
		$vQuery = "Select password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = mysql_fetch_array($cPasswd))
		{
			return $aPasswd['passwd'];
		}		
	}
	function fsafetylogin()
	{
		if($_SESSION['sUsertip_usu'] === 'student')
		{
			if($_SESSION['sSafetylogin'] == '*E64C43A32CDCA595E9F49426B88646EEAA618E0D')
				return TRUE;
			else
				return FALSE;
		}
		elseif($_SESSION['sUsertip_usu'] === 'teacher')
		{
			if($_SESSION['sSafetylogin'] == '*4D3135D9A09A85FE3E45C245957210F8818F880A')
				return TRUE;
			else
				return FALSE;
		}
		elseif($_SESSION['sUsertip_usu'] === 'cti')
		{
			if($_SESSION['sSafetylogin'] == '*E64C43A32CDCA595E9F49426B88646EEAA618E0D')
				return TRUE;
			else
				return FALSE;
		}
	}
	
	//-------------------------------------------------------
	
	function fFecha()
	{
		$vQuery = "Select now() as fch_mat";
		$cFecha = fQuery($vQuery);
		if($aFecha = mysql_fetch_array($cFecha) )
			return $aFecha['fch_mat'];
	}
	function fFechastd($pFecha)
	{
		$vFecha = $pFecha;
		$vAmpm = "";
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4)." ";
		if(substr($vFecha, 11, 2) == '00')
		{
			$vHora = '12';	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) >= '01' and substr($vFecha, 11, 2) <= '11')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'AM';
		}
		if(substr($vFecha, 11, 2) == '12')
		{
			$vHora = substr($vFecha, 11, 2);	$vAmpm = 'PM';
		}
		if(substr($vFecha, 11, 2) >= '13' and substr($vFecha, 11, 2) <= '23')
		{
			$vHora = substr($vFecha, 11, 2) - 12;
			$vHora = ((strlen((string)$vHora) == 1)?'0':'').(string)$vHora;
			$vAmpm = 'PM';
		}
		
		$vReturn .= $vHora.":".substr($vFecha, 14, 2).":".substr($vFecha, 17, 2)." ".$vAmpm;
		return $vReturn;
	}
	
	function fFechad($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 8, 2)."/".substr($vFecha, 5, 2)."/".substr($vFecha, 0, 4);
		return $vReturn;
	}
	function fFechamy($pFecha)
	{
		$vFecha = $pFecha;
		$vReturn = substr($vFecha, 6, 4)."-".substr($vFecha, 3, 2)."-".substr($vFecha, 0, 2);
		return $vReturn;
	}
	
	//----------------------------------------------------
	function fVerinotaapr($pNot_cur, $pTip_not)
	{
		if($pTip_not == 'C')
		{
			if($pNot_cur >= 0 and $pNot_cur <= 10)
				return FALSE;
			elseif($pNot_cur > 10 and $pNot_cur <= 20)
				return TRUE;
		}
		elseif($pTip_not == 'A')
		{
			if($pNot_cur >= 0 and $pNot_cur <= 2)
				return TRUE;
			else
				return FALSE;
		}
	}
	function fIsnota($pNot_cur)
	{
		if($pNot_cur >= 0 and $pNot_cur <= 20 and strlen($pNot_cur) > 0) 
			return TRUE;
		else
			return FALSE;
	}
	//------------------------------------------------
	function fModestumat ($pVeces, $pPromedio, $pPromediop, $pCrdapro, $pCrddes, $pCrdall)
	{
		$_SESSION['sEstumod_mat'] = '01';
		$_SESSION['sEstumax_crd'] = 24.00;
		$_SESSION['sEstusem_anu'] = '01';
		
		$sCredicar = "";
		$vTot_crd = 0;		
		
		$vQuery = "Select * from credicar where cod_car = '{$_SESSION['sUsercod_car']}' and ";
		$vQuery .= "pln_est = '{$_SESSION['sEstupln_est']}' ";
		$cCredicar = fQuery($vQuery);
		$sCredicar = mysql_fetch_array($cCredicar);
		
		if($_SESSION['sEstupen_mat'] == TRUE and $pPromedio <= $sCredicar['prd_2sc'] and $pPromediop <= $sCredicar['prd_2sc'] and $pVeces >= 2 )
		{
			$_SESSION['sEstumod_mat'] = '07';
			$_SESSION['sEstumax_crd'] = $sCredicar['crd_obs'];				
		}
		else
		{
			switch ($pVeces)			
			{
				case 0: 
				case 1: $_SESSION['sEstumod_mat'] = '01';	break;
				case 2: $_SESSION['sEstumod_mat'] = '18';	break;
				case 3: $_SESSION['sEstumod_mat'] = '08';	break;
				case 4: $_SESSION['sEstumod_mat'] = '11';	break;
				case 5: $_SESSION['sEstumod_mat'] = '13';	break;
				case 6: $_SESSION['sEstumod_mat'] = '14';	break;
				case 7: $_SESSION['sEstumod_mat'] = '15';	break;
				case 8: $_SESSION['sEstumod_mat'] = '20';	break;
				case 9: $_SESSION['sEstumod_mat'] = '21';	break;
				case 10: $_SESSION['sEstumod_mat'] = '22';	break;
				case 11: $_SESSION['sEstumod_mat'] = '23';	break;
				case 12: $_SESSION['sEstumod_mat'] = '24';	break;
				case 13: $_SESSION['sEstumod_mat'] = '25';	break;
				case 14: $_SESSION['sEstumod_mat'] = '26';	break;
				case 15: $_SESSION['sEstumod_mat'] = '27';	break;
				case 16: $_SESSION['sEstumod_mat'] = '28';	break;
				case 17: $_SESSION['sEstumod_mat'] = '29';	break;
				case 18: $_SESSION['sEstumod_mat'] = '30';	break;
				case 19: $_SESSION['sEstumod_mat'] = '31';	break;	
			}
			switch ($pVeces)			
			{
				case 0: case 1:
					if($pCrdapro > $sCredicar['crd_min'])
					{	$_SESSION['sEstumax_crd'] = $sCredicar['crd_max'];
						if($pPromedio >= $sCredicar['prd_mn1'] and $pPromedio <= $sCredicar['prd_mx1'])	
							$_SESSION['sEstumax_crd'] = $sCredicar['crd_p1'];
						if($pPromedio > $sCredicar['prd_mn2'])		
							$_SESSION['sEstumax_crd'] = $sCredicar['crd_p2'];							
					}
					else
					{	$_SESSION['sEstumax_crd'] = $sCredicar['crd_max']; 	}
					break;
				case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 12: case 13:
					if($pCrddes > $sCredicar['crd_des'])
					{	$_SESSION['sEstumax_crd'] = 18;	}
					else
					{	$_SESSION['sEstumax_crd'] = $sCredicar['crd_max'];	}
					break;
			}	
		}	
		$vTot_crd = $pCrdall + $_SESSION['sEstumax_crd'];
		
		$vQuery = "Select sem_anu from credisem ";
		$vQuery .= "where cod_car = '{$_SESSION['sUsercod_car']}' and pln_est = '{$_SESSION['sEstupln_est']}' and ";
		$vQuery .= "crd_ini <= '$vTot_crd' and crd_fin >= '$vTot_crd' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
			$_SESSION['sEstusem_anu'] = $aResult['sem_anu'];
	
		$vQuery = "Select sem_des from semestre where sem_anu = '{$_SESSION['sEstusem_anu']}' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
			$_SESSION['sEstusem_des'] = $aResult['sem_des'];
			
		$vQuery = "Select mod_des from modmat where mod_mat = '{$_SESSION['sEstumod_mat']}' ";
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
			$_SESSION['sEstumod_des'] = $aResult['mod_des'];
		
	}		
	function fModcurso ($pVeces)
	{
		switch ($pVeces)			
		{
			case 0: 
			case 1: return '01';
			case 2: return '18';
			case 3: return '08';
			case 4: return '11';
			case 5: return '13';
			case 6: return '14';
			case 7: return '15';
			case 8: return '20';
			case 9: return '21';
			case 10: return '22';
			case 11: return '23';
			case 12: return '24';
			case 13: return '25';
			case 14: return '26';
			case 15: return '27';
			case 16: return '28';
			case 17: return '29';
			case 18: return '30';
			case 19: return '31';
		}
	}
	//------------------------------------------------
	function fNomespcurso($pCod_car, $pPln_est, $pCod_cur)
	{
		$vQuery = "select esp.esp_nom from curso cu left join especial esp on cu.cod_car = esp.cod_car and ";
		$vQuery .= "cu.pln_est = esp.pln_est and cu.cod_esp = esp.cod_esp ";
		$vQuery .= "where cu.cod_car = '$pCod_car' and cu.pln_est = '$pPln_est' and cu.cod_cur = '$pCod_cur' ";
		$cResult = fQuery2($vQuery);
		if($aResult = mysql_fetch_array($cResult))
			return $aResult['esp_nom'];
		else
			return "";
		
	}
	
	//----------------------------------------------------
	function fNextcur($pCod_esp, $pNivel)
	{
		$vQuery = "Select cod_cur, des_cur from cursos where cod_esp = '$pCod_esp' and nivel = '$pNivel'";
		$cCurso = fQueryi($vQuery);
		if($aCurso = mysql_fetch_array($cCurso))
		{
			return $aCurso['cod_cur'].$aCurso['des_cur'];
		}	
	}
?>