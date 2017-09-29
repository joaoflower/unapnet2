<?php
	//header("Content-type: application/msword");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=notaacta.xls");
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	
	if(!fverifyds2())
		header("Location:../.");
	
		//-------------------------------------------------------
	$vSendData = $_GET['rSendData'];
	$rCod_car = substr($vSendData, 20, 4);
	$rPln_est = substr($vSendData, 44, 4);
	$rCod_cur = substr($vSendData, 68, 6);
	$rSec_gru = substr($vSendData, 94, 4);
	$rMod_mat = substr($vSendData, 118, 4);

	$vQuery = "Select 0x$rCod_car as cod_car, 0x$rPln_est as pln_est, 0x$rCod_cur as cod_cur, 0x$rSec_gru as sec_gru, ";
	$vQuery .= "0x$rMod_mat as mod_mat ";
	$cDatos = fQuery($vQuery);
	if($aDatos = mysql_fetch_array($cDatos))
	{
		$vCod_car = $aDatos['cod_car'];
		$vPln_est = $aDatos['pln_est'];
		$vCod_cur = $aDatos['cod_cur'];	
		$vSec_gru = $aDatos['sec_gru'];
		$vMod_mat = $aDatos['mod_mat'];
	}

	if(!empty($sCarrera[$vCod_car]))
	{
		$vCont = 0;
		$vCan_cap = 0;
		$vCan_act = 0;

		$vPro_cap = 0;
		$vPro_act = 0;
		$vPro_fin = 0;

		$tCurmat = "unapnet.curmat{$vCod_car}{$sUser['ano_aca']}";
		$tNotaca = "unapnet.notaca{$vCod_car}{$sUser['ano_aca']}";
		$tApla = "unapnet.apla{$sUser['ano_aca']}";

		$cNotacap = "";
		$cNotaact = "";

		$sUser['cod_car_cur'] = $vCod_car;
		$sEspecial = "";
		
		$vQuery = "Select cu.nom_cur, cu.niv_est, cu.sem_anu, cu.crd_cur, cu.cod_esp, es.esp_nom ";
		$vQuery .= "from unapnet.curso cu left join unapnet.especial es on cu.cod_esp = es.cod_esp and ";
		$vQuery .= "cu.pln_est = es.pln_est and cu.cod_car = es.cod_car ";
		$vQuery .= "where cu.cod_car = '$vCod_car' and  cu.pln_est = '$vPln_est' and cu.cod_cur = '$vCod_cur'";
		$cCurso = fQuery($vQuery);
		if($aCurso = mysql_fetch_array($cCurso))
		{
			$sUser['nom_cur'] = $aCurso['nom_cur'];
			$sUser['niv_est'] = strtoupper($sNivel[$aCurso['niv_est']]);
			$sUser['sem_anu'] = strtoupper($sSemestre[$aCurso['sem_anu']]);
			$sUser['crd_cur'] = $aCurso['crd_cur'];
			$sUser['cod_esp'] = strtoupper($aCurso['esp_nom']);		
			$sUser['sec_gru'] = strtoupper($sGrupo[$vSec_gru]);
			$sUser['mod_mat'] = strtoupper($sModnot[$vMod_mat]);	
		}
		else
			header("Location:actas.php");

		if($vMod_mat == '02' or $vMod_mat == '08')
		{
			$vQuery = "Select es.num_mat, es.paterno, es.materno, es.nombres, ap.mod_mat ";
			$vQuery .= "from $tApla ap left join unapnet.estudiante es on ap.num_mat = es.num_mat and ap.cod_car = es.cod_car ";
			$vQuery .= "where ap.cod_car  = '$vCod_car' and ap.per_aca = '{$sUser['per_aca']}' and ap.pln_est = '$vPln_est' and ";
			$vQuery .= "ap.cod_cur = '$vCod_cur' and ap.sec_gru = '$vSec_gru' and ap.mod_mat = '$vMod_mat' ";
			$vQuery .= "order by paterno, materno, nombres ";
		}
		else
		{
			$vQuery = "Select es.num_mat, es.paterno, es.materno, es.nombres, cm.mod_mat ";
			$vQuery .= "from $tCurmat cm left join unapnet.estudiante es on cm.num_mat = es.num_mat and cm.cod_car = es.cod_car ";
			$vQuery .= "left join unapnet.modmat mm on cm.mod_mat = mm.mod_mat ";
			$vQuery .= "where cm.pln_est = '$vPln_est' and cm.cod_cur = '$vCod_cur' and cm.sec_gru = '$vSec_gru' and ";
			$vQuery .= "cm.per_aca = '{$sUser['per_aca']}' and mm.mod_act = '$vMod_mat' ";
			$vQuery .= "order by paterno, materno, nombres ";
		}
		$cEstumat = fQuery($vQuery);
		$sEstupdf = "";

		//----------------------------------------------------
		$vQuery = "select max(no.ord_not) as ord_not ";
		$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
		$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and no.per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "no.ano_aca = '{$sUser['ano_aca']}' and mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and ";
		$vQuery .= "no.tip_not = 'C'";
		$cCan_cap = fQuery($vQuery);
		if($aCan_cap = mysql_fetch_array($cCan_cap))
			$vCan_cap = $aCan_cap['ord_not'];

		//----------------------------------------------------
		$vQuery = "select max(no.ord_not) as ord_not ";
		$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
		$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and no.per_aca = '{$sUser['per_aca']}' and ";
		$vQuery .= "no.ano_aca = '{$sUser['ano_aca']}' and mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and ";
		$vQuery .= "no.tip_not = 'A'";
		$cCan_act = fQuery($vQuery);
		if($aCan_act = mysql_fetch_array($cCan_act))
			$vCan_act = $aCan_act['ord_not'];
		
		(empty($vCan_cap)?$vCan_cap=0:$vCan_cap=$vCan_cap);
		(empty($vCan_act)?$vCan_act=0:$vCan_act=$vCan_act);
	
		//----------------------------------------------------
		if($vCan_cap > 0)
		{
			$vQuery = "select no.num_mat, no.ord_not, no.not_cur ";
			$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
			$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and ";
			$vQuery .= "no.per_aca = '{$sUser['per_aca']}' and no.ano_aca = '{$sUser['ano_aca']}' and ";			
			$vQuery .= "mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and no.tip_not = 'C'";
			$cNotacap2 = fQuery($vQuery);
			while($aNotacap2 = mysql_fetch_array($cNotacap2))
				$cNotacap[$aNotacap2['num_mat']][$aNotacap2['ord_not']] = $aNotacap2['not_cur'];
		}			
		if($vCan_act > 0)
		{
			$vQuery = "select no.num_mat, no.ord_not, no.not_cur ";
			$vQuery .= "from $tNotaca no left join unapnet.modnot mn on no.mod_not = mn.mod_not ";
			$vQuery .= "where no.pln_est = '$vPln_est' and no.cod_cur = '$vCod_cur' and ";
			$vQuery .= "no.per_aca = '{$sUser['per_aca']}' and no.ano_aca = '{$sUser['ano_aca']}' and ";			
			$vQuery .= "mn.mod_act = '$vMod_mat' and no.cod_car = '$vCod_car' and no.tip_not = 'A'";
			$cNotaact2 = fQuery($vQuery);
			while($aNotaact2 = mysql_fetch_array($cNotaact2))
				$cNotaact[$aNotaact2['num_mat']][$aNotaact2['ord_not']] = $aNotaact2['not_cur'];
		}			
	
		$vNombre = strtoupper("{$sUser['paterno']} {$sUser['materno']}, {$sUser['nombres']}");
	}
	else
	{
		header("Location:actas.php");
	}
?>

<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">            
			
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Facultad:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sFacultad[$sUser['cod_car_cur']]?></td>
  </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Escuela Prof. </strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sCarrera[$sUser['cod_car_cur']]?></td>
  </tr>
			<tr>
			  <td width="20" class="wordderb">&nbsp;</td>
			  <td width="120" align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Curso:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sUser['nom_cur']?></td>
	        </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Nivel:</strong></td>
			  <td width="110" class="tdcampo">&nbsp;<?=$sUser['niv_est']?></td>
			  <td width="120" align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Semestre:</strong></td>
			  <td width="110" class="tdcampo">&nbsp;<?=$sUser['sem_anu']?></td>
			</tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Especialidad:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$sUser['cod_esp']?></td>
	        </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
              <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Grupo: </strong></td>
			  <td class="tdcampo">&nbsp;<?=$sUser['sec_gru']?></td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Modalidad:</strong></td>
			  <td class="tdcampo">&nbsp;<?=$sUser['mod_mat']?></td>
		    </tr>
			<tr>
			  <td class="wordderb">&nbsp;</td>
			  <td align="right" bgcolor="#CCCCCC" class="wordderb"><strong>Docente:</strong></td>
			  <td colspan="3" class="tdcampo">&nbsp;<?=$vNombre?></td>
		    </tr>
			
			<tr>
			  <td colspan="5" class="wordcen"></td>
		    </tr>					
</table>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
  <tr>
    <th width="30" rowspan="2" bgcolor="#DDDDDD" scope="col">Nro</th>
    <th width="50" rowspan="2" bgcolor="#DDDDDD" scope="col">Num.Mat</th>
    <th width="280" rowspan="2" bgcolor="#DDDDDD" scope="col">Apellidos y Nombres </th>
    <th width="100" rowspan="2" bgcolor="#DDDDDD" scope="col">Modalidad</th>
    <th rowspan="2" bgcolor="#DDDDDD" scope="col">&nbsp;</th>
    <th bgcolor="#DDDDDD" scope="col">Capacidades</th>
    <th rowspan="2" bgcolor="#FFFF00" scope="col">PC</th>
    <th bgcolor="#DDDDDD" scope="col">Actitudes</th>
    <th rowspan="2" bgcolor="#FFFF00" scope="col">PA</th>
    <th rowspan="2" bgcolor="#FFFF00" scope="col">PF</th>
  </tr>
  <tr>
    <th align="left" bgcolor="#DDDDDD" scope="col"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdainpar">
			<?	for($i = 0; $i < $vCan_cap;$i++)	{  ?>
		   <th align="center">C-<?=$i+1?></th>
			<?	}	?>
		 </tr>
    </table></th>
    <th align="left" bgcolor="#DDDDDD" scope="col"><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdainpar">
			<?	for($i = 0; $i < $vCan_act;$i++)	{  ?>
		   <th align="center">A-<?=$i+1?></th>
			<?	}	?>
		 </tr>
    </table></th>
  </tr>
<? 	
	while($aEstumat = mysql_fetch_array($cEstumat))
	{
		$vPro_cap = 0;
		$vPro_act = 0;
		$vApe_nom = ucwords(strtolower("{$aEstumat['paterno']} {$aEstumat['materno']}, {$aEstumat['nombres']}"));					
		
		$vCont++;	
?>
  <tr>
    <td class="wordcen"><?=$vCont?></td>
    <td>&nbsp;<?=$aEstumat['num_mat']?></td>
    <td>&nbsp;<?=$vApe_nom?></td>
    <td>&nbsp;<?=$sModmat[$aEstumat['mod_mat']]?></td>
    <td>&nbsp;</td>
    <td><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		<tr class="celdainpar">
			<?	for($i = 0; $i < $vCan_cap;$i++)	{	$vPro_cap += $cNotacap[$aEstumat['num_mat']][$i+1];  ?>
		   <td width="17" align="right" > <font color="#<?=($cNotacap[$aEstumat['num_mat']][$i+1]>10?"0000FF":"FF0000")?>" >
				<?=$cNotacap[$aEstumat['num_mat']][$i+1]?></font></td>
			<?	}	?>
	    </tr>
    </table></td>
    <td><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdapar">
			<?	if($vCan_cap > 0)	{	$vPro_cap = round($vPro_cap/$vCan_cap);	?>
		   <th width="17" align="right" bgcolor="#FFFF00" ><font color="#<?=($vPro_cap>10?"0000FF":"FF0000")?>" ><?=$vPro_cap?></font></th>
			<?	}	?>
		 </tr>
    </table></td>
    <td><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdainpar">
			<?	for($i = 0; $i < $vCan_act;$i++)	{	$vPro_act += $cNotaact[$aEstumat['num_mat']][$i+1];  ?>
		   <td width="13" align="right"><font color="#0000FF"><?=$cNotaact[$aEstumat['num_mat']][$i+1]?></font></td>
			<?	}	?>
		 </tr>
    </table></td>
    <td><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdapar">
			<?	if($vCan_act > 0)	{	$vPro_act = round($vPro_act/$vCan_act);	?>
		   <th width="17" align="right" bgcolor="#FFFF00" > <font color="#0000FF"><?=$vPro_act?></font></th>
			<?	}	?>
		 </tr>
    </table></td>
    <td><table border="1" cellpadding="1" cellspacing="0" bordercolor="#BDD37B" rules="cols, rows" class="tabled">
		 <tr class="celdainpar">
			<?	if($vCan_cap > 0 || $vCan_act > 0)	
				{	
					if($vCan_act > 0)	$vPro_fin = round(($vPro_cap * 0.9) + $vPro_act);	
					else $vPro_fin = $vPro_cap;
			?>
		   <th width="18" align="right" bgcolor="#FFFF00"> <font color="#<?=($vPro_fin>10?"0000FF":"FF0000")?>" ><?=$vPro_fin?></font></th>
			<?	}	?>
		 </tr>
    </table></td>
  </tr>
<? 	}	?>
</table>
