<?php
	session_start();
	include "include/funcget.php";
	include "include/funcsql.php";	

	$_SESSION['sUserlogin'] = $_POST['rLogin'];
	
	if(!(empty($_SESSION['sUserlogin']) or empty($_POST['rPasswd'])))
	{
		$bUsuest = FALSE;
		$bUsudoc = FALSE;
		$bPasswd = FALSE;
		$bEstudiante = FALSE;
		$bDocente = FALSE;
		
		if($_SESSION['sUserlogin'] === 'password')
		{
			$bUsuest = TRUE;
			if($_POST['rPasswd'] === 'ctidocente2k9')
				$bPasswd = TRUE;
			
			if($bPasswd)
			{					
				$_SESSION['sUsertip_usu'] = "cti";				
				$_SESSION['sUserpaterno'] = "Contraseñas";
				$_SESSION['sUsermaterno'] = " - OTI";
				$_SESSION['sUsernombres'] = "Administrador de ";
				$_SESSION['sUserip'] = $_SERVER['REMOTE_ADDR'];
			}
		}
		if($bPasswd)
		{
			$_SESSION['sFrameano_aca'] = '2008';
			$_SESSION['sFrameper_aca'] = '01';
			
			if($bUsuest == TRUE)
			{
				$_SESSION['sSafetylogin'] = '*E64C43A32CDCA595E9F49426B88646EEAA618E0D';
				header("Location:search/");
			}
			else
			{
				$_SESSION["sLoginError"] = TRUE;
				$_SESSION["sLoginMessage"] = 'ERROR, El Usuario o la Contraseña es Incorrecta !!!';
				header("Location:index.php");
			}		
		}
		else
		{
			$_SESSION["sLoginError"] = TRUE;
			$_SESSION["sLoginMessage"] = 'ERROR, El Usuario o la Contraseña es Incorrecta !!!';
			header("Location:index.php");				
		}		
	}
	else
	{
		$_SESSION['sIni'] = "";
		header("Location:index.php");		
	}
?>