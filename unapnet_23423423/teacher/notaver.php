<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyds2())
		header("Location:../.");
		
	$vCod_car = $_GET['rCod_car'];	
	$vPln_est = $_GET['rPln_est'];
	$vCod_cur = $_GET['rCod_cur'];
	$vSec_gru = $_GET['rSec_gru'];
		
	$sUser['Notas'] = 'a';	
	
	$vHtml = "";
	$vTitle = "";
	$vBody = '';
	
	if(!empty($sCarrera[$vCod_car]))
	{
		$vHeader = array('N','N.M.', 'Apellidos y Nombres', "Examenes", 'Prácticas', 'Trabajos');
		$tEstucar = "car{$vCod_car}.estu{$vCod_car}";
		$tPlan = "car{$vCod_car}.plan{$vCod_car}";
		$tCurmat = "car{$vCod_car}.cm{$vCod_car}2004";
		$tCarga = "car{$vCod_car}.ca{$vCod_car}2004";
		$tNotaexa = "caw{$vCod_car}.ne{$vCod_car}2004";
		$tNotapra = "caw{$vCod_car}.np{$vCod_car}2004";
		$tNotatra = "caw{$vCod_car}.nt{$vCod_car}2004";
		
		$aNotaexa = '';
		$aNotapra = '';
		$aNotatra = '';
		
		$vRowexa = '';
		$vRowpra = '';
		$vRowtra = '';
		
		$vOrd_exa = 0;
		$vOrd_pra = 0;
		$vOrd_tra = 0;
		
		$vCont = 1;
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
				
		$vQuery = "Select nom_cur from $tPlan where pln_est = '$vPln_est' and cod_cur = '$vCod_cur'";
		$cPlan = $xSerdata->query($vQuery);
		if($aPlan = $cPlan->fetch_array())
			$vNom_cur = $aPlan['nom_cur'];
		else
			header("Location:notas.php");
		$cPlan->close();
		
		$vQuery = "Select cod_cur from $tCarga where pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "cod_prf like '%{$sUser['codigo']}' and per_aca = '02' and sec_gru = '$vSec_gru'";
		$cCarga = $xSerdata->query($vQuery);
		if($aCarga = $cCarga->fetch_array())
			$vCod_cur = ucwords(strtolower($aCarga['cod_cur']));
		else
			header("Location:notas.php");
		$cCarga->close();
		
				
		$vTitle = "Notas del semestre del Curso: $vNom_cur";
		
		$vQuery = "Select max(ord_not) as ord_not  from $tNotaexa where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$vOrd_exa = $aNota['ord_not'];
		$cNota->close();
		$vQuery = "Select num_mat, ord_not, not_ept  from $tNotaexa where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$aNotaexa[$aNota['num_mat']][$aNota['ord_not']] = $aNota['not_ept'];
		$cNota->close();
		
		$vQuery = "Select max(ord_not) as ord_not  from $tNotapra where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$vOrd_pra = $aNota['ord_not'];
		$cNota->close();
		$vQuery = "Select num_mat, ord_not, not_ept  from $tNotapra where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$aNotapra[$aNota['num_mat']][$aNota['ord_not']] = $aNota['not_ept'];
		$cNota->close();
		
		$vQuery = "Select max(ord_not) as ord_not  from $tNotatra where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$vOrd_tra = $aNota['ord_not'];
		$cNota->close();
		$vQuery = "Select num_mat, ord_not, not_ept  from $tNotatra where pln_est = '{$vPln_est}' and cod_cur = '{$vCod_cur}' and per_aca = '02' ";
		$cNota = $xSerdata->query($vQuery);
		while($aNota = $cNota->fetch_array())
			$aNotatra[$aNota['num_mat']][$aNota['ord_not']] = $aNota['not_ept'];
		$cNota->close();

		$vBody[a] = array('', '', '', "<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=1' class='tmensajebn' title='Agregar nota de examen'>Agregar</a>", 
			"<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=2' class='tmensajebn' title='Agregar nota de práctica'>Agregar</a>",
			"<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=3' class='tmensajebn' title='Agregar nota de trabajo'>Agregar</a>");
		
		
		$vRowexa = '';
		$vRowpra = '';
		$vRowtra = '';
		$aRowexa = '';
		$aRowpra = '';
		$aRowtra = '';
		
		if($vOrd_exa > 0)
		{				
			for($vConota = 1; $vConota <= $vOrd_exa; $vConota++)
			{				
				$aRowexa[0][$vConota] = "<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=1&rOrd_not=$vConota' class='tmensajebn' title='Modificar nota de examen'>M</a>";
				//$aRowexa[1][$vConota] = "<span class='tmensajebn'>E<span>";
			}
			$vRowexa = ftablerow($aRowexa);
		}			
		if($vOrd_pra > 0)
		{				
			for($vConota = 1; $vConota <= $vOrd_pra; $vConota++)
			{				
				$aRowpra[0][$vConota] = "<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=2&rOrd_not=$vConota' class='tmensajebn' title='Modificar nota de práctica'>M</a>";
				//$aRowpra[1][$vConota] = "<span class='tmensajebn'>E<span>";
			}
			$vRowpra = ftablerow($aRowpra);
		}			
		if($vOrd_tra > 0)
		{				
			for($vConota = 1; $vConota <= $vOrd_tra; $vConota++)
			{				
				$aRowtra[0][$vConota] = "<a href='notadd.php?rCod_car=$vCod_car&rPln_est=$vPln_est&rCod_cur=$vCod_cur&rSec_gru=$vSec_gru&rTip_not=3&rOrd_not=$vConota' class='tmensajebn' title='Modificar nota de trabajo'>M</a>";
				//$aRowtra[1][$vConota] = "<span class='tmensajebn'>E<span>";
			}
			$vRowtra = ftablerow($aRowtra);
		}					
		$vBody[b] = array('', '', '', $vRowexa, $vRowpra, $vRowtra);
				
				
		$vQuery = "Select $tCurmat.num_mat, $tEstucar.paterno, $tEstucar.materno, $tEstucar.nombres, $tCurmat.mod_mat ";
		$vQuery .= "from $tCurmat left join $tEstucar on $tCurmat.num_mat = $tEstucar.num_mat ";
		$vQuery .= "where $tCurmat.pln_est = '$vPln_est' and $tCurmat.cod_cur = '$vCod_cur' and per_aca = '02' ";
		$vQuery .= "order by paterno, materno, nombres";
		
		$cEstumat = $xSerdata->query($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vRowexa = '';
			$vRowpra = '';
			$vRowtra = '';
			$aRowexa = '';
			$aRowpra = '';
			$aRowtra = '';

			if($vOrd_exa > 0)
			{				
				for($vConota = 1; $vConota <= $vOrd_exa; $vConota++)
				{
					if($aNotaexa[$aEstumat['num_mat']][$vConota] > 10)
						$vNota = "<font color ='#0000FF'>{$aNotaexa[$aEstumat['num_mat']][$vConota]}</font>";
					else
						$vNota = "<font color ='#FF0000'>{$aNotaexa[$aEstumat['num_mat']][$vConota]}</font>";
					$aRowexa[0][$vConota] = $vNota;
				}
				$vRowexa = ftablerow($aRowexa);
			}			
			if($vOrd_pra > 0)
			{				
				for($vConota = 1; $vConota <= $vOrd_pra; $vConota++)
				{
					if($aNotapra[$aEstumat['num_mat']][$vConota] > 10)
						$vNota = "<font color ='#0000FF'>{$aNotapra[$aEstumat['num_mat']][$vConota]}</font>";
					else
						$vNota = "<font color ='#FF0000'>{$aNotapra[$aEstumat['num_mat']][$vConota]}</font>";
					$aRowpra[0][$vConota] = $vNota;
				}
				$vRowpra = ftablerow($aRowpra);
			}			
			if($vOrd_tra > 0)
			{				
				for($vConota = 1; $vConota <= $vOrd_tra; $vConota++)
				{
					if($aNotatra[$aEstumat['num_mat']][$vConota] > 10)
						$vNota = "<font color ='#0000FF'>{$aNotatra[$aEstumat['num_mat']][$vConota]}</font>";
					else
						$vNota = "<font color ='#FF0000'>{$aNotatra[$aEstumat['num_mat']][$vConota]}</font>";
					$aRowtra[0][$vConota] = $vNota;
				}
				$vRowtra = ftablerow($aRowtra);
			}			
			
			$vApe_nom = ucwords(strtolower("{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"));
			$vBody[$vCont] = array($vCont, $aEstumat['num_mat'], $vApe_nom, $vRowexa, $vRowpra, $vRowtra);
			$vCont++;
			
		}
		$cEstumat->close();
		$vMessage = ftablenota($vHeader, $vBody, 0);
		$vHtml .= fwindow($vTitle, $vMessage);						
		
		$xSerdata->close();	
	}
	else
	{
		header("Location:notas.php");
	}
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
   <td align="center" valign="top"><?=$vHtml?>    </td>
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
