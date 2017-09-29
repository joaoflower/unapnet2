<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";
	if(!fverifyrf())
		header("Location:.");
?>

<html>
<head>
<title>Un@p.Net2&reg; - Registro de Nuevo usuario : La forma mas comoda de acceder a la informaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--Fireworks MX 2004 Dreamweaver MX 2004 target.  Created Wed Jan 05 14:46:25 GMT-0500 2005-->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script language="JavaScript">
   window.moveTo(0,0);
</script>
<link href="../css/unapnet.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="600">
<!-- fwtable fwsrc="ventana2.png" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->

  <tr>
   <td colspan="3"><img name="index_r1_c1" src="images/index_r1_c1.jpg" width="600" height="64" border="0" alt=""></td>
  </tr>
  <tr>
   <td valign="top" background="images/index_r4_c1.jpg"><table border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="12"><img src="images/index_r3_c1.jpg" width="12" height="297"></td>
     </tr>
   </table>
     <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td background="images/index_r4_c1.jpg">&nbsp;</td>
       </tr>
    </table></td>
   <td width="575" align="center" valign="top">      <table border="0" cellpadding="0" cellspacing="0">
     <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
     <tr>
       <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
       <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">Bienvenido a Un@p.Net2&reg; <br>       </td>
       <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
     </tr>
     <tr>
       <td background="../images/ventana_r2_c1.jpg"></td>
       <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="450" border="0" cellpadding="0" cellspacing="1" class="tnormalbn">
           <tr>
             <td colspan="2">Usted ya es usuario de Un@pNet, cuenta con varios servicios, <Br>
            <hr noshade>
             </td>
           </tr>
           <tr>
             <td width="150" align="right"> C&oacute;digo :</td>
             <td width="300"><strong><?=$sReguser['codigo']?></strong></td>
           </tr>
           <tr>
             <td align="right"> Apellidos y Nombres :</td>
             <td><strong><?=$sReguser['paterno']?> <?=$sReguser['materno']?>, <?=$sReguser['nombres']?></strong></td>
           </tr>
           <tr>
             <td align="right"> Carrera Profesional : </td>
             <td><strong><?=$sCarrera[$sReguser['cod_car']]?> </strong></td>
           </tr>
		   <tr>
             <td align="right"> Tipo de usuario : </td>
             <td><strong><?=$sTipousu[$sReguser['tip_usu']]?> </strong></td>
           </tr>
           <tr>
             <td align="right">Usuario : </td>
             <td><strong><?=$sReguser['login']?></strong></td>
           </tr>
           <tr>
             <td align="right">E-mail : </td>
             <td><strong><?=$sReguser['login']?>@unap.edu.pe</strong></td>
           </tr>
           <tr align="center">
             <td colspan="2"><input name="Submit" type="submit" class="oboton" value="Cerrar" onClick="window.close();"></td>
             </tr>
       </table></td>
       <td background="../images/ventana_r2_c4.jpg"></td>
     </tr>
     <tr>
       <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
       <td background="../images/ventana_r4_c2.jpg"></td>
       <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
     </tr>
   </table></td>
   <td valign="top" background="images/index_r4_c3.jpg"><table border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><img src="images/index_r3_c3.jpg" width="13" height="297"></td>
     </tr>
   </table>
     <table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
       <tr>
         <td background="images/index_r4_c3.jpg">&nbsp;</td>
       </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="3"><img name="index_r5_c1" src="images/index_r5_c1.jpg" width="600" height="28" border="0" alt=""></td>
  </tr>
</table>
</body>
</html>
<?php
	session_start();
	unset($sReguser);
	unset($sConeun);
	unset($sConedb);
	unset($sCarrera);
	unset($sDocumen);
	unset($sSexo);
	unset($sMes);
	unset($sEcivil);
	session_destroy();
?>