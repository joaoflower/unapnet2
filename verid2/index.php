<?php
	session_start();
	if(empty($_SESSION['sIni']))
	{
		session_unset();
		$_SESSION["sLoginError"] = FALSE;
		$_SESSION["sLoginMessage"] = "";
	}
	$_SESSION['sIni'] = "OK";
	
	include "include/funcget.php";

	fgetconnect();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/frame.css">
<link rel="stylesheet" href="css/framelogin.css">
<link rel="stylesheet" href="css/style.css">
<title>Un@p.Net&reg; - Sistema Acad&eacute;mico via Web - UNA - Puno</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="js/function.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
	function enfocar()
	{
		document.fLogin.rLogin.focus();
		maximizar();
	}
	
	function verify()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';

		if(document.fLogin.rLogin.value.length < 4 )
		{
			alert("El Login debe de tener al menos 4 caracteres ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		for (jj = 0; jj < document.fLogin.rLogin.value.length; jj++)
		{
				ch = document.fLogin.rLogin.value.substring (jj, jj + 1);
				if ( ch == ' ')
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Login no debe de tener espacios en blanco ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		ch = document.fLogin.rLogin.value.substring (0,1);
		if (!(ch >= "a" && ch <= "z"))
		{
			alert("El el primer caracter debe ser una letra del abecedario en minuscula ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fLogin.rLogin.value.length; jj++)
		{
				ch = document.fLogin.rLogin.value.substring (jj, jj + 1);
				if ( !((ch >= "a" && ch <= "z") || (ch == "_") || (ch == "-") || (ch >= "0" && ch <= "9")) )
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("En el Login existen caracteres que no son validos o estan en mayuscula");
			document.fLogin.rLogin.focus();
			return false;
		}
        if(document.fLogin.rPasswd.value.length < 4 )
		{
			alert("La Contraseña debe de tener al menos 4 caracters ... !");
			document.fLogin.rPasswd.focus();
			return false;
		}
		return true;
	}

//-->
</script>
</head>
<body onLoad="enfocar();">
	<center>
	<form action="verifylogin.php" method="post" enctype="multipart/form-data" name="fLogin" id="fLogin"> 
	<div id="bodylogin">
		<div class="headercol"><img name="logo1" src="images/cabe_login.jpg" width="300" height="70" border="0" alt=""></div>	
		<div class="collogin" id="dgroupb">			
			<span class="wordi"><?=($_SESSION["sLoginError"]?$_SESSION["sLoginMessage"]:'')?> <? $_SESSION["sLoginMessage"] = ""; ?></span>			  
			<table width="250" border="0" cellpadding="2" cellspacing="0" class="tabled">
				<tr>
				  <td class="wordderb">Usuario : </td>
				  <td class="wordizq"><input name="rLogin" type="text" class="" id="rLogin" value="" size="15" maxlength="20"></td>
				</tr>
				<tr>
				  <td class="wordderb">Contrase&ntilde;a : </td>
				  <td class="wordizq"><input name="rPasswd" type="password" id="rPasswd" size="15" maxlength="20"></td>
				</tr>
		  	</table>
			  
	    <table border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>
					<div class="dboton"><a href="" onClick = "if(verify()){ document.fLogin.submit();} return false;" class="iok" title="Aceptar">Aceptar</a></div>
					<div class="dboton"><a href="" onClick="cerrar();" class="icancel" title="Cancelar">Cancelar</a></div>
				</td>
			  </tr>
			</table>
		  
		</div>
	</div>
	</form>	  
	</center>

</body>
</html>
