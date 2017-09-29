<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyds2())
		header("Location:../.");
	
	//-------------------------------------------------------
	$vSendData = $_GET['rSendData'];
	$rCod_car = substr($vSendData, 20, 4);
	$rPln_est = substr($vSendData, 44, 4);
	$rCod_cur = substr($vSendData, 68, 6);
	$rSec_gru = substr($vSendData, 94, 4);
	$rMod_mat = substr($vSendData, 118, 4);

	$vQuery = "Select 0x$rCod_car as cod_car, 0x$rPln_est as pln_est, 0x$rCod_cur as cod_cur, 0x$rSec_gru as sec_gru, ";
	$vQuery .= "0x$rMod_mat as mod_mat ";
	$cDatos = fQuery($vQuery);
	if($aDatos = mysql_fetch_array($cDatos))
	{
		$vCod_car = $aDatos['cod_car'];
		$vPln_est = $aDatos['pln_est'];
		$vCod_cur = $aDatos['cod_cur'];	
		$vSec_gru = $aDatos['sec_gru'];
		$vMod_mat = $aDatos['mod_mat'];
	}

	if(!empty($sCarrera[$vCod_car]))
	{
		$vCont = 0;
		$tCurmat = "unapnet.curmat{$vCod_car}{$sUser['ano_aca']}";
		$tApla = "unapnet.apla{$sUser['ano_aca']}";

		$sUser['cod_car_cur'] = $vCod_car;
		$sEspecial = "";

		$vQuery = "Select cu.nom_cur, cu.niv_est, cu.sem_anu, cu.crd_cur, cu.cod_esp, es.esp_nom ";
		$vQuery .= "from unapnet.curso cu left join unapnet.especial es on cu.cod_esp = es.cod_esp and ";
		$vQuery .= "cu.pln_est = es.pln_est and cu.cod_car = es.cod_car ";
		$vQuery .= "where cu.cod_car = '$vCod_car' and  cu.pln_est = '$vPln_est' and cu.cod_cur = '$vCod_cur'";
		$cCurso = fQuery($vQuery);
		if($aCurso = mysql_fetch_array($cCurso))
		{
			$sUser['nom_cur'] = $aCurso['nom_cur'];
			$sUser['niv_est'] = strtoupper($sNivel[$aCurso['niv_est']]);
			$sUser['sem_anu'] = strtoupper($sSemestre[$aCurso['sem_anu']]);
			$sUser['crd_cur'] = $aCurso['crd_cur'];
			$sUser['cod_esp'] = strtoupper($aCurso['esp_nom']);			
			$sUser['sec_gru'] = strtoupper($sGrupo[$vSec_gru]);
			$sUser['mod_mat'] = strtoupper($sModnot[$vMod_mat]);
			
		}
		else
			header("Location:listados.php");
		
		if($vMod_mat == '02' or $vMod_mat == '08')
		{
			$vQuery = "Select es.num_mat, es.paterno, es.materno, es.nombres, ap.mod_mat ";
			$vQuery .= "from $tApla ap left join unapnet.estudiante es on ap.num_mat = es.num_mat and ap.cod_car = es.cod_car ";
			$vQuery .= "where ap.cod_car  = '$vCod_car' and ap.per_aca = '{$sUser['per_aca']}' and ap.pln_est = '$vPln_est' and ";
			$vQuery .= "ap.cod_cur = '$vCod_cur' and ap.sec_gru = '$vSec_gru' and ap.mod_mat = '$vMod_mat' ";
			$vQuery .= "order by paterno, materno, nombres ";
		}
		else
		{
			$vQuery = "Select es.num_mat, es.paterno, es.materno, es.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante es on cm.num_mat = es.num_mat and cm.cod_car = es.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '$vPln_est' and cm.cod_cur = '$vCod_cur' and cm.sec_gru = '$vSec_gru' and ";
			$vQuery .= "cm.per_aca = '{$sUser['per_aca']}' and mm.mod_act = '$vMod_mat' ";
			$vQuery .= "order by paterno, materno, nombres ";
		}
		$cEstumat = fQuery($vQuery);
		$sEstupdf = "";
		
	}
	else
	{
		header("Location:listados.php");
	}
	//-----------------------------------------------------------------------
/*	$vCod_car = $_GET['rCod_car'];
	$vPln_est = $_GET['rPln_est'];
	$vCod_cur = $_GET['rCod_cur'];	
	$vSec_gru = $_GET['rSec_gru'];
		
	$vHtml = "";
	$vTitle = "";
	$vBody = '';
	$sEstupdf = '';
	
	if(!empty($sCarrera[$vCod_car]))
	{
		$vHeader = array('Nro','Num.Mat.', 'Apellidos y Nombres', 'Modalidad');
		$tEstucar = "car{$vCod_car}.estu{$vCod_car}";
		$tPlan = "car{$vCod_car}.plan{$vCod_car}";
		$tCurmat = "car{$vCod_car}.cm{$vCod_car}2004";
		$tCarga = "car{$vCod_car}.ca{$vCod_car}2004";
		
		$vCont = 1;
		$vConp = 0;
		$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
				
		$vQuery = "Select nom_cur, niv_est, sem_anu, crd_cur, cod_esp from $tPlan where pln_est = '$vPln_est' and cod_cur = '$vCod_cur'";
		$cPlan = $xSerdata->query($vQuery);
		if($aPlan = $cPlan->fetch_array())
		{
			$sUser['nom_cur'] = $aPlan['nom_cur'];
			$sUser['niv_est'] = strtoupper($sNivel[$aPlan['niv_est']]);
			$sUser['sem_anu'] = strtoupper($sSemestre[$aPlan['sem_anu']]);
			$sUser['crd_cur'] = $aPlan['crd_cur'];
			$sUser['cod_esp'] = strtoupper($sEspecial[$aPlan['cod_esp']]);
			$vNom_cur = $aPlan['nom_cur'];
		}
		else
			header("Location:listados.php");
		$cPlan->close();
		
		$vQuery = "Select cod_cur from $tCarga where pln_est = '$vPln_est' and cod_cur = '$vCod_cur' and ";
		$vQuery .= "cod_prf like '%{$sUser['codigo']}' and per_aca = '02' and sec_gru = '$vSec_gru'";
		$cCarga = $xSerdata->query($vQuery);
		if($aCarga = $cCarga->fetch_array())
			$vCod_cur = ucwords(strtolower($aCarga['cod_cur']));
		else
			header("Location:listados.php");
		$cCarga->close();
		
		$vTitle = "Listado del Curso: $vNom_cur";
		
		$vQuery = "Select $tCurmat.num_mat, $tEstucar.paterno, $tEstucar.materno, $tEstucar.nombres, $tCurmat.mod_mat ";
		$vQuery .= "from $tCurmat left join $tEstucar on $tCurmat.num_mat = $tEstucar.num_mat ";
		$vQuery .= "where $tCurmat.pln_est = '$vPln_est' and $tCurmat.cod_cur = '$vCod_cur' and per_aca = '02' ";
		$vQuery .= "order by paterno, materno, nombres";

		$cEstumat = $xSerdata->query($vQuery);
		while($aEstumat = $cEstumat->fetch_array())
		{
			$vApe_nom = ucwords(strtolower("{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"));
			$vBody[$vCont] = array($vCont, $aEstumat['num_mat'], $vApe_nom, $sModmat[$aEstumat['mod_mat']]);
			$vCont++;
			
			$sEstupdf[$vConp]['num_est'] = $vConp + 1;
			$sEstupdf[$vConp]['num_mat'] = $aEstumat['num_mat'];
			$sEstupdf[$vConp]['nombre'] = strtoupper($vApe_nom);
			$sEstupdf[$vConp]['mod_mat'] = strtoupper($sModmat[$aEstumat['mod_mat']]);
						
			$vConp++;
		}
		$cEstumat->close();
		$vMessage = ftabledata($vHeader, $vBody, 0);
		$vHtml .= fwindow($vTitle, $vMessage);						
		
		$xSerdata->close();	
	}
	else
	{
		header("Location:listados.php");
	}*/
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
   <td align="center" valign="top"><span class="celdapar"><table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../../images/ventana_r1_c2.jpg" class="tlargebb"><strong>Listado del curso de: <?=$sUser['nom_cur']?></strong></td>
         <td><img name="ventana_r1_c4" src="../../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../../images/ventana_r2_c1.jpg"></td>
         <td align="center" background="../../images/ventana_r2_c2.jpg" class="tnormalbn"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" class="tnormalbn">
             <tr align="center" class="cabecera">
               <td>&nbsp;N&deg;&nbsp;</td>
               <td>&nbsp;N&deg;Mat&nbsp;</td>
               <td>&nbsp;Apellidos y Nombres &nbsp;</td>
               <td>&nbsp;Mod.Mat.&nbsp;</td>
              </tr>
			<? 	
				while($aEstumat = mysql_fetch_array($cEstumat))
				{
					$vApe_nom = ucwords(strtolower("{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"));					
					
					$sEstupdf[$vCont]['num_est'] = $vCont + 1;
					$sEstupdf[$vCont]['num_mat'] = $aEstumat['num_mat'];
					$sEstupdf[$vCont]['nombre'] = strtoupper($vApe_nom);
					$sEstupdf[$vCont]['mod_mat'] = strtoupper($sModmat[$aEstumat['mod_mat']]);					
					$vCont++;	
			?>
             <tr <? if($vCont % 2 == 0) echo "class=\"celdapar\""; else echo "class=\"celdainpar\"";?>>
               <td align="right">&nbsp;<?=$vCont?>&nbsp;</td>
               <td>&nbsp;<?=$aEstumat['num_mat']?> &nbsp;</a></td>
               <td>&nbsp;<?=$vApe_nom?>&nbsp;</td>
               <td>&nbsp;<?=(($vMod_mat == '02' or $vMod_mat == '08')?$sModnot[$aEstumat['mod_mat']]:$sModmat[$aEstumat['mod_mat']])?>&nbsp;</td>
              </tr>
			<?	}	?>
           </table>
             <table border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
           </table></td>
         <td background="../../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
    </table>
   <a href="prnlistax.php" title="Exportar Excel">Exportar Excel </a></span></td>
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
