
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
	
	$vQuery = "Select cod_prf, cod_car, paterno, materno, nombres from docente where cnd_act = '1' ";

	if((!empty($_POST['rCod_prf']) or !empty($_POST['rPaterno']) or !empty($_POST['rMaterno']) or !empty($_POST['rNombres'])))
	{
		if(!empty($_POST['rCod_prf']))
			$vQuery .= "and cod_prf like '{$_POST['rCod_prf']}%'";			
		if(!empty($_POST['rPaterno']))
			$vQuery .= "and paterno like '{$_POST['rPaterno']}%'";		
		if(!empty($_POST['rMaterno']))
			$vQuery .= "and materno like '{$_POST['rMaterno']}%'";			
		if(!empty($_POST['rNombres']))
			$vQuery .= "and nombres like '{$_POST['rNombres']}%'";			
			
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
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="80"><?=ucwords(strtolower($aResult['cod_prf']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['paterno']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['materno']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="120"><?=ucwords(strtolower($aResult['nombres']))?></td>
			  <td <?=ftdstyle($vNum_rows, $vCont)?> width="16"><a href="" onclick="con_viewpasswd('<?=$aResult['cod_prf']?>'); return false;" class="enlaceb"><img src="../images/browse.png" alt="Ver datos de Docente" width="16" height="16" /></a></td>
			</tr>
		<? 
			$vCont++; 	
		} 
		?>
        </table>
        <?
	}	

	?>
		