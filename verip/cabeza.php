<?php
	session_start();
//        include "../include/function.php";
        if ($ar_upasswd['Safety'] != "1236") header("Location:.");
        $vArchivo="viewestu.php";
?>
<Html>
<Head>
<Title> Un@pNet - Password System 2003 </TITLE>
<!--<Meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=0)">-->
<Link href ='../style/unapnet.css' rel ='stylesheet'>

<script language="JavaScript">

</script>

</Head>

<body bgcolor="#333333" topmargin="0" leftmargin="0" link = '#FFFFFF' vlink = '#FFFFFF' alink = '#04134D' background ='../images/fondo.gif'>

<table width="750" border='0' cellpadding="0" cellspacing="0" background='../images/fondo.jpg' style="margin-left:5;margin-top:5">
	<tr>
		<td bgcolor="#FFFFFF">
		<table width="100%" border ='0' cellspacing="0" cellpadding="0">
			<tr>
				<td width="210" height="40" rowspan='2'><img src="../images/logoun.jpg" width="200" height="40" alt = "Centro de Tecnología Informática"></td>
				<td width="420" height="20" align="left" valign="middle"  class ='tnormalbb'>
					BIENVENIDO : Administrador Password System
				</td>
				<td width="120" align="right" valign="middle">
                                        <?php
                                                $vMenu['Title'] = "Cerrar Sesi&oacute;n Actual";
                                                $vMenu['Href'] = "cerrarsesion.php?".SID;
                                                $vMenu['Item'] = "Cerrar Sesi&oacute;n";
                                                //fMenu($vMenu, '2', '_top');
                                        ?>
				</Td>
			</tr>
                        <tr>
                                <td width=""  align="left" valign="middle" colspan ='2' >
                                <Table width="100%" height ='20' border='0' cellspacing="0" cellpadding="0">
                                        <Tr>
                                                <td width="350" align="left" valign="middle" class ='tnormalbn'>
                                                        <Table border ='0' cellspacing ="0" cellpadding ="0">
                                                        <Form Method ='POST' Action ="<?=$vArchivo.'?'.SID?>" Name ='fbuscar' Target ="conten" >
                                                                <Tr class ='tnormalbn'>
                                                                        <Td> N&uacute;m. de matr&iacute;cula: &nbsp;</Td>
                                                                        <Td> <Input Type ='text' Name ='rNum_Mat' class ='tnormalbn' size ='6' Maxlength ='6'>&nbsp;</Td>
                                                                        <Td> <Input Type ="submit" class ='tnormalbn' value ='Buscar'> </Td>
                                                                </Tr>
                                                        </FORM>
                                                        </Table>
				                </td>
                                                <td width="190" align="right" valign="middle" background ='../images/fondo.jpg' class ='tnormalwn'>
                                                        <?fViewDate();?> &nbsp;
				                </Td>
                                        </Tr>
				</font></td>
                                </Table>
                        </tr>
		</table>
		</Td>
	</tr>
</table>

</Body>
</Html>


