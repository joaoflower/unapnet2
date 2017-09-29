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
	if(fsafetylogin())
	{
		$vCont = 1;
	}
	else
	{
		header("Location:../index.php");
	}
	
?>
<center>
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Carga Acad&eacute;mica </th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tlistsearch">
				<tr>
				  <th width="10">&nbsp;</th>
				  <th width="80">C&oacute;digo</th>
				  <th width="120">Paterno</th>
				  <th width="120">Materno</th>
				  <th width="120">Nombres</th>
				  <th width="16">&nbsp;</th>
				</tr>
				<tr>
				  <th>&nbsp;</th>
				  <th><input name="rCod_prf" type="text" class="" id="rCod_prf" size="7" maxlength="7"/></th>
				  <th><input name="rPaterno" type="text" class="" id="rPaterno" size="20" maxlength="20"/></th>
				  <th><input name="rMaterno" type="text" class="" id="rMaterno" size="20" maxlength="20"/></th>
				  <th><input name="rNombres" type="text" class="" id="rNombres" size="30" maxlength="30"/></th>
				  <th>&nbsp;</th>
			  </tr>
			<?
			$tCarga = "cargaint".$_SESSION['sFrameano_aca'];
			
			$vQuery = "select ca.cod_car, ca.pln_est, ca.cod_cur, ca.mod_mat, ca.sec_gru, cu.nom_cur, cu.sem_anu, ";
			$vQuery .= "cu.cod_esp, gr.sec_des, mn.not_des, cr.car_des ";
			$vQuery .= "from $tCarga ca left join curso cu on ca.cod_car = cu.cod_car and ";
			$vQuery .= "ca.pln_est = cu.pln_est and ca.cod_cur = cu.cod_cur ";
			$vQuery .= "left join grupo gr on ca.sec_gru = gr.sec_gru ";
			$vQuery .= "left join modnot mn on ca.mod_mat = mn.mod_not ";
			$vQuery .= "left join carrera cr on ca.cod_car = cr.cod_car ";
			$vQuery .= "where ca.per_aca = '{$_SESSION['sFrameper_aca']}' and cod_prf = '{$_SESSION['sUsercod_usu']}' ";
			$vQuery .= "order by cod_car, sem_anu, cod_esp, sec_gru ";
			
			$cResult = fQuery($vQuery);
			$vNum_rows = fCountq($cResult);
			while($aResult = mysql_fetch_array($cResult))
			{
			?>
				<tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$vCont?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['nom_cur']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['sem_anu']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=$aResult['cod_esp']?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><?=ucwords(strtolower($aResult['sec_des']))?></td>
				  <td <?=ftdstyle($vNum_rows, $vCont)?>><a href="" onclick="lst_viewestumat('<?=$aResult['cod_car']?>', '<?=$aResult['pln_est']?>', '<?=$aResult['cod_cur']?>', '<?=$aResult['sec_gru']?>', '<?=$aResult['mod_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver estudiantes" width="16" height="16" /></a></td>
				</tr>
			<? 
				$vCont++; 	
			} 
			?>
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
