<?php
	function fInupde($pQuery)
	{
		global $sConedb;
		$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		mysql_query('BEGIN', $xSerdata);
		$cResult = mysql_query($pQuery, $xSerdata);
		if ($cResult) mysql_query('COMMIT', $xSerdata);
		else mysql_query('ROLLBACK', $xSerdata);
		return $cResult;
	}
	
	function fQuery($pQuery)
	{
		global $sConedb;
		$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		return mysql_query($pQuery, $xSerdata);
	}
	function fInewusu($pQestdoc, $pQusuario, $pQusued)
	{
		global $sConedb;
		$vReturn = FALSE;
		$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		mysql_query('BEGIN', $xSerdata);
		$cResult1 = mysql_query($pQestdoc, $xSerdata);
		$cResult2 = mysql_query($pQusuario, $xSerdata);
		$cResult3 = mysql_query($pQusued, $xSerdata);
		if ($cResult1 and $cResult2 and $cResult3) {	mysql_query('COMMIT', $xSerdata); $vReturn = TRUE;	} 
		else mysql_query('ROLLBACK', $xSerdata);
		return $vReturn;
	}
	function fUpusu($pQestdoc, $pQusued)
	{
		global $sConedb;
		$vReturn = FALSE;
		$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		mysql_query('BEGIN', $xSerdata);
		$cResult1 = mysql_query($pQestdoc, $xSerdata);
		$cResult2 = mysql_query($pQusued, $xSerdata);
		if ($cResult1 and $cResult2) {	mysql_query('COMMIT', $xSerdata); $vReturn = TRUE;	} 
		else mysql_query('ROLLBACK', $xSerdata);
		return $vReturn;
	}
	//--------------------------------------------------------------------
	function fInupdei($pQuery)
	{
		global $sConedb;
		$xSerdata = mysql_connect($sConedb['hosti'], $sConedb['useri'], $sConedb['passwdi']);
		mysql_query('BEGIN', $xSerdata);
		$cResult = mysql_query($pQuery, $xSerdata);
		if ($cResult) mysql_query('COMMIT', $xSerdata);
		else mysql_query('ROLLBACK', $xSerdata);
		return $cResult;
	}
	
	function fQueryi($pQuery)
	{
		global $sConedb;
		$xSerdata = mysql_connect($sConedb['hosti'], $sConedb['useri'], $sConedb['passwdi']);
		return mysql_query($pQuery, $xSerdata);
	}
	function fInewusui($pQestdoc, $pQusuario, $pQusued)
	{
		global $sConedb;
		$vReturn = FALSE;
		$xSerdata = mysql_connect($sConedb['hosti'], $sConedb['useri'], $sConedb['passwdi']);
		mysql_query('BEGIN', $xSerdata);
		$cResult1 = mysql_query($pQestdoc, $xSerdata);
		$cResult2 = mysql_query($pQusuario, $xSerdata);
		$cResult3 = mysql_query($pQusued, $xSerdata);
		if ($cResult1 and $cResult2 and $cResult3) {	mysql_query('COMMIT', $xSerdata); $vReturn = TRUE;	} 
		else mysql_query('ROLLBACK', $xSerdata);
		return $vReturn;
	}
	function fUpusui($pQestdoc, $pQusued)
	{
		global $sConedb;
		$vReturn = FALSE;
		$xSerdata = mysql_connect($sConedb['hosti'], $sConedb['useri'], $sConedb['passwdi']);
		mysql_query('BEGIN', $xSerdata);
		$cResult1 = mysql_query($pQestdoc, $xSerdata);
		$cResult2 = mysql_query($pQusued, $xSerdata);
		if ($cResult1 and $cResult2) {	mysql_query('COMMIT', $xSerdata); $vReturn = TRUE;	} 
		else mysql_query('ROLLBACK', $xSerdata);
		return $vReturn;
	}
	//--------------------------------------------------------------
	function fFecha()
	{
		$vFecha = getdate(time());
		return "{$vFecha['year']}-{$vFecha['mon']}-{$vFecha['mday']} {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']}";
	}
	function fMatricular()
	{
		global $sConedb, $sUser, $sCurmat2;
		$tEstumat = "unapnet.estutut{$sUser['cod_car']}2005";
		$tCurmat = "unapnet.curtut{$sUser['cod_car']}2005";
		$bResult = FALSE;

		if(!empty($sCurmat2)) 
		{
			$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
			
			$vFecha = fFecha();
			$vQuery = "Insert into $tEstumat (num_mat, cod_car, pln_est, sec_gru, tur_est, ano_aca, per_aca, cod_esp, ";
			$vQuery .= "mod_mat, fch_mat, cod_usu, tot_crd, tip_mat, max_crd) values ";
			$vQuery .= "('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$sUser['pln_est']}', '01', ";
			$vQuery .= "'1', '2005', '01', '{$sUser['cod_esp']}', ";
			$vQuery .= "'{$sUser['mod_mat']}', '$vFecha', '{$sUser['codigo']}', {$sUser['tot_crd']}, '04', {$sUser['max_crd']})";
			
			mysql_query('BEGIN', $xSerdata);
			$bResult = mysql_query($vQuery, $xSerdata);
			if($bResult)
			{
				foreach($sCurmat2 as $vCod_cur => $aCurmat)
				{
					$vQuery = "Insert Into $tCurmat (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, ";
					$vQuery .= "sec_gru, tur_est, cod_usu, cur_obli) values " ;
					$vQuery .= "('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$sUser['pln_est']}', ";
					$vQuery .= "'$vCod_cur', '2005', '01', '{$aCurmat['mod_mat']}', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['tur_est']}', '{$sUser['codigo']}', '{$aCurmat['cur_obli']}')";
					
					$bResult = mysql_query($vQuery, $xSerdata);
					if(!$bResult)
					{
						mysql_query('ROLLBACK', $xSerdata);
						return $bResult;
					}
				}
				mysql_query('COMMIT', $xSerdata);				
			}
			else
			{
				mysql_query('ROLLBACK', $xSerdata);
			}
		}
		return $bResult;
	}
	function fMatricurso()
	{
		global $sConedb, $sUser, $sCurmat2;
		$tEstumat = "unapnet.estutut{$sUser['cod_car']}2005";
		$tCurmat = "unapnet.curtut{$sUser['cod_car']}2005";
		$bResult = FALSE;

		if(!empty($sCurmat2)) 
		{
			$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
			
			
			$vQuery = "Update $tEstumat set tot_crd = {$sUser['tot_crd']} where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
			
			mysql_query('BEGIN', $xSerdata);
			$bResult = mysql_query($vQuery, $xSerdata);
			if($bResult)
			{
				foreach($sCurmat2 as $vCod_cur => $aCurmat)
				{
					$vQuery = "Insert Into $tCurmat (num_mat, cod_car, pln_est, cod_cur, ano_aca, per_aca, mod_mat, ";
					$vQuery .= "sec_gru, tur_est, cod_usu, cur_obli) values " ;
					$vQuery .= "('{$sUser['codigo']}', '{$sUser['cod_car']}', '{$sUser['pln_est']}', ";
					$vQuery .= "'$vCod_cur', '2005', '01', '{$aCurmat['mod_mat']}', ";
					$vQuery .= "'{$aCurmat['sec_gru']}', '{$aCurmat['tur_est']}', '{$sUser['codigo']}', '{$aCurmat['cur_obli']}')";
					
					$bResult = mysql_query($vQuery, $xSerdata);
					if(!$bResult)
					{
						mysql_query('ROLLBACK', $xSerdata);
						return $bResult;
					}
				}
				mysql_query('COMMIT', $xSerdata);				
			}
			else
			{
				mysql_query('ROLLBACK', $xSerdata);
			}
		}
		return $bResult;
	}
?>