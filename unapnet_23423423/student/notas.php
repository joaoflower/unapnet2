<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyss2())
		header("Location:../.");
		
	$vHtml = "";
	$vTitle = "";
		
	$tNota = "unapnet.nota{$sUser['cod_car']}";
	$tPlan = "unapnet.curso";
	$vHeader = array('P-C', 'C', 'Curso', 'Nota', 'Ptj', 'Mod');
	$vSubheader = array('Cursos', 'Puntaje', 'Créditos', 'Promedio');
	$vCont = 0;
	$vNota = '';
	$sNotapdf = '';
	$vConn = 0;
	
	$vQuery = "select distinct ano_aca, per_aca from $tNota where $tNota.num_mat = '{$sUser['codigo']}' order by ano_aca desc, per_aca desc";
	$cAno_per = fQuery($vQuery);
	while($aAno_per = mysql_fetch_array($cAno_per))
	{
		$vMessage = '';
		$vCont = 0;
		$vBody = '';
		$vSubody = '';
		
		$vCurso = 0;
		$vPuntaje = 0;
		$vCredito = 0;
		$vPromedio = 0;
		
		$vTitle = "Año Académico {$aAno_per['ano_aca']} - {$sPeriodo[$aAno_per['per_aca']]}";
				
		$vQuery = "Select $tNota.pln_est, $tNota.cod_cur, $tPlan.crd_cur, $tPlan.nom_cur, $tNota.not_cur, $tNota.mod_not, $tPlan.sem_anu, $tPlan.cod_cat, $tPlan.niv_est ";
		$vQuery .= "from $tNota left join $tPlan on $tNota.pln_est = $tPlan.pln_est and $tNota.cod_cur = $tPlan.cod_cur ";
		$vQuery .= "where $tNota.num_mat = '{$sUser['codigo']}' and $tNota.ano_aca = '{$aAno_per['ano_aca']}' and ";
		$vQuery .= "per_aca = '{$aAno_per['per_aca']}' and $tPlan.cod_car = '{$sUser['cod_car']}' order by pln_est, cod_cur, mod_not ";
				
		$cNotas = fQuery($vQuery);
		while($aNotas = mysql_fetch_array($cNotas))
		{
			if($aNotas['not_cur'] > 10)
				$vNota = "<font color ='#0000FF'>{$aNotas['not_cur']}</font>";
			else
				$vNota = "<font color ='#FF0000'>{$aNotas['not_cur']}</font>";
			$vBody[$vCont] = array("{$aNotas['pln_est']}-{$aNotas['cod_cur']}", $aNotas['crd_cur'], ucwords(strtolower($aNotas['nom_cur'])), 
				$vNota, $aNotas['crd_cur']*$aNotas['not_cur'], $sModnot[$aNotas['mod_not']]);
			$vCont++;
			if($aNotas['mod_not'] == '01' or $aNotas['mod_not'] == '10' or $aNotas['mod_not'] == '11' or 
				$aNotas['mod_not'] == '07' or $aNotas['mod_not'] == '14' or $aNotas['mod_not'] == '15' or 
				$aNotas['mod_not'] == '16' or $aNotas['mod_not'] == '18'  or $aNotas['mod_not'] == '17')
			{
				$vCurso++;
				$vCredito += $aNotas['crd_cur'];
				$vPuntaje += $aNotas['crd_cur'] * $aNotas['not_cur'];
			}

			$sNotapdf[$vConn]['ano_per'] = "{$aAno_per['ano_aca']}-{$aAno_per['per_aca']}";
			$sNotapdf[$vConn]['niv_est'] = $aNotas['niv_est'];
			
			$sNotapdf[$vConn]['sem_anu'] = $aNotas['sem_anu'];
			$sNotapdf[$vConn]['cod_cat'] = $aNotas['cod_cat'];
			$sNotapdf[$vConn]['nom_cur'] = ucwords(strtolower($aNotas['nom_cur']));
			$sNotapdf[$vConn]['mod_not'] = $sModnot[$aNotas['mod_not']];
			$sNotapdf[$vConn]['crd_cur'] = $aNotas['crd_cur'];
			$sNotapdf[$vConn]['not_cur'] = $aNotas['not_cur'];
			$vConn++;
		}
		if($vCredito)
			$vPromedio = $vPuntaje / $vCredito;
		if($vCurso)
		{
			$vSubody[$vCont] = array($vCurso, $vPuntaje, $vCredito, $vPromedio);
			$vMessage = ftabledata($vSubheader, $vSubody, 0);
		}
		$vMessage .= ftabledata($vHeader, $vBody, 500);
		$vHtml .= fwindow($vTitle, $vMessage);		
		$vHtml .= "<br>";
	}

	
?>
<html>
<head>
<title>Un@p.Net2&reg; Student : La forma mas comoda de acceder a la informaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Wed Jan 12 14:54:35 GMT-0500 2005-->
<script language="JavaScript">
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
<body bgcolor="#ffffff" onLoad="MM_preloadImages('images/index_r3_c2_f2.jpg','images/index_r4_c2_f2.jpg','images/index_r5_c2_f2.jpg','images/index_r6_c2_f2.jpg','images/index_r8_c2_f2.jpg','images/index_r9_c2_f2.jpg','images/index_r10_c2_f2.jpg','images/index_r11_c2_f2.jpg','images/index_r13_c2_f2.jpg','images/index_r14_c2_f2.jpg')">
<table border="0" cellpadding="0" cellspacing="0" width="770">
<!-- fwtable fwsrc="estdoc.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "377833132" fwnested="0" -->

  <tr>
   <td><img name="index_r1_c1" src="images/index_r1_c1.jpg" width="149" height="68" border="0" alt=""></td>
   <td><img name="index_r1_c4" src="images/index_r1_c4.jpg" width="605" height="68" border="0" alt=""></td>
   <td><img name="index_r1_c5" src="images/index_r1_c5.jpg" width="16" height="68" border="0" alt=""></td>
  </tr>
  <tr>
   <td valign="top" background="images/index_r16_c1.jpg"><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td colspan="3"><img name="index_r2_c1" src="images/index_r2_c1.jpg" width="149" height="42" border="0" alt=""></td>
     </tr>
     <tr>
       <td rowspan="13"><img name="index_r3_c1" src="images/index_r3_c1.jpg" width="9" height="326" border="0" alt=""></td>
       <td><a href="closession.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r3_c2','','images/index_r3_c2_f2.jpg',1);"><img name="index_r3_c2" src="images/index_r3_c2.jpg" width="122" height="24" border="0" alt="Cerrar Sesi&oacute;n"></a></td>
       <td rowspan="13"><img name="index_r3_c3" src="images/index_r3_c3.jpg" width="18" height="326" border="0" alt=""></td>
     </tr>
     <tr>
       <td><a href="mydata.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r4_c2','','images/index_r4_c2_f2.jpg',1);"><img name="index_r4_c2" src="images/index_r4_c2.jpg" width="122" height="24" border="0" alt="Datos Personales"></a></td>
     </tr>
     <tr>
       <td><a href="passwd.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r5_c2','','images/index_r5_c2_f2.jpg',1);"><img name="index_r5_c2" src="images/index_r5_c2.jpg" width="122" height="24" border="0" alt="Cambiar Contrase&ntilde;a"></a></td>
     </tr>
     <tr>
       <td><a href="baja.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r6_c2','','images/index_r6_c2_f2.jpg',1);"><img name="index_r6_c2" src="images/index_r6_c2.jpg" width="122" height="24" border="0" alt="Dar de Baja la Cuenta"></a></td>
     </tr>
     <tr>
       <td><img name="index_r7_c2" src="images/index_r7_c2.jpg" width="122" height="34" border="0" alt=""></td>
     </tr>
     <tr>
       <td><a href="notas.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r8_c2','','images/index_r8_c2_f2.jpg',1);"><img name="index_r8_c2" src="images/index_r8_c2.jpg" width="122" height="25" border="0" alt="Historial de Notas"></a></td>
     </tr>
     <tr>
       <td><a href="curmat.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r9_c2','','images/index_r9_c2_f2.jpg',1);"><img name="index_r9_c2" src="images/index_r9_c2.jpg" width="122" height="24" border="0" alt="Cursos matriculados"></a></td>
     </tr>
     <tr>
       <td><a href="plan.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r10_c2','','images/index_r10_c2_f2.jpg',1);"><img name="index_r10_c2" src="images/index_r10_c2.jpg" width="122" height="24" border="0" alt="Plan de Estudios"></a></td>
     </tr>
     <tr>
       <td><a href="horarios.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r11_c2','','images/index_r11_c2_f2.jpg',1);"><img name="index_r11_c2" src="images/index_r11_c2.jpg" width="122" height="25" border="0" alt="Horarios"></a></td>
     </tr>
     <tr>
       <td><img name="index_r12_c2" src="images/index_r12_c2.jpg" width="122" height="32" border="0" alt=""></td>
     </tr>
     <tr>
       <td><a href="tutoria.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r14_c2','','images/index_r14_c2_f2.jpg',1);"><img name="index_r14_c2" src="images/index_r14_c2.jpg" width="122" height="25" border="0" alt="Tutor&iacute;a"></a></td>
     </tr>
     <tr>
       <td><a href="prematricula.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('index_r13_c2','','images/index_r13_c2_f2.jpg',1);"><img name="index_r13_c2" src="images/index_r13_c2.jpg" width="122" height="25" border="0" alt="Pre-matr&iacute;cula"></a></td>
     </tr>
     <tr>
       <td><img name="index_r15_c2" src="images/index_r15_c2.jpg" width="122" height="16" border="0" alt=""></td>
     </tr>
   </table></td>
   <td align="center" valign="top">     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Historial de Notas </strong></td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn">A Continuaci&oacute;n se muestra el historial de todas las notas del Estudiante desde su ingreso.</td>
         <td background="../../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
   </table>
	<?=$vHtml?>
    <table border="0" cellpadding="0" cellspacing="0">
      <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
      <tr>
        <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
        <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Leyenda</strong></td>
        <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
      </tr>
      <tr>
        <td background="../../images/ventana_r2_c1.jpg"></td>
        <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" class="tnormalbn">
          <tr align="center" class="cabecera">
            <td>&nbsp;Codigo&nbsp;</td>
            <td>&nbsp;Descripci&oacute;n&nbsp;</td>
            </tr>
          <tr>
            <td align="right"><strong>P-C : </strong></td>
            <td>&nbsp;Plan de Estudios - Codigo de Curso</td>
            </tr>
          <tr>
            <td align="right"><strong>C : </strong></td>
            <td>Credito del Curso </td>
          </tr>
          <tr>
            <td align="right"><strong>Curso : </strong></td>
            <td>Denominaci&oacute;n del curso </td>
          </tr>
          <tr>
            <td align="right"><strong>Nota : </strong></td>
            <td>Nota optenida en el curso </td>
          </tr>
          <tr>
            <td align="right"><strong>Ptj : </strong></td>
            <td>Puntaje del Curso(Credito * Nota) </td>
          </tr>
          <tr>
            <td align="right"><strong>Mod : </strong></td>
            <td>Modalidad de la Nota </td>
          </tr>
        </table>
          <table border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF"></table></td>
        <td background="../../images/ventana_r2_c4.jpg"></td>
      </tr>
      <tr>
        <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
        <td background="../../images/ventana_r4_c2.jpg"></td>
        <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
      </tr>
    </table>    </td>
   <td valign="top" background="images/index_r16_c5.jpg"><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td><img name="index_r2_c5" src="images/index_r2_c5.jpg" width="16" height="368" border="0" alt=""></td>
     </tr>
   </table></td>
  </tr>
  <tr>
   <td colspan="3"><img name="index_r17_c1" src="images/index_r17_c1.jpg" width="770" height="46" border="0" alt=""></td>
  </tr>
</table>
</body>
</html>
