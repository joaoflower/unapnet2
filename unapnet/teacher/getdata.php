<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	$vFile = 'savedata.php';
	
	if(!fverifyds2())
		header("Location:../.");
?>

<html>
<head>
<title>Un@p.Net2&reg; Teacher : La forma m&aacute;s comoda de acceder a la informaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Tue Jan 18 17:34:07 GMT-0500 2005-->
<script language="JavaScript" type="text/JavaScript">
<!--
	window.moveTo(0,0);
	if (document.all)
   {
      top.window.resizeTo(screen.availWidth,screen.availHeight);
   }
   else if (document.layers||document.getElementById)
   {
      if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth)
      {
         top.window.outerHeight = screen.availHeight;
         top.window.outerWidth = screen.availWidth;
      }
   }
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
		document.fData.rCod_dep.value = document.frameUbigeo.frmLibUbigeo.rCod_dep.value;
		document.fData.rCod_prv.value = document.frameUbigeo.frmLibUbigeo.rCod_prv.value;
		document.fData.rCod_dis.value = document.frameUbigeo.frmLibUbigeo.rCod_dis.value;
		var Continuar = 1;
		var jj = 0;
		var ch = '8';
		var cMes = document.fData.rMes.value;
		
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
<link href="../../css/unapnet.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="770">
<!-- fwtable fwsrc="docen.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "377833132" fwnested="0" -->

  <tr>
   <td><img name="index_r1_c1" src="images/index_r1_c1.jpg" width="149" height="68" border="0" alt=""></td>
   <td><img name="index_r1_c4" src="images/index_r1_c4.jpg" width="605" height="68" border="0" alt=""></td>
   <td><img name="index_r1_c5" src="images/index_r1_c5.jpg" width="16" height="68" border="0" alt=""></td>
  </tr>
  <tr>
   <td valign="top" background="images/index_r15_c1.jpg"><table border="0" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="docen.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "377833132" fwnested="0" -->
  <tr>
    <td colspan="3"><img name="index_r2_c1" src="images/index_r2_c1.jpg" width="149" height="42" border="0" alt=""></td>
  </tr>
  <tr>
    <td rowspan="11"><img name="index_r3_c1" src="images/index_r3_c1.jpg" width="9" height="276" border="0" alt=""></td>
    <td><a href="closession.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r3_c21','','images/index_r3_c2_f2.jpg',1)"><img src="images/index_r3_c2.jpg" alt="Cerrar Sesi&oacute;n" name="index_r3_c21" width="122" height="24" border="0" id="index_r3_c21"></a></td>
    <td rowspan="11"><img name="index_r3_c3" src="images/index_r3_c3.jpg" width="18" height="276" border="0" alt=""></td>
  </tr>
  <tr>
    <td><a href="mydata.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r4_c21','','images/index_r4_c2_f2.jpg',1)"><img src="images/index_r4_c2.jpg" alt="Datos Personales" name="index_r4_c21" width="122" height="25" border="0" id="index_r4_c21"></a></td>
  </tr>
  <tr>
    <td><a href="passwd.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r5_c21','','images/index_r5_c2_f2.jpg',1)"><img src="images/index_r5_c2.jpg" alt="Cambiar Contrase&ntilde;a" name="index_r5_c21" width="122" height="24" border="0" id="index_r5_c21"></a></td>
  </tr>
  <tr>
    <td><a href="baja.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r6_c21','','images/index_r6_c2_f2.jpg',1)"><img src="images/index_r6_c2.jpg" alt="Dar de Baja la Cuenta" name="index_r6_c21" width="122" height="24" border="0" id="index_r6_c21"></a></td>
  </tr>
  <tr>
    <td><img name="index_r7_c2" src="images/index_r7_c2.jpg" width="122" height="33" border="0" alt=""></td>
  </tr>
  <tr>
    <td><a href="listados.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r8_c21','','images/index_r8_c2_f2.jpg',1)"><img src="images/index_r8_c2.jpg" alt="Relaci&oacute;n de Estudiantes por curso" name="index_r8_c21" width="122" height="24" border="0" id="index_r8_c21"></a></td>
  </tr>
  <tr>
    <td><a href="horarios.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r9_c21','','images/index_r9_c2_f2.jpg',1)"><img src="images/index_r9_c2.jpg" alt="Horarios" name="index_r9_c21" width="122" height="24" border="0" id="index_r9_c21"></a></td>
  </tr>
  <tr>
    <td><img name="index_r10_c2" src="images/index_r10_c2.jpg" width="122" height="32" border="0" alt=""></td>
  </tr>
  <tr>
    <td><a href="notas.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r11_c21','','images/index_r11_c2_f2.jpg',1)"><img src="images/index_r11_c2.jpg" alt="Ingreso de Notas del semestre" name="index_r11_c21" width="122" height="24" border="0" id="index_r11_c21"></a></td>
  </tr>
  <tr>
    <td><a href="actas.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r12_c21','','images/index_r12_c2_f2.jpg',1)"><img src="images/index_r12_c2.jpg" alt="Ingreso de notas a Actas" name="index_r12_c21" width="122" height="24" border="0" id="index_r12_c21"></a></td>
  </tr>
  <tr>
    <td><img name="index_r13_c2" src="images/index_r13_c2.jpg" width="122" height="18" border="0" alt=""></td>
  </tr>
</table></td>
   <td align="center" valign="top"><form action="<?=$vFile.'?'.SID?>" method="post" name="fData" id="fData">
     <? if($sUser['error']) fmsnerrors($sUser['msnerror']); $sUser['error'] = FALSE  ?>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Datos de usuario <br>
         </td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="500" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
             <tr>
               <td width="150" align="right"><span class ='timporbb'>#</span> Palabra Recordatorio : </td>
               <td width="350"><input name="rRecorda" type="text" class="otexto" id="rRecorda" value="<?=$sUser['recorda']?>" size="25" maxlength="25">
              (M&iacute;n. 5 Caracteres. Max 25 Caracteres) </td>
             </tr>
             <tr>
               <td align="right">otro email :</td>
               <td><input name="rOemail" type="text" class="otexto" id="rOemail" value="<?=$sUser['oemail']?>" size="40" maxlength="40"></td>
             </tr>
         </table></td>
         <td background="../../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
     </table>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"><p>Datos personales <br>
         </p></td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="500" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
             <tr>
               <td width="150" align="right"><span class ='timporbb'>#</span> Identificaci&oacute;n :</td>
               <td width="350"><select name="rTip_doc" class="ocombo" id="rTip_doc">
                   <?=fviewdoc($sUser['tip_doc'])?>
                 </select>
              N&uacute;mero :
              <input name="rNum_doc" type="text" class="otexto" id="rNum_doc" value="<?=$sUser['num_doc']?>" size="10" maxlength="10"></td>
             </tr>
             <tr>
               <td align="right"><span class ='timporbb'>#</span> Sexo :</td>
               <td><select name="rSexo" class="ocombo" id="rSexo">
                   <?=fviewsex($sUser['sexo'])?>
               </select></td>
             </tr>
             <tr>
               <td align="right"><span class ='timporbb'>#</span> Fecha de Nacimiento : </td>
               <td><input name="rDia" type="text" class="otexto" id="rDia" value="<?=$sUser['dia']?>" size="2" maxlength="2">
              de
                <select name="rMes" class="ocombo" id="rMes">
                  <?=fviewmes($sUser['mes'])?>
                </select>
              de 19
              <input name="rAno" type="text" class="otexto" id="rAno" value="<?=$sUser['ano']?>" size="2" maxlength="2"></td>
             </tr>
             <tr>
               <td align="right"><span class ='timporbb'>#</span> Direcci&oacute;n : </td>
               <td><input name="rDirec" type="text" class="otexto" id="rDirec" value="<?=$sUser['direc']?>" size="40" maxlength="40">
               </td>
             </tr>
             <tr>
               <td align="right">Tel&eacute;fono :</td>
               <td><input name="rFono" type="text" class="otexto" id="rFono" value="<?=$sUser['fono']?>" size="10" maxlength="10">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular :
              <input name="rCelular" type="text" class="otexto" id="rCelular" value="<?=$sUser['celular']?>" size="10" maxlength="10">
               </td>
             </tr>
             <tr>
               <td align="right"><span class ='timporbb'>#</span> Estado civi : </td>
               <td><select name="rEst_civ" class="ocombo" id="select3">
                   <?=fvieweci($sUser['est_civ'])?>
               </select></td>
             </tr>
             <tr>
               <td align="right"><span class ='timporbb'>#</span> Nacionalidad : </td>
               <td><select name="rCod_nac" class="ocombo" id="rCod_nac">
                   <?=fviewnac($sUser['cod_nac'])?>
               </select></td>
             </tr>
             <tr align="center">
               <td colspan="2"><iframe width="500"  name ="frameUbigeo"  height="66" id="frameUbigeo" src="../ubigeo.php"  scrolling="no" frameborder="0" > </iframe>
                   <input name="rCod_dep" type="hidden" id="rCod_dep">
                   <input name="rCod_prv" type="hidden" id="rCod_prv">
                   <input name="rCod_dis" type="hidden" id="rCod_dis">
               </td>
             </tr>
             <tr align="center">
               <td colspan="2"><input name="Submit" type="submit" class="oboton" value="Guardar" onClick = "if(verify()){ document.fData.submit();} return false"></td>
             </tr>
         </table></td>
         <td background="../../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
     </table>
   </form></td>
   <td valign="top" background="images/index_r15_c5.jpg"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="12"><img name="index_r2_c5" src="images/index_r2_c5.jpg" width="16" height="318" border="0" alt=""></td>
  </tr>
</table></td>
  </tr>
  <tr>
   <td colspan="3"><img name="index_r16_c1" src="images/index_r16_c1.jpg" width="770" height="46" border="0" alt=""></td>
  </tr>
</table>
</body>
</html>
