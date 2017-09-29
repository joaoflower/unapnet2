<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");

	if($sUser['tip_sist'] == '2')
	{

		$tHorario = "unapnet.hora{$sUser['cod_car']}2005";
		$tCarga = "unapnet.carga2005";
		$sCurso = "";
		
		$vQuery = "Select distinct curso.pln_est, curso.sem_anu, $tHorario.sec_gru ";
		$vQuery .= "from $tHorario left join unapnet.curso on curso.pln_est = $tHorario.pln_est and ";
		$vQuery .= "curso.cod_cur = $tHorario.cod_cur and curso.cod_car = $tHorario.cod_car ";
		$vQuery .= "where $tHorario.per_aca = '02'";
		$cSemgru = fQuery($vQuery);
		while($aSemgru = mysql_fetch_array($cSemgru))
		{
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['sec_gru']]['pln_est'] = $aSemgru['pln_est'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['sec_gru']]['sem_anu'] = $aSemgru['sem_anu'];
			$sSemgru[$aSemgru['pln_est'].$aSemgru['sem_anu'].$aSemgru['sec_gru']]['sec_gru'] = $aSemgru['sec_gru'];
		}
		
		$sDocente = "";
		$vQuery = "Select distinct docente.cod_prf, docente.paterno, docente.materno, docente.nombres ";
		$vQuery .= "from unapnet.docente left join $tCarga on docente.cod_prf = $tCarga.cod_prf ";
		$vQuery .= "where $tCarga.cod_car = '{$sUser['cod_car']}' and $tCarga.per_aca = '02'";
		$cDocente = fQuery($vQuery);
		while($aDocente = mysql_fetch_array($cDocente))
			$sDocente[$aDocente['cod_prf']] = "{$aDocente['paterno']} {$aDocente['materno']}, {$aDocente['nombres']}";
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
   <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
     <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
     <tr>
       <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
       <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"><p>Horario<strong></strong></p>         </td>
       <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
     </tr>
     <tr>
       <td background="../../images/ventana_r2_c1.jpg"></td>
       <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn">Horarios de todos los Semestres de la carrera profesional. </td>
       <td background="../../images/ventana_r2_c4.jpg"></td>
     </tr>
     <tr>
       <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
       <td background="../../images/ventana_r4_c2.jpg"></td>
       <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
     </tr>
   </table>
<?
		if(!empty($sSemgru)) 
		foreach($sSemgru as $vPSG => $aSemgru) 
		{ 
	?>    
<table border="0" cellpadding="0" cellspacing="0">
      <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
      <tr>
        <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
        <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"><p>Horario Semestre :
            <?=$sSemestre[$aSemgru['sem_anu']]?>
- Grupo :
<?=$sGrupo[$aSemgru['sec_gru']]?>
        </p></td>
        <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
      </tr>
      <tr>
        <td background="../../images/ventana_r2_c1.jpg"></td>
        <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows" class="tabled">
          <tr align="center" class="cabecera">
            <td width="60" class="cabecera" scope="col">Hora</td>
            <td width="60" scope="col">Lunes</td>
            <td width="60" scope="col">Martes</td>
            <td width="70" scope="col">Mi&eacute;rcoles</td>
            <td width="60" scope="col">Jueves</td>
            <td width="60" scope="col">Viernes</td>
            <td width="60" scope="col">S&aacute;bado</td>
            <td width="60" scope="col">Domingo</td>
          </tr>
          <? 	$vCont = 1;	 
				$sHorario = "";
				$sCursem = "";
				$vQuery = "Select curso.cod_cur, curso.nom_cur, $tHorario.cod_dia, $tHorario.cod_hor ";
				$vQuery .= "from $tHorario left join unapnet.curso on curso.pln_est = $tHorario.pln_est and ";
				$vQuery .= "curso.cod_cur = $tHorario.cod_cur and curso.cod_car = $tHorario.cod_car ";
				$vQuery .= "where $tHorario.per_aca = '02' and $tHorario.sec_gru = '{$aSemgru['sec_gru']}' and ";
				$vQuery .= "curso.sem_anu = '{$aSemgru['sem_anu']}' and curso.pln_est = '{$aSemgru['pln_est']}' order by cod_hor";
				$cHorasem = fQuery($vQuery);
				while($aHorasem = mysql_fetch_array($cHorasem))
				{
					$sHorario[$aHorasem['cod_hor']][$aHorasem['cod_dia']] = $aHorasem['cod_cur'];
					$sCursem[$aHorasem['cod_cur']] = $aHorasem['nom_cur'];
				}
				if(!empty($sHorario))
				foreach($sHorario as $vCod_hor => $aHorario)
				{
			?>
          <tr align="center" <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
            <td class="wordcen"><?=$sCodhora[$vCod_hor]?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['1']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['2']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['3']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['4']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['5']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['6']?></td>
            <td class="wordcen">&nbsp;
                <?=$aHorario['7']?></td>
          </tr>
          <? $vCont++; 	} ?>
        </table><table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows" class="tabled">
            <tr align="center" class="cabecera">
              <td width="60" scope="col">C&oacute;digo</td>
              <td width="200" scope="col">Curso</td>
              <td width="200" scope="col">Docente</td>
            </tr>
            <? 	$sCarga = "";
				$vCont = 1;	 
				$vQuery = "select curso.cod_cur, $tCarga.cod_prf ";
				$vQuery .= "from unapnet.curso left join $tCarga on curso.cod_car = $tCarga.cod_car and curso.pln_est = $tCarga.pln_est and ";
				$vQuery .= "curso.cod_cur = $tCarga.cod_cur ";
				$vQuery .= "where curso.cod_car = '{$sUser['cod_car']}' and curso.pln_est = '{$aSemgru['pln_est']}' and ";
				$vQuery .= "curso.sem_anu = {$aSemgru['sem_anu']} and $tCarga.sec_gru = '{$aSemgru['sec_gru']}'";
				$cCarga = fQuery($vQuery);
				while($aCarga = mysql_fetch_array($cCarga))
					$sCarga[$aCarga['cod_cur']] = $aCarga['cod_prf'];
				if(!empty($sCursem))
				foreach($sCursem as $vCod_cur => $vNom_cur)
				{
			?>
			<tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
              <td class="wordcen">&nbsp;<?=$vCod_cur?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sCursem[$vCod_cur]))?></td>
              <td class="wordizq">&nbsp;<?=ucwords(strtolower($sDocente[$sCarga[$vCod_cur]]))?></td>
            </tr>
			<? $vCont++; 	} ?>
          </table></td>
        <td background="../../images/ventana_r2_c4.jpg"></td>
      </tr>
      <tr>
        <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
        <td background="../../images/ventana_r4_c2.jpg"></td>
        <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
      </tr>
    </table>
<? } ?></td>
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
