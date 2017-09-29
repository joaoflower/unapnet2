<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";
	$vFile ="register.php";
	if(!fverifyrd())
		header("Location:.");
?>

<html>
<head>
<title>Un@p.Net2&reg; - Registro de Nuevo usuario : La forma mas comoda de acceder a la informaci&oacute;n</title>
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
	function verify()
	{
		document.fData.rCod_dep.value = document.frameUbigeo.frmLibUbigeo.rCod_dep.value;
		document.fData.rCod_prv.value = document.frameUbigeo.frmLibUbigeo.rCod_prv.value;
		document.fData.rCod_dis.value = document.frameUbigeo.frmLibUbigeo.rCod_dis.value;
		var Continuar = 1;
		var jj = 0;
		var ch = '8';
		var cMes = document.fData.rMes.value;

		if(document.fData.rLogin.value.length < 5 )
		{
			alert("El Nombre de usuario debe de tener al menos 5 caracteres ... !");
			document.fData.rLogin.focus();
			return false;
		}
		for (jj = 0; jj < document.fData.rLogin.value.length; jj++)
		{
				ch = document.fData.rLogin.value.substring (jj, jj + 1);
				if ( ch == ' ')
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Nombre de usuario no debe de tener espacios en blanco ... !");
			document.fData.rLogin.focus();
			return false;
		}
		ch = document.fData.rLogin.value.substring (0,1);
		if (!(ch >= "a" && ch <= "z"))
		{
			alert("El el primer caracter debe ser una letra del abecedario en minuscula ... !");
			document.fData.rLogin.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rLogin.value.length; jj++)
		{
				ch = document.fData.rLogin.value.substring (jj, jj + 1);
				if ( !((ch >= "a" && ch <= "z") || (ch == "_") || (ch == "-") || (ch >= "0" && ch <= "9")) )
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("En el nombre de usuario existen caracteres que no son validos o estan en mayuscula");
			document.fData.rLogin.focus();
			return false;
		}
		if(document.fData.rPasswd.value.length < 5 )
		{
			alert("La Contraseña tiene que tener al menos 5 caracteres ... !");
			document.fData.rPasswd.focus();
			return false;
		}
		if(document.fData.rPasswd.value != document.fData.rPasswd2.value )
		{
			alert("Las Contraseñas no coinsiden... !");
			document.fData.rPasswd.focus();
			return false;
		}
		if(document.fData.rRecorda.value.length < 5 )
		{
			alert("El recordatorio tiene que tener al menos 5 caracteres ... !");
			document.fData.rRecorda.focus();
			return false;
		}

		if(document.fData.rNum_doc.value == "")
		{
			alert("El Número de Documento no puede estar vacio ... !");
			document.fData.rNum_doc.focus();
			return false;
		}
		if(document.fData.rTip_doc.value == "01")
		{
			for (jj = 0; jj < document.fData.rNum_doc.value.length; jj++)
			{
					ch = document.fData.rNum_doc.value.substring (jj, jj + 1);
					if ( !(ch >= "0" && ch <= "9"))
						Continuar = 0;
			}
			if(!Continuar)
			{
				alert("El Número de Documento debe ser numérico ... !");
				document.fData.rNum_doc.focus();
				return false;
			}
			else
			{
				if(document.fData.rNum_doc.value.length != 8)
				{
					alert("El Número de DNI debe de ser 8 caracteres ... !");
					document.fData.rNum_doc.focus();
					return false;
				}
			}
		}		
		if(document.fData.rTip_doc.value == "02" && document.fData.rNum_doc.value.length != 10)
		{
			alert("El Número de una Libreta Militar debe de ser de 10 caracteres ... !");
			document.fData.rNum_doc.focus();
			return false;
		}

		if(document.fData.rDia.value == "")
		{
			alert("El Día de Nacimiento no puede estar vacio ... !");
			document.fData.rDia.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rDia.value.length; jj++)
		{
				ch = document.fData.rDia.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Día de nacimiento debe ser numérico ... !");
			document.fData.rDia.focus();
			return false;
		}

		if(document.fData.rAno.value == "")
		{
			alert("El Año de Nacimiento no puede estar vacio ... !");
			document.fData.rAno.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rAno.value.length; jj++)
		{
				ch = document.fData.rAno.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Año de nacimiento debe ser numérico ... !");
			document.fData.rAno.focus();
			return false;
		}

		if ((cMes == "01" || cMes == "03" || cMes == "05" || cMes == "07" || cMes == "08" || cMes == "10" || cMes == "12" ) &&
			(document.fData.rDia.value > 31 || document.fData.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "04" || cMes == "06" || cMes == "09" || cMes == "11" ) &&
			(document.fData.rDia.value > 30 || document.fData.rDia.value < 1))
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 28 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 != 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if ((cMes == "02") && (document.fData.rDia.value > 29 || document.fData.rDia.value < 1) &&
			document.fData.rAno.value % 4 == 0)
		{
			alert("El Día de nacimiento no es valido ... !");
			document.fData.rDia.focus();
			return false;
		}
		if(document.fData.rDirec.value == "")
		{
			alert("La dirección no puede estar vacia ... !");
			document.fData.rDirec.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rFono.value.length; jj++)
		{
				ch = document.fData.rFono.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Teléfono debe ser numérico ... !");
			document.fData.rFono.focus();
			return false;
		}
		Continuar = 1;
		for (jj = 0; jj < document.fData.rCelular.value.length; jj++)
		{
				ch = document.fData.rCelular.value.substring (jj, jj + 1);
				if ( !(ch >= "0" && ch <= "9"))
					Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Celular debe ser numérico ... !");
			document.fData.rCelular.focus();
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
   <td width="575" align="center" valign="top">      <form action="<?=$vFile.'?'.SID?>" method="post" name="fData" id="fData">
         <table border="0" cellpadding="0" cellspacing="0">
           <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
           <tr>
             <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
             <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Un@p.Net2&reg; : </strong> Registro de nuevo Usuario </td>
             <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
           </tr>
           <tr>
             <td background="../images/ventana_r2_c1.jpg"></td>
             <td background="../images/ventana_r2_c2.jpg" class="tnormalbn">Ingrese todos los datos que se piden, ingreselos con cuidado.<br>
                <hr noshade>
               <div align="right">(Los campos marca con <span class ='timporbb'>#</span> son olbligatorios)</div>
             </td>
             <td background="../images/ventana_r2_c4.jpg"></td>
           </tr>
           <tr>
             <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
             <td background="../images/ventana_r4_c2.jpg"></td>
             <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
           </tr>
         </table>
         <table border="0" cellpadding="0" cellspacing="0">
           <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
           <tr>
             <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
             <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">Datos Universitarios <br>
             </td>
             <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
           </tr>
           <tr>
             <td background="../images/ventana_r2_c1.jpg"></td>
             <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="450" border="0" cellpadding="0" cellspacing="1" class="tnormalbn">
                 <tr>
                   <td width="150" align="right"> C&oacute;digo :</td>
                   <td width="300"><strong><?=$sReguser['codigo']?></strong></td>
                 </tr>
                 <tr>
                   <td align="right"> Apellidos y Nombres:</td>
                   <td><strong> <?=$sReguser['paterno']?> <?=$sReguser['materno']?>, <?=$sReguser['nombres']?> </strong></td>
                 </tr>
                 <tr>
                   <td align="right"> Carrera Profesional: </td>
                   <td><strong><?=$sCarrera[$sReguser['cod_car']]?> </strong></td>
                 </tr>
                 <tr>
                   <td align="right">Tipo de usuario : </td>
                   <td><strong><?=$sTipousu[$sReguser['tip_usu']]?></strong></td>
                 </tr>
             </table></td>
             <td background="../images/ventana_r2_c4.jpg"></td>
           </tr>
           <tr>
             <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
             <td background="../images/ventana_r4_c2.jpg"></td>
             <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
           </tr>
         </table><? if($sReguser['error']) fmsnerror($sReguser['msnerror']); $sReguser['error'] = FALSE  ?>
         <table border="0" cellpadding="0" cellspacing="0">
           <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
           <tr>
             <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
             <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">Datos de usuario <br>
             </td>
             <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
           </tr>
           <tr>
             <td background="../images/ventana_r2_c1.jpg"></td>
             <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="500" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
                 <tr>
                   <td width="150" align="right"><span class ='timporbb'>#</span> Usuario :</td>
                   <td width="350"><input name="rLogin" type="text" class="otexto" id="rLogin4" value="<?=$sReguser['login']?>" size="15" maxlength="20">
                       <B>@unap.edu.pe</B> (M&iacute;n. 5 Caracteres)</td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Contrase&ntilde;a Nueva :</td>
                   <td><input name="rPasswd" type="password" class="otexto" id="rPassword5" size="25" maxlength="25">
              (M&iacute;n. 5 Caracteres. Max 25 Caracteres) </td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Repita Contrase&ntilde;a : </td>
                   <td><input name="rPasswd2" type="password" class="otexto" id="rPasswd2" size="25" maxlength="25">              
                   (M&iacute;n. 5 Caracteres. Max 25 Caracteres)</td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Palabra Recordatorio : </td>
                   <td><input name="rRecorda" type="text" class="otexto" id="rRecordatorio4" value="<?=$sReguser['recorda']?>" size="25" maxlength="25">
              (M&iacute;n. 5 Caracteres. Max 25 Caracteres) </td>
                 </tr>
                 <tr>
                   <td align="right">otro email :</td>
                   <td><input name="rOemail" type="text" class="otexto" id="rOemail3" value="<?=$sReguser['oemail']?>" size="40" maxlength="40"></td>
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
         <table border="0" cellpadding="0" cellspacing="0">
           <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
           <tr>
             <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
             <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb"><p>Datos personales <br>             
               </p>             </td>
             <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
           </tr>
           <tr>
             <td background="../images/ventana_r2_c1.jpg"></td>
             <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="500" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
                 <tr>
                   <td width="150" align="right"><span class ='timporbb'>#</span> Identificaci&oacute;n :</td>
                   <td width="350"><select name="rTip_doc" class="ocombo" id="rTip_doc">
                     <?=fviewdoc($sReguser['tip_doc'])?>
                   </select>
                   N&uacute;mero :
                   <input name="rNum_doc" type="text" class="otexto" id="rLogin5" value="<?=$sReguser['num_doc']?>" size="10" maxlength="10"></td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Sexo :</td>
                   <td><select name="rSexo" class="ocombo" id="rSexo">
                  		<?=fviewsex($sReguser['sexo'])?>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Fecha de Nacimiento : </td>
                   <td><input name="rDia" type="text" class="otexto" id="rPassword25" value="<?=$sReguser['dia']?>" size="2" maxlength="2"> 
                     de 
                       <select name="rMes" class="ocombo" id="select2">
                         <?=fviewmes($sReguser['mes'])?>
                     </select> 
                       de 19 
                       <input name="rAno" type="text" class="otexto" id="rAno" value="<?=$sReguser['ano']?>" size="2" maxlength="2"></td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Direcci&oacute;n : </td>
                   <td><input name="rDirec" type="text" class="otexto" id="rRecordatorio5" value="<?=$sReguser['direc']?>" size="40" maxlength="40">              </td>
                 </tr>
                 <tr>
                   <td align="right">Tel&eacute;fono :</td>
                   <td><input name="rFono" type="text" class="otexto" id="rFono" value="<?=$sReguser['fono']?>" size="10" maxlength="10">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular : 
                   <input name="rCelular" type="text" class="otexto" id="rCelular" value="<?=$sReguser['celular']?>" size="10" maxlength="10"> </td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span> Estado civi : </td>
                   <td><select name="rEst_civ" class="ocombo" id="select3">
                   		<?=fvieweci($sReguser['est_civ'])?>
                   </select></td>
                 </tr>
                 <tr>
                   <td align="right"><span class ='timporbb'>#</span>Nacionalidad : </td>
                   <td><select name="rCod_nac" class="ocombo" id="rCod_nac">
                     <?=fviewnac($sReguser['cod_nac'])?>
                                      </select></td>
                 </tr>
                 <tr align="center">
                   <td colspan="2"><iframe width="500"  name ="frameUbigeo"  height="66" id="frameUbigeo" src="ubigeo.php"  scrolling="no" frameborder="0" >                     
                   </iframe><input name="rCod_dep" type="hidden" id="rCod_dep">
                     <input name="rCod_prv" type="hidden" id="rCod_prv">
                     <input name="rCod_dis" type="hidden" id="rCod_dis">
					 </td>
                 </tr>
                 <tr align="center">
                   <td colspan="2"><input name="Submit" type="submit" class="oboton" value="Registrar" onClick = "if(verify()){ document.fData.submit();} return false"></td>
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
    </form>     </td><td valign="top" background="images/index_r4_c3.jpg"><table border="0" cellpadding="0" cellspacing="0">
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
