<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyss2())
		header("Location:../.");
		
	if(!empty($_POST['rCod_esp']))
		$sUser['cod_esp'] = $_POST['rCod_esp'];

	if(!$sUser['safetytutor'])
		header("Location:tutoria.php");
	
	$vFile = 'savetutor.php';

	$tNota = "unapnet.nota".$sUser['cod_car'];
	
	$aSemnot = "";
	$aSemele = "";

	$aCurdes = "";
	$aCurapro = "";
	$aCurnot = "";
	$aCurobli = "";
	$aCurele = "";
	$aCuropta = "";

	if($sUser['max_crd2'] > 0)
	{
		$sUser['max_crd'] -= $sUser['max_crd2'];
		if ($sUser['max_crd'] < 0 )
			$sUser['max_crd'] = 0;
		$vFile = 'savetutor2.php';
	}
	
	$sCurmat = "";
	$sCurapto = "";
	$sCurtut = "";
	$tCurtut = "unapnet.curtut{$sUser['cod_car']}2005";
	
	$vQuery = "Select cod_cur from $tCurtut where num_mat = '{$sUser['codigo']}' and per_aca = '01'";
	$cCurtut = fQuery($vQuery);
	while($aCurtut = mysql_fetch_array($cCurtut))
		$sCurtut[$aCurtut['cod_cur']] = TRUE;
	
	$vQuery = "Select $tNota.cod_cur, count(*) as veces ";
	$vQuery .= "from $tNota ";
	$vQuery .= "where $tNota.pln_est = '{$sUser['pln_est']}' and ";
	$vQuery .= "$tNota.num_mat = '{$sUser['codigo']}' and $tNota.not_cur < 11 and $tNota.cod_cur not in ";
	$vQuery .= "(Select cod_cur from $tNota where pln_est = '{$sUser['pln_est']}' and num_mat = '{$sUser['codigo']}' and ";
	$vQuery .= "not_cur > 10) group by cod_cur order by cod_cur";		
	$cCurdes2 = fQuery($vQuery);	
	$sUser['crd_ini'] = 0;
	while($aCurdes2 = mysql_fetch_array($cCurdes2))
	{
		if ($sCurso[$aCurdes2['cod_cur']]['tip_cur'] == '02')
			$aSemnot[$sCurso[$aCurdes2['cod_cur']]['sem_anu']] = TRUE;
		if(!$sCurtut[$aCurdes2['cod_cur']])
		{
			$sCurmat[$aCurdes2['cod_cur']]['mod_mat'] = fModcurso($aCurdes2['veces']);
			$sCurmat[$aCurdes2['cod_cur']]['tur_est'] = '1';
			$sCurmat[$aCurdes2['cod_cur']]['cur_obli'] = '1';
			$aCurdes[$aCurdes2['cod_cur']] = TRUE;			
			$sUser['crd_ini'] += $sCurso[$aCurdes2['cod_cur']]['crd_cur'];
		}
	}
	
	$vQuery = "Select $tNota.cod_cur ";
	$vQuery .= "from $tNota ";
	$vQuery .= "where $tNota.pln_est = '{$sUser['pln_est']}' and $tNota.num_mat = '{$sUser['codigo']}' and $tNota.not_cur > 10 ";
	$cCurapro2 = fQuery($vQuery);	
	while($aCurapro2 = mysql_fetch_array($cCurapro2))
	{
		$aCurapro[$aCurapro2['cod_cur']] = TRUE;
		if ($sCurso[$aCurapro2['cod_cur']]['tip_cur'] == '02')
			$aSemnot[$sCurso[$aCurapro2['cod_cur']]['sem_anu']] = TRUE;
	}
	
	$vQuery = "Select cod_cur, cur_pre ";
	$vQuery .= "from unapnet.requ ";
	$vQuery .= "where cod_car = '{$sUser['cod_car']}' and pln_est = '{$sUser['pln_est']}'";
	$cCurpre = fQuery($vQuery);	
	while($aCurpre = mysql_fetch_array($cCurpre))
	{
		if(!$aCurapro[$aCurpre['cur_pre']])
			$aCurnot[$aCurpre['cod_cur']] = TRUE;
	}
	
	if(!empty($sCurso))
	foreach($sCurso as $vCod_cur => $aCurso)
	{
		if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '01' and !$sCurtut[$vCod_cur])
		{
			$sCurapto[$vCod_cur] = TRUE;
			$aCurobli[$vCod_cur] = TRUE;
		}				
		if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '02' and !$aSemnot[$aCurso['sem_anu']]  and !$sCurtut[$vCod_cur])
		{
			$sCurapto[$vCod_cur] = TRUE;
			$aCurele[$vCod_cur] = TRUE;
			$aSemele[$aCurso['sem_anu']] = TRUE;
		}
		if(!$aCurapro[$vCod_cur] and !$aCurdes[$vCod_cur] and !$aCurnot[$vCod_cur] and $aCurso['tip_cur'] == '03'  and !$sCurtut[$vCod_cur])
		{
			$sCurapto[$vCod_cur] = TRUE;
			$aCuropta[$vCod_cur] = TRUE;
		}				
	}
	$sUser['safetymatri'] = TRUE;
	
	if($sUser['crd_ini'] > $sUser['max_crd'])
	{
		//$aCurdes = "";
		$aCurobli = "";
		$aCuropta = "";
		$aCurele = "";
		foreach($aCurdes as $vCod_cur => $bCod_cur)
			$aCurdes[$vCod_cur] = FALSE;
		$sUser['crd_ini'] = 0;		
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
function aumentar(cont, vCanti)
	{ 
		if(cont.checked)
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) + parseFloat(vCanti);
		else
			document.fData.txtCantidad.value = parseFloat(document.fData.txtCantidad.value) - parseFloat(vCanti);
		if(parseFloat(document.fData.txtCantidad.value) > <?=$sUser['max_crd']?>)
		{
			alert("A sobrepasado el límite de créditos permitidos, se QUITARA el curso escogido");
			cont.checked = false;
			aumentar(cont, vCanti);
		}
		
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
   <td align="center" valign="top"><form action="<?=$vFile.'?'.SID?>" method="post" name="fData" id="fData">
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Datos principales del Estudiante </td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="400" border="0" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
           <tr>
             <td width="75" align="right" class="tnormalbn">Plan : </td>
             <td colspan="3" class="tnormalbn"><strong>
               <?=$sUser['pln_est']?>
      -
        <strong>
        <?=$sTiposist[$sUser['tip_sist']]?>
        </strong>             </strong></td>
           </tr>
           <tr>
             <td align="right" class="tnormalbn">Especialidad : </td>
             <td colspan="3" class="tnormalbn"><strong><?=$sEspecial[$sUser['cod_esp']]?></strong></td>
           </tr>
           <tr>
             <td align="right" class="tnormalbn">Modalidad : </td>
             <td width="125" class="tnormalbn"><strong><?=$sModmat[$sUser['mod_mat']]?></strong></td>
             <td width="80" class="tnormalbn">M&aacute;ximo. Cred : </td>
             <td class="tnormalbn"><strong><?=$sUser['max_crd']?>      
               cr&eacute;ditos</strong></td>
           </tr>
           <tr>
             <td align="right" class="tnormalbn">&nbsp;</td>
             <td class="tnormalbn">&nbsp;</td>
             <td class="tnormalbn">Escogidos : </td>
             <td class="tnormalbn"><input name="txtCantidad" type="text" class="texto" id="txtCantidad2" value="<?=$sUser['crd_ini']?>" size="2" maxlength="2">
      Cr&eacute;ditos</td>
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
     <? if(!empty($aCurdes))  {?>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Cursos Desaprobados obligatorios a matricularse </td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="580" border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows">
           <tr class="cabecera">
             <td width="20" scope="col">&nbsp;</td>
             <td width="45" scope="col">C&oacute;d.</td>
             <td scope="col">Curso</td>
             <td width="60" scope="col">Sem.</td>
             <td width="60" scope="col">Mod.</td>
             <td width="80" scope="col">Grupo</td>
             <td width="30" scope="col">Cred.</td>
           </tr>
           <? 	$vCont = 1;	foreach($aCurdes as $vCod_cur => $bCod_cur) { ?>
           <tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
             <td>
			 <? if(!$bCod_cur) 	{	?>
				 <input name="rCurdes[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)">
			 <? 	}	?>
			 </td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['cod_cat']?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sModmat[$sCurmat[$vCod_cur]['mod_mat']]))?></td>
             <td class="tnormalbn"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>" class="ocombo" >
                 <?=fviewgrupo('01')?>
             </select></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
     <? } ?>
     <? if(!empty($aCurobli)) {?>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Cursos Obligatorios</td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="580" border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows">
           <tr class="cabecera">
             <td width="20" scope="col">&nbsp;</td>
             <td width="45" scope="col">C&oacute;d.</td>
             <td scope="col">Curso</td>
             <td width="60" scope="col">Sem.</td>
             <td width="60" scope="col">Mod.</td>
             <td width="80" scope="col">Grupo</td>
             <td width="30" scope="col">Cred.</td>
           </tr>
           <? 	$vCont = 1;	foreach($aCurobli as $vCod_cur => $bCod_cur) { ?>
           <tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
             <td><input name="rCurobli[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)"></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['cod_cat']?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
             <td class="tnormalbn">&nbsp;Regular</td>
             <td class="tnormalbn"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>" class="ocombo" >
                 <?=fviewgrupo('01')?>
             </select></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
     <? } ?>
     <? if(!empty($aCuropta)) {?>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Cursos Optativos - Mensi&oacute;n :
           <?=$sEspecial[$sEstudia['pln_est'].$sEstudia['cod_esp']]['esp_nom']?></td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="580" border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows" class="tabled">
           <tr class="cabecera">
             <td width="20" scope="col">&nbsp;</td>
             <td width="45" scope="col">C&oacute;d.</td>
             <td scope="col">Curso</td>
             <td width="60" scope="col">Sem.</td>
             <td width="60" scope="col">Mod.</td>
             <td width="80" scope="col">Grupo</td>
             <td width="30" scope="col">Cred.</td>
           </tr>
           <? 	$vCont = 1;	foreach($aCuropta as $vCod_cur => $bCod_cur) { ?>
           <tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
             <td><input name="rCuropta[<?=$vCod_cur?>]" type="checkbox" class="check" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)"></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['cod_cat']?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
             <td class="tnormalbn">&nbsp;Regular</td>
             <td class="tnormalbn"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>"class="ocombo" >
                 <?=fviewgrupo('01')?>
             </select></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['crd_cur']?></td>
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
     <? } ?>
     <? if(!empty($aSemele)) { 	foreach($aSemele as $vSem_anu => $bSem_anu) {	?>
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb">Cursos Electivos - Semestre :
           <?=$sSemestre[$vSem_anu]?></td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="580" border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" rules="cols, rows" class="tabled">
           <tr class="cabecera">
             <th width="20" scope="col">&nbsp;</th>
             <th width="45" scope="col">C&oacute;d.</th>
             <th scope="col">Curso</th>
             <th width="60" scope="col">Sem.</th>
             <th width="60" scope="col">Mod.</th>
             <th width="80" scope="col">Grupo</th>
             <th width="30" scope="col">Cred.</th>
           </tr>
           <? 	$vCont = 1;	foreach($aCurele as $vCod_cur => $bCod_cur) 	{ 	if($sCurso[$vCod_cur]['sem_anu'] == $vSem_anu)	{?>
           <tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
             <td><input name="rCurele[<?=$vSem_anu?>]" type="radio" class="radio" value="<?=$vCod_cur?>" onClick="aumentar(this, <?=$sCurso[$vCod_cur]['crd_cur']?>)"></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['cod_cat']?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sCurso[$vCod_cur]['nom_cur']))?></td>
             <td class="tnormalbn">&nbsp;
                 <?=ucwords(strtolower($sSemestre[$sCurso[$vCod_cur]['sem_anu']]))?></td>
             <td class="tnormalbn">&nbsp;Regular</td>
             <td class="tnormalbn"><select name="rGrupo<?=$vCod_cur?>" id="rGrupo<?=$vCod_cur?>" class="ocombo" >
                 <?=fviewgrupo('01')?>
             </select></td>
             <td class="tnormalbn">&nbsp;
                 <?=$sCurso[$vCod_cur]['crd_cur']?></td>
           </tr>
           <? $vCont++; 	}	} 	?>
         </table></td>
         <td background="../../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
     </table>
     <? } 	}?>     
     <br>
     <input name="Submit" type="submit" class="oboton" value="Matricular">   
        </form></td>
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
