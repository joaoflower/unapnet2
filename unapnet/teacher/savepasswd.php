<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyds2())
		header("Location:../.");

	$sUser['passold'] = $_POST['rPassold'];
	$sUser['passnew'] = $_POST['rPassnew'];
	$sUser['passnew2'] = $_POST['rPassnew2'];
	
	if(fverifyp())
	{
		$bPassold = FALSE;
		$vQuery = "Select passwd from unapnet.usudoc where login = '{$sUser['login']}'";
		$cUsudoc = fQuery($vQuery);
		if($aUsudoc = mysql_fetch_array($cUsudoc))
			if($aUsudoc['passwd'] === fpassword($sUser['passold']))
				$bPassold = TRUE;
		
		if($bPassold)
		{
			$vQuery = "Update unapnet.usudoc set passwd = password('{$sUser['passnew']}') where login = '{$sUser['login']}'";
			$cUsudoc = fInupde($vQuery);
			if($cUsudoc)
			{
				$sUser['passold'] = '';
				$sUser['passnew'] = '';
				$sUser['passnew2'] = '';
				header("Location:index2.php");
			}
			else
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = "ERROR, LA CONTRASEÑA NUEVA NO SE PUDO ACTUALIZAR";
				header("Location:passwd.php");
			}
		}
		else
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = "ERROR, LA CONTRASEÑA ANTIGUA INGRESADA ES INCORRECTA";
			header("Location:passwd.php");
		}		
	}
	else
		header("Location:getdata.php");	
?>