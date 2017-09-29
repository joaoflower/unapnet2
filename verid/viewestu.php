<?php
	session_start();

        if ($ar_upasswd['Safety'] != "1236") header("Location:.");
?>
<Html>
<Head>
<Title> Un@pNet - Internet System 2003 </TITLE>
<!--<Meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=0)">-->
<link href ="../style/unapnet.css" type=text/css rel ='stylesheet'>

<script language="JavaScript">

</script>



</Head>

<Body topmargin="0" marginheight="0" bgcolor="#333333" leftmargin="0" rightmargin="0" background ='../images/fondo.gif' >

<table width="750" height = "100%" border="0" cellpadding="0" cellspacing="0" background='../images/fondo.jpg' style ='margin-left:5'>
	<tr> <td valign = "top">
                <Center>
				
				<?php
					$conexion = mysql_connect($ar_conex['host'], $ar_conex['user'], $ar_conex['passwd']);
					$consulta = "select * from unapnet.docente where cod_prf = '" .$rNum_Mat. "' ";
					$cr_unap = mysql_query($consulta, $conexion);

					while($ar_Alumno = mysql_fetch_array($cr_unap))
					{
							
						?>
						
						<Table cellpadding ='1' cellspacing ='0' border ='0' width ="500" style="margin-top:5">
                        <Tr> <Td bgcolor ="#DBEAF5" class ='tlargebb' align ='center'>Un@pNet - Datos de Docente </Td> 
                        </Tr>
                        <Tr> <Td bgcolor ="#DBEAF5">

                                <table border ='0' cellpadding ='1' cellspacing="0" width = "100%" bgcolor ="#F0F0F0" class ='tnormalbn'>

                                        <tr>
                                                <td align="center" Width ="" rowspan ='6' >

                                                </td>

                                                <td align ="right" Width ="" > C&oacute;digo de docente :: </td>
                                                <td class ='tnormalbb' > <B> <?=$ar_Alumno['cod_prf']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Apellidos : </td>
                                                <td> <B> <?=$ar_Alumno['paterno']?> <?=$ar_Alumno['materno']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Nombre(s) : </td>
                                                <td> <B> <?=$ar_Alumno['nombres']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Carrera Profesional : </td>
                                                <td> <B> <?=$ar_carrera[$ar_Alumno['cod_car']]?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Contrase&ntilde;a : </td>
                                                <td > <font size = '5' face ='TimeNewRoman' ><B> <?=$ar_Alumno['passwd']?> </B></font></td>
                                        </tr>
										<tr>
                                                <td align="right">&nbsp;  </td>
                                                <td class ='txlargebb'>&nbsp;  </td>
                                        </tr>
                                </table>

                        </Td> </Tr>
                </Table>
						
						<?
							
/*							$ar_Alumno['Num_Mat'] = $ar_unap['num_mat'];
							$ar_Alumno['Paterno'] = ucwords(strtolower($ar_unap['paterno']));
							$ar_Alumno['Materno'] = ucwords(strtolower($ar_unap['materno']));
							$ar_Alumno['Nombres'] = ucwords(strtolower($ar_unap['nombres']));
							$ar_Alumno['Passwd'] = $ar_unap['passwd'];
							$ar_Alumno['Car_Des'] = ucwords(strtolower($ar_carrera[$ar_unap['cod_car']]));*/
					}
/*					else
					{

							$ar_Alumno['num_mat'] = $rNum_Mat;
							$ar_Alumno['paterno'] = 'EL NUM. MATRICULA';
							$ar_Alumno['materno'] = 'NO EXISTE ';
							$ar_Alumno['nombres'] = 'EN LA BASE DE DATOS';
							$ar_Alumno['passwd'] = 'x00xxxxxx000000';
							$ar_Alumno['car_des'] = 'REINTENTE DE NUEVO';
							
							?>
							
							<Table cellpadding ='1' cellspacing ='0' border ='0' width ="500" style="margin-top:5">
                        <Tr> <Td bgcolor ="#DBEAF5" class ='tlargebb' align ='center'>Un@pNet - Datos de Estudiante </Td> </Tr>
                        <Tr> <Td bgcolor ="#DBEAF5">

                                <table border ='0' cellpadding ='1' cellspacing="0" width = "100%" bgcolor ="#F0F0F0" class ='tnormalbn'>

                                        <tr>
                                                <td align="center" Width ="" rowspan ='6' >

                                                </td>

                                                <td align ="right" Width ="" > N&uacute;mero de matr&iacute;cula : </td>
                                                <td class ='tnormalbb' > <B> <?=$ar_Alumno['num_mat']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Apellidos : </td>
                                                <td> <B> <?=$ar_Alumno['paterno']?> <?=$ar_Alumno['materno']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Nombre(s) : </td>
                                                <td> <B> <?=$ar_Alumno['nombres']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Carrera Profesional : </td>
                                                <td> <B> <?=$ar_Alumno['car_des']?> </B> </td>
                                        </tr>
                                        <tr>
                                                <td align="right"> Contrase&ntilde;a : </td>
                                                <td > <font size = '5' face ='TimeNewRoman' ><B> <?=$ar_Alumno['passwd']?> </B></font></td>
                                        </tr>
										<tr>
                                                <td align="right">&nbsp;  </td>
                                                <td class ='txlargebb'>&nbsp;  </td>
                                        </tr>
                                </table>

                        </Td> </Tr>
                </Table>
							
							<?
					}*/

					mysql_close($conexion);

					?>
				
                
                </Center>
	</Td></tr>
	</table>

</Body>
</Html>
