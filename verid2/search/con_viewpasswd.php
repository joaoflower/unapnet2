<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	include "../include/funcoption.php";
	if(fsafetylogin())
	{
		$bDatos = FALSE;
		
		$vQuery = "Select do.cod_prf, do.paterno, do.materno, do.nombres, ca.car_des, do.passwd ";
		$vQuery .= "from docente do left join carrera ca on do.cod_car = ca.cod_car ";
		$vQuery .= "where do.cod_prf = '{$_POST['rCod_prf']}' and cnd_act = '1' ";
		
		$cResult = fQuery($vQuery);
		if($aResult = mysql_fetch_array($cResult))
		{
			$bDatos = TRUE;
		}

	}
	else
	{
		header("Location:../index.php");
	}
	
	if($bDatos == TRUE)
	{
?>
<center>

	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Datos del Docente Universitario</th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="1" bordercolor="#FF0000" class="tviewdata">
			  <tr>
				<td width="75">C&oacute;digo :</td>
				<th width="150"><?=$aResult['cod_prf']?></th>
				<td width="75">&nbsp;</td>
				<th width="150">&nbsp;</th>
			  </tr>
			  <tr>
				<td>Nombres :</td>
				<th colspan="3"><?=$aResult['paterno']?> <?=$aResult['materno']?>, <?=$aResult['nombres']?></th>
			  </tr>
			  <tr>
			    <td>Escuela Prof. : </td>
			    <th colspan="3"><?=$aResult['car_des']?></th>
		      </tr>
			  <tr>
			    <td>Contrase&ntilde;a :</td>
			    <th colspan="3" class="tviewdatapass"><?=$aResult['passwd']?></th>
		      </tr>
		  </table>
		
		</td>
		<td background="../images/ven_mediumright.jpg"></td>
	  </tr>
	  <tr>
		<td><img src="../images/ven_bottomleft.jpg" width="16" height="16" border="0" alt="" /></td>
		<td background="../images/ven_bottomcenter.jpg"></td>
		<td><img src="../images/ven_bottomright.jpg" width="16" height="16" border="0" alt="" /></td>
	  </tr>
	</table>
			
</center>
<?
	}
?>