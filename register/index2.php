<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";
	$sReguser['safetyd'] = '';
	$sReguser['safetyv'] = '';
	$vFile ="verify.php";

//	$xSerunap = new mysqli($sConeun['host'], $sConeun['user'], $sConeun['passwd']);
//	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
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
   	function verify()
	{
		var Continuar = 1;
		var jj = 0;
		var ch = '8';

		for (jj = 0; jj < document.fUniver.rCodigo.value.length; jj++)
		{
			ch = document.fUniver.rCodigo.value.substring (jj, jj + 1);
			if ( !(ch >= "0" && ch <= "9"))
				Continuar = 0;
		}
		if(!Continuar)
		{
			alert("El Código debe ser numérico ... !");
			document.fUniver.rCodigo.value = "";
			document.fUniver.rCodigo.focus();
			return false;
       	}
		if(document.fUniver.rCodigo.value.length < 4 )
		{
			alert("El Código debe de tener al menos 4 caracters ... !");
			document.fUniver.rCodigo.focus();
			return false;
		}
        if(document.fUniver.rPasswd.value.length < 5 )
		{
			alert("La Contraseña debe de tener al menos 5 caracters ... !");
			document.fUniver.rPasswd.focus();
			return false;
		}
		return true;
	}
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
   <td width="575" align="center" valign="top"><form action="<?=$vFile.'?'.SID?>" method="post" name="fUniver" id="fUniver">
     <table border="0" cellpadding="0" cellspacing="0">
       <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
       <tr>
         <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
         <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb"> <strong>Un@p.Net2&reg; : </strong> Registro de nuevo Usuario </td>
         <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
       </tr>
       <tr>
         <td background="../images/ventana_r2_c1.jpg"></td>
         <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"> En esta secci&oacute;n se realizara la verificaci&oacute;n y validaci&oacute;n de los datos, en ella tiene que ingresar la informaci&oacute;n que se le solicita, esto para comprobar que usted es Docente o Estudiante de la UNA-PUNO; en el item <strong>Contrase&ntilde;a</strong>, los docentes deben de ingresar su n&uacute;mero de documento y en el caso de los estudiantes deben de apersonese al Centro de Tecnolog&iacute;a Inform&aacute;tica para recabar su Contrase&ntilde;a del CTI, con sus respectivos documentos personlaes, esto como medida de seguridad. <br>
           <hr noshade>              <div align="right">(Los campos marca con <span class ='timporbb'>#</span> son olbligatorios)<br>         
           </div></td>
         <td background="../images/ventana_r2_c4.jpg"></td>
       </tr>
       <tr>
         <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
         <td background="../images/ventana_r4_c2.jpg"></td>
         <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
       </tr>
     </table> <? if($sReguser['error']) fmsnerror($sReguser['msnerror']); $sReguser['error'] = FALSE  ?>
      <table border="0" cellpadding="0" cellspacing="0">
        <!-- fwtable fwsrc="ventana.png" fwbase="ventana.jpg" fwstyle="Dreamweaver" fwdocid = "322746639" fwnested="0" -->
        <tr>
          <td><img name="ventana_r1_c1" src="../images/ventana_r1_c1.jpg" width="12" height="29" border="0" alt=""></td>
          <td align="center" background="../images/ventana_r1_c2.jpg" class="tlargebb">Datos Universitarios <br>
          </td>
          <td><img name="ventana_r1_c4" src="../images/ventana_r1_c4.jpg" width="11" height="29" border="0" alt=""></td>
        </tr>
        <tr>
          <td background="../images/ventana_r2_c1.jpg"></td>
          <td background="../images/ventana_r2_c2.jpg" class="tnormalbn"><table width="450" border="0" cellpadding="0" cellspacing="0" class="tnormalbn">
              <tr>
                <td width="130" align="right"><span class ='timporbb'>#</span> C&oacute;digo :</td>
                <td width="320"><input name="rCodigo" type="text" class="otexto" id="rCodigo" value="<?=$sReguser['codigo']?>" size="10" maxlength="10">
            (N&uacute;meros) </td>
              </tr>
              <tr>
                <td align="right"><span class ='timporbb'>#</span> Escuela Profesional :</td>
                <td><select name="rCod_Car" class="ocombo" >
					<?=fviewcar($sReguser['cod_car'])?>
                </select></td>
              </tr>
              <tr>
                <td align="right"><span class ='timporbb'>#</span> Contrase&ntilde;a : </td>
                <td><input name="rPasswd" type="password" class="otexto" size="15" maxlength="15">
            (Min&uacute;sculas / N&uacute;meros) </td>
              </tr>
              <tr align="center">
                <td colspan="2"><input name="Submit" type="submit" class="oboton" value="Verificar" onClick = "if(verify()){ document.fUniver.submit();} return false"></td>
              </tr>
          </table></td>
          <td background="../images/ventana_r2_c4.jpg"></td>
        </tr>
        <tr>
          <td><img name="ventana_r4_c1" src="../images/ventana_r4_c1.jpg" width="12" height="10" border="0" alt=""></td>
          <td background="../images/ventana_r4_c2.jpg"></td>
          <td><img name="ventana_r4_c4" src="../images/ventana_r4_c4.jpg" width="11" height="10" border="0" alt=""></td>
        </tr>
      </table>
   </form>    </td>
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
//	$xSerunap->close();
//	$xSerdata->close();
?>