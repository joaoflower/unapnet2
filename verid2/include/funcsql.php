<?php
	function fInupde($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDbHost"], $_SESSION["sDbUser"], $_SESSION["sDbPasswd"]);
		mysql_select_db('unapnet', $xSerdata);
		mysql_query('BEGIN', $xSerdata);
		$cResult = mysql_query($pQuery, $xSerdata);
		if ($cResult) mysql_query('COMMIT', $xSerdata);
		else mysql_query('ROLLBACK', $xSerdata);
		mysql_close($xSerdata);
		return $cResult;
	}
	
	function fQuery($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDbHost"], $_SESSION["sDbUser"], $_SESSION["sDbPasswd"]);
		mysql_select_db('unapnet', $xSerdata);
		return mysql_query($pQuery, $xSerdata);
	}
	function fCountq($pResult)
	{
		return mysql_num_rows($pResult);
	}
	function fInupde2($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDb2Host"], $_SESSION["sDb2User"], $_SESSION["sDb2Passwd"]);
		mysql_select_db('unapnet', $xSerdata);
		mysql_query('BEGIN', $xSerdata);
		$cResult = mysql_query($pQuery, $xSerdata);
		if ($cResult) mysql_query('COMMIT', $xSerdata);
		else mysql_query('ROLLBACK', $xSerdata);
		mysql_close($xSerdata);
		return $cResult;
	}
	function fQuery2($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDb2Host"], $_SESSION["sDb2User"], $_SESSION["sDb2Passwd"]);
		mysql_select_db('unapnet', $xSerdata);
		return mysql_query($pQuery, $xSerdata);
	}
	function fCountq2($pResult)
	{
		return mysql_num_rows($pResult);
	}
	function fQuerydeudor($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDbHost"], $_SESSION["sDbUser"], $_SESSION["sDbPasswd"]);
		mysql_select_db('unap', $xSerdata);
		return mysql_query($pQuery, $xSerdata);
	}
	function fInupdei($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDbiHost"], $_SESSION["sDbiUser"], $_SESSION["sDbiPasswd"]);
		mysql_select_db('dbcidiomas', $xSerdata);
		mysql_query('BEGIN', $xSerdata);
		$cResult = mysql_query($pQuery, $xSerdata);
		if ($cResult) mysql_query('COMMIT', $xSerdata);
		else mysql_query('ROLLBACK', $xSerdata);
		mysql_close($xSerdata);
		return $cResult;
	}
	function fQueryi($pQuery)
	{
		$xSerdata = mysql_connect($_SESSION["sDbiHost"], $_SESSION["sDbiUser"], $_SESSION["sDbiPasswd"]);
		mysql_select_db('dbcidiomas', $xSerdata);
		return mysql_query($pQuery, $xSerdata);
	}
	function fCountqi($pResult)
	{
		return mysql_num_rows($pResult);
	}
?>