<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";
	include "../include/funcunap.php";
	$vFile ="ubigeo.php";
	if(!fverifyrd())
		header("Location:.");
		
	if (!empty($_POST['rCod_dep'])) $sReguser['cod_dep'] = $_POST['rCod_dep'];
	if (!empty($_POST['rCod_prv'])) $sReguser['cod_prv'] = $_POST['rCod_prv'];
	if (!empty($_POST['rCod_dis'])) $sReguser['cod_dis'] = $_POST['rCod_dis'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/unapnet.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function scriptUbigeo(){
		document.frmLibUbigeo.submit();	
}
</script>
<style type="text/css">
<!--
body {
	background-image: url(../images/ventana_r2_c2.jpg);
}
-->
</style></head>
<body marginwidth=0 marginheight=0 topmargin=0 leftmargin=0 >


<table  border="0" cellpadding="0" cellspacing="0"  width="500"   background="../images/ventana_r2_c2.jpg" class="tnormalbn"> 
<form action="<?=$vFile.'?'.SID?>" method="post" name="frmLibUbigeo">
                      <!--DWLayoutTable-->
	<tr> 
   	  <td width="150" align="right"><span class ='timporbb'>#</span> Departamento de proc. :</td>
		<td width="350"><select name="rCod_dep" id="rCod_dep" onChange="scriptUbigeo();" class="ocombo">
        	<?=fviewdep($sReguser['cod_dep'])?>
	    </select></td>
	</tr>
    <tr> 
    	<td align="right"><span class ='timporbb'>#</span> Provincia de procedencia :</td>
		<td ><select name="rCod_prv" id="rCod_prv" onChange="scriptUbigeo();" class="ocombo">
        	<?=fviewprv($sReguser['cod_dep'], $sReguser['cod_prv'])?>
      	</select></td>
	</tr>
    <tr> 
    	<td align="right"><span class ='timporbb'>#</span> Distrito de procedencia :</td>
		<td><select name="rCod_dis" id="rCod_dis" class="ocombo">
			<?=fviewdis($sReguser['cod_dep'], $sReguser['cod_prv'], $sReguser['cod_dis'])?>
      	</select></td>
	</tr>
	</form>
</table>
</body>
</html>
