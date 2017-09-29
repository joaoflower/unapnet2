<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");
		
	if(!($sUser['tip_sist'] === '2'))
		header("Location:index2.php");
	
	$vFile = 'tutorcur.php';
	$vHtml = "";
	$vTitle = "";
	$vMessage = '';
	$vCur_crd = 0;
	$vEst_crd = 0;
	$sUser['max_crd2'] = 0;
	$sUser['tot_tut'] = 0;
	$sUser['safetymatri'] = FALSE;
	$sUser['safetytutor'] = FALSE;
	
	$tEstutor = "unapnet.estutut{$sUser['cod_car']}2005";
	$tCurtutor = "unapnet.curtut{$sUser['cod_car']}2005";
	$tPlan = "unapnet.curso";
	$tEstumat = "unapnet.estumat{$sUser['cod_car']}2005";
	$tEstuwat = "unapnet.estumat{$sUser['cod_car']}2005";
	
	$vHeader = array('P-C', 'CAT', 'S', 'Curso', 'Mod', 'Grupo', 'C', '');
	$vSubheader = array('Especialidad', 'Plan', 'Mod', 'C');
	
	$bEst_wat = FALSE;
	
	$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	
	$vQuery = "Select pln_est from $tEstuwat where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
	$cEstuwat = mysql_query($vQuery, $xSerdata);
	if($aEstuwat = mysql_fetch_array($cEstuwat))
		$bEst_wat = TRUE;

	$vQuery = "Select pln_est from $tEstumat where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
	$cEstumat = mysql_query($vQuery, $xSerdata);
	if($aEstumat = mysql_fetch_array($cEstumat))
		$sTutor['pln_est'] = $aEstumat['pln_est'];
	
	$vQuery = "Select cod_esp, pln_est, mod_mat, tot_crd, max_crd from $tEstutor where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
	$cEstutor = mysql_query($vQuery, $xSerdata);
	if($aEstutor = mysql_fetch_array($cEstutor))
	{
		$sUser['pln_est'] = $aEstutor['pln_est'];
		$sUser['cod_esp'] = $aEstutor['cod_esp'];
		$sUser['max_crd'] = $aEstutor['max_crd'];
		$sUser['tot_tut'] = $aEstutor['tot_crd'];
		$sUser['max_crd2'] = $aEstutor['tot_crd'];
		
		$sUser['safetytutor'] = TRUE;
		
		$vCont = 0;
		$vTitle = "Matricula Realizada";
		$vBody = '';
		$vSubody = '';

		$vSubody[$vCont] = array($sEspecial[$aEstutor['cod_esp']], $aEstutor['pln_est'], $sModmat[$aEstutor['mod_mat']], $aEstutor['tot_crd']);
		$vEst_crd = $aEstutor['max_crd'];
		$sUser['max_crd'] = $aEstutor['max_crd'];
		
		$vQuery = "Select $tPlan.pln_est, $tPlan.cod_cur, $tPlan.cod_cat, $tPlan.sem_anu, $tPlan.nom_cur, $tCurtutor.mod_mat, $tCurtutor.sec_gru, $tPlan.crd_cur, $tCurtutor.cur_obli ";
		$vQuery .= "from $tCurtutor left join $tPlan on $tCurtutor.pln_est = $tPlan.pln_est and $tCurtutor.cod_cur = $tPlan.cod_cur ";
		$vQuery .= "where $tCurtutor.num_mat = '{$sUser['codigo']}' and per_aca = '01' and $tPlan.cod_car = '{$sUser['cod_car']}'";
		
		$cCurtutor = mysql_query($vQuery, $xSerdata);
		while($aCurtutor = mysql_fetch_array($cCurtutor))
		{
			$vEliminar = "";
			if(empty($aCurtutor['cur_obli']) and !$bEst_wat)
				$vEliminar = "<a href='tutoreli.php?rCod_cur={$aCurtutor['cod_cur']}' class='tmensajebn' title='Quitar curso' >Quitar</a>";
				
			$vBody[$vCont] = array("{$aCurtutor['pln_est']}-{$aCurtutor['cod_cur']}", $aCurtutor['cod_cat'], $aCurtutor['sem_anu'], 
				ucwords(strtolower($aCurtutor['nom_cur'])), $sModmat[$aCurtutor['mod_mat']], $sGrupo[$aCurtutor['sec_gru']], 
				$aCurtutor['crd_cur'], $vEliminar);
			$vCont++;
			$vCur_crd += $aCurtutor['crd_cur'];
		}
		
		$vMessage = ftabledata($vSubheader, $vSubody, 0);
		$vMessage .= ftabledata($vHeader, $vBody, 550);
		$vHtml .= fwindow($vTitle, $vMessage);						
//		$vHtml .= "<br>";
		
		//---------------------------------------------------------------------------------------
		
		$vHtml2 = "";
		$vTitle = "";
		$vPlan = "";
		$aCata = "";
		$aCurso = "";
		$aDocente = "";
		$aCurdoc = "";
		
		$vHeader = array('Hora', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo' );
		$vHeader2 = array('Código', 'Curso', 'Docente');
		$tPlan = "unapnet.curso";
		$tEstumat = "unapnet.estumat{$sUser['cod_car']}2005";
		$tCarga = "unapnet.carga2005";
		$tHorcar = "unapnet.hora{$sUser['cod_car']}2005";
		$tDocente = "unapnet.docente";
		
		$vCont = 0;
		$vPlan = $sUser['pln_est'];
		
		$vQuery = "select cod_cur, nom_cur, cod_cat from $tPlan where pln_est = '$vPlan' and cod_car = '{$sUser['cod_car']}'";
		$cCur = mysql_query($vQuery, $xSerdata);
		while($aCur = mysql_fetch_array($cCur))
		{
			$aCata[$aCur['cod_cur']] = $aCur['cod_cat'];
			$aCurso[$aCur['cod_cur']] = $aCur['nom_cur'];
		}
	
		$vQuery = "select cod_cur, paterno, materno, nombres from $tCarga left join $tDocente on $tCarga.cod_prf = $tDocente.cod_prf ";
		$vQuery .= "where $tCarga.pln_est = '$vPlan' and $tCarga.per_aca = '01'";
		$cDoc = mysql_query($vQuery, $xSerdata);
		while($aDoc = mysql_fetch_array($cDoc))
			$aDocente[$aDoc['cod_cur']] = "{$aDoc['nombres']} {$aDoc['paterno']} {$aDoc['materno']}";
			
		$vTitle = "Horario de los cursos Matriculados";
		$vCont = 0;
		$vBody = '';
		$vBody2 = '';
		$vMessage = '';
		$aHorario = '';
		$aCurdoc = '';
		
		$vQuery = "Select $tHorcar.cod_cur, $tHorcar.cod_dia, $tHorcar.cod_hor ";
		$vQuery .= "from $tHorcar left join $tCurtutor on $tHorcar.pln_est = $tCurtutor.pln_est and $tHorcar.cod_cur = $tCurtutor.cod_cur and ";
		$vQuery .= "$tHorcar.per_aca = $tCurtutor.per_aca and $tHorcar.sec_gru = $tCurtutor.sec_gru ";
		$vQuery .= "where $tCurtutor.num_mat = '{$sUser['codigo']}' and $tCurtutor.per_aca = '01' order by $tHorcar.cod_hor, $tHorcar.cod_dia";

		$cHorcar = mysql_query($vQuery, $xSerdata);
		while ($aHorcar = mysql_fetch_array($cHorcar))
		{
			if(empty($aHorario[$aHorcar['cod_hor']][$aHorcar['cod_dia']]))
				$aHorario[$aHorcar['cod_hor']][$aHorcar['cod_dia']] = $aCata[$aHorcar['cod_cur']];
			else
				$aHorario[$aHorcar['cod_hor']][$aHorcar['cod_dia']] .= " <span class='timporbb'>{$aCata[$aHorcar['cod_cur']]}</span>";
			$aCurdoc[$aHorcar['cod_cur']] = $aHorcar['cod_cur'];
		}
		
		if(!empty($aHorario))
		foreach($aHorario as $vCod_hor => $vDia)
		{
			$vBody[$vCont] = array($sCodhora[$vCod_hor], $vDia['1'], $vDia['2'], $vDia['3'], 
				$vDia['4'], $vDia['5'], $vDia['6'], $vDia['7']);
			$vCont++;
		}
		$vMessage = ftabledata($vHeader, $vBody, 550);
		
		if(!empty($aCurdoc))
		foreach($aCurdoc as $vCur)
		{
			$vBody2[$vCont] = array($aCata[$vCur], ucwords(strtolower($aCurso[$vCur])), ucwords(strtolower($aDocente[$vCur])));
			$vCont++;
		}
		
		$vMessage .= "<Br>".ftabledata($vHeader2, $vBody2, 550);
		$vHtml2 .= fwindow($vTitle, $vMessage);						
		$vHtml2 .= "<br>";			
	}
	else
	{
		header("Location:tutoreva.php");
//		echo "evalua";
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
   <td align="center" valign="top">      <form action="<?=$vFile.'?'.SID?>" method="post" name="fTutor" id="fTutor">
     <span class="timporbb">Usted ya realiz&oacute; su matr&iacute;cula.<br>
En el periodo de ratificaci&oacute;n tiene que ir a la Coordinaci&oacute;n Acad&eacute;mica <br>
para RATIFICAR su matr&iacute;cula y recoger su ficha de matr&iacute;cula. <br>
Porque si NO LO HACE su matricula NO SER&Aacute; V&Aacute;LIDA</span>
     <? if($sUser['error']) fmsnerrors($sUser['msnerror']); $sUser['error'] = FALSE  ?>
     <?=$vHtml?>
	 <?  if(($vCur_crd < $vEst_crd) and !$bEst_wat) { ?>
	 <input name="Submit" type="submit" class="oboton" value="Agregar Cursos">   
	 <? } ?>
     <?=$vHtml2?>
   </form>        </td>
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
