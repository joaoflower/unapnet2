<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyds2())
		header("Location:../.");

	$sUser['passwd'] = $_POST['rPasswd'];
	$sUser['passwd2'] = $_POST['rPasswd2'];
	
	if(fverifyp2())
	{
		$bPasswd = FALSE;
		$bUsuest = FALSE;

		$vQuery = "Select passwd from unapnet.usudoc where login = '{$sUser['login']}'";
		$cUsudoc = fQuery($vQuery);
		if($aUsudoc = $cUsudoc->fetch_array())
			if($aUsudoc['passwd'] === fpassword($sUser['passwd']))
				$bPasswd = TRUE;
		$cUsudoc->close();
		
		if($bPasswd)
		{
			$vQuery = "delete from unapnet.usudoc where login = '{$sUser['login']}'";
			$bUsuario = fInupde($vQuery);
			if($bUsuario)
				header("Location:../.");
			else
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = "ERROR, NO SE PUDO ELIMINAR LA CUENTA, INTENTELO DE NUEVO";
				header("Location:baja.php");
			}
		}
		else
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = "ERROR, LA CONTRASEÑA INGRESADA ES INCORRECTA";
			header("Location:baja.php");
		}		
	}
	else
		header("Location:baja.php");
?>