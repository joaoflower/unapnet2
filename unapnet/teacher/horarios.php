<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyds2())
		header("Location:../.");
		
/*	$vHtml = "";
	$vTitle = "";
	$vPlan = "";
	$aCata = "";
	$aCurso = "";
	
	$vHeader = array('Hora', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo' );
	$vHeader2 = array('Código', 'Curso', 'Carrera');
	$tPlan = "car{$sUser['cod_car']}.plan{$sUser['cod_car']}";
	$tCarga = "car{$sUser['cod_car']}.ca{$sUser['cod_car']}2004";
	$tHorcar = "caw{$sUser['cod_car']}.hr{$sUser['cod_car']}2004";
	
	$vCont = 0;
	
	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	
	$vQuery = "select $tPlan.pln_est, $tPlan.cod_cur, $tPlan.nom_cur, $tPlan.cod_cat ";
	$vQuery .= "from $tCarga left join $tPlan on $tCarga.pln_est = $tPlan.pln_est and $tCarga.cod_cur = $tPlan.cod_cur ";
	$vQuery .= "where cod_prf like '%{$sUser['codigo']}' and per_aca = '02'";
	$cCur = $xSerdata->query($vQuery);
	while($aCur = $cCur->fetch_array())
	{
		$aCata[$aCur['pln_est'].$aCur['cod_cur']] = $aCur['cod_cat'];
		$aCurso[$aCur['pln_est'].$aCur['cod_cur']] = $aCur['nom_cur'];
	}
	$cCur->close();
	
	$vTitle = "Horario 2004-II";
	$vCont = 0;
	$vBody = '';
	$vBody2 = '';
	$vMessage = '';
	$aHorario = '';
	$aCurdoc = '';
	
	$vQuery = "Select $tHorcar.pln_est, $tHorcar.cod_cur, cod_dia, cod_hor, cod_car from $tHorcar left join $tCarga on $tHorcar.pln_est = $tCarga.pln_est and ";
	$vQuery .= "$tHorcar.cod_cur = $tCarga.cod_cur and $tHorcar.per_aca = $tCarga.per_aca ";
	$vQuery .= "where $tCarga.cod_prf like '%{$sUser['codigo']}%' and $tCarga.per_aca = '02' order by cod_hor, cod_dia";

	$cHorcar = $xSerdata->query($vQuery);
	while ($aHorcar = $cHorcar->fetch_array())
	{
		$aHorario[$aHorcar['cod_hor']][$aHorcar['cod_dia']] = $aHorcar['pln_est'].$aHorcar['cod_cur'];
		$aCurdoc[$aHorcar['pln_est'].$aHorcar['cod_cur']] = $aHorcar['cod_car'];
	}
	$cHorcar->close();
	
	foreach($aHorario as $vCod_hor => $vDia)
	{
		$vBody[$vCont] = array($sHorario[$vCod_hor], $aCata[$vDia['1']], $aCata[$vDia['2']], $aCata[$vDia['3']], 
			$aCata[$vDia['4']], $aCata[$vDia['5']], $aCata[$vDia['6']], $aCata[$vDia['7']]);
		$vCont++;
	}
	$vMessage = ftabledata($vHeader, $vBody);
	
	foreach($aCurdoc as $vCur => $vCar)
	{
		$vBody2[$vCont] = array($aCata[$vCur], ucwords(strtolower($aCurso[$vCur])),  ucwords(strtolower($sCarrera[$vCar])));
		$vCont++;
	}
	
	$vMessage .= "<Br>".ftabledata($vHeader2, $vBody2, 550);
	$vHtml .= fwindow($vTitle, $vMessage);						
	$vHtml .= "<br>";			
	
	$xSerdata->close();*/
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
   <td align="center" valign="top"><?=$vHtml?></td>
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
