<?php
	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";

	if(!fverifyss2())
		header("Location:../.");

	$sUser['recorda'] = $_POST['rRecorda'];
	$sUser['oemail'] = $_POST['rOemail'];
	$sUser['tip_doc'] = $_POST['rTip_doc'];
	$sUser['num_doc'] = $_POST['rNum_doc'];
	$sUser['sexo'] = $_POST['rSexo'];
	$sUser['dia'] = $_POST['rDia'];
	$sUser['mes'] = $_POST['rMes'];
	$sUser['ano'] = $_POST['rAno'];
	$sUser['fec_nac'] = "19{$sUser['ano']}-{$sUser['mes']}-{$sUser['dia']}";
	$sUser['direc'] = $_POST['rDirec'];
	$sUser['fono'] = $_POST['rFono'];
	$sUser['celular'] = $_POST['rCelular'];
	$sUser['est_civ'] = $_POST['rEst_civ'];
	$sUser['cod_nac'] = $_POST['rCod_nac'];
	if(!empty($_POST['rCod_dep']))	$sUser['cod_dep'] = $_POST['rCod_dep'];
	if(!empty($_POST['rCod_prv']))	$sUser['cod_prv'] = $_POST['rCod_prv'];
	if(!empty($_POST['rCod_dis']))	$sUser['cod_dis'] = $_POST['rCod_dis'];
	
	
	if(fverifysd())
	{
		$bInsert = FALSE;
		if ($sUser['tip_usu'] == '1')
		{					
			$vQuery1 = "update unapnet.estudiante set tip_doc = '{$sUser['tip_doc']}', num_doc = '{$sUser['num_doc']}', ";
			$vQuery1 .= "fch_nac = '{$sUser['fec_nac']}', sexo = '{$sUser['sexo']}', est_civ = '{$sUser['est_civ']}', ";
			$vQuery1 .= "cod_nac = '{$sUser['cod_nac']}', cod_dep = '{$sUser['cod_dep']}', cod_prv = '{$sUser['cod_prv']}', ";
			$vQuery1 .= "cod_dis = '{$sUser['cod_dis']}', direc = '{$sUser['direc']}', fono = '{$sUser['fono']}', ";
			$vQuery1 .= "celular = '{$sUser['celular']}' ";
			$vQuery1 .= "where num_mat = '{$sUser['codigo']}' and cod_car = '{$sUser['cod_car']}'";
			
			$vQuery2 = "update unapnet.usuest set recorda = '{$sUser['recorda']}', oemail = '{$sUser['oemail']}' ";
			$vQuery2 .= "where login = '{$sUser['login']}'";
			
			$bInsert = fUpusu($vQuery1, $vQuery2);
		}
		elseif ($sUser['tip_usu'] == '2')
		{
			$vQuery1 = "update unapnet.docente set tip_doc = '{$sUser['tip_doc']}', num_doc = '{$sUser['num_doc']}', ";
			$vQuery1 .= "fch_nac = '{$sUser['fec_nac']}', sexo = '{$sUser['sexo']}', est_civ = '{$sUser['est_civ']}', ";
			$vQuery1 .= "cod_nac = '{$sUser['cod_nac']}', cod_dep = '{$sUser['cod_dep']}', cod_prv = '{$sUser['cod_prv']}', ";
			$vQuery1 .= "cod_dis = '{$sUser['cod_dis']}', direc = '{$sUser['direc']}', fono = '{$sUser['fono']}', ";
			$vQuery1 .= "celular = '{$sUser['celular']}' ";
			$vQuery1 .= "where cod_prf = '{$sUser['codigo']}'";
			
			$vQuery2 = "update unapnet.usuest set recorda = '{$sUser['recorda']}', oemail = '{$sUser['oemail']}' ";
			$vQuery2 .= "where login = '{$sUser['login']}'";
			
			$bInsert = fUpusu($vQuery1, $vQuery2);
		}
												
		if($bInsert)
			header("Location:mydata.php");
		else
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = "ERROR, NO SE PUDO ACTUALIZAR LOS DATOS, INTENTELO DE NUEVO";
			header("Location:getdata.php");
		}		
	}
	else
		header("Location:getdata.php");	
?>