<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
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
<style type="text/css">
<!--
.Estilo1 {font-size: 20px}
-->
</style>
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
   <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
     <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
     <tr>
       <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
       <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Bienvenido a Un@p.Net2&reg;</strong></td>
       <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
     </tr>
     <tr>
       <td background="../../images/ventana_r2_c1.jpg"></td>
       <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><div align="center">
         <p class="Estilo1">El ingreso de Notas a Actas via Internet inici&oacute; el <strong>Martes 26 de Junio del 2007</strong>.<br>
           Por disposici&oacute;n de Vicerrectorado Acad&eacute;mico el &uacute;ltimo d&iacute;a para el ingreso de Notas via Internet es el <strong>Lunes 9 de Julio del 2007</strong>. <br>
           En Consejo Universitario se ratifico el &uacute;ltimo d&iacute;a de llenado de actas v&iacute;a Internet. <br>
         </p>
       </div></td>
       <td background="../../images/ventana_r2_c4.jpg"></td>
     </tr>
     <tr>
       <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
       <td background="../../images/ventana_r4_c2.jpg"></td>
       <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
     </tr>
   </table></td>
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
