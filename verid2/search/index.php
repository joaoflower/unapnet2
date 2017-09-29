<?php
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	
	if(fsafetylogin())
	{
	}
	else
	{
		$_SESSION['sIni'] = "";
		header("Location:../index.php");
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/frame.css">
<link rel="stylesheet" href="../css/framelogin.css">
<link rel="stylesheet" href="../css/style.css">
<title>Un@p.Net&reg; - Sistema Acad&eacute;mico via Web - UNA - Puno</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" src="../js/ggw3.js"></script>
<script language="JavaScript" src="../js/function.js"></script>
<script language="JavaScript" src="../js/teacher.js"></script>
<script language="JavaScript">
	function enfocar()
	{
		maximizar();
	}
	function aumentar(cont, vCanti, vMax)
	{ 
		if(cont.checked)
		{
			if((parseFloat(document.fData.rCrd_cur.value) + parseFloat(vCanti)) > parseFloat(vMax))
			{
				var vMsg = "A exedido los " + vMax + " CRÉDITOS permitidos, se QUITARA el curso escogido";
				alert(vMsg);
				cont.checked = false;
			}
			else
			{
				document.fData.rCrd_cur.value = parseFloat(document.fData.rCrd_cur.value) + parseFloat(vCanti);
				sombrear(cont);
			}
		}
		else
		{
			document.fData.rCrd_cur.value = parseFloat(document.fData.rCrd_cur.value) - parseFloat(vCanti);
			desombrear(cont);
		}
	}

</script>

</head>

<body onLoad="enfocar();">
	<center>
	<table border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>
			<? include "../include/header1.php"; ?>
			<? include "../include/menu1.php"; ?>
			
			<div id="dcontent">
				<table width="770" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" id="tcontent">
				  <tr id="trcontent">
					
					<td valign="top" id="tdsubcontent">
						<div id="dsubcontent">
							<center>
							  Un@p.Net&reg; - Sistema Acad&eacute;mico via Web - UNA - Puno
							  <br>
                        <span class="wordi"><strong>EL INGRESO DE NOTAS V&Iacute;A INTERNET ES A PARTIR DEL <br>
                        DEL 26 AL 30 DE ENERO DEL 2008 Y LA IMPRESI&Oacute;N DE ACTAS ES<br>
                        EN EL PRIMER PISO DE LA OFICINA DE TECNOLOG&Iacute;A INFORM&Aacute;TICA
                        </strong></span>
							</center>
					  	</div>
					</td>
				  </tr>
				</table>    
			</div>
			<? include "../include/foot1.php"; ?>	
		</td>
	  </tr>
	</table>
	</center>
</body>
</html>