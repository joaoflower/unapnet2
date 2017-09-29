<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");

	$vFile = 'tutorcur.php';
	$vHtml = "";
	$vTitle = "";
	$vAno_ini = '';
	$vAno_fin = '2004';
	$vAno = '';
	$vMessage = '';
	$Perpas = '01';
	$Pernow = '02';
	
	$tPlan = "car{$sUser['cod_car']}.plan{$sUser['cod_car']}";
	$tNota = "car{$sUser['cod_car']}.nota{$sUser['cod_car']}";
	$tEstumat = "";
	
	$vHeader = array('Año-Periodo', 'Especialidad', 'Plan', 'Nivel', 'Grupo', 'Mod', 'Turno', 'C');
	$vCont = 0;
	
	$vAno_ini = substr($sUser['codigo'], 0, 2);
	if($vAno_ini < '50') 
		$vAno_ini = "20$vAno_ini";
	else
		$vAno_ini = "1999";
	
	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	
	$vBody = '';
	for($vAno = $vAno_ini; $vAno <= $vAno_fin; $vAno++)
	{				
		$vTitle = "Matrículas Anteriores";
		$tEstumat = "car{$sUser['cod_car']}.em{$sUser['cod_car']}$vAno";
		

		$vQuery = "select cod_esp, pln_est, niv_est, sec_gru, mod_mat, tur_est, tot_crd, per_aca from $tEstumat ";
		$vQuery .= "where num_mat = '{$sUser['codigo']}' order by per_aca asc";
		$cEstumat = $xSerdata->query($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vBody[$vCont] = array("$vAno-{$sPeriodo[$aEstumat['per_aca']]}", $sEspecial[$aEstumat['cod_esp']], $aEstumat['pln_est'], $sNivel[$aEstumat['niv_est']], 
				$sGrupo[$aEstumat['sec_gru']], $sModmat[$aEstumat['mod_mat']], $sTurno[$aEstumat['tur_est']], $aEstumat['tot_crd']);
			$vCont++;
			$sTutor['ano_pas'] = $vAno;
			$sTutor['per_pas'] = $aEstumat['per_aca'];
			$sTutor['crd_pas'] = $aEstumat['tot_crd'];
			$sTutor['pln_est'] = $aEstumat['pln_est'];
		}
		$cEstumat->close();
	}
	$vMessage .= ftabledata($vHeader, $vBody);
	$vHtml .= fwindow($vTitle, $vMessage);						
	
	$sTutor['ano_aca'] = '2004';
	$sTutor['per_aca'] = '02';
	
	$vCrdapro = 0;
	$vCredito = 0;
	$vPuntaje = 0;
	
	$vQuery = "Select $tNota.pln_est, $tNota.cod_cur, $tPlan.crd_cur, $tNota.not_cur, $tNota.mod_not ";
	$vQuery .= "from $tNota left join $tPlan on $tNota.pln_est = $tPlan.pln_est and $tNota.cod_cur = $tPlan.cod_cur ";
	$vQuery .= "where $tNota.num_mat = '{$sUser['codigo']}' and $tNota.ano_aca = '{$sTutor['ano_pas']}' and ";
	$vQuery .= "per_aca = '{$sTutor['per_pas']}' order by pln_est, cod_cur, mod_not";
	
	$cNotas = $xSerdata->query($vQuery);
	while($aNotas = $cNotas->fetch_array())
	{
		if($aNotas['mod_not'] == '01' or $aNotas['mod_not'] == '10' or $aNotas['mod_not'] == '11')
		{
			if($aNotas['not_cur'] >= 11)
				$vCrdapro += $aNotas['crd_cur'];
			$vCredito += $aNotas['crd_cur'];
			$vPuntaje += $aNotas['crd_cur'] * $aNotas['not_cur'];
		}
	}
	$sTutor['apr_pas'] = $vCrdapro;
	if ($vCredito)
		$sTutor['pro_pas'] = $vPuntaje / $vCredito;
	
	$vVeces = 0;
	
	/*$vQuery = "Select pln_est, cod_cur, count(*) as veces from $tNota where pln_est = '{$sTutor['pln_est']}' and ";
	$vQuery .= "num_mat = '{$sUser['codigo']}' and not_cur < 11 and cod_cur not in ";
	$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sTutor['pln_est']}' and num_mat = '{$sUser['codigo']}' and ";
	$vQuery .= "not_cur > 10) group by pln_est, cod_cur order by veces desc";*/
	
/*	$vQuery = "Select pln_est, cod_cur, count(*) as veces from $tNota where pln_est = '{$sTutor['pln_est']}' and ";
	$vQuery .= "num_mat = '{$sUser['codigo']}' and not_cur < 11 and ano_aca = '{$sTutor['ano_pas']}' and per_aca = '{$sTutor['per_pas']}' ";
	$vQuery .= "group by pln_est, cod_cur order by veces desc";*/
	
	$vQuery = "Select pln_est, cod_cur, count(*) as veces from $tNota where pln_est = '{$sTutor['pln_est']}' and ";
	$vQuery .= "num_mat = '{$sUser['codigo']}' and not_cur < 11 and cod_cur in ";
	$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sTutor['pln_est']}' and num_mat = '{$sUser['codigo']}' and ";
	$vQuery .= "not_cur < 11 and ano_aca = '{$sTutor['ano_pas']}' and per_aca = '{$sTutor['per_pas']}' ) ";
	$vQuery .= "group by pln_est, cod_cur order by veces desc";

	$cVeces = $xSerdata->query($vQuery);
	if($aVeces = $cVeces->fetch_array())
		$vVeces = $aVeces['veces'];
	$cVeces->close();

	fCondicion($vVeces);
	
	$xSerdata->close();
		
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
   <td align="center" valign="top"><form action="<?=$vFile.'?'.SID?>" method="post" name="fTutor" id="fTutor">
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> Tutor&iacute;a Realizada </td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><div align="right"></div></td>
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
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> Situaci&oacute;n Acad&eacute;mica 2004-Periodo I</td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table border="0" cellpadding="0" cellspacing="1" class="tnormalbn">
           <tr>
             <td width="180" align="right">Creditos Matriculados : </td>
             <td width="100"><strong>
               <?=$sTutor['crd_pas']?> 
               Créditos</strong></td>
           </tr>
           <tr>
             <td align="right">Creditos Aprobados : </td>
             <td><strong><?=$sTutor['apr_pas']?> Créditos</strong></td>
           </tr>
           <tr>
             <td align="right">Promedio Ponderado Semestral : </td>
             <td><strong><?=$sTutor['pro_pas']?></strong></td>
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
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"> Situaci&oacute;n Acad&eacute;mica 2004-Periodo II</td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table border="0" cellpadding="0" cellspacing="1" class="tnormalbn">
             <tr>
               <td width="180" align="right">Modalidad de Matr&iacute;cula : </td>
               <td width="180"><strong><?=$sModmat[$sTutor['mod_mat']]?></strong></td>
             </tr>
             <tr>
               <td align="right">M&aacute;ximo de cr&eacute;ditos a Matricular : </td>
               <td><strong><?=$sTutor['crd_max']?> Créditos</strong></td>
             </tr>
             <tr>
               <td align="right">Especialidad : </td>
               <td><select name="rCod_esp" class="ocombo" id="rCod_esp">
                 <?=fviewesp()?>
                              </select></td>
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
     <input name="Submit" type="submit" class="oboton" value="Efectuar Tutoria">
   </form>    </td>
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
