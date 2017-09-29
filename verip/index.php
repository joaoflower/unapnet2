<?php
	session_start();
	session_register('ar_upasswd');
	session_register('ar_conex');
	session_register('ar_conedb');               
	session_register('ar_carrera');
        session_register('ar_UnapNet');

	$archivo="verilogin.php";
//        include '../include/function.php';
?>

<Html>
<Head>
<Title> Un@pNet - Internet System 2003</title>

<script language="JavaScript">
        function comprueba()
	{
		if(document.fLogin.rLogin.value.length < 5 )
		{
			alert("El Login tiene que tener al menos 5 caracteres ... !");
			document.fLogin.rLogin.focus();
			return false;
		}
		if(document.fLogin.rClave.value.length < 5 )
		{
			alert("La contraseña tiene que tener al menos 5 caracteres ... !");
			document.fLogin.rClave.focus();
			return false;
		}
		return true;
	}

</script>

</Head>

<body bgcolor="#333333" topmargin="0" leftmargin="0" background ='../images/fondo.gif'>
<center>
<Table BgColor ='#000000' Width ='250' Cellpadding ='1' Cellspacing ='0' Border ='0' style ='margin-top:5'>

        <Tr> <Td>
   	        <Table Width ='100%' Bgcolor ='#F0F0F0' Cellpadding ='2' Cellspacing ='0' >
                        <Tr> <Td align = 'Center' Bgcolor = '#FFFFFF' >
				<img src ="../images/logoun.jpg" border ="0" alt = "Centro de Tecnología Informática" width="250" height="50">
                        </Td> </Tr>
                        <Tr> <Td align ='Center' Bgcolor ='#DBEAF5' ><B>
                                <Font  Size = '6' Color = #111155>Intr@net </font> </B> <Br>
                                <span class ='txlargebb'>Password System 2003 </span> <Br>
                                <span class ='tmensajebn'> <?=$ar_upasswd['Mensaje']?> <?=$ar_uinter['Mensaje'] = "";?>  </span>
                        </Td></Tr>
                        <Tr> <Td >
                                <table border="0" cellpadding ='1' cellspacing ='0' width ='100%' bgcolor="#F0F0F0" class ='tnormalbn' >
                                <form method="post" Action ="<?=$archivo.'?'.SID?>" name ='fLogin' target ='_top'>
                                        <Tr>
                                                <Td align ='right'> Usuario : </Td>
                                                <Td> <Input type ="text" size="15" class ='tnormalbn' MaxLength = "20" name="rLogin" value = "<?=$ar_uinter['Login']?>"> </Td>
                                        </Tr>
                                        <Tr>
                                                <Td Align = 'right'> Contrase&ntilde;a : </Td>
                                                <Td > <Input type ="password" size="15" class ='tnormalbn' name ="rClave" MaxLength ="25" ></Td>
                                        </Tr>
                                        </form>
                                        <Tr> <Td Colspan = "2" align ='center'>
                                                <input type="submit" value ="Ingresar" width="72" onClick = "if(comprueba()){ document.fLogin.submit();}  return false">
                                        </Tr>

                                </table>
                        </Td></Tr>
                </Table>
        </Td></Tr>
</Table>
</center>


</body></html>

