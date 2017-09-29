
<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	if(fsafetylogin())
	{
		$vCont = 1;
		$bDatos = FALSE;
	}
	else
	{
		header("Location:../index.php");
	}
	
	$vQuery = "Select num_mat, cod_car, paterno, materno, nombres from estudiante where (con_est = '1' or con_est = 'V') ";

	if(!empty($_POST['rNum_mat']))
	{
		if(!empty($_POST['rNum_mat']))
			$vQuery .= "and num_mat like '{$_POST['rNum_mat']}%'";
			
		$vQuery .= " order by paterno, materno, nombres limit 5 ";
		$bDatos = TRUE;
	}
	
	if($bDatos == TRUE)
	{	
		?>
        
        <table border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tlistsearch">
        <?
		
		$cResult = fQuery($vQuery);
		$vNum_rows = fCountq($cResult);
		while($aResult = mysql_fetch_array($cResult))
		{
		?>
			<tr <?=ftrstyle($vCont)?>  onMouseOver="mouseover(this)" onMouseOut="mouseout(this)">
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="10"><?=$vCont?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="80"><?=ucwords(strtolower($aResult['num_mat']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['paterno']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['materno']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['nombres']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="16"><a href="" onclick="con_viewpasswdestu('<?=$aResult['num_mat']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver datos de Estudiante" width="16" height="16" /></a></td>
			</tr>
		<? 
			$vCont++;
		} 
		?>
        </table>
        <?
	}	

	?>
		