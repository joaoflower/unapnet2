<?php
	session_start();
	include "../include/function.php";
	include "../include/funcolv.php";
	$vFilep ="veripas.php";
	$vFiled ="veridoc.php";
	$sOlvuser['safetyv'] = ''

?>
<html>
<head>
<title>Un@p.Net2&reg; - Recordar Contraseña y Número de Documento : La forma mas comoda de acceder a la informaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Wed Jan 05 14:46:25 GMT-0500 2005-->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script language="JavaScript">
   window.moveTo(0,0);
   	function verifyp()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';

		for (jj = 0; jj < document.fContra.rCodigop.value.length; jj++)
		{
			ch = document.fContra.rCodigop.value.substring (jj, jj + 1);
			if ( !(ch >= "0" && ch <= "9"))
				Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Código debe ser numérico ... !");
			document.fContra.rCodigop.value = "";
			document.fContra.rCodigop.focus();
			return false;
       	}
		if(document.fContra.rCodigop.value.length < 4 )
		{
			alert("El Código debe de tener al menos 4 caracters ... !");
			document.fContra.rCodigop.focus();
			return false;
		}
        if(document.fContra.rPasswdp.value.length < 5 )
		{
			alert("La Contraseña debe de tener al menos 5 caracters ... !");
			document.fContra.rPasswdp.focus();
			return false;
		}
		return true;
	}
	function verifyd()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';
		var cMes = document.fNumdoc.rMes.value;

		if(document.fNumdoc.rLogin.value.length < 5 )
		{
			alert("El Nombre de usuario debe de tener al menos 5 caracteres ... !");
			document.fNumdoc.rLogin.focus();
			return false;
		}
		for (jj = 0; jj < document.fNumdoc.rLogin.value.length; jj++)
		{
				ch = document.fNumdoc.rLogin.value.substring (jj, jj + 1);
				if ( ch == ' ')
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Nombre de usuario no debe de tener espacios en blanco ... !");
			document.fNumdoc.rLogin.focus();
			return false;
		}
		ch = document.fNumdoc.rLogin.value.substring (0,1);
		if (!(ch >= "a" && ch <= "z"))
		{
			alert("El el primer caracter debe ser una letra del abecedario en minuscula ... !");
			document.fNumdoc.rLogin.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fNumdoc.rLogin.value.length; jj++)
		{
				ch = document.fNumdoc.rLogin.value.substring (jj, jj + 1);
				if ( !((ch >= "a" && ch <= "z") || (ch == "_") || (ch == "-") || (ch >= "0" && ch <= "9")) )
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("En el nombre de usuario existen caracteres que no son validos o estan en mayuscula");
			document.fNumdoc.rLogin.focus();
			return false;
		}
        if(document.fNumdoc.rPasswdd.value.length < 5 )
		{
			alert("La Contraseña debe de tener al menos 5 caracters ... !");
			document.fNumdoc.rPasswdd.focus();
			return false;
		}
		if(document.fNumdoc.rDia.value == "")
		{
			alert("El Día de Nacimiento no puede estar vacio ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fNumdoc.rDia.value.length; jj++)
		{
				ch = document.fNumdoc.rDia.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Día de nacimiento debe ser numérico ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}

		if(document.fNumdoc.rAno.value == "")
		{
			alert("El Año de Nacimiento no puede estar vacio ... !");
			document.fNumdoc.rAno.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fNumdoc.rAno.value.length; jj++)
		{
				ch = document.fNumdoc.rAno.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Año de nacimiento debe ser numérico ... !");
			document.fNumdoc.rAno.focus();
			return false;
		}

		if ((cMes == "01" || cMes == "03" || cMes == "05" || cMes == "07" || cMes == "08" || cMes == "10" || cMes == "12" ) &&
			(document.fNumdoc.rDia.value > 31 || document.fNumdoc.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}
		if ((cMes == "04" || cMes == "06" || cMes == "09" || cMes == "11" ) &&
			(document.fNumdoc.rDia.value > 30 || document.fNumdoc.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fNumdoc.rDia.value > 28 || document.fNumdoc.rDia.value < 1) &&
			document.fNumdoc.rAno.value % 4 != 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fNumdoc.rDia.value > 29 || document.fNumdoc.rDia.value < 1) &&
			document.fNumdoc.rAno.value % 4 == 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fNumdoc.rDia.focus();
			return false;
		}
		return true;
	}
</script>
<link href="../css/unapnet.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="600">
<!-- fwtable fwsrc="ventana2.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->

  <tr>
   <td colspan="3"><img name="index_r1_c1" src="images/index_r1_c1.jpg" width="600" height="64" border="0" alt=""></td>
  </tr>
  <tr>
   <td valign="top" background="images/index_r4_c1.jpg"><table border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="12"><img src="images/index_r3_c1.jpg" width="12" height="297"></td>
     </tr>
   </table>
     <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td background="images/index_r4_c1.jpg">&nbsp;</td>
       </tr>
    </table></td>
   <td width="575" align="center" valign="top">
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Un@p.Net2&reg; : </strong> &iquest;Has olvidado tu contrase&ntilde;a y N&uacute;mero de Documento? </td>
         <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../images/ventana_r2_c1.jpg"></td>
         <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"> No te preocupes en aqui solucionaremos ese problema, para lo cual se tiene las siguientes opciones: <br>
 <strong>1. </strong> No te podemos ayudar a recordar tu contrase&ntilde;a, pero el sistema te asignara una nueva contrase&ntilde;a, para lo cual tienes que ingresar tu c&oacute;digo y tu contrase&ntilde;a(Para los estudiantes es la contrase&ntilde;a del CTI y para los docentes su n&uacute;mero de DNI), por razones de seguridad, este es el &uacute;nico m&eacute;todo establecido.<br>
 <strong>2.</strong> Para corregir tu n&uacute;mero de documento tienes que ingresar tu nombre de Usuario, Contrase&ntilde;a de usuario y la Fecha de Nacimiento. <br>
Si con estas opciones no puedes cambiar tu contrase&ntilde;a o corregir tu n&uacute;mero de documento tendr&aacute;s que apersonarte a la Oficina de Tecnolog&iacute;a Inform&aacute;tica. <br>
             <hr noshade>
             <div align="right">(Los campos marca con <span class ='timporbb'>#</span> son olbligatorios)<br>
          </div></td>
         <td background="../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
     </table>
     <form action="<?=$vFilep.'?'.SID?>" method="post" name="fContra" id="fContra">
     <? if($sOlvuser['errorp']) fmsnerror($sOlvuser['msnerror']); $sOlvuser['errorp'] = FALSE  ?>
<table border="0" cellpadding="0" cellspacing="0">
        <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
        <tr>
          <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
          <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">1. Cambiar contrase&ntilde;a de Usuario <br>          </td>
          <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="450" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
              <tr>
                <td width="130" align="right"><span class ='timporbb'>#</span> C&oacute;digo :</td>
                <td width="320"><input name="rCodigop" type="text" class="otexto" id="rCodigop" value="<?=$sOlvuser['codigop']?>" size="7" maxlength="7">
            (N&uacute;meros) </td>
              </tr>
              <tr>
                <td align="right"><span class ='timporbb'>#</span> Carrera Profesional :</td>
                <td><select name="rCod_Car" class="ocombo" >
                    <?=fviewcar($sOlvuser['cod_car'])?>
                </select></td>
              </tr>
              <tr>
                <td align="right"><span class ='timporbb'>#</span> Contrase&ntilde;a : </td>
                <td><input name="rPasswdp" type="password" class="otexto" id="rPasswdp" size="15" maxlength="15">            
                  (Min&uacute;sculas / N&uacute;meros) </td>
              </tr>
              <tr align="center">
                <td colspan="2"><input name="Submit" type="submit" class="oboton" value="Cambiar" onClick = "if(verifyp()){ document.fContra.submit();} return false"></td>
              </tr>
          </table></td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
   </form>   
     <form action="<?=$vFiled.'?'.SID?>" method="post" name="fNumdoc" id="fNumdoc">
       <? if($sOlvuser['errord']) fmsnerror($sOlvuser['msnerror']); $sOlvuser['errord'] = FALSE  ?>
       <table border="0" cellpadding="0" cellspacing="0">
         <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
         <tr>
           <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
           <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">2. Recordar N&uacute;mero de Documento <br>
           </td>
           <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
         </tr>
         <tr>
           <td background="../images/ventana_r2_c1.jpg"></td>
           <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="450" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
               <tr>
                 <td width="130" align="right"><span class ='timporbb'>#</span> Usuario :</td>
                 <td width="320"><input name="rLogin" type="text" class="otexto" id="rLogin" value="<?=$sOlvuser['login']?>" size="15" maxlength="20">
                   <B>@unap.edu.pe</B> </td>
               </tr>
               <tr>
                 <td align="right"><span class ='timporbb'>#</span> Contrase&ntilde;a : </td>
                 <td><input name="rPasswdd" type="password" class="otexto" id="rPasswdd" size="15" maxlength="15">
              (Min&uacute;sculas / N&uacute;meros) </td>
               </tr>
               <tr>
                 <td align="right"><span class ='timporbb'>#</span> Fecha de Nacimiento : </td>
                 <td><input name="rDia" type="text" class="otexto" id="rDia" value="<?=$sOlvuser['dia']?>" size="2" maxlength="2">
    de
      <select name="rMes" class="ocombo" id="rMes">
        <?=fviewmes($sOlvuser['mes'])?>
      </select>
    de 19
    <input name="rAno" type="text" class="otexto" id="rAno" value="<?=$sOlvuser['ano']?>" size="2" maxlength="2"></td>
               </tr>
               <tr align="center">
                 <td colspan="2"><input name="Submit2" type="submit" class="oboton" value="Recordar" onClick = "if(verifyd()){ document.fNumdoc.submit();} return false"></td>
               </tr>
           </table></td>
           <td background="../images/ventana_r2_c4.jpg"></td>
         </tr>
         <tr>
           <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
           <td background="../images/ventana_r4_c2.jpg"></td>
           <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
         </tr>
       </table>
    </form></td>
   <td valign="top" background="images/index_r4_c3.jpg"><table border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><img src="images/index_r3_c3.jpg" width="13" height="297"></td>
     </tr>
   </table>
     <table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
       <tr>
         <td background="images/index_r4_c3.jpg">&nbsp;</td>
       </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="3"><img name="index_r5_c1" src="images/index_r5_c1.jpg" width="600" height="28" border="0" alt=""></td>
  </tr>
</table>
</body>
</html>