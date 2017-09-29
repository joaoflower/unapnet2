<?php
	session_start();
	$vFile ="verify.php";	
	include "../include/funcunap.php";
	
	if(!fverifylo())
		header("Location:.")
?>
<html>
<head>
<title>Un@p.Net2&reg; - Registro de Nuevo usuario : La forma mas comoda de acceder a la informaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Tue Jan 11 17:14:56 GMT-0500 2005-->
<script language="JavaScript">
<!--
window.moveTo(0,0);

function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
   var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
   if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
	function verify()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';

		if(document.fLogin.rLogin.value.length < 5 )
		{
			alert("El Nombre de usuario debe de tener al menos 5 caracteres ... !");
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
			alert("El Nombre de usuario no debe de tener espacios en blanco ... !");
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
			alert("En el nombre de usuario existen caracteres que no son validos o estan en mayuscula");
			document.fLogin.rLogin.focus();
			return false;
		}
        if(document.fLogin.rPasswd.value.length < 5 )
		{
			alert("La Contraseña debe de tener al menos 5 caracters ... !");
			document.fLogin.rPasswd.focus();
			return false;
		}
		if(document.fLogin.rNum_doc.value == "")
		{
			alert("El Número de Documento no puede estar vacio ... !");
			document.fLogin.rNum_doc.focus();
			return false;
		}
		return true;
	}
//-->
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<link href="../css/unapnet.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff" onLoad="MM_preloadImages('images/index_r7_c3_f2.jpg')">
<div align="center">
  <form action="<?=$vFile.'?'.SID?>" method="post" name="fLogin" id="fLogin">
    <table border="0" cellpadding="0" cellspacing="0" width="500">
      <!-- fwtable fwsrc="login.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "377833132" fwnested="0" -->
      <tr>
        <td><img src="images/spacer.gif" width="105" height="1" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="100" height="1" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="106" height="1" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="82" height="1" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="107" height="1" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="5"><img name="index_r1_c1" src="images/index_r1_c1.jpg" width="500" height="57" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="57" border="0" alt=""></td>
      </tr>
      <tr>
        <td rowspan="7"><img name="index_r2_c1" src="images/index_r2_c1.jpg" width="105" height="217" border="0" alt=""></td>
        <td colspan="3"><img name="index_r2_c2" src="images/index_r2_c2.jpg" width="288" height="58" border="0" alt=""></td>
        <td rowspan="7"><img name="index_r2_c5" src="images/index_r2_c5.jpg" width="107" height="217" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="58" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="3" align="center" class="timporbb"><? if($sUser['errorl']) echo $sUser['msnerror']; $sUser['errorl'] = FALSE;  ?></td>
        <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="3"><img name="index_r4_c2" src="images/index_r4_c2.jpg" width="288" height="7" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="7" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="3" background="images/index_r5_c2.jpg"><table width="285" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
            <tr>
              <td width="100" align="right" class="tlargewb"> Usuario :</td>
              <td width="320"><input name="rLogin" type="text" class="otexto" id="rLogin4" value="<?=$sUser['login']?>" size="15" maxlength="20">
                  <span class="tlargewb">@unap.edu.pe</span></td>
            </tr>
            <tr>
              <td align="right" class="tlargewb"> Contrase&ntilde;a : </td>
              <td><input name="rPasswd" type="password" class="otexto" id="rPasswd" size="25" maxlength="25">
              </td>
            </tr>
            <tr>
              <td align="right" class="tlargewb">Nro. Docum. : </td>
              <td><input name="rNum_doc" type="password" class="otexto" id="rNum_doc" size="10" maxlength="10"></td>
            </tr>
        </table></td>
        <td><img src="images/spacer.gif" width="1" height="73" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="3"><img name="index_r6_c2" src="images/index_r6_c2.jpg" width="288" height="14" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="14" border="0" alt=""></td>
      </tr>
      <tr>
        <td rowspan="2"><img name="index_r7_c2" src="images/index_r7_c2.jpg" width="100" height="43" border="0" alt=""></td>
        <td><a href="" onClick = "if(verify()){ document.fLogin.submit();} return false" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r7_c3','','images/index_r7_c3_f2.jpg',1);"><img name="index_r7_c3" src="images/index_r7_c3.jpg" width="106" height="37" border="0" alt="Ingresar al Sistema"></a></td>
        <td rowspan="2"><img name="index_r7_c4" src="images/index_r7_c4.jpg" width="82" height="43" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="37" border="0" alt=""></td>
      </tr>
      <tr>
        <td><img name="index_r8_c3" src="images/index_r8_c3.jpg" width="106" height="6" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="6" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="5"><img name="index_r9_c1" src="images/index_r9_c1.jpg" width="500" height="26" border="0" alt=""></td>
        <td><img src="images/spacer.gif" width="1" height="26" border="0" alt=""></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
